<!DOCTYPE html>
<html style="overflow: visible; height: initial;">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>ระบบข้อสอบออนไลน์</title>

	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<script type="text/javascript" language="javascript" src="js/jquery.js"></script>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/send_email.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="orange_files/jquery.min.js.download"></script>
    <script src="orange_files/bootstrap.min.js.download"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>

	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>

	<link rel="stylesheet" type="text/css" href="orange_files/jquery.fullPage.css">
	<link rel="stylesheet" type="text/css" href="orange_files/examples.css">
	<link type="text/css" rel="stylesheet" href="css/orange_style.css">

</head>
<body>

	<?php
		session_start();
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

		$alert = "ไม่มีอีเมลนี้อยู่จริง";

		if(!isset($_SESSION['login_id'])) {		/*สำหรับผู้ใช้ทั่วไปที่ยังไม่ได้เข้าสู่ระบบ */
	?>
			<div class="container-fluid">
				<div class="row wrap_menu sticky">

					<div class="col-xs-6 col-sm-2 col-md-2 sm-nopad-right">
			            <a class="link_logo hvr-shrink" href="index.php">ระบบข้อสอบออนไลน์</a>
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
							</div>

							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-bottom: 11px;">
								  <ul id="menu" class="nav navbar-nav">
									  <li><a href="form_register.php" class="hvr-shrink"> ลงทะเบียน</a></li>
								      <li><a href="form_login.php" class="hvr-shrink"> เข้าสู่ระบบ</a></li>
								  </ul>
							</div><!-- /.navbar-collapse -->

						 </div>
					 </div>
				  </div>
			   </div> <!--END container-fluid-->
	<?php
		}else{									/*สำหรับ admin อาจารย์และนักศึกษาที่เข้าสู่ระบบแล้ว */
			header("Location: main.php");
		}
	?>	<!--END Navbar -->

	<?php
		if(isset($_POST['send-email'])){
			require 'connectdb.php';

			$email = $_POST['email'];

			$query = "select * from user WHERE email = '$email'";
			$result = mysqli_query($conn, $query);

			if($result->num_rows == 1){
				$token = "thisie6Nj23IfjsOjwe4B56Nj0l8H7dET82Pinines6Njdll";
				$token = str_shuffle($token);					/*นำตัวอักษรใน string มา random สลับตำแหน่งกัน*/
				$token = substr($token, 0, 40);
				$url = "http://localhost/exam-online/reset_password.php?token=$token&email=$email";
				$subject    = "Reset password";
				$body 		= "We heard that you lost your password. Sorry about that! <br>
							   But do not worry! You can use the following link to reset your password: $url <br>
							   Thanks";

				$query_token = "UPDATE user SET password_token = '$token' WHERE email = '$email'";
				$result_token = mysqli_query($conn, $query_token);

				/*ส่ง email */
				require 'vendor/autoload.php';

				$mail = new PHPMailer(true);

				//Server settings
				$mail->SMTPDebug = 2;                                 // Enable verbose debug output
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';  					  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = 'treeanut.22@gmail.com';            // SMTP username
				$mail->Password = 'wednesday22';                      // SMTP password
				$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                                    // TCP port to connect to

				//Recipients
				$mail->setFrom($email, 'Exam Online System');
				$mail->addAddress($email);     						  // Add a recipient

				//Content
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = $subject;
				$mail->Body    = $body;

				$alert = "ไม่มีอีเมลนี้อยู่จริง";

				if($mail->send()){									  /* ส่ง email สำเร็จ */
					mysqli_close($conn);
					$alert = "ตรวจสอบอีเมลของคุณเพื่อทำการกำหนดรหัสผ่านใหม่"
			?>
					<div class="form-group">
						<div class="alert alert-success alert-dismissible" role="alert" style="font-size: 25px;">
							ส่งอีเมลสำเร็จ! ตรวจสอบอีเมลของคุณเพื่อทำการกำหนดรหัสผ่านใหม่
						</div>
					</div>

			<?php
				}else{												 /* ส่ง email ไม่สำเร็จ */
					echo "<br><br>";
					echo '<h3 class="red">การส่งอีเมลผิดพลาด กรุณาทดลองใหม่</h3>';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				}
			}
		}
	?>

	<div class="container" style="">
	   <div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-body">

						<?php
		 					if(!isset($_POST['send-email'])){					/*ยังไม่มีการ submit */
		 			   ?>
		 						<form class="form-group" action="send_email.php" method="post">

		 						  <div align="center">
		 							  <h2 style="font-size: 20px; color: #fff;">กำหนดรหัสผ่านใหม่</h2>
		 						  </div>
		 						  <hr>

		 						  <div class="form-group">
		 							   ป้อนอีเมลของคุณแล้วเราจะส่งลิงก์ให้คุณกำหนดรหัสผ่านใหม่
		 						  </div>

		 						  <div class="form-group">
		 							 <input type="email" name="email" id="email" class="form-control" placeholder="ป้อนอีเมลของคุณ" required autofocus>
		 						  </div>
		 						  <button class="btn btn-success btn-block" type="submit" name="send-email">ตกลง</button><br>

		 						</form>
		 			   <?php
				   			}else{												/*่มีการ submit แล้ว */
								require 'connectdb.php';

								$email = $_POST['email'];

								$query = "select * from user WHERE email = '$email'";
								$result = mysqli_query($conn, $query);

								if($result->num_rows > 0){						/*มีอีเมลอยู่ในระบบ*/
					   ?>
								   <form class="form-group" action="send_email.php" method="post">

									 <div align="center">
										 <h2 style="font-size: 20px; color: #fff;">กำหนดรหัสผ่านใหม่</h2>
									 </div>
									 <hr>

									 <div class="form-group">
										 <div class="alert alert-success alert-dismissible" role="alert">
											 <?php echo $alert; ?>
										 </div>
									 </div>

									 <div class="form-group">
										<input type="email" name="email" id="email" class="form-control" placeholder="ป้อนอีเมลของคุณ" required autofocus>
									 </div>
									 <button class="btn btn-success btn-block" type="submit" name="send-email">ตกลง</button><br>

								   </form>

					   	<?php
				   				}else{											/*ไม่มีอีเมลอยู่ในระบบ*/
						?>

									<form class="form-group" action="send_email.php" method="post">

									  <div align="center">
										  <h2 style="font-size: 20px; color: #fff;">กำหนดรหัสผ่านใหม่</h2>
									  </div>
									  <hr>

									  <div class="form-group">
										  <div class="alert alert-success alert-dismissible" role="alert">
											  ไม่มีอีเมลของคุณในระบบ กรุณาป้อนอีเมลใหม่
										  </div>
									  </div>

									  <div class="form-group">
										 <input type="email" name="email" id="email" class="form-control" placeholder="ป้อนอีเมลของคุณ" required autofocus>
									  </div>
									  <button class="btn btn-success btn-block" type="submit" name="send-email">ตกลง</button><br>

									</form>
						<?php
							   }
		 					}
		 			   ?>

				   </div><!-- panel-body -->
			   </div><!-- panel-default -->
		   </div><!-- col -->
	   </div><!-- row -->
   </div><!--container-->

</body>
</html>
