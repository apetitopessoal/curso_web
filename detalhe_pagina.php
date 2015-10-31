<?php
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
					<?php
                    $paginaObj = new Paginas($_GET["url"]);
                    ?>
                    <h1>
                        <?php echo $paginaObj->titulo?>
                    </h1>    
                    <?php
                    echo $paginaObj->conteudo;                        
                    ?>	
				</div>
			</div>
			<?php
			include("rodape.php");
			?>
		</div>		
	</body>
</html>