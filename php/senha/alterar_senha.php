<?php
require_once("../painel/painel.php");
require_once("../conexao/conexao.php");
?>
<head>
</head>
<div class="page-header">
        <h1>Alterar Senha</h1>
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
                          <div class="col-sm-6"style="margin-left:210px;">
                            <label for="inputState"></label>
                            <select class="chosen-select form-control" id="usuario_id">
                                <option value="">Selecione</option>
                                <?php

                                $sql = mysqli_query($conexao,"SELECT usuario_id,usuario_nome FROM usuarios WHERE usuario_login != 'sisbackup' AND usuario_status != 'BLOQUEADO' ORDER BY usuario_login");
                                while($usuario = mysqli_fetch_array($sql))
                                    echo "<option value='$usuario[usuario_id]'>$usuario[usuario_nome]</option>";
                                ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="form-field-select-3">Senha</label>
                            <br>
                              <input type="password" class="form-control" id="usuario_senha">
                        </div>
                        <div class="col-sm-6">
                            <label for="form-field-select-3">Confirme a senha</label>
                            <br>
                            <input type="password" class="form-control" id="usuario_confirma_senha">
                        </div>
                    </div>
                    <hr>
                    <br>
                    <hr>
                    <center>
                      <button type="button" class="btn btn-primary" onclick="altera_senha()"> ALTERAR </button>
                      <button type="button" class="btn btn-warning" onclick="limpar_alt_senha()"> CANCELAR </button>
                  </center>
                    <br>
                </div>
            </div>
        </div>
      </div>
    </div>
