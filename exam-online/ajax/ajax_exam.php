<?php
	require '../connectdb.php';

	/* ทำงานเป็นฝั่ง server */
	if(isset($_POST['subject_id']) && !empty($_POST['subject_id'])){
		/*Get subject data*/
		$subject_id = $_POST['subject_id'];
		$query = "select * from exam_set WHERE subject_id = '$subject_id'";
		$result = mysqli_query($conn, $query);

		$count_row = mysqli_num_rows($result);

		/*Display Set list*/
		if($count_row > 0){
			echo '<option></option>';		/*หลังการประมวลผล ก็ส่งข้อมูลกลับออกไปด้วยคำสั่ง echo ตามปกติ*/
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				echo '<option value="' . $row['set_id'] . '">' . $row['set_name'] . '</option>';
			}
		}else{
			echo '<option value="">ไม่มีชุดข้อสอบรายวิชานี้</option>';
		}
	}
/*-------------------------------------------------------------------------------------------------------------------*/
	if(isset($_POST['set_id']) && !empty($_POST['set_id'])){

		$set_id = $_POST['set_id'];
		$query_order = "select * from exam WHERE set_id = $set_id";
		$result_order = mysqli_query($conn, $query_order);

		$amount = $result_order->num_rows;			 //mysqli_num_rows($result_order);

		echo "ข้อที่ " . ($amount + 1);					/*หลังการประมวลผล ก็ส่งข้อมูลกลับออกไปด้วยคำสั่ง echo ตามปกติ*/
	}

/*-------------------------------------------------------------------------------------------------------------------*/


?>
