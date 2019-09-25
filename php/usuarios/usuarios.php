<?php
require_once("../conexao/conexao_pdo.php");
require_once("../painel/painel.php");

$conexao = conectar();
$sql = $conexao->prepare("SELECT * FROM usuarios A JOIN setores B ON A.usuario_id_setor = B.setor_id WHERE usuario_id != 1 ORDER BY usuario_nome");
$sql->execute();
?>
<div class="container">
<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">USUÁRIOS</h3>
    <div class="clearfix">
      <div class="pull-right tableTools-container"> <a href="cadastro_usuario.php"><button type="button" id="cadastrar"  class="btn btn-primary btn-sm">Adicionar</button></a></div>
    </div>
    <div class="table-header"></div>
    <div>
      <table id="table" class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="hidden-480">Código do usuario</th>
            <th class="hidden-480">Nome do usuario</th>
            <th class="hidden-480">Login</th>
            <th class="hidden-480">Setor do usuario</th>
            <th class="hidden-480">Status do usuario</th>
            <th class="hidden-480">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php while($dados = $sql->fetch(PDO:: FETCH_ASSOC)) {?>
          <tr>
            <td><?php echo $dados["usuario_id"]?></td>
            <td><?php echo $dados["usuario_nome"]?></td>
            <td><?php echo $dados["usuario_login"]?></td>
            <td><?php echo $dados["setor_nome"]?></td>
            <td><?php echo $dados["usuario_status"]?></td>
            <td>
              <center>
              <a href="alterar_usuario.php?usuario_id=<?php echo $dados['usuario_id']?>"><button class="btn btn-xs btn-success"><i class="ace-icon fa fa-pencil bigger-120"></i></button></i></a>
            </center>
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
