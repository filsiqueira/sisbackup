<?php
require_once("../painel/painel.php");
require_once("../conexao/conexao.php");

if(isset($_GET['computador_id'])){

    $comp_id = mysqli_escape_string($conexao, $_GET['computador_id']);
  ?>
  <script>
    retorna_computador(<?php echo $comp_id?>);

  </script>
  <?php }

?>
 <div class="page-header">
        <h1>Alterar Cadastro de Computadores</h1>
    </div>
    <div class="container" style="width:1350px;">
        <div class="col-xs-12 col-sm-8" style="margin-left:210px;">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Dados do Computador</h4>
                    <span style="margin-left:72%" class="help-button" data-rel="popover" data-trigger="hover" data-placement="bottom" title="OBS: Compartilhe o disco com nome de 'HD' ">?</span>
                </div>
                <input type="text" hidden="true" id="comp_id" value="<?php echo $comp_id ?>">

                <div class="widget-body">
                    <div class="widget-main">
                      <div class="row">
                        <div class="col-sm-12">
                            <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Nome completo do usuário">Nome Completo</label>
                            <br>
                            <input type="text" id="comp_nome_usuario" class="form-control" />
                        </div>
                      </div>
                      <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Login do usuário na máquina">Login</label>
                                <br>
                                <input type="text" id="comp_login" class="form-control" />
                            </div>
                            <div class="col-sm-4">
                                <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Usuário com permissão no compartilhamento 'HD' deste computador">Usuario Administrador</label>
                                <br>
                                <input type="text" id="comp_usuario_adm" class="form-control" />
                            </div>
                            <div class="col-sm-4">
                                <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Senha do usuário com permissão no compartilhamento 'HD' deste computador">Senha</label>
                                <br>
                                <input type="password" id="comp_senha" class="form-control" />
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-4">
                              <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Endereço IP deste computador">Endereço IP</label>
                              <br>
                              <input type="text" id="comp_ip" class="form-control input-mask-ip" />
                          </div>
                          <div class="col-sm-4">
                              <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="O endereço MAC é utilizado para ligar o computador pela rede">Endereço MAC</label>
                              <br>
                              <input type="text" id="comp_mac" class="form-control input-mask-mac" />
                          </div>
                          <div class="col-sm-4">
                            <label for="inputState" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Sistema Operacional deste computador">Sistema Operacional</label>
                            <select id="sistema_operacional_id" class="chosen-select form-control" data-placeholder="Selecione" onchange="retorna_doc_a_partir_do_so2()">

                              <?php
                              $sql = mysqli_query($conexao,"SELECT DISTINCT sistema_operacional_id,sistema_operacional_nome FROM sistemas_operacionais A JOIN diretorio_documentos B ON A.sistema_operacional_id = B.diretorio_id_sistema_operacional");
                              while($sistema_operacional = mysqli_fetch_array($sql)){
                                echo "<option value='$sistema_operacional[sistema_operacional_id]'>$sistema_operacional[sistema_operacional_nome]</option>";
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                    <hr>
                      <center>
                        <h4 data-rel="popover" data-trigger="hover" data-placement="bottom" title="Escolha o(s) dia(s) de backup">Dia do Backup</h4>
                      </center>
                      <br>
                      <div class="col-sm-12" style="margin-left:10px;">
                        <label onclick="marca_dias_semana();"><input type="checkbox" id="todos_os_dias" class="ace checkbox"><span class="lbl"><span class="lbl"><span class="lbl"><span class="lbl"><span class="lbl"> Todos os dias</span></label>
                        <label class="checkbox-inline"><input type="checkbox" id="dia0" class="ace checkbox"><span class="lbl">Domingo</span></label>
                        <label class="checkbox-inline"><input type="checkbox" id="dia1" class="ace checkbox"><span class="lbl">Segunda</span></label>
                        <label class="checkbox-inline"><input type="checkbox" id="dia2" class="ace checkbox"><span class="lbl">Terça</span></label>
                        <label class="checkbox-inline"><input type="checkbox" id="dia3" class="ace checkbox"><span class="lbl">Quarta</span></label>
                        <label class="checkbox-inline"><input type="checkbox" id="dia4" class="ace checkbox"><span class="lbl">Quinta</span></label>
                        <label class="checkbox-inline"><input type="checkbox" id="dia5" class="ace checkbox"><span class="lbl">Sexta</span></label>
                        <label class="checkbox-inline"><input type="checkbox" id="dia6" class="ace checkbox"><span class="lbl">Sábado</span> </label>
                      </div>
                      <hr>
                      <hr>
                      <div class="row">
                          <div class="col-sm-4">
                              <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Escolha o horário do backup automático">Horário</label>
                              <br>
                              <select class="chosen-select form-control" id="comp_hora_backup">
                                <option value="">Selecione</option>
                                <option value="0">00:00</option>
                                <option value="01">01:00</option>
                                <option value="02">02:00</option>
                                <option value="03">03:00</option>
                                <option value="04">04:00</option>
                                <option value="05">05:00</option>
                                <option value="06">06:00</option>
                                <option value="07">07:00</option>
                                <option value="08">08:00</option>
                                <option value="09">09:00</option>
                                <option value="10">10:00</option>
                                <option value="11">11:00</option>
                                <option value="12">12:00</option>
                                <option value="13">13:00</option>
                                <option value="14">14:00</option>
                                <option value="15">15:00</option>
                                <option value="16">16:00</option>
                                <option value="17">17:00</option>
                                <option value="18">18:00</option>
                                <option value="19">19:00</option>
                                <option value="20">20:00</option>
                                <option value="21">21:00</option>
                                <option value="22">22:00</option>
                                <option value="23">23:00</option>
                              </select>

                          </div>
                          <div class="col-sm-4">
                              <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="O sistema é capaz de ligar seu computador (Ative a função WAKE ON LAN na Bios da máquina)">Ligar antes?</label>
                              <br>
                              <select class="chosen-select form-control" id="comp_liga_computador">
                                <option value="">Selecione</option>
                                <option value="SIM">SIM</option>
                                <option value="NÃO">NÃO</option>
                              </select>
                          </div>
                          <div class="col-sm-4">
                              <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Desligar o computador após o backup">Desligar após?</label>
                              <br>
                              <select class="chosen-select form-control" id="comp_desliga_computador">
                                <option value="">Selecione</option>
                                <option value="SIM">SIM</option>
                                <option value="NÃO">NÃO</option>
                              </select>
                          </div>
                      </div>
                      <hr>
                      <div class="row">
                      <div class="col-sm-4">
                              <label for="form-field-select-3">Backup Ativo ?</label>
                              <br>
                              <select class="chosen-select form-control" id="comp_backup_ativo">
                                <option value="">Selecione</option>
                                <option value="SIM">SIM</option>
                                <option value="NÃO">NÃO</option>
                              </select>
                          </div>
                        <div class="form-group col-md-4">
                          <label data-rel="popover" data-trigger="hover" data-placement="bottom" title="Escolha para qual servidor o backup será enviado">Servidor de Backup</label>
                          <select id="servidor_id" class="chosen-select form-control">
                            <option value="">Selecione</option>
                            <?php
                            $sql = mysqli_query($conexao,"SELECT servidor_id,servidor_nome FROM servidores ORDER BY servidor_id");
                            while($servidor = mysqli_fetch_array($sql)){
                              echo "<option value='$servidor[servidor_id]'>$servidor[servidor_nome]</option>";
                            }
                            ?>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputState" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Setor deste usuário">Setor</label>
                          <select id="comp_setor" class="chosen-select form-control">
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
                      <div class="row">
                      <div class="form-group col-md-6">
                          <label data-rel="popover" data-trigger="hover" data-placement="bottom" title="Selecione os documentos que deseja copiar">Diretórios que devem ser copiados</label>
                          <select multiple="" class="form-control chosen-select" id='documento_id' data-placeholder="Selecione">
                            <?php
                            $sql = mysqli_query($conexao,"SELECT * FROM documentos ORDER BY documento_nome");
                            while($documento_id = mysqli_fetch_array($sql))
                              echo "<option value='$documento_id[documento_id]'>$documento_id[documento_nome]</option>";
                            ?>
                        </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label data-rel="popover" data-trigger="hover" data-placement="bottom" title="Exclua extensões de arquivos do backup">Não copiar Arquivos com as seguintes extensões</label>

                          <select multiple="" class="chosen-select form-control" id='extensao_arquivo_id' data-placeholder="Selecione">
                            <option value="99999" id="99999">COPIAR TUDO</option>
                            <?php
                            $sql = mysqli_query($conexao,"SELECT * FROM extensao_arquivo  WHERE extensao_arquivo_id <> '99999' ORDER BY extensao_arquivo");
                            while($extensao_arquivo_id = mysqli_fetch_array($sql))
                              echo "<option value='$extensao_arquivo_id[extensao_arquivo_id]'>$extensao_arquivo_id[extensao_arquivo]</option>";
                            ?>
                          </select>
                        </div>
                      </div>
                      </div>
                      <hr>
                    <center>
                        <button type="button" class="btn btn-primary" onclick="altera_computador()" id="alterar_comp">ALTERAR</button>
                        <a type="button" id="cancelar" class="btn btn-default" href="computadores.php"> VOLTAR </a>
                    </center>
                    <br>
                </div>
            </div>
        </div>
      </div>
    </div>
