<?php
	require '../connectdb.php';

	$subject_id = $_POST['subject_id'];

	$result = mysqli_query($conn, "DELETE FROM subject WHERE subject_id='$subject_id'");

	mysqli_close($conn);

	header("Location: ../main.php");
?>
