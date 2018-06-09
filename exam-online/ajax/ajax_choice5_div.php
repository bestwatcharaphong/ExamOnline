<?php
	require '../connectdb.php';

/* ทำงานเป็นฝั่ง server */
/*---------------------------------------------------1----------------------------------------------------------------*/
	if(isset($_POST['set_id']) && !empty($_POST['set_id'])){
		$set_id = $_POST['set_id'];

		$query_amount = "SELECT amount_choice from exam_set WHERE set_id = $set_id";
		$result_amount = mysqli_query($conn, $query_amount);
		$row_amount = mysqli_fetch_array($result_amount, MYSQLI_ASSOC);

		$amount_choice = $row_amount['amount_choice'];

		if($amount_choice == 5){
			echo '<label for="choice5" style="font-weight: normal;">ตัวเลือก 5</label>';
			echo '<input type="text" name="choice5" id="choice5" class="form-control" required>';
		}else if($amount_choice == 4){
			echo "";
		}
	}

	if(isset($_POST['amount_choice']) && !empty($_POST['amount_choice']) && isset($_POST['set_id']) && ($_POST['set_id'])==''){
		$amount_choice = $_POST['amount_choice'];

		if($amount_choice == 5){
			echo '<label for="choice5" style="font-weight: normal;">ตัวเลือก 5</label>';
			echo '<input type="text" name="choice5" id="choice5" class="form-control" required>';
		}else if($amount_choice == 4){
			echo "";
		}
	}

?>
