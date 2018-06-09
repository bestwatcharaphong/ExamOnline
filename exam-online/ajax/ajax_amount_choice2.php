<?php
	require '../connectdb.php';

/* ทำงานเป็นฝั่ง server */
/*---------------------------------------------------1----------------------------------------------------------------*/
	if(isset($_POST['set_id']) && !empty($_POST['set_id']) && isset($_POST['amount_choice']) && !empty($_POST['amount_choice'])){
		$amount_choice = $_POST['amount_choice'];
		$set_id = $_POST['set_id'];

		$query_amount = "UPDATE exam_set SET amount_choice = $amount_choice WHERE set_id = $set_id";
		$result_amount = mysqli_query($conn, $query_amount);

		 if($amount_choice == 5){
			echo '<label for="choice5" style="font-weight: normal;">ตัวเลือก 5</label>';
			echo '<input type="text" name="choice5" id="choice5" class="form-control" required>';
		}else if($amount_choice == 4){
			echo "";
		}
	}

?>
