<!DOCTYPE html>
<html style="overflow: visible; height: initial;">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>ระบบข้อสอบออนไลน์</title>

	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<script type="text/javascript" language="javascript" src="js/jquery.js"></script>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
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

	<style media="screen">
		.btn_onlinenquiry a:hover, a:focus, a:active{
			text-decoration: none;
			color: #b6ca68;
		}
	</style>

</head>
<body>

	<?php
		session_start();
		if(!isset($_SESSION['login_id'])) {		/*สำหรับผู้ใช้ทั่วไปที่ยังไม่ได้เข้าสู่ระบบ */
		$alert = false;
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
						      <li class="active"><a href="#"> เข้าสู่ระบบ</a></li>
	                      </ul>
	                </div><!-- /.navbar-collapse -->

	             </div>
	         </div>
	      </div>
	   </div> <!--END container-fluid-->

	   <?php
			   if(isset($_POST['login'])){
				  	require 'connectdb.php';

		 		  	$user_id      	= (isset($_POST['user_id'])) ? $_POST['user_id'] : '';
		 			$password     	= (isset($_POST['password'])) ? $_POST['password'] : '';
		 			$salt			= 'jakljfiwnRRjionooaliJKFLAjslkd';
		 			$hash_password	= hash_hmac('sha256', $password, $salt);

				    if(is_numeric($user_id)){
		 				$sql = "select * from user where user_id='" . $user_id . "' AND password='" . $hash_password . "'";
		 			}else{
		 				$sql = "select * from user where fname='" . $user_id . "' AND password='" . $hash_password . "'";
		 			}

				    if (!$conn) {
							die("การเชื่อมต่อฐานข้อมูลผิดพลาด : " . mysqli_connect_error());
					}else{
						mysqli_set_charset($conn, 'utf8');
						$result = mysqli_query($conn, $sql);
						$count  = mysqli_num_rows($result);
						if($count == 0) {
							$alert = true;
						} else {
							$row_user = mysqli_fetch_assoc($result);
							$_SESSION['login_id'] = $row_user['user_id'];	//เก็บรหัสผู้ใช้ไว้เพื่อใช้ในหน้าอื่นต่อไป				
							$_SESSION['login_role'] = $row_user['role'];
							header("Location: main.php");
						}

				   }
			}else{
				$alert = false;
			}
		}else{									/*สำหรับอาจารย์และนักศึกษาที่เข้าสู่ระบบแล้ว */
			header("Location: main.php");
		}
	?>

	   <div class="container">
		   <div class="row">
		   		<div class="col-md-4 col-md-offset-4">
					<div class="panel panel-default">
						<div class="panel-body">

							<form class="form-group" action="form_login.php" method="post">

							  <div align="center">
								   <h2 style="font-size: 25px; color: #fff;">เข้าสู่ระบบ</h2>
							  </div>
							  <hr>

							  <?php
								   if($alert){
							  ?>
									   <div class="alert alert-danger alert-dismissible" role="alert">									
										   ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง
									   </div>
							  <?php
									   $alert = false;
								   }
							  ?>

							  <div class="form-group">
								  <input type="text" name="user_id" id="user_id" class="form-control" placeholder="ชื่อผู้ใช้งาน..." required autofocus>
							  </div>

							  <div class="form-group">
								  <input type="password" name="password" id="password" class="form-control" placeholder="รหัสผ่าน..." required>
							  </div>

							  <div style="float: right;">
								   <a href="send_email.php" style="color: white;">ลืมรหัสผ่าน</a>
							  </div>

							  <div class="form-group" style="float: left;">
								  <label>
									  <input type="checkbox" id="remember-me">
									  จดจำฉันไว้
								  </label>
							  </div>

							  <button class="btn btn-primary btn-block" type="submit" name="login">เข้าสู่ระบบ</button><br>

						   </form>

					   </div><!-- panel-body -->
					   <div class="lock"><i class="glyphicon glyphicon-lock"></i></div>
					   <div class="label">ยินดีต้อนรับ</div>
					   <div class="label2"></div>

				   </div><!-- panel-default -->
			   </div><!-- col -->
		   </div><!-- row -->

	  </div><!--container-->

</body>
</html>
