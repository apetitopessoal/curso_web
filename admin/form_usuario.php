<h3>
    <i class="fa fa-angle-right"></i> 
    Usuários
</h3>

<!-- BASIC FORM ELELEMNTS -->
<div class="row mt">
    <div class="col-lg-12">
        <div class="form-panel">
            <h4 class="mb">
                <i class="fa fa-angle-right"></i> 
                Usuários
            </h4>
            <?php
            if(count($mensagem_erro)){
                foreach($mensagem_erro as $erros){
                    ?>
                    <p style="color:red"><?php echo $erros?></p>    
                    <?php
                }
            }
            ?>
            <form class="form-horizontal style-form" method="post" enctype='multipart/form-data'>
                <?php
                if(!empty($usuarioObj->id)){
                    ?>
                    <input type="hidden" name="id" value="<?php echo $usuarioObj->id?>" />
                    <?php
                }
                ?>
                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">
                        Nome
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nome" <?php echo (!empty($usuarioObj->nome) ? "value='".$usuarioObj->nome."'" : "")?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">
                        E-mail
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" <?php echo (!empty($usuarioObj->email) ? "value='".$usuarioObj->email."' disabled='disabled' readonly='true'" : "")?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">
                        Senha <br /> (Permitido somente letras e números)
                    </label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="senha" <?php echo (!empty($usuarioObj->senha) ? "value='".$usuarioObj->senha."' disabled='disabled' readonly='true'" : "")?>>
                    </div>
                </div>                                              
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">
                        Foto
                    </label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="foto">
                        <?php 
                        if(!empty($usuarioObj->foto)){
                            ?>
                            <br />
                            <img src="<?php echo $usuarioObj->foto?>" class="img-circle" width="60" />
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


    