<?php
require_once("../painel/painel.php");
require_once("../conexao/conexao.php");
?>
<head>
</head>
<div class="page-header">
        <h1>Restaurar Base de Dados</h1>
    </div>
    <div class="container">
        <div class="col-xs-12 col-sm-8" style="margin-left:210px;">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Selecione um Backup</h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                      <div class="row">
                          <div class="col-sm-6"style="margin-left:210px;">
                            <label for="inputState"></label>
                            <select id="registro_backup_id" class="chosen-select form-control" data-width="100%" data-live-search="true">
                                <option value="">  Selecione um Backup </option>
                                <?php
                                $sql = mysqli_query($conexao,"SELECT * FROM registro_backup ORDER BY registro_backup");
                                while($backup = mysqli_fetch_array($sql))
                                    echo "<option value='$backup[registro_backup_id]'>$backup[registro_backup]</option>";
                                ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <hr>
                    <center>
                      <button type="button" id="executar" class="btn btn-success" onclick="restaura_base()"> RESTAURAR </button>
                      <button type="button" id="cancelar" class="btn btn-warning" onclick="limpar_rest_bkp()"> CANCELAR </button>
                  </center>
                    <br>
                </div>
            </div>
        </div>
      </div>
    </div>
