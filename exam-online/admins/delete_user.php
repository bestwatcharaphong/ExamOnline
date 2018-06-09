<?php
	require '../connectdb.php';

	$user_id = $_POST['user_id'];

	$result = mysqli_query($conn, "DELETE FROM user WHERE user_id='$user_id'");

	mysqli_close($conn);

	header("Location: ../main.php");
?>
