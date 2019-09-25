<?php
include('../templates/template2.php');
include('../conexao/conexao.php');

$sql = mysqli_query($conexao,"SELECT * FROM auditoria_acoes WHERE auditoria_acao = 'alteracao' AND auditoria_tela = 'Manutenção de Senha' ORDER BY auditoria_usuario");
?>
<body>
	<div style="margin-left: 255px;">
		<center><h2> REGISTRO DE AÇÕES </h2></center>
		<table class="table table-striped table-bordered table-hover " id="table">
			<thead style="background: #B0C4DE">
				<tr>
					<th scope="col"> USUARIO </th>
					<th scope="col"> AÇÃO </th>
					<th scope="col"> DATA E HORA </th>
					<th scope="col"> TELA </th>
					<th scope="col"> DESCRIÇÃO </th>

				</tr>	
			</thead>
			<tbody>
				<?php while($dados = mysqli_fetch_array($sql)) {

				$usuario = $dados["auditoria_usuario"];
				$acao = "ALTERAÇÃO";
				$auditoria_data_hora = $dados['auditoria_data_hora'];
				$tela = $dados["auditoria_tela"];
				$descricao = $dados['auditoria_descricao'];
				?>
				<tr>
					<td><?php echo $usuario ?></td>
					<td><?php echo $acao ?></td>
					<td><?php echo $auditoria_data_hora ?></td>
					<td><?php echo $tela ?></td>
					<td><?php echo $descricao ?></td>

				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</body>

