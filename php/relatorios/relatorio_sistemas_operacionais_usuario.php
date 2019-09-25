<?php
require_once("../conexao/conexao_pdo.php");
require_once("../painel/painel.php");

$conexao = conectar();
$sql = $conexao->prepare("SELECT sistema_operacional_nome,sistema_operacional_plataforma, count(*) as total from sistemas_operacionais A join computadores B on A.sistema_operacional_id = B.comp_sistema_operacional group by (sistema_operacional_nome)");
$sql->execute();
?>
<div class="container">
<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">SISTEMAS OPERACIONAIS/USUÁRIOS</h3>
    <div class="table-header"></div>
    <div>
      <table id="table" class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="hidden-480">Sistema Operacional</th>
            <th class="hidden-480">Plataforma</th>
            <th class="hidden-480">Utilização</th>
          </tr>
        </thead>
        <tbody>
          <?php while($dados = $sql->fetch(PDO:: FETCH_ASSOC)) {?>
          <tr>
						<td><?php echo $dados["sistema_operacional_nome"]?></td>
						<td><?php echo $dados["sistema_operacional_plataforma"]?></td>
						<td><b><?php echo $dados["total"]?></b> computadores utilizam este Sistema Operacional</td>
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
