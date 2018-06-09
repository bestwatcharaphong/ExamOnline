<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>ระบบข้อสอบออนไลน์</title>

	</head>
	<body>

		<?php
			session_start();
			if(!isset($_SESSION['login_id'])) {				/*สำหรับผู้ใช้ทั่วไปที่ยังไม่ได้เข้าสู่ระบบ */
				header("Location: form_login.php");
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
								$output = '';

								require '../connectdb.php';

								$query = "select * from exam_set
									where set_id = $set_id";
								$result = mysqli_query($conn, $query);
								$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

								$subject_id = $row['subject_id'];
								$set_name = $row['set_name'];
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

								$output .= '
									<strong>รายวิชา &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $subject_id . '&nbsp;&nbsp; ' . $subject_name . '</strong><br>
									ชุดข้อสอบ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $row['set_name'] . '<br>
									อาจารย์ผู้สอน &nbsp;&nbsp;&nbsp;' . $row_instructor['fname'] . ' ' . $row_instructor['lname'] . '<br><br>

									<table style="width: 40%;">
										<thead>
											<tr>
												<th style="width: 10%;"></th>
												<th align="center">รหัสนักศึกษา</th>
												<th style="width: 40%; align="center">ชื่อ-สกุล</th>
												<th style="width: 20%; align="center">
													คะแนน (' . $full_score . ')';
													for($i = 0; $i <= $full_score; $i++){
														$score[$i] = 0;
													}
								$output .= '
												</th>
											</tr>
										</thead>
										<tbody>
								';

								$query = "select * from score, exam_set, user
									where score.set_id = '$set_id'
									AND score.set_id = exam_set.set_id
									AND score.user_id = user.user_id";
								$result = mysqli_query($conn, $query);

								$count = 0;
								while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
									$count++;
									$output .= '
											<tr>
												<td align="center">' . $count . '</td>
												<td align="center">' . $row['user_id'] . '</td>
												<td style="width: 40%;" align="center">' . $row['fname'] . '  &nbsp;' . $row['lname'] . '</td>
												<td style="width: 20%;" align="center">' . $row['score'] . '</td>
											</tr>
									';
									$score[$row['score']]++;
								}
								$output .= '
										</tbody>
									</table>
									<br>
									<br>
									<br>
								';

								/* Find Max, Min */
								$query = "select min(score) as min, max(score) as max, avg(score) as avg
									from score, exam_set, user
									where score.set_id = '$set_id'
									AND score.set_id = exam_set.set_id
									AND score.user_id = user.user_id";
								$result = mysqli_query($conn, $query);
								$values = mysqli_fetch_assoc($result);

								$output .= '
									<table style="width: 40%;">
										<tbody>
											<tr>
												<td></td>
												<td></td>
												<td align="center">สูงสุด</td>
												<td align="center">' . $values['max'] . '</td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td align="center">ต่ำสุด</td>
												<td align="center">' . $values['min'] . '</td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td align="center">ค่าเฉลี่ย</td>
												<td align="center">' . round($values['avg'], 2) . '</td>
											</tr>
										</tbody>
									</table>
									<br><br><br>

									<table style="width: 50%;" align="Center">
										<tr>
											<th align="center" style="border: 1; height: 25px;">คะแนน</th>
											<th align="center" style="border: 1; height: 25px;">จำนวน (คน)</th>
											<th align="center" style="border: 1; height: 25px;">ร้อยละ</th>
										</tr>
								';
									for ($i=0; $i <= $full_score; $i++) {
										$percent = round(($score[$i] / $count) * 100, 2);
								$output .= '
										<tr>
											<td align="center" style="border: 1; height: 25px;">'. $i . '</td>
											<td align="center" style="border: 1; height: 25px;">' . $score[$i] . '</td>
											<td align="center" style="border: 1; height: 25px;">' . $percent . '
											</td>
										</tr>
								';
									}
								$output .= '
									</table>
								';

								$filename = "test";

								header("Content-Type: application/xls");
								header("Content-Disposition: attachment; filename = score-$set_name-$subject_id.xls");
								echo $output;
							?>

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
