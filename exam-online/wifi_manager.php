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

		/*----------------------------( Wifi Manager Begin)/*----------------------------*/
		$sshuser     = "pi";
		$sshpassword = "raspberry";
		$command     = htmlspecialchars($_GET["cmd"]);
		switch ($command) {
		    case "start":
		          if($ssh = ssh2_connect('127.0.0.1', 22)) {
		              if(ssh2_auth_password($ssh, $sshuser, $sshpassword)) {
		                  $stream = ssh2_exec($ssh, 'sudo service hostapd start');  //The Command to do
		                  stream_set_blocking($stream, true);
		                  fclose($stream);
		              }
		          }
		        sleep(3);
		        break;
		    case "stop":
		          if($ssh = ssh2_connect('127.0.0.1', 22)) {
		              if(ssh2_auth_password($ssh, $sshuser, $sshpassword)) {
		                  $stream = ssh2_exec($ssh, 'sudo service hostapd stop');  //The Command to do
		                  stream_set_blocking($stream, true);
		                  fclose($stream);
		              }
		          }
		        sleep(3);
		        break;
		    default:
		        //echo "";
		}

		if($ssh = ssh2_connect('127.0.0.1', 22)) {
		    if(ssh2_auth_password($ssh, $sshuser, $sshpassword)) {
		        $stream = ssh2_exec($ssh, 'sudo /sbin/ifconfig eth0 | grep \'inet addr:\' | cut -d: -f2 | awk \'{ print $1}\'');  //The Command to do
		        stream_set_blocking($stream, true);
		        $eth0data = '';
		        while($buffer = fread($stream, 4096)) {
		            $eth0data .= $buffer;
		        }
		        fclose($stream);
		    }
		}

		if($ssh = ssh2_connect('127.0.0.1', 22)) {
		    if(ssh2_auth_password($ssh, $sshuser, $sshpassword)) {
		        $stream = ssh2_exec($ssh, 'sudo /sbin/ifconfig wlan0 | grep \'inet addr:\' | cut -d: -f2 | awk \'{ print $1}\'');  //The Command to do
		        stream_set_blocking($stream, true);
		        $wlan0data = '';
		        while($buffer = fread($stream, 4096)) {
		            $wlan0data .= $buffer;
		        }
		        fclose($stream);
		    }
		}
		/*----------------------------( Wifi Manager End)/*----------------------------*/
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
						if($row_user['role'] == 1){						/* อาจารย์สามารถปล่อย Wifi ได้ */
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
									 <li><a href="main.php">จัดการรายวิชา</a></li>
									 <li><a href="set_instructor.php">จัดการชุดข้อสอบ</a></li>
									 <li><a href="form_add_exam.php">บันทึกข้อสอบ</a></li>
									 <li><a href="static_exam.php">สถิติการสอบ</a></li>
									 <li class="sidebar-selected"><a href="#">Wifi</a></li>
								 </ul>
							 </div>
					  </div>

					<?php
						  exec("pgrep hostapd", $output, $return);
						  if ($return == 0) {
									echo "LAN IP Address : " . $eth0data . "<br>";
									echo "WiFI IP Address : " . $wlan0data . "<br>";
						      echo "<font color=\"#00CC00\">Access Point (Wifi) กำลังทำงาน</font><br>\n";
									echo "<a href=\"" . basename(__FILE__) . "?cmd=stop\" class=\"btn btn-danger btn-sm\">
													<span class=\"glyphicon glyphicon-signal\"></span> หยุดการทำงาน
												</a>";
						  }else{
									echo "LAN IP Address : " . $eth0data . "<br>";
						      echo "<font color=\"#CC0000\">Access Point (Wifi) หยุดทำงาน</font><br>\n";
									echo "<a href=\"" . basename(__FILE__) . "?cmd=start\" class=\"btn btn-info btn-sm\">
													<span class=\"glyphicon glyphicon-signal\"></span> เริ่มการทำงาน
												</a>";
						  }
					?>

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
