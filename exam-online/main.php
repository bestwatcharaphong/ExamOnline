<?php
	session_start();
	if(!isset($_SESSION['login_id'])) {				/*สำหรับผู้ใช้ทั่วไปที่ยังไม่ได้เข้าสู่ระบบ */
		header("Location: form_login.php");
	}

	require 'connectdb.php';						/*สำหรับอาจารย์และนักศึกษาที่เข้าสู่ระบบแล้ว */
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
	<!-- <link type="image/ico" rel="shortcut icon" href="https://www.orange-thailand.com/images/favicon.ico"> -->

    <link href="orange_files/css" rel="stylesheet">
    <link href="orange_files/hover-min.css" rel="stylesheet" media="all">
    <link href="orange_files/font-awesome.min.css" rel="stylesheet" media="all">

    <link rel="stylesheet" href="orange_files/animate.min.css">
  	<link rel="stylesheet" href="orange_files/site.css">

    <meta name="format-detection" content="telephone=no">

	<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
    <script async="" src="orange_files/analytics.js.download"></script>
	<script type="text/javascript" async="" src="orange_files/recaptcha__en.js.download"></script>

	<script src="orange_files/jquery.min.js.download"></script>
    <script src="orange_files/bootstrap.min.js.download"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <link href="orange_files/bootstrap.min.css" rel="stylesheet">
    <link href="orange_files/bootstrap-theme.min.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="orange_files/layout.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>

	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>

	<!-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script> -->

    <link rel="stylesheet" type="text/css" href="orange_files/jquery.fullPage.css">
	<link rel="stylesheet" type="text/css" href="orange_files/examples.css">
	<link type="text/css" rel="stylesheet" href="css/orange_style.css">

