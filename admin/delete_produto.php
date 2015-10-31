<?php
session_start();
session_regenerate_id();
include_once("../configuracao.php");
if(!Usuario::ValidarLogin()){
    header("Location: login.php");
    exit;
}else{      
    if(is_numeric($_GET["id"])){        
        Produto::Delete($_GET["id"]);
    }
    
}
?>
