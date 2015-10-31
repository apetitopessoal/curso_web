<?php
session_start();
session_regenerate_id();
include_once("../configuracao.php");
if(!Usuario::ValidarLogin()){
    header("Location: login.php");
    exit;
}else{   
    if($_POST){
        if(!empty($_POST["titulo"]) && !empty($_POST["conteudo"])){
            if(Paginas::Adicionar($_POST)){
                $_SESSION["sucesso_mensagem"] = "Página cadastrada com sucesso!";
                header("Location: ".SITE_URL_ADMIN."/lista_pagina.php");
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
                        <?php //include_once "tabela_modelo.php"; ?>
                        <?php include_once "form_paginas.php"; ?>
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
