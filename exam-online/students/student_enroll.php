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
						if($row_user['role'] == 2) {							/*สำหรับนักศึกษา*/
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
								 <li><a href="score_summary.php">คะแนน</a></li>
								 <li class="sidebar-selected"><a href="#">ลงทะเบียนเรียน</a></li>
							 </ul>
						 </div>
				  </div>

				  <h3 align="center" style="font-size: 20px;">ลงทะเบียนเรียน</h3><br>

				  <?php
					  require '../connectdb.php';
					  $query = "select * from subject join user where instructor_id = user.user_id";
					  $result = mysqli_query($conn, $query);
				  ?>

				  <div style="overflow-x:auto;">
					  <table style="width: 100%;" class="table datatable">
						  <thead>
							  <tr>
								  <th></th>
								  <th>รหัสวิชา</th>
								  <th>ชื่อวิชา</th>
								  <th>ผู้สอน</th>
								  <th></th>
							  </tr>
						  </thead>

					  <?php
						  $count = 0;
						  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							  $subject_id = $row['subject_id'];
							  $query_enroll = "select * from enroll WHERE user_id = '$user_id' AND subject_id = '$subject_id'";
							  $result_enroll = mysqli_query($conn, $query_enroll);

							  if($result_enroll->num_rows == 0){
								  $count++;

					  ?>
							  <tr>
								  <td align="center"><?php echo $count; ?></td>
								  <td><a href="set_student.php?subject_id=<?php echo $row['subject_id']; ?>"><?php echo $row['subject_id']; ?></a></td>
								  <td><a href="set_student.php?subject_id=<?php echo $row['subject_id']; ?>"><?php echo $row['subject_name']; ?></a></td>
								  <td><?php echo $row['fname'] . " " . $row['lname']; ?></td>
								  <td align="center">
									  <button type="button" class="btn btn-success btn-sm"
										  data-toggle="modal" data-target="#<?php echo $row['subject_id']; ?>">
										  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> ลงทะเบียน
									  </button>
								  </td>
							  </tr>

							<!-- Modal Enroll-->
							<div class="modal fade" role="dialog" id="<?php echo $row['subject_id']; ?>">
							  <div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									  <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title" style="font-size: 20px;">ลงทะเบียนเรียน</h4>
									  </div>
									  <div class="modal-body">
										  คุณต้องการลงทะเบียนเรียนวิชา <strong><?php echo $row['subject_id']; ?></strong> ใช่หรือไม่ ?
									  </div>

									  <div class="modal-footer">
										  <form action="enroll.php" method="post">
												<input type="hidden" name="subject_id" id="subject_id" value="<?php echo $row['subject_id']; ?>">
												<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

												<button type="submit" class="btn btn-success" name="enroll">ตกลง</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
										  </form>
									  </div>
								</div>

							  </div>
							</div>
				<?php
						   }
					  }
				?>
					  </table>
				  </div>


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
