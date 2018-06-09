<?php

	//$raspberrypi_ip = "192.168.2.40";				/* Config Raspberry Pi */

	$conn = mysqli_connect('localhost', 'root', '', 'exam-online');
	mysqli_set_charset($conn, "utf8");

	if(mysqli_connect_errno()){
		echo "ไม่สามารถเชื่อมต่อฐานข้อมูล MySQL ได้ <br>" . mysqli_connect_errno();
	}

 ?>
