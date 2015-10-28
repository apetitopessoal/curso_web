<h3>
    <i class="fa fa-angle-right"></i> Páginas Cadastradas
</h3>        
<button class="btn btn-primary" type="button" id="btn_adicionar_paginas">Adicionar Páginas</button>
<div class="row mt">
    <div class="col-md-12">
        <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                <h4><i class="fa fa-angle-right"></i> Páginas</h4>
                <hr>
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th class="hidden-phone">
                            Título
                        </th>
                        <th>
                            <i class=" fa fa-edit"></i> Opções
                        </th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($paginas->num_rows > 0){
                        
                        while($linhas = mysqli_fetch_assoc($paginas)){
                            ?>
                            <tr>
                                <td>
                                    <?php echo $linhas["id"]?>
                                </td>
                                <td>
                                    <?php echo $linhas["titulo"]?>
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
            window.location.href = "<?php echo SITE_URL_ADMIN?>/add_pagina.php";
        });
    });
</script>
