<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Acerta | Curso Web</title>
	<style>
	.conteudo{
		background-color: #CCC;
		color: #000;
		padding: 20px;
	}
	</style>
</head>
<body>
	<div class="conteudo">
		Aula de Desenvolvimento Web
		<?php
		// Array com uma dimensão
		$alunos[0]["nome"] 	= "Rodrigo";
		$alunos[0]["rg"]	= "1234";
		$alunos[1]["nome"] 	= "Katty";
		$alunos[1]["rg"]	= "1234";
		$alunos[2]["nome"] 	= "Jean";
		$alunos[2]["rg"]	= "1234";
		$alunos[3]["nome"] 	= "Tarciso";
		$alunos[3]["rg"]	= "1234";
		?>
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>RG</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($alunos as $indice => $informacao) {
					?>
					<tr>
						<td><?php echo $indice?></td>
						<td><?php echo $informacao["nome"];?></td>
						<td><?php echo $informacao["rg"];?></td>
					</tr>
					<?php
				}
				?>				
			</tbody>
		</table>
	</div>
</body>
</html>