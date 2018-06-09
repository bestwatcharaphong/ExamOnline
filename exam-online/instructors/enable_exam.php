<?php
	require '../connectdb.php';

	$activeflag = $_POST['activeflag'];
	$set_id = $_POST['set_id'];
	$subject_id = $_POST['subject_id'];

	if($activeflag == 0){
		$activeflag = 1;
	}else if($activeflag == 1){
		$activeflag = 0;
	}

	$query = "UPDATE exam_set SET activeflag = $activeflag WHERE set_id = $set_id";
	$result = mysqli_query($conn, $query);

	if($result){
		// header("LOCATION: set_instructor.php");
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}else{
		echo "เกิดข้อผิดพลาด <br>" . mysqli_error($conn);
	}
?>
