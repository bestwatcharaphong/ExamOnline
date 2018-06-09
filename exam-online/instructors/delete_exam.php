<?php
	require '../connectdb.php';

	$exam_id = $_POST['exam_id'];
	$set_id = $_POST['set_id'];

	$result = mysqli_query($conn, "DELETE FROM exam WHERE exam_id = $exam_id");

	$query_exam = "select * from exam WHERE set_id = $set_id";
	$result_exam = mysqli_query($conn, $query_exam);
	$full_score = $result_exam->num_rows;

	$query_set = "UPDATE exam_set SET full_score = $full_score WHERE set_id = $set_id";
	$result_set = mysqli_query($conn, $query_set);

	if($result_set){
		header("Location: form_add_exam.php?set_id=$set_id");
	}else{
		echo "เกิดข้อผิดพลาด <br>" . mysqli_error($conn);
	}

	mysqli_close($conn);

	// header("Location: set_detail.php?set_id=$set_id");
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
?>
