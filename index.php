<?php
	
	session_start();
	include_once("configuracao.php");
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
						Carros
					</h1>
					<div class="fotos">
						<?php
						$dir    = $_SERVER["DOCUMENT_ROOT"].CAMINHO_IMAGEM;
						$fotos  = scandir($dir);					
						foreach ($fotos as $imagem) {
							if(is_file($dir."/".$imagem)){
								?>
								<div class="miniatura_foto">
									<a href="<?php echo CAMINHO_IMAGEM."/".$imagem?>" rel="group" class="fancybox">
										<img src="<?php echo CAMINHO_IMAGEM."/".$imagem?>"><br>		
									</a>
								</div>						
								<?php			
							}
						}
						?>						
					</div>					
				</div>
			</div>
			<?php
			include("rodape.php");
			?>
		</div>		
	</body>
</html>