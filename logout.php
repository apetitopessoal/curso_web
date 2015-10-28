<?php

	session_start();
	session_destroy();

	header("Location: http://curso_web.com/index.php");
	exit;
?>