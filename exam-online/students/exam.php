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

		$role_name = "";
		if($role == 0){
			$role_name = "ผู้ดูแลระบบ";
		}else if($role == 1){
			$role_name = "อาจารย์";
		}else if($role == 2){
			$role_name = "นักศึกษา";
		}else if($role == 10){
			$role_name = "ไม่มีบทบาท";
		}

		mysqli_free_result($result_user);
?>
<!DOCTYPE html>
<html class="fp-enabled" style="overflow: visible; height: initial;">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>ระบบข้อสอบออนไลน์</title>

	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link href="../orange_files/css" rel="stylesheet">
    <link href="../orange_files/hover-min.css" rel="stylesheet" media="all">
    <link href="../orange_files/font-awesome.min.css" rel="stylesheet" media="all">

    <link rel="stylesheet" href="../orange_files/animate.min.css">
  	<link rel="stylesheet" href="../orange_files/site.css">

    <meta name="format-detection" content="telephone=no">

	<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
    <script async="" src="../orange_files/analytics.js.download"></script>
	<script type="text/javascript" async="" src="../orange_files/recaptcha__en.js.download"></script>

	<script src="../orange_files/jquery.min.js.download"></script>
    <script src="../orange_files/bootstrap.min.js.download"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <link href="../orange_files/bootstrap.min.css" rel="stylesheet">
    <link href="../orange_files/bootstrap-theme.min.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../orange_files/layout.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="../js/app.js"></script>

	<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css">
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../orange_files/jquery.fullPage.css">
	<link rel="stylesheet" type="text/css" href="../orange_files/examples.css">
	<link type="text/css" rel="stylesheet" href="../css/orange_style.css">

