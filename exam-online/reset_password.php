<?php
	if(isset($_POST['reset'])){
		require 'connectdb.php';

		$user_id = $_POST['user_id'];
		$password = $_POST['password'];

		$salt = 'jakljfiwnRRjionooaliJKFLAjslkd';
		$hash_password = hash_hmac('sha256', $password, $salt);

		$query = "UPDATE user SET password = '$hash_password', password_token = '' WHERE user_id = '$user_id'";
		$result = mysqli_query($conn, $query);

		$result = mysqli_query($conn, $query);

		if($result){
			header("Location: form_login.php");
		}else{
			echo "เกิดข้อผิดพลาด <br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
?>

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

</head>
<body>


	<div class="container">
		<div class="row">
			 <div class="col-md-4 col-md-offset-4">
				 <div class="panel panel-default">
					 <div class="panel-body">

				  <?php
					  if (isset($_GET['email']) && isset($_GET['token'])) {
						  require 'connectdb.php';

						  $email = $_GET['email'];
						  $token = $_GET['token'];

						  $query = "select * from user WHERE email = '$email' AND password_token = '$token'";
						  $result = mysqli_query($conn, $query);
						  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

						  if($result->num_rows == 1){
				  ?>
							  <form class="form-group" action="reset_password.php" method="post">

								<div align="center">
									 <h2 style="font-size: 25px; color: #fff;">กำหนดรหัสผ่านใหม่</h2>
								</div>
								<hr>

								<div class="form-group" align="center" style="font-size: 20px;">
									<label><?php echo $row['fname'] . " " . $row['lname'] ?></label>
								</div>

								<div class="form-group">
									<label for="password">รหัสผ่าน </label>
									<input type="password" name="password" id="password" class="form-control" required>
								</div>

								<input type="hidden" name="user_id" id="user_id" value="<?php echo $row['user_id']; ?>">
								<button class="btn btn-success btn-block" type="submit" name="reset">ตกลง</button><br>

							 </form>

			<?php
						  }else{
							  echo "URL ของคุณไม่ถูกต้อง";
						  }

					} else {
						 echo "URL ของคุณไม่ถูกต้อง";
					}

	   		?>
					</div><!-- panel-body -->
				</div><!-- panel-default -->
		    </div><!-- col -->
		 </div><!-- row -->

	 </div><!--container-->


</body>
</html>
