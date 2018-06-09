<?php
	require '../connectdb.php';

	$user_id = $_POST['user_id'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$role = $_POST['role'];

	$query = "UPDATE user SET fname='$fname', lname='$lname', email='$email', role=$role WHERE user_id='$user_id'";

	$result = mysqli_query($conn, $query);

	if($result){
		header("Location: ../main.php");
	}else{
		echo "เกิดข้อผิดพลาด <br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
 ?>
