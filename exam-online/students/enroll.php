<?php
	require '../connectdb.php';

	if(isset($_POST['enroll'])){
		$user_id = $_POST['user_id'];
		$subject_id = $_POST['subject_id'];
		$date = date('Y-m-d');

		$query = "insert into enroll (user_id, subject_id, enroll_date) "
				 . "values ('$user_id', '$subject_id', '$date')";

		$result = mysqli_query($conn, $query);

		if($result){
			// header("Location: student_enroll.php");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			exit;
		}else{
			echo "เกิดข้อผิดพลาด <br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
?>
