<?php
	require 'connectdb.php';

	$user_id = $_POST['user_id'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$email = $_POST['email'];
	$sending_type = $_POST['sending_type'];


	$salt = 'jakljfiwnRRjionooaliJKFLAjslkd';
	$hash_password = hash_hmac('sha256', $password, $salt);

	$role = 10; 	/*ค่าเริ่มต้นเป็นบทบาทสมมุติเพื่อรอให้ admin มากำหนดให้อีกที*/

	$query = "insert into user (user_id, fname, lname, password, email, role) "
				 . "values ('$user_id', '$fname', '$lname', '$hash_password', '$email', '$role')";

	$result = mysqli_query($conn, $query);

	if($result){

		if($sending_type == "register"){

			$query_user = "select * from user where user_id='$user_id' AND password='$hash_password'";
			$result_user = mysqli_query($conn, $result_user);

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

		}else if($sending_type == "add"){
			header("Location: main.php");
		}
	}else{
		echo "เกิดข้อผิดพลาด <br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
 ?>
