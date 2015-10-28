<script type="text/javascript" src="http://curso_web.com/admin/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "#conteudo"
    });
</script>
<h3>
    <i class="fa fa-angle-right"></i> 
    Páginas
</h3>

<!-- BASIC FORM ELELEMNTS -->
<div class="row mt">
    <div class="col-lg-12">
        <div class="form-panel">
            <h4 class="mb">
                <i class="fa fa-angle-right"></i> 
                Página
            </h4>
            <form class="form-horizontal style-form" method="post">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">
                        Título da Página
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="titulo">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">
                        Conteúdo
                    </label>
                    <div class="col-sm-10">                        
                        <textarea id="conteudo" name="conteudo"></textarea>
                    </div>
                </div>                                
                <input type="submit" class="btn btn-primary" value="Salvar" />
            </form>
        </div>
    </div><!-- col-lg-12-->      	
</div><!-- /row -->


    