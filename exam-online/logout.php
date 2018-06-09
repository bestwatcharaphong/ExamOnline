<?php

	session_start();

	if (session_destroy()) {				//ทำลาย session
		header("Location: form_login.php");
	}

 ?>
