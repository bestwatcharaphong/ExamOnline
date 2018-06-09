<?php
	if (!isset($_POST['choice5'])) {				/*มี 4 ตัวเลือก*/

		require '../connectdb.php';

		$exam_id = $_POST['exam_id'];
		$question = $_POST['question'];
		$choice1 = $_POST['choice1'];
		$choice2 = $_POST['choice2'];
		$choice3 = $_POST['choice3'];
		$choice4 = $_POST['choice4'];
		$answer_key = $_POST['answer_key'];

		$query = "UPDATE exam SET question='$question', choice1='$choice1', choice2='$choice2', choice3='$choice3', choice4='$choice4', answer_key=$answer_key WHERE exam_id=$exam_id";
		$result = mysqli_query($conn, $query);

		if($result){
			$query_set = "select * from exam where exam_id = $exam_id";
			$result_set = mysqli_query($conn, $query_set);

			$row_set = mysqli_fetch_assoc($result_set);
			$set_id = $row_set['set_id'];

			// header("Location: set_detail.php?set_id=$set_id");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			exit;
		}else{
			echo "เกิดข้อผิดพลาด <br>" . mysqli_error($conn);
		}
		mysqli_close($conn);


	} else {										/*มี 5 ตัวเลือก*/


		require '../connectdb.php';

		$exam_id = $_POST['exam_id'];
		$question = $_POST['question'];
		$choice1 = $_POST['choice1'];
		$choice2 = $_POST['choice2'];
		$choice3 = $_POST['choice3'];
		$choice4 = $_POST['choice4'];
		$choice5 = $_POST['choice5'];
		$answer_key = $_POST['answer_key'];

		$query = "UPDATE exam SET question='$question', choice1='$choice1', choice2='$choice2', choice3='$choice3', choice4='$choice4', choice5='$choice5', answer_key=$answer_key WHERE exam_id=$exam_id";
		$result = mysqli_query($conn, $query);

		if($result){
			$query_set = "select * from exam where exam_id = $exam_id";
			$result_set = mysqli_query($conn, $query_set);

			$row_set = mysqli_fetch_assoc($result_set);
			$set_id = $row_set['set_id'];

			header("Location: set_detail.php?set_id=$set_id");
		}else{
			echo "เกิดข้อผิดพลาด <br>" . mysqli_error($conn);
		}
		mysqli_close($conn);

	}

 ?>
