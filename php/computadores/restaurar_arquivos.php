<?php
include('../templates/template2.php');
include('../conexao/conexao.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12"></div>
    </div>
    <center>
      <div id="modal" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document" style="min-width: 95%">
          <div class="modal-content">                    
            <div id="alert" style="height: 50px;"></div>
        </div>
    </div>
    </div>
<div class="row">
    <div class="col-lg-8" style="float: none">
        <br><br>
        <h1>RESTAURAR ARQUIVOS</h1>
        <br><br>
        <div class="form-horizontal form-label-left">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" ><span class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="selectpicker" data-width="100%" data-live-search="true" id="comp_id" class="form-control" onchange="retorna_dir_user()">
                    <option value="">  SELECIONE O CADASTRO </option>
                    <?php
                    $sql = mysqli_query($conexao,"SELECT * FROM computadores ORDER BY comp_nome_usuario");
                    while($computadores = mysqli_fetch_array($sql))
                        echo "<option value='$computadores[comp_id]'>$computadores[comp_nome_usuario]</option>";
                    ?>
                </select>
            </div>
        </div>
        <br><br>
        <button type="button" id="restaurar" class="btn btn-success" onclick="restaurar_backup() "> RESTAURAR </button>
        <button type="button" id="cancelar_restaurar" class="btn btn-warning" onclick="limpar_rest_bkp_usu()"> CANCELAR </button>
    </div>
    <br>
</div>
</center>
</div>
<script src="../../js/funcoes_diversas.js"></script>
</body>
</html>
