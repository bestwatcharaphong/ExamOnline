<?php
	require_once('../ThaiPDF/thaipdf.php');
	ob_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>ระบบข้อสอบออนไลน์</title>

		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

	</head>
	<body>

		<?php
			session_start();
			if(!isset($_SESSION['login_id'])) {				/*สำหรับผู้ใช้ทั่วไปที่ยังไม่ได้เข้าสู่ระบบ */
				header("Location: ../form_login.php");
			}

			require '../connectdb.php';						/*สำหรับอาจารย์และนักศึกษาที่เข้าสู่ระบบแล้ว */
			$session_login_id = $_SESSION['login_id'];

			$query_user = "select * from user where user_id = '$session_login_id'";
			$result_user = mysqli_query($conn, $query_user);

			if ($result_user->num_rows == 1) {
				$row_user = mysqli_fetch_array($result_user, MYSQLI_ASSOC);
				$user_id = $row_user['user_id'];
				$fname = $row_user['fname'];
				$lname = $row_user['lname'];
				$email = $row_user['email'];
				$role = $row_user['role'];
				mysqli_free_result($result_user);
			?>

			<?php
				if($row_user['role'] == 1) {			/*สำหรับอาจารย์*/
			?>

				   <div class="container">
		    			<div class="container-content has-shadow">

							<?php
								$set_id = $_GET['set_id'];

								require '../connectdb.php';

								$query = "select * from exam_set where set_id = $set_id";
								$result = mysqli_query($conn, $query);
								$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

								$subject_id = $row['subject_id'];
								$query_subject = "select * from subject where subject_id = '$subject_id'";
								$result_subject = mysqli_query($conn, $query_subject);
								$row_subject = mysqli_fetch_array($result_subject, MYSQLI_ASSOC);
								$subject_name = $row_subject['subject_name'];

								$query_instructor = "select * from subject, user where subject_id = '$subject_id' AND
									user.user_id = subject.instructor_id";
								$result_instructor = mysqli_query($conn, $query_instructor);
								$row_instructor = mysqli_fetch_array($result_instructor, MYSQLI_ASSOC);
								$instructor_name = $row_instructor['fname'];

								$query = "select * from score, exam_set
									where score.set_id = '$set_id'
									AND score.set_id = exam_set.set_id";
								$result = mysqli_query($conn, $query);
								$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
								$full_score = $row['full_score'];
							?>

							<strong>รายวิชา &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $subject_id . "&nbsp;&nbsp; " . $subject_name ?></strong><br>
							ชุดข้อสอบ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['set_name']; ?><br>
							อาจารย์ผู้สอน &nbsp;&nbsp;&nbsp;<?php echo $row_instructor['fname'] . " " . $row_instructor['lname'] ?><br><br>
							<table style="width: 70%;" align="Center">
								<thead>
									<tr>
										<th style="width: 10%; border: 1; height: 25px;"></th>
										<th style="border: 1; height: 25px;" align="center">รหัสนักศึกษา</th>
										<th style="width: 40%; border: 1; height: 25px;" align="center">ชื่อ-สกุล</th>
										<th style="width: 20%; border: 1; height: 25px;" align="center">
											คะแนน (<?php echo $full_score; ?>)
											<?php
												for($i = 0; $i <= $full_score; $i++){
													$score[$i] = 0;
												}
											?>
										</th>
									</tr>
								</thead>
								<tbody>

							<?php
								$query = "select * from score, exam_set, user
									where score.set_id = '$set_id'
									AND score.set_id = exam_set.set_id
									AND score.user_id = user.user_id";
								$result = mysqli_query($conn, $query);

								$count = 0;
								while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
									$count++;
							?>
									<tr>
										<td style="border: 1; height: 25px;" align="center"><?php echo $count; ?></td>
										<td style="border: 1; height: 25px;" align="center"><?php echo $row['user_id']; ?></td>
										<td style="width: 40%; border: 1; height: 25px;" align="center"><?php echo $row['fname'] . " &nbsp;" . $row['lname']; ?></td>
										<td style="width: 20%; border: 1; height: 25px;" align="center">
											<?php echo $row['score']; ?>
											<?php $score[$row['score']]++; ?>
										</td>
									</tr>
							<?php
								}

							?>
							<?php
								/* Find Max, Min */
								$query = "select min(score) as min, max(score) as max, avg(score) as avg
									from score, exam_set, user
									where score.set_id = '$set_id'
									AND score.set_id = exam_set.set_id
									AND score.user_id = user.user_id";
								$result = mysqli_query($conn, $query);
								$values = mysqli_fetch_assoc($result);
							?>
									<tr>
										<td></td>
										<td></td>
										<td style="border: 1; height: 25px;" align="center">สูงสุด</td>
										<td style="border: 1; height: 25px;" align="center"><?php echo $values['max'] ?></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td style="border: 1; height: 25px;" align="center">ต่ำสุด</td>
										<td style="border: 1; height: 25px;" align="center"><?php echo $values['min'] ?></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td style="border: 1; height: 25px;" align="center">ค่าเฉลี่ย</td>
										<td style="border: 1; height: 25px;" align="center"><?php echo round($values['avg'], 2) ?></td>
									</tr>

								</tbody>
							</table>
							<br><br>

								<table style="width: 50%;" align="Center">
									<tr>
										<th align="center" style="border: 1; height: 25px;">คะแนน</th>
										<th align="center" style="border: 1; height: 25px;">จำนวน (คน)</th>
										<th align="center" style="border: 1; height: 25px;">ร้อยละ</th>
									</tr>
							<?php
								for ($i=0; $i <= $full_score; $i++) {
									$percent = round(($score[$i] / $count) * 100, 2);
							?>
									<tr>
										<td align="center" style="border: 1; height: 25px;"><?php echo $i; ?></td>
										<td align="center" style="border: 1; height: 25px;"><?php echo $score[$i]; ?></td>
										<td align="center" style="border: 1; height: 25px;">
											<?php echo $percent; ?>
										</td>
									</tr>
							<?php
								}
							?>
								</table>

			   			</div>
			   		 </div> <!-- /container -->

			<?php
				} else {
					require '../access_denied.php';
				}
			}
		?>

	</body>
</html>

<?php
	$html = ob_get_clean();
	$__pdf_pgn_show=false;
	pdf_html($html);
	pdf_echo();
?>
