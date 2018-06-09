<?php
	require '../connectdb.php';

	$set_id = $_POST['set_id'];
	$subject_id = $_POST['subject_id'];

	$result = mysqli_query($conn, "DELETE FROM exam_set WHERE set_id = $set_id");

	mysqli_close($conn);

	// header("Location: set_instructor.php");
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
?>
