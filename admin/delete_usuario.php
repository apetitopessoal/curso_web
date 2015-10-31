<?php
session_start();
session_regenerate_id();
include_once("../configuracao.php");
if(!Usuario::ValidarLogin()){
    header("Location: login.php");
    exit;
}else{      
    if(is_numeric($_GET["id"]) && ($_GET["id"] != $_SESSION["id"])){        
        Usuario::Delete($_GET["id"]);
    }
    
}
?>
