<?php
require_once("../conexao/conexao_pdo.php");
require_once("../painel/painel.php");

$conexao = conectar();
$sql = $conexao->prepare("SELECT * FROM setores WHERE setor_id != 1 ORDER BY setor_nome");
$sql->execute();
?>
<div class="container">
<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">SETORES</h3>
    <div class="clearfix">
      <div class="pull-right tableTools-container"> <a href="cadastro_setor.php"><button type="button" id="cadastrar"  class="btn btn-primary btn-sm">Adicionar</button></a></div>
    </div>
    <div class="table-header"></div>
    <div>
      <table id="table" class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="hidden-480">Código do Setor</th>
            <th class="hidden-480">Nome do Setor</th>
            <th class="hidden-480">Descrição do Setor</th>
            <th class="hidden-480">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php while($dados = $sql->fetch(PDO:: FETCH_ASSOC)) {?>
          <tr>
            <td><?php echo $dados["setor_id"]?></td>
            <td><?php echo $dados["setor_nome"]?></td>
            <td><?php echo $dados["setor_descricao"]?></td>
            <td>
              <a href="alterar_setor.php?setor_id=<?php echo $dados['setor_id']?>"><button class="btn btn-xs btn-success"><i class="ace-icon fa fa-pencil bigger-120"></i></button></i></a>
            <a id="setor_id" onclick="excluir_setor('<?php echo $dados['setor_id']?>')"><button class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></a>            </td>
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
