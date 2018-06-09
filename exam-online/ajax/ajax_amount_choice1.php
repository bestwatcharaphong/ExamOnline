<?php
	require '../connectdb.php';

/* ทำงานเป็นฝั่ง server */
/*---------------------------------------------------1----------------------------------------------------------------*/
	if(isset($_POST['set_id']) && !empty($_POST['set_id'])){
		$set_id = $_POST['set_id'];

		$query_amount = "select amount_choice from exam_set WHERE set_id = $set_id";
		$result_amount = mysqli_query($conn, $query_amount);
		$row_amount = mysqli_fetch_array($result_amount, MYSQLI_ASSOC);

		$amount_choice = $row_amount['amount_choice'];

		/*Display amount choice list*/
		if($amount_choice == 5){
			echo '<option value="5">5</option>';						/*หลังการประมวลผล ก็ส่งข้อมูลกลับออกไปด้วยคำสั่ง echo ตามปกติ*/
			echo '<option value="4">4</option>';						/*หลังการประมวลผล ก็ส่งข้อมูลกลับออกไปด้วยคำสั่ง echo ตามปกติ*/
		}else if($amount_choice == 4){
			echo '<option value="4">4</option>';						/*หลังการประมวลผล ก็ส่งข้อมูลกลับออกไปด้วยคำสั่ง echo ตามปกติ*/
			echo '<option value="5">5</option>';
		}
	}

?>
