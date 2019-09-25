<?php
require_once("../painel/painel.php");
require_once("../conexao/conexao.php");
?>

    <div class="page-header">
        <h1>Cadastro de Usuários</h1>
    </div>
    <div class="container">

        <div class="col-xs-12 col-sm-8" style="margin-left:180px;">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Dados do Usuário</h4>
                    <span style="margin-left:73%" class="help-button" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Cadastro de usuários do Sisbackup">?</span>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                      <div class="row">
                        <div class="col-sm-12">
                            <label for="form-field-select-3">Nome Completo</label>
                            <br>
                            <input type="text" id="nome_usuario" class="form-control" />
                        </div>
                      </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="form-field-select-3">Login</label>
                                <br>
                                <input type="text" id="login" class="form-control" />
                            </div>
                            <div class="col-sm-6">
                                <label for="form-field-select-3">Setor</label>
                                <br>
                                <select id="setor" class="chosen-select form-control">
                                  <option value="">Selecione</option>
                                  <?php
                                  $sql = mysqli_query($conexao,"SELECT setor_id,setor_nome FROM setores WHERE setor_id != 1 ORDER BY setor_nome");
                                  while($setor = mysqli_fetch_array($sql)){
                                      echo "<option value='$setor[setor_id]'>$setor[setor_nome]</option>";
                                  }
                                  ?>
                              </select>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="form-field-select-3">Senha</label>
                                    <br>
                                      <input type="password" class="form-control" id="senha">
                                </div>
                                <div class="col-sm-6">
                                    <label for="form-field-select-3">Confirme a senha</label>
                                    <br>
                                    <input type="password" class="form-control" id="confirma_senha">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div>
                                    <div class="col-sm-6">
                                        <label for="form-field-select-3">Email</label>
                                        <br>
                                        <input type="email" class="form-control" id="usuario_email">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="form-field-select-3">Status</label>
                                        <br>
                                        <select id="status" class="chosen-select form-control">
                                          <option value="">Selecione</option>
                                          <option value="ATIVO">ATIVO</option>
                                          <option value="BLOQUEADO">BLOQUEADO</option>
                                      </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><hr>
                    <center>
                        <button type="button" class="btn btn-primary" onclick="cadastrar_usuario()" id="cadastrar_usuario">CADASTRAR</button>
                        <a type="button" id="cancelar" class="btn btn-default" href="usuarios.php"> VOLTAR </a>
                    </center>
                    <br>
                </div>
            </div>
        </div>
