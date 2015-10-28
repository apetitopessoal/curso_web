<?php
	
	session_start();
	$_SESSION["email"] = "rodrigoapetito@gmail.com";

	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
?>
<a href="http://curso_web.com/index.php">Curso</a>
<a href="http://curso_web.com/logout.php">Logout</a>