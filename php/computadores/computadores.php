<?php
require_once("../conexao/conexao_pdo.php");
require_once("../painel/painel.php");

$conexao = conectar();
$sql = $conexao->prepare("SELECT * FROM computadores A JOIN sistemas_operacionais B ON A.comp_sistema_operacional = B.sistema_operacional_id JOIN setores C ON A.comp_setor = C.setor_id ORDER BY comp_nome_usuario");
$sql->execute();
?>
<div class="container">
<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">COMPUTADORES CLIENTES</h3>
    <div class="clearfix">
      <div class="pull-right tableTools-container"><a href="cadastro_computador.php"><button type="button" id="cadastrar"  class="btn btn-primary btn-sm">Adicionar</button></a></div>
    </div>
    <div class="table-header"></div>
    <div>
      <table id="table" class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="hidden-480">Nome do usuário</th>
            <th class="hidden-480">Sistema Operacional</th>
            <th class="hidden-480">Horário</th>
            <th class="hidden-480">Setor</th>
            <th class="hidden-480">IP</th>
            <th class="hidden-480">Data de Cadastro</th>
            <th class="hidden-480">Ativo</th>
            <th class="hidden-480">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php while($dados = $sql->fetch(PDO:: FETCH_ASSOC)) {?>
          <tr>
            <td><?php echo $dados["comp_nome_usuario"]?></td>
  					<td><?php echo $dados["sistema_operacional_nome"]?></td>
  					<td><?php echo $dados["comp_hora_backup"]?>:00 Hs</td>
  					<td><?php echo $dados["setor_nome"]?></td>
  					<td><?php echo $dados["comp_ip"]?></td>
  					<td><?php echo date ('d/m/Y H:i:s',strtotime($dados["comp_data_cadastro"]))?></td>
  					<td><?php echo $dados["comp_backup_ativo"]?></td>
            <td>
              <a href="altera_computador.php?computador_id=<?php echo $dados['comp_id']?>"><button class="btn btn-xs btn-success"><i class="ace-icon fa fa-pencil bigger-120"></i></button></i></a>
            <a id="computador_id" onclick="excluir_computador('<?php echo $dados['comp_id']?>')"><button class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></a>            </td>
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
