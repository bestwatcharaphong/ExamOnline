<?php
	require '../connectdb.php';

	/* ทำงานเป็นฝั่ง server */

		$activeflag = $_POST['activeflag'];
		$set_activeflag_id = $_POST['set_activeflag_id'];

		$query = "UPDATE `exam_set` SET `activeflag` = $activeflag WHERE `set_id` = $set_activeflag_id";
		$result = mysqli_query($conn, $query);

/*-------------------------------------------------------------------------------------------------------------------*/

?>
