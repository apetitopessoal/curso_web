<?php

	if(isset($mensagem)){
		?>
		<p><?php echo $mensagem ?></p>
		<?php
	}

?>
<form class="form-login" action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
    <h2 class="form-login-heading">Entrar</h2>
    <div class="login-wrap">
        <input type="text" class="form-control" placeholder="Email" name="email" autofocus>
        <br>
        <input type="password" class="form-control" name="senha" placeholder="Senha">
        <label class="checkbox">
            <span class="pull-right">
                <a data-toggle="modal" href="login.php#myModal">Esqueci a senha</a>

            </span>
        </label>
        <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> Entrar</button>                
    </div>

	<!-- Modal -->
	<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
	  <div class="modal-dialog">
	      <div class="modal-content">
	          <div class="modal-header">
	              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	              <h4 class="modal-title">Forgot Password ?</h4>
	          </div>
	          <div class="modal-body">
	              <p>Enter your e-mail address below to reset your password.</p>
	              

	          </div>
	          <div class="modal-footer">
	              <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
	              <button class="btn btn-theme" type="button">Submit</button>
	          </div>
	      </div>
	  </div>
	</div>
	<!-- modal -->

</form>	  	