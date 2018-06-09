<!DOCTYPE html>
<html style="overflow: visible; height: initial;">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>ระบบข้อสอบออนไลน์</title>

	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<script type="text/javascript" language="javascript" src="js/jquery-3.2.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/register.css">
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

	<script type="text/javascript">
	   $(function(){

		  $('#user_id').keypress(function(){
			    var key = String.fromCharCode(event.which);
			    if(isNaN(key)){
				    event.preventDefault();
				    alert("กรุณาใส่เฉพาะตัวเลข 0-9 เท่านั้น");
			    }
		  });

	   });
	</script>

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
							  <li class="active"><a href="#"> ลงทะเบียน</a></li>
						      <li><a href="form_login.php" class="hvr-shrink"> เข้าสู่ระบบ</a></li>
	                      </ul>
	                </div><!-- /.navbar-collapse -->

	             </div>
	         </div>
	      </div>
	   </div> <!--END container-fluid-->

	   <?php
			   if(isset($_POST['register'])){

				    require 'connectdb.php';

				   	$user_id = $_POST['user_id'];
				   	$fname = $_POST['fname'];
				   	$lname = $_POST['lname'];
				   	$password = $_POST['password'];
				   	$confirm_password = $_POST['confirm_password'];
				   	$email = $_POST['email'];

					if($password != $confirm_password){			/*รหัสผ่านไม่ตรงกัน */
						$alert = true;
					}else{										/*รหัสผ่านตรงกัน */
						/* เข้ารหัส แน่นหนากว่า md5 โดยชื่อ salting (การโรยเกลือหรือโรย string เอาไปต่อท้าย password แล้วไปเข้ารหัสอีกที) */
						$salt = 'jakljfiwnRRjionooaliJKFLAjslkd';
						$hash_password = hash_hmac('sha256', $password, $salt);

						$role = 10; 	/*ค่าเริ่มต้นเป็นบทบาทสมมุติเพื่อรอให้ admin มากำหนดให้อีกที*/

						$query = "insert into user (user_id, fname, lname, password, email, role) "
								 . "values ('$user_id', '$fname', '$lname', '$hash_password', '$email', '$role')";
						$result = mysqli_query($conn, $query);

						if($result){

							$query_user = "select * from user where user_id='$user_id' AND password='$hash_password'";
							$result_user = mysqli_query($conn, $query_user);

							if ($result_user->num_rows == 1) {
								session_start();

								$row_user = mysqli_fetch_array($result_user, MYSQLI_ASSOC);
								$_SESSION['login_id'] = $row_user['user_id'];					//เก็บรหัสผู้ใช้ไว้เพื่อใช้ในหน้าอื่น
								$_SESSION['login_role'] = $row_user['role'];

								header("Location: main.php");

							} else {
								echo "<font color=red>รหัสผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง</font> <br><br>";
								echo '<a href="index.php">กลับสู่หน้าหลัก</a>';
							}

						}else{
							echo "เกิดข้อผิดพลาด <br>" . mysqli_error($conn);
						}
						mysqli_close($conn);
					}

			   }else{
					   $alert = false;
			   }
		   }else{									/*สำหรับอาจารย์และนักศึกษาที่เข้าสู่ระบบแล้ว */
			   header("Location: main.php");
		   }
	   ?>	<!--END Navbar -->

	   <div class="container">
		   <div class="row">
		   		<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-default">
						<div class="panel-body">
						   <form action="form_register.php" method="post">

							  <div align="center">
								  <h2 style="font-size: 25px; color: #fff;">ลงทะเบียน</h2>
							  </div>
							  <hr>

							  <?php
								   if($alert){
							  ?>
							  			<div class="form-group  col-xs-12 col-lg-12">
											<div class="alert alert-danger alert-dismissible" role="alert">
	 										   รหัสผ่านไม่ตรงกัน
	 									   </div>
							  			</div>

							  <?php
									   $alert = false;
								   }
							  ?>



							  <div class="form-group col-md-12">
								  <label for="id">รหัสผู้ใช้งาน </label>
								  <input type="text" name="user_id" id="user_id" class="form-control" required
								  	value="<?php echo isset($_POST['user_id'])?$_POST['user_id']:''; ?>">
							  </div>

							  <div class="form-group col-md-6">
								  <label for="name">ชื่อ </label>
								  <input type="text" name="fname" id="fname" class="form-control" required
								    value="<?php echo isset($_POST['fname'])?$_POST['fname']:''; ?>">
							  </div>

							  <div class="form-group col-md-6">
								  <label for="lname">นามสกุล </label>
								  <input type="text" name="lname" id="lname" class="form-control" required
								    value="<?php echo isset($_POST['lname'])?$_POST['lname']:''; ?>">
							  </div>

							  <div class="form-group col-md-12">
								  <label for="email">อีเมล </label><br>
								  <input type="email" name="email" id="email" class="form-control" require placeholder="a@b.com"
								    value="<?php echo isset($_POST['email'])?$_POST['email']:''; ?>">
							  </div>

							  <div class="form-group col-md-12">
								  <label for="password">รหัสผ่าน </label>
								  <input type="password" name="password" id="password" class="form-control" required
								    value="<?php echo isset($_POST['password'])?$_POST['password']:''; ?>">
							  </div>

							  <div class="form-group col-md-12">
								  <label for="confirm_password">ยืนยันรหัสผ่าน </label>
								  <input type="password" name="confirm_password" id="confirm_password" class="form-control" required
								    value="<?php echo isset($_POST['confirm_password'])?$_POST['confirm_password']:''; ?>">
							  </div>

							  <div class="form-group col-md-12">
								  <button class="btn btn-default btn-block" name="register" id="register" type="submit">ลงทะเบียน</button>
							  </div>

						  </form>

					   </div><!-- panel-body -->
			   		   <div class="lock"><i class="glyphicon glyphicon-user"></i></div>
			   		   <div class="label">ยินดีต้อนรับ</div>
			   		   <div class="label2"></div>

			   	   </div><!-- panel-default -->
			      </div><!-- col -->
			   </div><!-- row -->

			</div><!--container-->

</body>
</html>
