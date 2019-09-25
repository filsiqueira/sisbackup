<?php
require_once("../conexao/conexao_pdo.php");
require_once("../painel/painel.php");

$conexao = conectar();
$sql = $conexao->prepare("SELECT backup_data,backup_origem,comp_nome_usuario,backup_status FROM computadores A JOIN backups_realizados B ON A.comp_id = B.backup_id_computador ORDER BY backup_data DESC");
$sql->execute();
?>
<div class="container">
<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">Backups Realizados</h3>
    <div class="table-header"></div>
    <div>
      <table id="table" class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="hidden-480">Nome do usuário</th>
            <th class="hidden-480">Origem</th>
            <th class="hidden-480">Data</th>
            <th class="hidden-480">Status</th>
         </tr>
        </thead>
        <tbody>
          <?php while($dados = $sql->fetch(PDO:: FETCH_ASSOC)) {

            if($dados["backup_status"] == "SUCESSO"){
              $style = "style='background-color:lawngreen'";
            } else {
              $style = "style='background-color:orangered'";
            }

            ?>
          <tr>
						<td><?php echo $dados["comp_nome_usuario"]?></td>
						<td><?php echo $dados["backup_origem"]?></td>
  					<td><?php echo date ('d/m/Y H:i:s',strtotime($dados["backup_data"]))?></td>
            <td <?php echo $style ?>><?php echo $dados["backup_status"]?></td>
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
