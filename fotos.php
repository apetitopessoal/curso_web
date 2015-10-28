<?php
	define("CAMINHO_IMAGEM","/fotos");	
	$dir    = $_SERVER["DOCUMENT_ROOT"].CAMINHO_IMAGEM;
	$fotos  = scandir($dir);					
	foreach ($fotos as $imagem) {
		if(is_file($dir."/".$imagem)){
			?>
			<div class="miniatura_foto">
				<img src="<?php echo CAMINHO_IMAGEM."/".$imagem?>"><br>	
			</div>						
			<?php			
			}
		}
	}

?>
