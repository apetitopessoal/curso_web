<h3>
    <i class="fa fa-angle-right"></i> Usuários Cadastradas
</h3>        
<button class="btn btn-primary" type="button" id="btn_adicionar_paginas">Adicionar Usuário</button>

<?php
if(!empty($_SESSION["sucesso_mensagem"])){
    /*
    ?>
    <p><?php echo $_SESSION["sucesso_mensagem"]?></p>
    <?php
    */
    ?>
    <script type="text/javascript">
        alert('<?php echo $_SESSION["sucesso_mensagem"]?>');
    </script>
    <?php
    unset($_SESSION["sucesso_mensagem"]);
}
?>

<div class="row mt">
    <div class="col-md-12">
        <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                <h4><i class="fa fa-angle-right"></i> Usuários</h4>
                <hr>
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th class="hidden-phone">
                            Nome
                        </th>
                        <th class="hidden-phone">
                            Email
                        </th>
                        <th>
                            <i class=" fa fa-edit"></i> Opções
                        </th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($usuarios->num_rows > 0){
                        
                        while($linhas = mysqli_fetch_assoc($usuarios)){
                            ?>
                            <tr>
                                <td>
                                    <?php echo $linhas["id"]?>
                                </td>
                                <td>
                                    <?php echo $linhas["nome"]?>
                                </td>
                                <td>
                                    <?php echo $linhas["email"]?>
                                </td>
                                <td>
                                    <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
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
        $("#btn_adicionar_paginas").click(function() {
            window.location.href = "<?php echo SITE_URL_ADMIN?>/add_usuario.php";
        });
    });
</script>
