<?php
	require '../connectdb.php';

	$subject_id = $_POST['subject_id'];
	$subject_name = $_POST['subject_name'];

	$query = "UPDATE `subject` SET `subject_name` = '$subject_name' WHERE `subject`.`subject_id` = '$subject_id';";

	$result = mysqli_query($conn, $query);

	if($result){
		header("Location: ../main.php");
	}else{
		echo "เกิดข้อผิดพลาด <br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
 ?>
