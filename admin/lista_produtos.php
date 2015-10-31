<?php
session_start();
session_regenerate_id();
include_once("../configuracao.php");
if(!Usuario::ValidarLogin()){
    session_destroy();
    header("Location: login.php");
    exit;
}else{
    $produtos = Produto::ListarProdutos(1);
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
                        <?php include_once "tabela_produto.php"; ?>                        
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
                function DeleteProduto(id){
                    if(confirm("Tem certeza que deseja apagar esse Produto ?")){
                        $.ajax({
                            url: '<?php echo SITE_URL_ADMIN?>/delete_produto.php?id='+id,                            
                        }).done(function() {
                            alert("Produto apagado com sucesso!");
                            location.reload();
                        })
                        
                        
                    }
                }
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
