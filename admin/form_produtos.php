<script type="text/javascript" src="http://curso_web.com/admin/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "#conteudo"
    });
</script>
<h3>
    <i class="fa fa-angle-right"></i> 
    Produtos
</h3>

<!-- BASIC FORM ELELEMNTS -->
<div class="row mt">
    <div class="col-lg-12">
        <div class="form-panel">
            <h4 class="mb">
                <i class="fa fa-angle-right"></i> 
                Produto
            </h4>
            <form class="form-horizontal style-form" method="post" enctype='multipart/form-data'>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">
                        Título da Produto
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nome" <?php echo (!empty($produtoObj->nome) ? "value='".$produtoObj->nome."'" : "")?> >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">
                        Descrição
                    </label>
                    <div class="col-sm-10">                        
                        <textarea id="conteudo" name="descricao"><?php echo (!empty($produtoObj->descricao) ? $produtoObj->descricao : "")?></textarea>
                    </div>
                </div>                                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">
                        Valor
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="valor" <?php echo (!empty($produtoObj->valor) ? "value='".$produtoObj->valor."'" : "")?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">
                        Foto
                    </label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="foto">
                        <?php 
                        if(!empty($produtoObj->foto)){
                            ?>
                            <br />
                            <img src="<?php echo $produtoObj->foto?>" class="img-circle" width="60" />
                            <?php
                        }
                        ?>
                    </div>
                </div>      
                <input type="submit" class="btn btn-primary" value="Salvar" />
            </form>
        </div>
    </div><!-- col-lg-12-->      	
</div><!-- /row -->


    