</head>
<body style="overflow: visible; height: initial; color: #333; color: rgba(0,0,0,0.8);" class="Design fp-responsive fp-viewing-Ecommerce" onLoad="begintimer()">

	<div class="container-fluid">
	    <div class="row wrap_menu sticky">

			<div class="col-xs-6 col-sm-2 col-md-2 sm-nopad-right">
	            <a class="link_logo hvr-shrink" href="../main.php">ระบบข้อสอบออนไลน์</a>
	        </div>
	        <div class="col-xs-6 col-sm-7 col-md-7 wrap_menu-z">
	           <div class="menubar">

	               <div class="navbar-header">
					   <!-- Navbar -->
		                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		                  <span class="sr-only">Toggle navigation</span>
		                  <span class="icon-bar"></span>
		                  <span class="icon-bar"></span>
		                  <span class="icon-bar"></span>
		                </button>

						<!-- Sidebar -->
						<button type="button" class="navbar-toggle collapsed" aria-expanded="false" id="menu-toggle" style="float: left;">
						    <span class="sr-only">Toggle navigation</span>
						    <span class="icon-bar" style="width: 27px;"></span>
						    <span class="icon-bar" style="width: 20px;"></span>
						    <span class="icon-bar" style="width: 16px;"></span>
						</button>
					</div>

					<?php
						if($row_user['role'] == 2 && isset($_GET['set_id'])) {			/*สำหรับนักศึกษา*/
							$set_id = $_GET['set_id'];

							$query = "select subject_id from exam_set WHERE set_id = '$set_id'";
							$result = mysqli_query($conn, $query);
							$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

							$subject_id = $row['subject_id'];

							$query = "select * from enroll WHERE user_id = '$user_id' AND subject_id = '$subject_id'";
							$result = mysqli_query($conn, $query);

							if($result->num_rows == 1){									/*สำหรับนักศึกษาที่ได้ลงทะเบียนเรียนวิชานี้*/

								$query = "select * from exam_set WHERE set_id = '$set_id'";
								$result = mysqli_query($conn, $query);
								$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

								if($row['activeflag'] == 1){							/*สำหรับข้อสอบที่เปิดให้ทำ*/

									$query_score = "SELECT user_id, set_id FROM score WHERE user_id = '$user_id' AND set_id = $set_id";
									$result_score = mysqli_query($conn, $query_score);
									$row_score = mysqli_fetch_array($result_score, MYSQLI_ASSOC);

									if($result_score->num_rows == 0){					/*สำหรับนักศึกษาที่ยังไม่ทำข้อสอบชุดนี้ที*/
					?>


	                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-bottom: 11px;">
	                      <ul id="menu" class="nav navbar-nav">
	                        <li data-menuanchor="firstPage"><a href="../main.php" class="hvr-shrink">หน้าหลัก</a></li>
							<li class="dropdown">
								<a class="dropdown-toggle hvr-shrink" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $fname . " " . $lname; ?>
	 							   <?php echo "(" . $role_name . ")"; ?>
	 							   <span class="caret"></span>
	 						   </a>
							   <ul class="dropdown-menu">
								  <li style="padding-top: 14px;"><a href="../logout.php">ออกจากระบบ</a></li>
							   </ul>
							</li>
	                      </ul>
	                </div><!-- /.navbar-collapse -->

	             </div>
	         </div>
	      </div>
	   </div> <!--END container-fluid-->

						  <div class="container">
								<div class="container-content">

									 <!-- Sidebar -->
									 <div class="nav navbar-default" role="navigation">
											 <div id="sidebar-wrapper" class="sidebar-toggle" align="center">
												 <ul class="sidebar-nav">
													 <li><a href="../main.php">รายวิชา</a></li>
													 <li class="sidebar-selected"><a href="#">ทำข้อสอบ</a></li>
													 <li><a href="score_summary.php">คะแนน</a></li>
													 <li><a href="student_enroll.php">ลงทะเบียนเรียน</a></li>
												 </ul>
											 </div>
									  </div>


									  <?php
										  require '../connectdb.php';
										  date_default_timezone_set("Asia/Bangkok");

										  $set_id = $_GET['set_id'];
										  $subject_id = $_GET['subject_id'];

										  $date = date("Y-m-d H:i:s");
										  $query_begin_exam = "INSERT into score (user_id, set_id, score_date_time, score) values ('$user_id', $set_id, '$date', 0)";		/*เริ่มทำข้อสอบแล้วจะทำครั้งต่อไปอีกไม่ได้*/
				   					   	  $result_begin_exam = mysqli_query($conn, $query_begin_exam);

										  $query = "select * from exam_set where set_id = $set_id";
										  $result = mysqli_query($conn, $query);
										  $row = mysqli_fetch_assoc($result);
										  $set_time = $row['set_time'];
										  $set_name = $row['set_name'];
										  $subject_id = $row['subject_id'];

										  $query = "select subject_name from subject where subject_id = '$subject_id'";
										  $result = mysqli_query($conn, $query);
										  $row = mysqli_fetch_assoc($result);
										  $subject_name = $row['subject_name'];

										  $query = "select * from exam where set_id = $set_id";
										  $result = mysqli_query($conn, $query);
									  ?>

										  <div style="margin-top: 10px; font-family: san serif;">
											  <h4 style="font-size: 16px;">ข้อสอบรายวิชา :
												  <?php echo $subject_id; ?>
												  <?php echo $subject_name; ?>
											  </h4>
										  </div>

										  <!-- Timer -->
										  <div id="timer" align="right">
										  </div>

										  <form name="send_answer" id="send_answer" action="check_answer.php" method="post" style=" font-family: san serif;">

											 <h3 align="center" style="font-size: 20px;"><?php echo $set_name; ?></h3><br>

											  <?php
												  $count = 0;
												  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
													  $count++;
											  ?>
													  <?php echo $count; ?>
													  <?php echo ". "; ?>
													  <?php echo $row['question']; ?><br><br>

													  <div class="form-group">
														  <span style="margin-left: 20px;">

															  <label for="<?php echo $row['exam_id'] . "_1" ?>">
																  <input type="radio" name="<?php echo $row['exam_id']; ?>" id="<?php echo $row['exam_id'] . "_1" ?>" value="1" required>&nbsp;&nbsp;
																  <?php echo $row['choice1']; ?>
															  </label>
														  </span>
													  </div>
													  <div class="form-group">
														  <span style="margin-left: 20px;" class="wrappable">
															  <label for="<?php echo $row['exam_id'] . "_2" ?>">
																  <input type="radio" name="<?php echo $row['exam_id']; ?>" id="<?php echo $row['exam_id'] . "_2" ?>" value="2" required>&nbsp;&nbsp;
																  <?php echo $row['choice2']; ?>
															  </label>
														  </span>
													  </div>
													  <div class="form-group">
														  <span style="margin-left: 20px;">

															  <label for="<?php echo $row['exam_id'] . "_3" ?>">
																  <input type="radio" name="<?php echo $row['exam_id']; ?>" id="<?php echo $row['exam_id'] . "_3" ?>" value="3" required>&nbsp;&nbsp;
																  <?php echo $row['choice3']; ?>
															  </label>
														  </span>
													  </div>
													  <div class="form-group">
														  <span style="margin-left: 20px;">
															  <label for="<?php echo $row['exam_id'] . "_4" ?>">
																  <input type="radio" name="<?php echo $row['exam_id']; ?>" id="<?php echo $row['exam_id'] . "_4" ?>" value="4" required>&nbsp;&nbsp;
																  <?php echo $row['choice4']; ?>
															  </label>
														  </span>
													  </div>
											  <?php
												  if($row['choice5'] != ''){
											  ?>
													  <div class="form-group">
														  <span style="margin-left: 20px;">
															  <label for="<?php echo $row['exam_id'] . "_5" ?>">
																  <input type="radio" name="<?php echo $row['exam_id']; ?>" id="<?php echo $row['exam_id'] . "_5" ?>" value="5" required>&nbsp;&nbsp;
																  <?php echo $row['choice5']; ?>
															  </label>
														  </span>
													  </div>
												  <?php
													  }
												  ?>
											  <?php
												  }
												  mysqli_close($conn);
											  ?>
											  <input type="hidden" name="set_id" value="<?php echo $set_id; ?>">
											  <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">
											  <div  align="center">
												  <input type="submit" class="btn btn-primary btn-lg" value="ส่งคำตอบ"><br><br>
											  </div>
										  </form>


								</div><!--container-content-->
							</div><!--container-->

	<?php
						}else{			/*สำหรับนักศึกษาที่ทำข้อสอบชุดนี้แล้ว*/
							require '../access_denied.php';
						}
					}else{			/*สำหรับข้อสอบที่ปิดไม่ให้ทำ*/
						require '../access_denied.php';
					}
				}else{			/*สำหรับนักศึกษาที่ไม่ได้ลงทะเบียนเรียนวิชานี้*/
					require '../access_denied.php';
				}
			} else {		/*สำหรับ admin,อาจารย์หรือนักศึกษาที่พิมพ์ URL ใหม่*/
				require '../access_denied.php';
			}
		}

		require '../footer/footer.php';
	?>

	<script>
	   var set_time = <?php echo $set_time; ?>;
	   var limit = set_time + ":01";
	   if (document.images){
		   var parselimit = limit.split(":")
		   parselimit = parselimit[0] * 60 + parselimit[1] * 1		/*วินาที*/
	   }
	   function begintimer(){
		   if (!document.images)
			   return
		   if (parselimit == 1)
			   // เหตุการณ์ที่ต้องการให้เกิดขึ้น
			   // window.location = 'check_answer.php'; //ถ้าต้องการให้กระโดดไปยัง Page อื่น
			   send_answer.submit();
		   else{
			   parselimit -= 1
			   curmin = Math.floor(parselimit / 60)
			   cursec = parselimit % 60
			   if (curmin != 0)
				   curtime="เวลาที่เหลือ <font color=red> " + curmin + " </font>นาที <font color=red>"+cursec+" </font>วินาที "
			   else if(cursec == 0){
				   alert('หมดเวลาแล้ว');
			   }else{
				   curtime="เวลาที่เหลือ <font color=red font-size=20>" + cursec + " </font>วินาที "
			   }
			   document.getElementById('timer').innerHTML = curtime;
			   setTimeout("begintimer()", 1000)
		   }
	   }
   </script>

</body>
</html>
