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

		function DateThai($strDate)
		{
			$strYear = date("Y",strtotime($strDate)) + 543;
			$strMonth= date("n",strtotime($strDate));
			$strDay= date("d",strtotime($strDate));
			$strHour= date("H",strtotime($strDate));
			$strMinute= date("i",strtotime($strDate));
			$strSeconds= date("s",strtotime($strDate));
			$strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
			$strMonthThai = $strMonthCut[$strMonth];
			return "$strDay $strMonthThai $strYear";
		}
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

	<link href="../templates/Signin Template_files/signin.css" rel="stylesheet">

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
						if($row_user['role'] == 1) {			/*สำหรับอาจารย์*/
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
								 <li><a href="../main.php">จัดการรายวิชา</a></li>
								 <li class="sidebar-selected"><a href="#">จัดการชุดข้อสอบ</a></li>
								 <li><a href="form_add_exam.php">บันทึกข้อสอบ</a></li>
								 <li><a href="static_exam.php">สถิติการสอบ</a></li>
								 <li><a href="../wifi_manager.php">Wifi</a></li>
							 </ul>
						 </div>
				  </div>


				  <?php
					  if(isset($_GET['subject_id'])){							/*เข้ามาหน้านี้ผ่านทางการเลือกวิชา*/
						  $subject_id = $_GET['subject_id'];
						  $subject_id_subject_fixed = $_GET['subject_id'];

						  $query = "select * from subject where subject_id = '$subject_id'";
						  $result = mysqli_query($conn, $query);
						  $row = mysqli_fetch_assoc($result);
				  ?>
						  <h3 align="center" style="font-size: 20px;"><?php echo $row['subject_id'] . " " . $row['subject_name']; ?></h3><br>
						  <div align="right">
							  <button type="button" class="btn btn-success"
									data-toggle="modal" data-target="#add-has-subject-id">
								  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มชุดข้อสอบ
							  </button>
						  </div><br>

						  <div style="overflow-x: auto;">
							  <table style="width: 100%;" class="table datatable table-hover">
								  <thead>
									  <tr>
										  <th></th>
										  <th style="width: 30%;">ชื่อชุดข้อสอบ</th>
										  <th style="text-align: center;">วันที่สร้าง</th>
										  <th style="text-align: center;">เวลา (นาที)</th>
										  <th style="text-align: center;">ทำข้อสอบ</th>
										  <th></th>
									  </tr>
								  </thead>
								  <tbody>

								<?php

								  $query = "select * from exam_set, subject where exam_set.subject_id = '$subject_id' AND subject.subject_id = '$subject_id' order by exam_set.set_date";
								  $result = mysqli_query($conn, $query);

								  $count = 0;
								  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
									  $count++;
							  ?>
									  <tr>
										  <td align="Center"><?php echo $count; ?></td>
										  <td><a href="set_detail.php?set_id=<?php echo $row['set_id']; ?>"><?php echo $row['set_name']; ?></a></td>
										  <td align="Center"><?php echo DateThai($row['set_date']); ?></td>
										  <td align="Center"><?php echo $row['set_time'] ?></td>
										  <td align="Center">
											  <label class="switch">
													<input type="checkbox" id="activeflag" class="activeflag"
														<?php
															if($row['activeflag'] == 1) {
																echo "checked";
															}else{
																echo "";
															}
														?>
														<?php $value = $row['activeflag']; ?>
														value="<?php echo $value; ?>"
														data-id="<?php echo $row['set_id']; ?>"
													>
													<span class="slider round"></span>
											  </label>
										  </td>
										  <td align="Center">
											  <a href="report_score.php?set_id=<?php echo $row['set_id']; ?>">
												  <button type="button" class="btn btn-primary btn-sm">
													<span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> รายงาน
												  </button>
											  </a>

											  <button type="button" class="btn btn-warning btn-sm"
													data-toggle="modal" data-target="#edit<?php echo $row['set_id']; ?>">
												  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> แก้ไข
											  </button>

											  <button type="button" class="btn btn-danger btn-sm"
												  data-toggle="modal" data-target="#<?php echo $row['set_id']; ?>">
												  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> ลบ
											  </button>
										  </td>
									  </tr>

								   <!-- Modal Edit Set-->
   								   <div class="modal fade" role="dialog" id="edit<?php echo $row['set_id']; ?>">
   									 <div class="modal-dialog">

   									   <!-- Modal content-->
   									   <div class="modal-content">
   											 <div class="modal-body">
   												 <form action="edit_set.php" method="post">

   												  <h3 align="center" style="font-size: 20px;">แก้ไขชุดข้อสอบ</h3><br>
   												  <div class="row">
   													  <div class="form-group col-xs-12 col-md-10 col-lg-12">
   														  <label for="set_name">ชื่อชุดข้อสอบ</label>
   														  <input type="text" name="set_name" id="set_name" class="form-control" required
   																value="<?php echo $row['set_name']; ?>"
   														  >
   													  </div>
   													  <div class="form-group col-xs-6 col-md-4">
   														  <label for="time">เวลา (นาที)</label>
   														  <input type="number" name="time" id="time"
   																class="form-control" required  min="0" max="1440" step="1"
   																value="<?php echo $row['set_time']; ?>"
   														  >
   													  </div>
   													  <div class="form-group col-xs-12" align="right">
   														  <input type="hidden" name="set_id" id="set_id" value="<?php echo $row['set_id']; ?>">
   														  <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $row['subject_id']; ?>">

   														  <button class="btn btn-success" type="submit">ตกลง</button>
   														  <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
   													  </form>
   													 </div>
   												</div>
   											 </div>
   									   </div>
   									 </div>
   								   </div>

   								   <!-- Modal Delete Set-->
   								   <div class="modal fade" role="dialog" id="<?php echo $row['set_id']; ?>">
   									 <div class="modal-dialog">

   									   <!-- Modal content-->
   									   <div class="modal-content">
   											 <div class="modal-header">
   												   <button type="button" class="close" data-dismiss="modal">&times;</button>
   												   <h4 class="modal-title" style="font-size: 20px;">ลบชุดข้อสอบ</h4>
   											 </div>
   											 <div class="modal-body">
   												 คุณแน่ใจหรือไม่ที่จะลบชุดข้อสอบ <strong><?php echo $row['set_name']; ?></strong> ออกจากระบบ ?
   											 </div>

   											 <div class="modal-footer">
   												 <form action="delete_set.php" method="post">
   													   <input type="hidden" name="set_id" id="set_id" value="<?php echo $row['set_id']; ?>">
   													   <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $row['subject_id']; ?>">
   													   <button type="submit" class="btn btn-danger" name="delete">ลบ</button>
   													   <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
   												 </form>
   											 </div>
   									   </div>

   									 </div>
   								   </div>

   								   <!-- Modal Toggle Activeflag-->
   								   <div class="modal fade" role="dialog" id="toggle<?php echo $row['set_id']; ?>">
   									 <div class="modal-dialog">

   									   <!-- Modal content-->
   									   <div class="modal-content">
   											 <div class="modal-header">
   												   <button type="button" class="close" data-dismiss="modal">&times;</button>
   												   <h4 class="modal-title" style="font-size: 20px;">เปลี่ยนสถานะ</h4>
   											 </div>
   											 <div class="modal-body">
   												 คุณแน่ใจหรือไม่ที่จะเปลี่ยนสถานะ <strong><?php echo $row['set_name']; ?></strong> ?
   											 </div>

   											 <div class="modal-footer">
   												 <form action="enable_exam.php" method="post">
   													   <input type="hidden" name="set_id" id="set_id" value="<?php echo $row['set_id']; ?>">
   													   <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $row['subject_id']; ?>">
   													   <input type="hidden" name="activeflag" id="activeflag" value="<?php echo $row['activeflag']; ?>">

   													   <button type="submit" class="btn btn-primary" name="delete">ตกลง</button>
   													   <button type="button" id="btn-cancel-toggle" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
   												 </form>
   											 </div>
   									   </div>

   									 </div>
   								   </div>
							  <?php
								  }
							  ?>
								  </tbody>
							  </table>
						  </div>

				  <?php
			  }else{															/*เข้ามาหน้านี้โดยไม่ได้ผ่านทางการเลือกวิชา*/
						  require '../connectdb.php';
						   $query = "select * from subject where subject.instructor_id = $user_id";
						   $result = mysqli_query($conn, $query);
				  ?>

						  <h3 align="center" style="font-size: 20px;">จัดการชุดข้อสอบ</h3><br>
						  <div align="right">
							  <button type="button" class="btn btn-success"
									data-toggle="modal" data-target="#add">
								  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มชุดข้อสอบ
							  </button>
						  </div><br>

						  <div style="overflow-x:auto;">
						   <table style="width: 100%;" class="table datatable">
							   <thead>
								   <tr>
									   <th style="text-align: left;">รายวิชา</th>
								   </tr>
							   </thead>

						   <?php
							   $count = 0;
							   while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								   $count++;
								   $subject_id = $row['subject_id'];
						   ?>
							   <tr>
								   <td>
									   <strong><?php echo $row['subject_id'] . " " . $row['subject_name']; ?></strong>
									   <div style="overflow-x:auto;">
										  <br>
										  <table style="width: 100%;" class="table">
											  <thead>
												  <tr>
													  <th></th>
													  <th style="width: 30%;">ชื่อชุดข้อสอบ</th>
													  <th style="text-align: center;">วันที่สร้าง</th>
													  <th style="text-align: center;">เวลา (นาที)</th>
													  <th style="text-align: center;">การทำข้อสอบ</th>
													  <th style="text-align: center;"></th>
												  </tr>
											  </thead>
											  <tbody>

										  <?php
											  $query_set = "select * from exam_set, subject where exam_set.subject_id = '$subject_id' AND subject.subject_id = '$subject_id' order by exam_set.set_date";
											  $result_set = mysqli_query($conn, $query_set);

											  $count_set = 0;
											  while($row_set = mysqli_fetch_array($result_set, MYSQLI_ASSOC)) {
												  $count_set++;
										  ?>
												  <tr>
													  <td align="Center"><?php echo $count_set; ?></td>
													  <td align="left">
														  <a href="set_detail.php?set_id=<?php echo $row_set['set_id']; ?>"><?php echo $row_set['set_name']; ?></a>
													  </td>
													  <td align="Center"><?php echo DateThai($row_set['set_date']); ?></td>
													  <td align="Center"><?php echo $row_set['set_time'] ?></td>
													  <td align="Center">
														  <label class="switch">
																<input type="checkbox" id="activeflag" class="activeflag"
																	<?php
																		if($row_set['activeflag'] == 1) {
																			echo "checked";
																		}else{
																			echo "";
																		}
																	?>
																	<?php $value = $row_set['activeflag']; ?>
																	value="<?php echo $value; ?>"
																	data-id="<?php echo $row_set['set_id']; ?>"
																>
																<span class="slider round"></span>
														  </label>
													  </td>
													  <td align="Center">
														  <a href="report_score.php?set_id=<?php echo $row_set['set_id']; ?>">
															  <button type="button" class="btn btn-primary btn-sm">
																<span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> รายงาน
															  </button>
														  </a>

														  <button type="button" class="btn btn-warning btn-sm"
														  		data-toggle="modal" data-target="#edit<?php echo $row_set['set_id']; ?>">
															  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> แก้ไข
														  </button>

														  <button type="button" class="btn btn-danger btn-sm"
															  data-toggle="modal" data-target="#<?php echo $row_set['set_id']; ?>">
															  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> ลบ
														  </button>
													  </td>
												  </tr>

												   <!-- Modal Edit Set-->
												   <div class="modal fade" role="dialog" id="edit<?php echo $row_set['set_id']; ?>">
													 <div class="modal-dialog">

													   <!-- Modal content-->
													   <div class="modal-content">
															 <div class="modal-body">
																 <form action="edit_set.php" method="post">

											   					  <h3 align="center" style="font-size: 20px;">แก้ไขชุดข้อสอบ</h3><br>
																  <div class="row">
												   					  <div class="form-group col-xs-12 col-md-10 col-lg-12">
												   						  <label for="set_name">ชื่อชุดข้อสอบ</label>
												   						  <input type="text" name="set_name" id="set_name" class="form-control" required
																		  		value="<?php echo $row_set['set_name']; ?>"
																		  >
												   					  </div>
												   					  <div class="form-group col-xs-6 col-md-4">
												   						  <label for="time">เวลา (นาที)</label>
												   						  <input type="number" name="time" id="time"
																		    	class="form-control" required  min="0" max="1440" step="1"
																		  		value="<?php echo $row_set['set_time']; ?>"
																		  >
												   					  </div>
																	  <div class="form-group col-xs-12" align="right">
													   					  <input type="hidden" name="set_id" id="set_id" value="<?php echo $row_set['set_id']; ?>">
													   					  <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $row_set['subject_id']; ?>">

																		  <button class="btn btn-success" type="submit">ตกลง</button>
																		  <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
																	  </form>
																  	 </div>
																</div>
															 </div>
													   </div>
													 </div>
												   </div>

												   <!-- Modal Delete Set-->
												   <div class="modal fade" role="dialog" id="<?php echo $row_set['set_id']; ?>">
													 <div class="modal-dialog">

													   <!-- Modal content-->
													   <div class="modal-content">
															 <div class="modal-header">
																   <button type="button" class="close" data-dismiss="modal">&times;</button>
																   <h4 class="modal-title" style="font-size: 20px;">ลบชุดข้อสอบ</h4>
															 </div>
															 <div class="modal-body">
																 คุณแน่ใจหรือไม่ที่จะลบชุดข้อสอบ <strong><?php echo $row_set['set_name']; ?></strong> ออกจากระบบ ?
															 </div>

															 <div class="modal-footer">
																 <form action="delete_set.php" method="post">
																	   <input type="hidden" name="set_id" id="set_id" value="<?php echo $row_set['set_id']; ?>">
																	   <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $row_set['subject_id']; ?>">
																	   <button type="submit" class="btn btn-danger" name="delete">ลบ</button>
																	   <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
																 </form>
															 </div>
													   </div>

													 </div>
												   </div>

												   <!-- Modal Toggle Activeflag-->
												   <div class="modal fade" role="dialog" id="toggle<?php echo $row_set['set_id']; ?>">
													 <div class="modal-dialog">

													   <!-- Modal content-->
													   <div class="modal-content">
															 <div class="modal-header">
																   <button type="button" class="close" data-dismiss="modal">&times;</button>
																   <h4 class="modal-title" style="font-size: 20px;">เปลี่ยนสถานะ</h4>
															 </div>
															 <div class="modal-body">
																 คุณแน่ใจหรือไม่ที่จะเปลี่ยนสถานะ <strong><?php echo $row_set['set_name']; ?></strong> ?
															 </div>

															 <div class="modal-footer">
																 <form action="enable_exam.php" method="post">
																	   <input type="hidden" name="set_id" id="set_id" value="<?php echo $row_set['set_id']; ?>">
																	   <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $row_set['subject_id']; ?>">
																	   <input type="hidden" name="activeflag" id="activeflag" value="<?php echo $row_set['activeflag']; ?>">

																	   <button type="submit" class="btn btn-primary" name="delete">ตกลง</button>
																	   <button type="button" id="btn-cancel-toggle" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
																 </form>
															 </div>
													   </div>

													 </div>
												   </div>
										  <?php
											  }
										  ?>
											  </tbody>
										  </table>
									  </div>
								   </td>
							   </tr>

						   <?php
							   }
						   ?>
						   </table>
					   </div>

				  <?php
					  }
				  ?>

				  <!-- Modal Add Set Subject Fixed-->
				  <div class="modal fade" role="dialog" id="add-has-subject-id">
					<div class="modal-dialog">

					  <!-- Modal content-->
					  <div class="modal-content">
							  <div class="modal-header">
								   <button type="button" class="close" data-dismiss="modal">&times;</button>
								   <h4 class="modal-title" style="font-size: 20px;" align="center">เพิ่มชุดข้อสอบ</h4>
							 </div>
							<div class="modal-body">
								<form action="add_set.php" method="post">
								  <div class="row">

									 <div class="form-group col-xs-12 col-md-10 col-lg-12">
										 <label for="set_name">ชื่อชุดข้อสอบ</label>
										 <input type="text" name="set_name" id="set_name" class="form-control" required
										 >
									 </div>
									 <div class="form-group col-xs-6 col-md-4">
										 <label for="time">เวลา (นาที)</label>
										 <input type="number" name="time" id="time"
											   class="form-control" required  min="0" max="1440" step="1"
										 >
									 </div>
									 <div class="form-group col-xs-12" align="right">
										 <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $subject_id_subject_fixed; ?>">
										 <button class="btn btn-success" type="submit">ตกลง</button>
										 <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
									 </form>
									</div>
							   </div>
							</div>
					  </div>
					</div>
				  </div>

				  <!-- Modal Add Set-->
				  <div class="modal fade" role="dialog" id="add">
					<div class="modal-dialog">

					  <!-- Modal content-->
					  <div class="modal-content">
							  <div class="modal-header">
								   <button type="button" class="close" data-dismiss="modal">&times;</button>
								   <h4 class="modal-title" style="font-size: 20px;" align="center">เพิ่มชุดข้อสอบ</h4>
							 </div>
							<div class="modal-body">
								<form action="add_set.php" method="post">
								  <div class="row">
									 <div class="form-group col-xs-6 col-md-4">
										 <?php
											  $query_subject = "select * from subject where instructor_id = $user_id";
											  $result_subject = mysqli_query($conn, $query_subject);
										  ?>

										 <label for="subject_id">รหัสวิชา</label>
										 <select name="subject_id" id="subject_id" class="form-control" required  autofocus>
											 <option></option>
										 <?php
											  while($row_subject = mysqli_fetch_array($result_subject, MYSQLI_ASSOC)) {
										 ?>
												 <option value="<?php echo $row_subject['subject_id']; ?>"><?php echo $row_subject['subject_id']; ?></option>
										 <?php
											  }
										 ?>
										 </select>
									 </div>
									 <div class="form-group col-xs-12 col-md-10 col-lg-12">
										 <label for="set_name">ชื่อชุดข้อสอบ</label>
										 <input type="text" name="set_name" id="set_name" class="form-control" required
										 >
									 </div>
									 <div class="form-group col-xs-6 col-md-4">
										 <label for="time">เวลา (นาที)</label>
										 <input type="number" name="time" id="time"
											   class="form-control" required  min="0" max="1440" step="1"
										 >
									 </div>
									 <div class="form-group col-xs-12" align="right">
										 <button class="btn btn-success" type="submit">ตกลง</button>
										 <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
									 </form>
									</div>
							   </div>
							</div>
					  </div>
					</div>
				  </div>

				  <a onclick="history.back(-1)" class="btn btn-default glyphicon glyphicon-chevron-left back"> Back</a>

			</div><!--container-content-->
		</div><!--container-->

	<?php
			} else {
				require '../access_denied.php';
			}
		}
		require '../footer/footer.php';
	?>

</body>
</html>
