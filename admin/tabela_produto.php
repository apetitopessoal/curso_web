<h3>
    <i class="fa fa-angle-right"></i> Produtos Cadastrados
</h3>        
<button class="btn btn-primary" type="button" id="btn_adicionar_produtos">Adicionar Produto</button>
<?php
if(!empty($_SESSION["sucesso_mensagem"])){
    ?>
    <p><?php echo $_SESSION["sucesso_mensagem"]?></p>
    <?php
    unset($_SESSION["sucesso_mensagem"]);
}
if(!empty($_SESSION["error_msg"])){
    ?>
    <p><?php echo $_SESSION["error_msg"]?></p>
    <?php
    unset($_SESSION["error_msg"]);
}
?>
<div class="row mt">
    <div class="col-md-12">
        <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                <h4><i class="fa fa-angle-right"></i> Produtos</h4>
                <hr>
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th class="hidden-phone">
                            Nome
                        </th>
                        <th>
                            <i class=" fa fa-edit"></i> Opções
                        </th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($produtos->num_rows > 0){                        
                        while($linhas = mysqli_fetch_assoc($produtos)){
                            ?>
                            <tr>
                                <td>
                                    <?php echo $linhas["id"]?>
                                </td>
                                <td>
                                    <?php echo $linhas["nome"]?>
                                </td>
                                <td>
                                    <a href="edit_produto.php?id=<?php echo $linhas["id"]?>">
                                        <button class="btn btn-primary btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </a>                                    
                                    <button class="btn btn-danger btn-xs" onclick="javascript:DeleteProduto(<?php echo $linhas["id"]?>)">
                                        <i class="fa fa-trash-o "></i>
                                    </button>
                                </td>
                            </tr>    
                            <?php
                        }
                    }else{
                        ?>
                        <tr>
                            <td colspan="3">
                                Nenhum Registro Encontrado
                            </td>
                        </tr>    
                        <?php
                    }
                    ?>                    
                </tbody>
            </table>
        </div><!-- /content-panel -->
    </div><!-- /col-md-12 -->
</div><!-- /row -->

<script>
    $( document ).ready(function() {
        $("#btn_adicionar_produtos").click(function() {
            window.location.href = "<?php echo SITE_URL_ADMIN?>/add_produto.php";
        });
    });
</script>
