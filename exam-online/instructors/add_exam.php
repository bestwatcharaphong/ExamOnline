<?php

	if (!isset($_POST['choice5'])) {				/*มี 4 ตัวเลือก*/
		require '../connectdb.php';

		date_default_timezone_set("Asia/Bangkok");

		$question = $_POST['question'];
		$choice1 = $_POST['choice1'];
		$choice2 = $_POST['choice2'];
		$choice3 = $_POST['choice3'];
		$choice4 = $_POST['choice4'];
		$answer_key = $_POST['answer_key'];
		$date = date('Y-m-d');
		$set_id = $_POST['set'];

		$query = "insert into exam (question, choice1, choice2, choice3, choice4, answer_key, date, set_id) "
				 . "values ('$question', '$choice1', '$choice2', '$choice3', '$choice4', $answer_key, '$date', '$set_id')";
		$result = mysqli_query($conn, $query);



		if($result){
			$query_exam = "select * from exam WHERE set_id = $set_id";
			$result_exam = mysqli_query($conn, $query_exam);
			$full_score = $result_exam->num_rows;

			$query_set = "UPDATE exam_set SET full_score = $full_score WHERE set_id = $set_id";
			$result_set = mysqli_query($conn, $query_set);

			if($result_set){
				header("Location: form_add_exam.php?set_id=$set_id");
				// header('Location: ' . $_SERVER['HTTP_REFERER']);
				exit;
			}else{
				echo "เกิดข้อผิดพลาด <br>" . mysqli_error($conn);
			}
		}else{
			echo "เกิดข้อผิดพลาด <br>" . mysqli_error($conn);
		}
		mysqli_close($conn);




	}else{										/*มี 5 ตัวเลือก*/




		require '../connectdb.php';

		$question = $_POST['question'];
		$choice1 = $_POST['choice1'];
		$choice2 = $_POST['choice2'];
		$choice3 = $_POST['choice3'];
		$choice4 = $_POST['choice4'];
		$choice5 = $_POST['choice5'];
		$answer_key = $_POST['answer_key'];
		$date = date('Y-m-d');
		$set_id = $_POST['set'];

		$query = "insert into exam (question, choice1, choice2, choice3, choice4, choice5, answer_key, date, set_id) "
				 . "values ('$question', '$choice1', '$choice2', '$choice3', '$choice4', '$choice5', $answer_key, '$date', '$set_id')";
		$result = mysqli_query($conn, $query);

		if($result){
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
		}else{
			echo "เกิดข้อผิดพลาด <br>" . mysqli_error($conn);
		}
		mysqli_close($conn);


	}





 ?>
