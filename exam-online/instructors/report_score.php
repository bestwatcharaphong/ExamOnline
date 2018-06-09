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
								 <li><a href="set_instructor.php">จัดการชุดข้อสอบ</a></li>
								 <li><a href="form_add_exam.php">บันทึกข้อสอบ</a></li>
								 <li class="sidebar-selected"><a href="#">รายงาน</a></li>
								 <li><a href="static_exam.php">สถิติการสอบ</a></li>
								 <li><a href="../wifi_manager.php">Wifi</a></li>
							 </ul>
						 </div>
				  </div>

				  <?php
					  $set_id = $_GET['set_id'];

					  require '../connectdb.php';

					  $query = "select * from exam_set
						  where set_id = $set_id";
					  $result = mysqli_query($conn, $query);
					  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

					  $subject_id = $row['subject_id'];
					  $query_subject = "select * from subject where subject_id = '$subject_id'";
					  $result_subject = mysqli_query($conn, $query_subject);

					  $row_subject = mysqli_fetch_array($result_subject, MYSQLI_ASSOC);
					  $subject_name = $row_subject['subject_name'];

					  $query = "select * from score, exam_set
						  where score.set_id = '$set_id'
						  AND score.set_id = exam_set.set_id";
					  $result = mysqli_query($conn, $query);
					  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				  ?>

					  <h4 align="center" style="font-size: 16px;"><?php echo $subject_id . " " . $subject_name; ?></h4><br>
					  <h4 align="center" style="font-size: 20px;"><?php echo $row['set_name']; ?></h4><br>
					  <table class="table table-bordered table-hover table-score" align="Center">
						  <thead>
							  <tr>
								  <th style="width: 10%;"></th>
								  <th style="text-align: center;">รหัสนักศึกษา</th>
								  <th style="width: 40%; text-align: center;">ชื่อ-สกุล</th>
								  <th style="width: 20%; text-align: center;">คะแนน (<?php echo $row['full_score']; ?>)</th>
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
								  <td align="center"><?php echo $count; ?></td>
								  <td align="center"><?php echo $row['user_id']; ?></td>
								  <td><?php echo $row['fname'] . " &nbsp;" . $row['lname']; ?></td>
								  <td align="center"><?php echo $row['score']; ?></td>
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
								  <td align="center">สูงสุด</td>
								  <td align="center" style="background: #FAFA96;"><?php echo $values['max'] ?></td>
							  </tr>
							  <tr>
								  <td></td>
								  <td></td>
								  <td align="center">ต่ำสุด</td>
								  <td align="center" style="background: #FAFA96;"><?php echo $values['min'] ?></td>
							  </tr>
							  <tr>
								  <td></td>
								  <td></td>
								  <td align="center">ค่าเฉลี่ย</td>
								  <td align="center" style="background: #FAFA96;"><?php echo round($values['avg'], 2) ?></td>
							  </tr>

						  </tbody>
					  </table><br>

					  <div align="center">
						  <a href="report_score_pdf.php?set_id=<?php echo $set_id; ?>" class="btn btn-success glyphicon glyphicon-download"> PDF</a>
						  <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
						  <a href="report_score_excel.php?set_id=<?php echo $set_id; ?>" class="btn btn-info glyphicon glyphicon-download"> Excel</a>
					  </div><br>
					  <a onclick="history.back(-1)" class="btn btn-default glyphicon glyphicon-chevron-left back"> กลับ</a>

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
