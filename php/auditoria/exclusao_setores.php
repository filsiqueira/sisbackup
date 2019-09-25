<?php
require_once("../conexao/conexao_pdo.php");
require_once("../painel/painel.php");

$conexao = conectar();
$sql = $conexao->prepare("SELECT * FROM auditoria_acoes WHERE auditoria_acao = 'exclusao' AND auditoria_tela = 'Manutenção de Setor' ORDER BY auditoria_data_hora DESC");
$sql->execute();
?>
<div class="container">
<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">Registro de Ações - Tela Exclusão de Setores </h3>
    <div class="table-header"></div>
    <div>
      <table id="table" class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="hidden-480">Nome do usuário</th>
            <th class="hidden-480">Ação</th>
            <th class="hidden-480">Data e Hora</th>
						<th class="hidden-480">Tela</th>
						<th class="hidden-480">Descrição</th>
         </tr>
        </thead>
        <tbody>
          <?php while($dados = $sql->fetch(PDO:: FETCH_ASSOC)) {
						$usuario = $dados["auditoria_usuario"];
						$acao = "EXCLUSÃO";
						$auditoria_data_hora = $dados['auditoria_data_hora'];
						$tela = $dados["auditoria_tela"];
						$descricao = $dados['auditoria_descricao'];
					?>
          <tr>
						<td><?php echo $usuario ?></td>
						<td><?php echo $acao ?></td>
						<td><?php echo date ('d/m/Y H:i:s',strtotime($auditoria_data_hora))?></td>
						<td><?php echo $tela ?></td>
						<td><?php echo $descricao ?></td>
        </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
$('#table').DataTable({
    "lengthMenu": [[5], [5]],
  "language": {
    "paginate": {
      "previous": "Anterior",
      "next": "Próximo"
    },
    search:"",
    searchPlaceholder: "Pesquisar",
    "lengthMenu": "Mostrando _MENU_ registros por página",
    "zeroRecords": "Nada encontrado",
    "info": "Mostrando página _PAGE_ de _PAGES_",
    "infoEmpty": "Nenhum registro disponível",
    "infoFiltered": "(filtrado de _MAX_ registros no total)"
  }
});

function abrirModalSo(){
  $('#modal').modal('show');
}
</script>
</body>
</html>
