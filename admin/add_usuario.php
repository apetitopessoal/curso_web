<?php
session_start();
if(!$_SESSION["usuario"]){
    header("Location: login.php");
    exit;
}else{
    include_once("../configuracao.php");
    include_once("../classes/class_conexao.php");
    include_once("../classes/class_usuario.php");
    
    if($_POST){
        if(!empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["senha"])){
            if(Usuario::Adicionar($_POST)){
                $_SESSION["sucesso_mensagem"] = "Usuário cadastrada com sucesso!";
                header("Location: ".SITE_URL_ADMIN."/lista_usuarios.php");
                exit;
            }
            
        }
    }
    
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <?php
        include_once("tag_head.php");
        ?>
        <body>
            <section id="container" >
                <?php
                include_once("header.php");
                include_once("menu.php");
                ?>
                <section id="main-content">
                    <section class="wrapper">
                        <?php include_once "form_usuario.php"; ?>
                    </section>
                </section>
            </section>
            <!-- js placed at the end of the document so the pages load faster -->
            <script src="assets/js/jquery.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
            <script src="assets/js/jquery.scrollTo.min.js"></script>
            <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


            <!--common script for all pages-->
            <script src="assets/js/common-scripts.js"></script>

            <!--script for this page-->
            <script>
                //custom select box
                $(function () {
                    $('select.styled').customSelect();
                });
            </script>
        </body>
    </html>
    <?php
}
?>
