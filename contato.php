<?php
	include_once("configuracao.php");

	unset($msg_erro, $msg_sucesso);
	if($_POST){
		if(empty($_POST["nome"]) || empty($_POST["email"]) || empty($_POST["telefone"])){
			$msg_erro    = "Por favor digite o nome, email e telefone!";
		}else{

			$assunto	  = "Contato enviado pelo site - ".date("d")."/".date("M")."/".date("Y");

			$corpo_email  = "===================================================";
			$corpo_email .= "Dados enviados pelo site \n";
			$corpo_email .= "Nome: ".$_POST["nome"]." \n";
			$corpo_email .= "Email: ".$_POST["email"]." \n";
			$corpo_email .= "Telefone: ".$_POST["telefone"]." \n";
			$corpo_email .= "Mensagem: ".$_POST["mensagem"]." \n";
			$corpo_email .= "===================================================";

			$destinatario = "rodrigoapetito@gmail.com";

			mail($destinatario, $assunto, $corpo_email);	

			$msg_sucesso = "Formulario enviado com sucesso!!";

		}
	}

?>
<!DOCTYPE html>
<html lang="pt">
	<?php
	include("tag_head.php");
	?>
	<body>
		<div class="background-principal">
			<img class="imagem_principal" src="<?php echo SITE_URL?>/layout/imagens/ferrari-background.jpg" alt="">
		</div>
		<div class="conteudo_site">	
			<?php
			include("cabecalho.php");
			?>
			<div class="corpo_pagina">			
				<?php
				include("menu.php");
				?>
				<div class="conteudo">
					<h1>
						Contato
					</h1>
					<?php
					if(isset($msg_erro)){
						?>
						<p class="msg_erro">
							<?php echo $msg_erro?>
						</p>
						<?php
					}else if(isset($msg_sucesso)){
						?>
						<p class="msg_sucesso">
							<?php echo $msg_sucesso?>
						</p>
						<?php
					}
					?>
					<form action="<?php echo $_SERVER["PHP_SELF"]?>" class="formulario" method="post">
						<input type="text" name="nome" placeholder="Digite o Nome"><br />
						<input type="text" name="telefone" placeholder="Digite o Telefone"><br />
						<input type="text" name="email" placeholder="Digite o Email"><br />
						<textarea name="mensagem" id="" cols="30" rows="10" placeholder="Deixe sua mensagem"></textarea><br />						
						<input class="btn_enviar" type="submit" value="Enviar" />
					</form>
				</div>
			</div>
			<?php
			include("rodape.php");
			?>
		</div>		
	</body>
</html>