</head>
<body style="overflow: visible; height: initial; color: #333; color: rgba(0,0,0,0.8);" class="Design fp-responsive fp-viewing-Ecommerce">

	<div class="container-fluid">
	    <div class="row wrap_menu sticky">

			<div class="col-xs-6 col-sm-2 col-md-2 sm-nopad-right">
	            <a class="link_logo hvr-shrink" href="#">ระบบข้อสอบออนไลน์</a>
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
						if($row_user['role'] == 0) {							/* admin */
							require 'connectdb.php';

							$query = "select * from user";
							$result = mysqli_query($conn, $query);
					?>

	                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-bottom: 11px;">
	                      <ul id="menu" class="nav navbar-nav">
	                        <li data-menuanchor="firstPage"><a href="#" class="hvr-shrink">หน้าหลัก</a></li>
							<li class="dropdown">
								<a class="dropdown-toggle hvr-shrink" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $fname . " " . $lname; ?>
	 							   <?php echo "(" . $role_name . ")"; ?>
	 							   <span class="caret"></span>
	 						   </a>
							   <ul class="dropdown-menu">
								  <li style="padding-top: 14px;"><a href="logout.php">ออกจากระบบ</a></li>
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
								 <li class="sidebar-selected"><a href="#">จัดการข้อมูลผู้ใช้งาน</a></li>
							 </ul>
						 </div>
				  </div>

				  <h3 align="center" style="font-size: 20px;">ผู้ใช้งานระบบ</h3><br>

				  <div align="right">
					  <button type="button" class="btn btn-success"
							data-toggle="modal" data-target="#add-user">
						  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มผู้ใช้งาน
					  </button>
				  </div><br>

			  <div style="overflow-x:auto;">
				  <table style="width: 100%;" class="table table-hover datatable">
					  <thead>
						  <tr>
							  <th style="text-align: center;"></th>
							  <th>รหัสผู้ใช้งาน</th>
							  <th>ชื่อ</th>
							  <th>นามสกุล</th>
							  <th>อีเมล์</th>
							  <th>บทบาท</th>
							  <th></th>
						  </tr>
					  </thead>

			  <?php
					  $count = 0;
					  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						  $count++;
						  $user_id = $row['user_id'];
						  $fname = $row['fname'];
						  $lname = $row['lname'];
						  $email = $row['email'];
						  $role = $row['role'];
			  ?>
					  <tr>
						  <td align="center"><?php echo $count; ?></td>
						  <td><?php echo $user_id; ?></td>
						  <td><?php echo $fname; ?></td>
						  <td><?php echo $lname; ?></td>
						  <td><?php echo $email; ?></td>
						  <td><?php
								  if($role == 0){
									  echo "ผู้ดูแลระบบ";
								  }else if($role == 1){
									  echo "อาจารย์";
								  }else if($role == 2){
									  echo "นักศึกษา";
								  }else if($role == 10){
									  echo "ไม่มีบทบาท";
								  }
							  ?>
						  </td>

						  <td align="center">
							  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?php echo $user_id; ?>">
								  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> แก้ไข
							  </button>
							  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#<?php echo $user_id; ?>">
								  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> ลบ
							  </button>
						  </td>
					  </tr>

					  <!-- Modal Edit User-->
					  <div class="modal fade" role="dialog" id="edit<?php echo $row['user_id']; ?>">
						<div class="modal-dialog">

						  <!-- Modal content-->
						  <div class="modal-content">

								<div class="modal-header">
									 <button type="button" class="close" data-dismiss="modal">&times;</button>
									 <h4 class="modal-title" style="font-size: 20px;" align="center">แก้ไขผู้ใช้งานระบบ</h4>
								</div>
								<div class="modal-body">

								  <div class="form-add-user">
									<form action="admins/edit_user.php" method="post">
									  <div class="row">
										  <div class="form-group col-xs-8 col-md-5">
											  <label for="user_id_show">รหัสผู้ใช้งาน </label>
											  <input type="text" name="user_id_show" id="user_id_show" class="form-control" value="<?php echo $row['user_id']; ?>" disabled>
											  <input type="hidden" name="user_id" id="user_id" value="<?php echo $row['user_id']; ?>">
				 						  </div>

				 						  <div class="form-group col-xs-12 col-md-12">
											  <label for="fname">ชื่อ </label>
											  <input type="text" name="fname" id="fname" class="form-control" required value="<?php echo $row['fname']; ?>">
				 						  </div>

				 						  <div class="form-group col-xs-12 col-md-12">
											  <label for="lname">นามสกุล </label>
											  <input type="text" name="lname" id="lname" class="form-control" required value="<?php echo $row['lname']; ?>">
				 						  </div>

				 						  <div class="form-group col-xs-12 col-md-12">
				 							  <label for="email">อีเมล์ </label>
											  <input type="email" name="email" id="email" class="form-control" require placeholder="a@b.com" value="<?php echo $row['email']; ?>">
				 						  </div>

										  <?php
											  $role = $row['role'];
											  if($role == 0){
												  $role_name = "ผู้ดูแลระบบ";
											  }else if($role == 1){
												  $role_name = "อาจารย์";
											  }else if($role == 2){
												  $role_name = "นักศึกษา";
											  }else if($role == 10){
												  $role_name = "ไม่มีบทบาท";
											  }
										  ?>

				 						  <div class="form-group col-xs-6 col-md-5">
											  <label for="role">บทบาท </label>
											  <select name="role" id="role" class="form-control">
												 <option value="<?php echo $role; ?>"><?php echo $role_name; ?></option>
										  <?php
											  if($role != 0){
										  ?>
												  <option value="0">ผู้ดูแลระบบ</option>
										  <?php
											  }
											  if($role != 1){
										  ?>
												  <option value="1">อาจารย์</option>
										  <?php
											  }
											  if($role != 2){
										  ?>
												  <option value="2">นักศึกษา</option>
										  <?php
											  }if($role != 10){
										  ?>
												  <option value="10">ไม่มีบทบาท</option>
										  <?php
											  }
										  ?>
											  </select>
										  </div>

										 <div class="form-group col-xs-12 col-md-12" align="right">
								  	 		 <input type="submit" class="btn btn-success" value="ตกลง">
											 <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
										 </form>
										</div>
									</div>
								   </div>
								</div>
						  </div>
						</div>
					  </div>

					  <!-- Modal Delete User-->
					  <div class="modal fade" role="dialog" id="<?php echo $user_id; ?>">
						<div class="modal-dialog">

						  <!-- Modal content-->
						  <div class="modal-content">
								<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h4 class="modal-title">ลบผู้ใช้งาน</h4>
								</div>
								<div class="modal-body">
									คุณแน่ใจหรือไม่ที่จะลบผู้ใช้งาน <strong><?php echo $fname . " " . $lname; ?></strong> ออกจากระบบ ?
								</div>


								<div class="modal-footer">
									<form action="admins/delete_user.php" method="post">
										  <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
										  <button type="submit" class="btn btn-danger" name="delete">ลบ</button>
										  <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
									</form>
								</div>
						  </div>

						</div>
					  </div>
			  <?php
					  }
			  ?>
				  </table>
			  </div>

			  <!-- Modal Add User-->
			  <div class="modal fade" role="dialog" id="add-user">
				<div class="modal-dialog">

				  <!-- Modal content-->
				  <div class="modal-content">
						<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal">&times;</button>
							 <h4 class="modal-title" style="font-size: 20px;" align="center">เพิ่มผู้ใช้งานระบบ</h4>
						</div>
						<div class="modal-body">

							<form action="register.php" method="post" class="form-add-user">
							  <div class="row">
								  <div class="form-group col-xs-8 col-md-5">
		 							  <label for="user_id">รหัสผู้ใช้งาน </label>
		 							  <input type="text" name="user_id" id="user_id" class="form-control" required>
		 						  </div>

		 						  <div class="form-group col-xs-12 col-md-12">
		 							  <label for="fname">ชื่อ </label>
		 							  <input type="text" name="fname" id="fname" class="form-control" required>
		 						  </div>

		 						  <div class="form-group col-xs-12 col-md-12">
		 							  <label for="lname">นามสกุล </label>
		 							  <input type="text" name="lname" id="lname" class="form-control" required>
		 						  </div>

		 						  <div class="form-group col-xs-12 col-md-12">
		 							  <label for="email">อีเมล์ </label>
		 							  <input type="email" name="email" id="email" class="form-control" require placeholder="a@b.com">
		 						  </div>

		 						  <div class="form-group col-xs-12 col-md-12">
		 							  <label for="password">รหัสผ่าน </label>
		 							  <input type="password" name="password" id="password" class="form-control" required>
		 						  </div>

		 						  <div class="form-group col-xs-12 col-md-12">
		 							  <label for="confirm_password">ยืนยันรหัสผ่าน </label>
		 							  <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
		 						  </div>

								 <div class="form-group col-xs-12 col-md-12" align="right">
									 <input type="hidden" name="sending_type" id="sending_type" value="add">
						  	 		 <input type="submit" class="btn btn-success" value="เพิ่ม">
									 <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
								 </form>
								</div>

						   </div>
						</div>
				  </div>
				</div>
			  </div>


			</div><!--container-content-->
		</div><!--container-->

	<?php
		} else if($row_user['role'] == 1){												/* อาจารย์ */
				require 'connectdb.php';
				$query = "select * from subject where subject.instructor_id = $user_id";
				$result = mysqli_query($conn, $query);
	?>

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-bottom: 11px;">
						  <ul id="menu" class="nav navbar-nav">
							<li data-menuanchor="firstPage"><a href="main.php" class="hvr-shrink">หน้าหลัก</a></li>
							<li class="dropdown">
								<a class="dropdown-toggle hvr-shrink" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $fname . " " . $lname; ?>
								   <?php echo "(" . $role_name . ")"; ?>
								   <span class="caret"></span>
							   </a>
							   <ul class="dropdown-menu">
								  <li style="padding-top: 14px;"><a href="logout.php">ออกจากระบบ</a></li>
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
									 <li class="sidebar-selected"><a href="#">จัดการรายวิชา</a></li>
									 <li><a href="instructors/set_instructor.php">จัดการชุดข้อสอบ</a></li>
									 <li><a href="instructors/form_add_exam.php">บันทึกข้อสอบ</a></li>
									 <li><a href="instructors/static_exam.php">สถิติการสอบ</a></li>
									 <li><a href="wifi_manager.php">Wifi</a></li>
								 </ul>
							 </div>
					  </div>

					  <h3 align="center" style="font-size: 20px;">รายวิชา</h3><br>
					  <div align="right">
						  <button type="button" class="btn btn-success"
								data-toggle="modal" data-target="#add-subject">
							  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มรายวิชา
						  </button>
					  </div><br>

					  <div>
						  <table style="width: 100%;" class="table datatable">
							  <thead>
								  <tr>
									  <th></th>
									  <th>รหัสวิชา</th>
									  <th style="width: 50%;">ชื่อวิชา</th>
									  <th></th>
								  </tr>
							  </thead>

						  <?php
							  $count = 0;
							  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								  $count++;
						  ?>
							  <tr>
								  <td><?php echo $count; ?></td>
								  <td><a href="instructors/set_instructor.php?subject_id=<?php echo $row['subject_id']; ?>"><?php echo $row['subject_id']; ?></a></td>
								  <td><a href="instructors/set_instructor.php?subject_id=<?php echo $row['subject_id']; ?>"><?php echo $row['subject_name']; ?></a></td>
								  <td>
									  <a href="instructors/subject_student_enroll.php?subject_id=<?php echo $row['subject_id']; ?>" class="btn btn-info btn-sm">
										  <span class="glyphicon glyphicon-eye-open"></span> นักศึกษา
									  </a>
									  <button type="button" class="btn btn-warning btn-sm"
										  data-toggle="modal" data-target="#edit<?php echo $row['subject_id']; ?>">
										  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> แก้ไข
									  </button>
									  <button type="button" class="btn btn-danger btn-sm"
										  data-toggle="modal" data-target="#<?php echo $row['subject_id']; ?>">
										  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> ลบ
									  </button>
								  </td>
							  </tr>

							  <!-- Modal Edit Subject-->
							  <div class="modal fade" role="dialog" id="edit<?php echo $row['subject_id']; ?>">
								<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
										<div class="modal-body">
											<form action="instructors/edit_subject.php" method="post">

											 <h3 align="center" style="font-size: 20px;">แก้ไขข้อมูลรายวิชา</h3><br>
											 <div class="row">
												 <div class="form-group col-xs-6 col-md-4">
													 <label for="subject_id_show">รหัสวิชา</label>
								   						  <input type="text" name="subject_id_show" id="subject_id_show" class="form-control" required value="<?php echo $row['subject_id']; ?>" disabled="disabled">
								   						  <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $row['subject_id']; ?>">
													 </div>
												 <div class="form-group col-xs-12">
													 <label for="subject_name">ชื่อวิชา</label>
						   						  <input type="text" name="subject_name" id="subject_name" class="form-control" required value="<?php echo $row['subject_name']; ?>">
												 </div>
												 <div class="form-group col-xs-12" align="right">
													 <input type="hidden" name="instructor_id" id="instructor_id" value="<?php echo $user_id; ?>">

													 <button class="btn btn-success" type="submit">ตกลง</button>
													 <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
												 </form>
												</div>
										   </div>
										</div>
								  </div>
								</div>
							  </div>

							   <!-- Modal Delete Subject-->
							   <div class="modal fade" role="dialog" id="<?php echo $row['subject_id']; ?>">
								 <div class="modal-dialog">

								   <!-- Modal content-->
								   <div class="modal-content">
										 <div class="modal-header">
											   <button type="button" class="close" data-dismiss="modal">&times;</button>
											   <h4 class="modal-title">ลบรายวิชา</h4>
										 </div>
										 <div class="modal-body">
											 คุณแน่ใจหรือไม่ที่จะลบรายวิชา <strong><?php echo $row['subject_id']; ?></strong> ออกจากระบบ ?
										 </div>


										 <div class="modal-footer">
											 <form action="instructors/delete_subject.php" method="post">
												   <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $row['subject_id']; ?>">
												   <button type="submit" class="btn btn-danger" name="delete">ลบ</button>
												   <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
											 </form>
										 </div>
								   </div>

								 </div>
							   </div>
						  <?php
							  }
						  ?>
						  </table>

						  <!-- Modal Add Subject-->
						  <div class="modal fade" role="dialog" id="add-subject">
							<div class="modal-dialog">

							  <!-- Modal content-->
							  <div class="modal-content">
									  <div class="modal-header">
										   <button type="button" class="close" data-dismiss="modal">&times;</button>
										   <h4 class="modal-title" style="font-size: 20px;" align="center">เพิ่มรายวิชา</h4>
									 </div>
									<div class="modal-body">
										<form action="instructors/add_subject.php" method="post">
										  <div class="row">
											 <div class="form-group col-xs-6 col-md-4">
												 <label for="subject_id">รหัสวิชา</label>
												 <input type="text" name="subject_id" id="subject_id" class="form-control" required autofocus>
											 </div>
											 <div class="form-group col-xs-12 col-md-10 col-lg-12">
												 <label for="subject_name">ชื่อวิชา</label>
					   						  	 <input type="text" name="subject_name" id="subject_name" class="form-control" required>
											 </div>

											 <input type="hidden" name="instructor_id" id="instructor_id" value="<?php echo $user_id; ?>">

											 <div class="form-group col-xs-12" align="right">
												 <button class="btn btn-success" type="submit">เพิ่ม</button>
												 <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
											 </form>
											</div>
									   </div>
									</div>
							  </div>
							</div>
						  </div>

					  </div>
					</div><!--container-content-->
				</div><!--container-->

	<?php
			} else if($row_user['role'] == 2){									/* นักศึกษา */
	?>

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-bottom: 11px;">
						  <ul id="menu" class="nav navbar-nav">
							<li data-menuanchor="firstPage"><a href="main.php" class="hvr-shrink">หน้าหลัก</a></li>
							<li class="dropdown">
								<a class="dropdown-toggle hvr-shrink" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $fname . " " . $lname; ?>
								   <?php echo "(" . $role_name . ")"; ?>
								   <span class="caret"></span>
							   </a>
							   <ul class="dropdown-menu">
								  <li style="padding-top: 14px;"><a href="logout.php">ออกจากระบบ</a></li>
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
								 <li class="sidebar-selected"><a href="#">รายวิชา</a></li>
								 <li><a href="students/score_summary.php">คะแนน</a></li>
								 <li><a href="students/student_enroll.php">ลงทะเบียนเรียน</a></li>
							 </ul>
						 </div>
				  </div>

				  <h4 style="font-size: 15px;">เลือกวิชาเพื่อทำข้อสอบ</h4>

				  <?php
					  require 'connectdb.php';
					  $query = "select * from enroll, subject join user where enroll.user_id = $user_id AND enroll.subject_id = subject.subject_id AND instructor_id = user.user_id";
					  $result = mysqli_query($conn, $query);
				  ?>

				  <h3 align="center" style="font-size: 20px;">รายวิชา</h3><br>
				  <div style="">
					  <table style="width: 100%;" class="table datatable">
						  <thead>
							  <tr>
								  <th></th>
								  <th>รหัสวิชา</th>
								  <th>ชื่อวิชา</th>
								  <th>ผู้สอน</th>
							  </tr>
						  </thead>

					  <?php
						  $count = 0;
						  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							  $count++;
					  ?>
						  <tr>
							  <td align="center"><?php echo $count; ?></td>
							  <td><a href="students/set_student.php?subject_id=<?php echo $row['subject_id']; ?>"><?php echo $row['subject_id']; ?></a></td>
							  <td><a href="students/set_student.php?subject_id=<?php echo $row['subject_id']; ?>"><?php echo $row['subject_name']; ?></a></td>
							  <td><?php echo $row['fname'] . "&nbsp;&nbsp;&nbsp;&nbsp;" . $row['lname']; ?></td>
						  </tr>
					  <?php
						  }
					  ?>
					  </table>
				  </div>

				</div><!--container-content-->
				</div><!--container-->

	<?php
			} else if($row_user['role'] == 10){									/* คนที่เพิ่งลงทะเบียน ยังไม่มีบทบาท */
	?>

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-bottom: 11px;">
						  <ul id="menu" class="nav navbar-nav">
							<li data-menuanchor="firstPage"><a href="main.php" class="hvr-shrink">หน้าหลัก</a></li>
							<li class="dropdown">
								<a class="dropdown-toggle hvr-shrink" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $fname . " " . $lname; ?>
								   <?php echo "(" . $role_name . ")"; ?>
								   <span class="caret"></span>
							   </a>
							   <ul class="dropdown-menu">
								  <li style="padding-top: 14px;"><a href="logout.php">ออกจากระบบ</a></li>
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

				  <div align="center" style="margin-top: 140px;">
					  <h2 style="font-size: 20px;">ยินดีต้อนรับสู่ ระบบข้อสอบออนไลน์</h2><br>
					  <h4>กรุณารอการกำหนดสิทธิ์การใช้งานโดยผู้ดูแลระบบ</h4>
				  </div>


				</div><!--container-content-->
				</div><!--container-->

	<?php
			}else{
				require 'access_denied.php';
			}
		}

		require 'footer/footer.php';
	?>



</body>
</html>
