<?php
require_once("../painel/painel.php");
require_once("../conexao/conexao.php");

if(isset($_GET['usuario_id'])){

  $usuario_id = mysqli_escape_string($conexao, $_GET['usuario_id']);
  $sql = mysqli_query($conexao,"SELECT * FROM usuarios A JOIN setores B ON A.usuario_id_setor = B.setor_id WHERE usuario_id = '$usuario_id' ");
  $dados = mysqli_fetch_array($sql);

}
?>

    <div class="page-header">
        <h1>Alterar de Usuários</h1>
    </div>
    <div class="container">
      <input type="text" hidden="true" id="usuario_id" value="<?php echo $dados['usuario_id']?>">
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
                            <input type="text" id="nome_usuario" class="form-control" value="<?php echo $dados['usuario_nome']?>"/>
                        </div>
                      </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="form-field-select-3">Login</label>
                                <br>
                                <input type="text" id="login" disabled="true" class="form-control" value="<?php echo $dados['usuario_login']?>" />
                            </div>
                            <div class="col-sm-6">
                                <label for="form-field-select-3">Setor</label>
                                <br>
                                <select id="setor_id" class="chosen-select form-control" data-placeholder="Selecione">
                                  <option value="<?php echo $dados['setor_id']?>"><?php echo $dados['setor_nome']?></option>
                                  <?php
                                  $sql = mysqli_query($conexao,"SELECT * FROM setores WHERE setor_id != 1 ORDER BY setor_nome");
                                  while($usuario = mysqli_fetch_array($sql)){
                                      echo "<option value='$usuario[setor_id]'>$usuario[setor_nome]</option>";
                                  }
                                  ?>
                              </select>
                            </div>
                        </div>
                        <hr>
                        <div>
                          <div class="row">
                                <div>
                                    <div class="col-sm-6">
                                        <label for="form-field-select-3">Email</label>
                                        <br>
                                        <input type="email" class="form-control" id="usuario_email" value="<?php echo $dados['usuario_email']?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="form-field-select-3">Status</label>
                                        <br>
                                        <select id="status" class="chosen-select form-control" data-placeholder="Selecione">
                                          <option  value="<?php echo $dados['usuario_status']?>"><?php echo $dados['usuario_status']?></option>
                                          <?php
                                          if($dados['usuario_status'] == "ATIVO"){
                                            echo "<option value='BLOQUEADO'>BLOQUEADO</option>";
                                          } else{
                                            echo "<option value='ATIVO'>ATIVO</option>";
                                          }
                                          ?>
                                      </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><hr>
                    <center>
                        <button type="button" class="btn btn-primary" onclick="alterar_usuario()" id="alterar_usuario">ALTERAR</button>
                        <a type="button" id="cancelar" class="btn btn-default" href="usuarios.php"> VOLTAR </a>
                    </center>
                    <br>
                </div>
            </div>
        </div>
