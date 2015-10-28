<div class="menu">
	<a href="<?php echo SITE_URL?>index.php" 		<?php echo ((strpos( $_SERVER["REQUEST_URI"], "index.php") !== false) 		? "class='active'" : "")?>>
		Home
	</a>
	<a href="<?php echo SITE_URL?>quem_somos.php" 	<?php echo ((strpos( $_SERVER["REQUEST_URI"], "quem_somos.php") !== false) 	? "class='active'" : "")?>>
		Quem Somos
	</a>
	<a href="<?php echo SITE_URL?>missao.php" 		<?php echo ((strpos( $_SERVER["REQUEST_URI"], "missao.php") !== false) 		? "class='active'" : "")?>>
		Missão
	</a>
	<a href="<?php echo SITE_URL?>visao.php" 		<?php echo ((strpos( $_SERVER["REQUEST_URI"], "visao.php") !== false) 		? "class='active'" : "")?>>
		Visão
	</a>
	<a href="<?php echo SITE_URL?>contato.php" 		<?php echo ((strpos( $_SERVER["REQUEST_URI"], "contato.php") !== false) 	? "class='active'" : "")?>>
		Contato
	</a>
</div>