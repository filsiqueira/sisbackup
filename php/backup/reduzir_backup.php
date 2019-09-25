<?php
require_once("../painel/painel.php");
require_once("../conexao/conexao.php");
?>
<head>
</head>
<div class="page-header">
        <h1>Sincronizar Arquivos</h1>
    </div>
    <div class="container">
        <div class="col-xs-12 col-sm-8" style="margin-left:210px;">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Selecione um Cadastro</h4>          
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                      <div class="row">
                          <div class="col-sm-4"style="margin-left:210px;">
                            <label for="inputState"></label>
                            <select id="comp_id" class="chosen-select form-control">                              
                            <option value="">Buscar ...</option>
                            <option value="todos"> ### TODOS OS CADASTROS ###</option>
                                <?php
                                $sql = mysqli_query($conexao,"SELECT * FROM computadores ORDER BY comp_nome_usuario");
                                while($computadores = mysqli_fetch_array($sql))
                                    echo "<option value='$computadores[comp_id]'>$computadores[comp_nome_usuario]</option>";
                                ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <hr>
                    <center>
                    <button type="button" id="reduzir" class="btn btn-success" onclick="reduzir_backup()"> SINCRONIZAR </button>
                    <button type="button" id="reduzir_info" class="btn btn-info" onclick="reduzir_info()">COMO FUNCIONA ?</button>
                    <button type="button" id="cancelar" class="btn btn-warning" onclick="limpar_reduzir_bkp()"> CANCELAR </button>
                    </center>
                    <br>
                </div>
            </div>
        </div>
      </div>
    </div>
