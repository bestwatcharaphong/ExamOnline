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
	<script type="text/javascript" language="javascript" src="../js/jquery-3.2.1.min.js"></script>

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
	</div>

		<div class="container">
			 <div class="container-content">

				 <!-- Sidebar -->
				 <div class="nav navbar-default" role="navigation">
						 <div id="sidebar-wrapper" class="sidebar-toggle" align="center">
							 <ul class="sidebar-nav">
								 <li><a href="../main.php">จัดการรายวิชา</a></li>
								 <li><a href="set_instructor.php">จัดการชุดข้อสอบ</a></li>
								 <li class="sidebar-selected"><a href="#">บันทึกข้อสอบ</a></li>
								 <li><a href="static_exam.php">สถิติการสอบ</a></li>
								 <li><a href="../wifi_manager.php">Wifi</a></li>
							 </ul>
						 </div>
				  </div>
				<!-- END Sidebar -->

				<div id="fullpage_service" class="fullpage-wrapper" style="height: 100%; position: relative; transform: translate3d(0px, 0px, 0px); transition: all 0ms ease;">

					<div class="section fp-auto-height-responsive bgecommerce fp-section fp-table active fp-completely" data-anchor="Ecommerce" style="height: 901px;">
						<div class="fp-tableCell" style="height: 901px;">
						  <div class="bg_ecommerce">
				            <div class="container-fluid">
						        <div class="row">
									<?php
										if(isset($_GET['set_id'])){
											$set_id = $_GET['set_id'];

											$query = "select * from exam_set where set_id = $set_id";
											$result = mysqli_query($conn, $query);
											$row = mysqli_fetch_assoc($result);

											$set_name = $row['set_name'];
											$subject_id = $row['subject_id'];
										}else{
											$set_name = "";
											$subject_id = "";
										}
									?>

									<form class="form-add" action="add_exam.php" method="post" style="font-family: sans-serif;" enctype="multipart/form-data">

					   				   <h3 align="center" style="font-size: 20px;">เพิ่มข้อสอบ</h3><br>
									   <div class="row">
										   <div class="form-group col-xs-5 col-md-2">
											   <?php
				   									$query = "select * from subject where instructor_id = $user_id";
				   									$result = mysqli_query($conn, $query);
				   								?>

		    								   <label for="subject_id" style="font-weight: normal;">รายวิชา</label>
		    								   <select name="subject_id" id="subject_id" required class="form-control" required>
												   <option><?php echo $subject_id; ?></option>
											   <?php
											   		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
														if($row['subject_id'] != $subject_id){
											   ?>
			    									   		<option value="<?php echo $row['subject_id']; ?>"><?php echo $row['subject_id']; ?></option>
											   <?php
										   				}
													}
											   ?>
		    								   </select>

		    							   </div>

		    							   <div class="form-group col-xs-6 col-md-4">
											   <?php
				   									$query = "select * from exam_set WHERE subject_id = '$subject_id'";
				   									$result = mysqli_query($conn, $query);
				   								?>

		    								   <label for="set" style="font-weight: normal;">ชุดข้อสอบ</label>
											   <select name="set" id="set" class="form-control" required>
												   <?php
														if(isset($_GET['set_id'])){
															echo '<option value="' . $set_id . '">' . $set_name . '</option>';
													}

														while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
															if($row['set_id'] != $set_id){
													?>
												   			<option value="<?php echo $row['set_id']; ?>"><?php echo $row['set_name']; ?></option>
													<?php
													   		}
														}
													?>
											   </select>
		    							   </div>
										</div>
									   	<hr>

									<?php
										if(isset($_GET['set_id'])){
											$query_order = "select * from exam WHERE set_id = $set_id";
											$result_order = mysqli_query($conn, $query_order);

											$amount = $result_order->num_rows;
											$amount = $amount + 1;

											$query_amount = "select * from exam_set WHERE set_id = $set_id";
											$result_amount = mysqli_query($conn, $query_amount);
											$row_amount = mysqli_fetch_array($result_amount, MYSQLI_ASSOC);

											$amount_choice = $row_amount['amount_choice'];
										}else{
											$amount_choice = 4;
										}
									?>

										<div class="row">
										    <div class="form-group col-md-12">
			   			   					    <label for="question" style="font-weight: normal;">คำถาม</label>&nbsp;
												<label class="question_order">
													<?php
														if(isset($_GET['set_id'])){
															echo "ข้อที่ " . $amount;
														}
													?>
												</label>
												<textarea name="question" id="question" class="form-control" rows="5" required><?php echo $row['question']; ?></textarea>

			   			   					</div>

											<div class="form-group col-xs-5 col-md-2">
												<label for="amount_choice" style="font-weight: normal;">จำนวนตัวเลือก</label>
												<select name="amount_choice" id="amount_choice" class="form-control" required>
													<option value="<?php
														if(isset($_GET['set_id'])){
															$query_order = "select * from exam WHERE set_id = $set_id";
															$result_order = mysqli_query($conn, $query_order);

															$amount = $result_order->num_rows;
															$amount = $amount + 1;

															$query_amount = "select * from exam_set WHERE set_id = $set_id";
															$result_amount = mysqli_query($conn, $query_amount);
															$row_amount = mysqli_fetch_array($result_amount, MYSQLI_ASSOC);

															$amount_choice = $row_amount['amount_choice'];
														}else{
															$amount_choice = 4;
														}
														echo $amount_choice;
													?>"><?php
														if(isset($_GET['set_id'])){
															$query_order = "select * from exam WHERE set_id = $set_id";
															$result_order = mysqli_query($conn, $query_order);

															$amount = $result_order->num_rows;
															$amount = $amount + 1;

															$query_amount = "select * from exam_set WHERE set_id = $set_id";
															$result_amount = mysqli_query($conn, $query_amount);
															$row_amount = mysqli_fetch_array($result_amount, MYSQLI_ASSOC);

															$amount_choice = $row_amount['amount_choice'];
														}else{
															$amount_choice = 4;
														}
														echo $amount_choice;
													?></option>
													<option value="<?php
															if(isset($_GET['set_id'])){
																$query_order = "select * from exam WHERE set_id = $set_id";
																$result_order = mysqli_query($conn, $query_order);

																$amount = $result_order->num_rows;
																$amount = $amount + 1;

																$query_amount = "select * from exam_set WHERE set_id = $set_id";
																$result_amount = mysqli_query($conn, $query_amount);
																$row_amount = mysqli_fetch_array($result_amount, MYSQLI_ASSOC);

																$amount_choice = $row_amount['amount_choice'];
															}else{
																$amount_choice = 4;
															}
															if($amount_choice == 4) {echo 5;}else{echo 4;}
														?>">
														<?php
																if(isset($_GET['set_id'])){
																	$query_order = "select * from exam WHERE set_id = $set_id";
																	$result_order = mysqli_query($conn, $query_order);

																	$amount = $result_order->num_rows;
																	$amount = $amount + 1;

																	$query_amount = "select * from exam_set WHERE set_id = $set_id";
																	$result_amount = mysqli_query($conn, $query_amount);
																	$row_amount = mysqli_fetch_array($result_amount, MYSQLI_ASSOC);

																	$amount_choice = $row_amount['amount_choice'];
																}else{
																	$amount_choice = 4;
																}
																if($amount_choice == 4) {echo 5;}else{echo 4;}
															?>
													</option>
												</select>
			   			   					</div>

			   			   					<div class="form-group col-xs-12 col-md-12">
			   			   			   			<label for="choice1" style="font-weight: normal;">ตัวเลือก 1</label>
			   			   			   			<input type="text" name="choice1" id="choice1" class="form-control" required>
			   			   					</div>
			   			   					<div class="form-group col-xs-12 col-md-12">
			   			   			   			<label for="choice2" style="font-weight: normal;">ตัวเลือก 2</label>
			   			   			   			<input type="text" name="choice2" id="choice2" class="form-control" required>
			   			   					</div>
			   			   					<div class="form-group col-xs-12 col-md-12">
			   			   			   			<label for="choice3" style="font-weight: normal;">ตัวเลือก 3</label>
			   			   			   			<input type="text" name="choice3" id="choice3" class="form-control" required>
			   			   					</div>
			   			   					<div class="form-group col-xs-12 col-md-12">
			   			   			   			<label for="choice4" style="font-weight: normal;">ตัวเลือก 4</label>
			   			   			   			<input type="text" name="choice4" id="choice4" class="form-control" required>
			   			   					</div>

											<div class="form-group col-xs-12 col-md-12" id="choice5_div">
										<?php
											if(isset($_GET['set_id'])){
												$query_order = "select * from exam WHERE set_id = $set_id";
												$result_order = mysqli_query($conn, $query_order);

												$amount = $result_order->num_rows;
												$amount = $amount + 1;

												$query_amount = "select * from exam_set WHERE set_id = $set_id";
												$result_amount = mysqli_query($conn, $query_amount);
												$row_amount = mysqli_fetch_array($result_amount, MYSQLI_ASSOC);

												$amount_choice = $row_amount['amount_choice'];
											}else{
												$amount_choice = 4;
											}
											if($amount_choice == 5){
										?>
												<label for="choice5" style="font-weight: normal;">ตัวเลือก 5</label>
												<input type="text" name="choice5" id="choice5" class="form-control" required>
										<?php
											}
										?>
											</div>

			   			   					<div class="form-group col-xs-5 col-md-2">
			   			   			   			<label for="answer_key" style="font-weight: normal;">เฉลย</label>
												<input type="number" name="answer_key" id="answer_key" class="form-control" min="1" max="5" required>
			   			   					</div>

										  <div class="form-group col-xs-12 col-md-12">
				   								<input type="hidden" name="set_id" id="set_id" value="<?php echo $set_id ?>">
				   								<a onclick='location = "main.php"' class="btn btn-default glyphicon glyphicon-chevron-left back"> กลับ</a>
				   			   				    <button class="btn btn-success" type="submit" style="float: right; width: 80px;">เพิ่ม</button>
										  </div>
									   </div><!--row-->
					   			  	</form>
								</div>
				                </div>
				            </div>
						</div>
					</div></div><!--e-commerce-->

				</div>
		</div>

	</div>

	<?php
			} else {
				require '../access_denied.php';
			}
		}

		require '../footer/footer.php';
	?>

</body>
</html>
