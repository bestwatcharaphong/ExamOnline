<?php

	require '../connectdb.php';

	$instructor_id = $_POST['instructor_id'];
	$subject_id = $_POST['subject_id'];
	$subject_name = $_POST['subject_name'];

	$query = "insert into subject (subject_id, subject_name, instructor_id) "
			 . "values ('$subject_id', '$subject_name', '$instructor_id')";

	$result = mysqli_query($conn, $query);

	if($result){
		header("Location: ../main.php");
	}else{
		echo "เกิดข้อผิดพลาด <br>" . mysqli_error($conn);
	}
	mysqli_close($conn);

 ?>
