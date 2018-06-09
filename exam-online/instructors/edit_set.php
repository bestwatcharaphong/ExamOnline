<?php
	require '../connectdb.php';

	$set_id = $_POST['set_id'];
	$subject_id = $_POST['subject_id'];
	$set_name = $_POST['set_name'];
	$set_time = $_POST['time'];

	$query = "UPDATE exam_set SET set_name='$set_name', set_time=$set_time WHERE set_id=$set_id";
	$result = mysqli_query($conn, $query);

	if($result){
		// header("Location: set_instructor.php");
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}else{
		echo "เกิดข้อผิดพลาด <br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
 ?>
