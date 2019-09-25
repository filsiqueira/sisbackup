<?php
include('../templates/template2.php');
include('../conexao/conexao.php');
?>
<script>
  $(document).ready(function () { 
    var $comp_mac = $("#comp_mac");
    $comp_mac.mask('AA:AA:AA:AA:AA:AA', {reverse: true});

  });

</script>
<body>
<div hidden="true">
<select style="height:50px; width:100%;" id="comp_id" onchange="retorna_computador()">
</select> 
</div>
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
    <div id="modal2" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document" style="min-width: 95%">
        <div class="modal-content">                    
          <div id="alert2" style="height: 50px;"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8" style="float: none">
        <h3>MANUTENÇÃO DE CADASTRO DE COMPUTADORES</h3>
        <button style="margin-left:800px;" data-toogle="tooltip" data-placement="right" title="Pesquisar Cadastro" type="" class="btn btn-info" onclick="buscar_computador()"> <i class="fas fa-search"></i></button>
      <form>
          <div class="form-row">
            <div class="form-group">
              <label>Nome Completo</label>
              <input type="text" class="form-control" id="comp_nome_usuario">
            </div>
            <div class="form-group col-md-4">
              <label>Login</label>
              <input type="text" class="form-control" id="comp_login">
            </div>
            <div class="form-group col-md-4">
              <label>Usuario Administrador</label>
              <input type="email" class="form-control" id="comp_usuario_adm">
            </div>
            <div class="form-group col-md-4">
              <label>Senha</label>
              <input type="password" class="form-control" id="comp_senha">
            </div>
            <div class="form-group col-md-4">
              <label>Endereço IP</label>
              <input type="text" class="form-control" id="comp_ip">
            </div>
            <div class="form-group col-md-4">
              <label>Endereço MAC</label>
              <input type="text" class="form-control" id="comp_mac">
            </div>
            <div class="form-group col-md-4">
              <label for="inputState">Sistema Operacional</label>
              <select id="comp_sistema_operacional" class="form-control selectpicker" data-live-search="true" onchange="retorna_doc_a_partir_do_so2()">
                <option value="">  </option>
                <?php                        
                $sql = mysqli_query($conexao,"SELECT DISTINCT sistema_operacional_id,sistema_operacional_nome FROM sistemas_operacionais A JOIN diretorio_documentos B ON A.sistema_operacional_id = B.diretorio_id_sistema_operacional");
                while($sistema_operacional = mysqli_fetch_array($sql)){
                  echo "<option value='$sistema_operacional[sistema_operacional_id]'>$sistema_operacional[sistema_operacional_nome]</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <center><label class="control-label " > <h4>Dia do Backup </h4> </label><br>
                <label class="checkbox-inline" onclick="marca_dias_semana();"><input type="checkbox" id="todos_os_dias" ><i class="far fa-calendar-check" data-toogle="tooltip" data-placement="right" title="Selecionar todos os dias da semana"></i></label>
                <label class="checkbox-inline"><input type="checkbox" id="dia0" >Domingo </label>
                <label class="checkbox-inline"><input type="checkbox" id="dia1" >Segunda</label>
                <label class="checkbox-inline"><input type="checkbox" id="dia2" >Terça</label>
                <label class="checkbox-inline"><input type="checkbox" id="dia3" >Quarta</label>
                <label class="checkbox-inline"><input type="checkbox" id="dia4" >Quinta</label>
                <label class="checkbox-inline"><input type="checkbox" id="dia5" >Sexta</label>
                <label class="checkbox-inline"><input type="checkbox" id="dia6" >Sábado</label>
              </div>
              <div class="form-group col-md-3">
                <label> Horário</label>                
                <select class="form-control selectpicker" data-live-search="true" id="comp_hora_backup">
                  <option>  </option>
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
              <div class="form-group col-md-3">
                <label> Ligar antes? </label>                
                <select class="form-control selectpicker" id="comp_liga_computador">
                  <option value="">  </option>
                  <option value="SIM">SIM</option>
                  <option value="NÃO">NÃO</option>
                </select>                
              </div>
              <div class="form-group col-md-3">
                <label> Desligar após? </label>                
                <select class="form-control selectpicker" id="comp_desliga_computador">
                  <option value="">  </option>
                  <option value="SIM">SIM</option>
                  <option value="NÃO">NÃO</option>
                </select>                
              </div>
              <div class="form-group col-md-3">
                <label> Backup Ativo ?</label>                
                <select class="form-control selectpicker" id="comp_backup_ativo">
                  <option value="">  </option>
                  <option value="SIM">SIM</option>
                  <option value="NÃO">NÃO</option>
                </select>                
              </div>
              <div class="form-group col-md-3">
                <label>Servidor de Backup</label>
                <select id="servidor_id" class="form-control selectpicker" data-live-search="true">
                  <option value="">  </option>
                  <?php                        
                  $sql = mysqli_query($conexao,"SELECT servidor_id,servidor_nome FROM servidores ORDER BY servidor_id");
                  while($servidor = mysqli_fetch_array($sql)){
                    echo "<option value='$servidor[servidor_id]'>$servidor[servidor_nome]</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label>Diretórios</label>
                <select class="form-control selectpicker" multiple data-actions-box="true" data-width = 100% title="" id='documento_id'>
                  <?php
                  $sql = mysqli_query($conexao,"SELECT * FROM documentos ORDER BY documento_nome");
                  while($documento_id = mysqli_fetch_array($sql))
                    echo "<option value='$documento_id[documento_id]'>$documento_id[documento_nome]</option>";
                  ?>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label>Não copiar</label>
                <select class="form-control selectpicker" multiple data-actions-box="true" data-width = 100% title="" id='extensao_arquivo_id'>
                  <option value="99999">COPIAR TUDO</option>
                  <?php
                  $sql = mysqli_query($conexao,"SELECT * FROM extensao_arquivo  WHERE extensao_arquivo_id <> '99999' ORDER BY extensao_arquivo");
                  while($extensao_arquivo_id = mysqli_fetch_array($sql))
                    echo "<option value='$extensao_arquivo_id[extensao_arquivo_id]'>$extensao_arquivo_id[extensao_arquivo]</option>";
                  ?>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="inputState">Setor</label>
                <select id="comp_setor" class="form-control selectpicker" data-live-search="true">
                  <option value="">  </option>
                  <?php                        
                  $sql = mysqli_query($conexao,"SELECT setor_id,setor_nome FROM setores ORDER BY setor_nome");
                  while($setor = mysqli_fetch_array($sql)){
                    echo "<option value='$setor[setor_id]'>$setor[setor_nome]</option>";
                  }
                  ?>
                </select>
              </div>  
            </div>            
          </form>
        </div>
      </div>      
      <button type="button" class="btn btn-danger" onclick="excluir_computador()">EXCLUIR</button>
      <button type="button" class="btn btn-success" onclick="alterar_computador()">  ALTERAR </button>
      <button type="" class="btn btn-warning" onclick="limpar_alt_comp()"> CANCELAR </button>
    </div>
  </center>
</div>
<script src="../../js/funcoes_alteracoes.js"></script>
<script src="../../js/funcoes_retorno.js"></script>
<script src="../../js/funcoes_exclusao.js"></script>
<script src="../../js/funcoes_diversas.js"></script>
<script>

$('[data-toogle="tooltip"]').tooltip();

busca_computador();

</script>
</body>
</html>
