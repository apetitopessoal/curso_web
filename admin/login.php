<?php  
    session_start();
    session_regenerate_id();
    include_once("../configuracao.php");
    unset($mensagem);
    if($_POST){        
        if(Usuario::Login($_POST["email"], $_POST["senha"])){
            header("Location: lista_pagina.php");
            exit;
        }else{
            $mensagem = "Usuário Inválido!";
        }
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">
  <?php
  include_once("tag_head.php");
  ?>
  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  		<?php
	  		include_once("forms/form_login.php");
	  		?>
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/ferrari-background-admin.jpg", {speed: 500});
    </script>


  </body>
</html>
