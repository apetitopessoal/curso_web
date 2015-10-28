<?php

	$nome = "Rodrigo Apetito";

	echo strpos($nome,"Rodrigo");


	if(strpos( $_SERVER["REQUEST_URI"], "index.php") !== false){
		echo "dentro do if";
	}else{
		echo "dentro do else";
	}



?>