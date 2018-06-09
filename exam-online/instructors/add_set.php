<?php
	require '../connectdb.php';

	date_default_timezone_set("Asia/Bangkok");

	$set_name = $_POST['set_name'];
	$date = date('Y-m-d');
	$time = $_POST['time'];
	$subject_id = $_POST['subject_id'];

	$query = "INSERT INTO exam_set (set_name, set_date, set_time, subject_id, full_score, amount_choice, activeflag) "
			 . "VALUES ('$set_name', '$date', $time, '$subject_id', 0, 4, 1)";

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
