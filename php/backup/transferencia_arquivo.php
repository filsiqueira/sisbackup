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
        <h1>TRANSFERÊNCIA DE ARQUIVOS</h1>
        <br><br>
        <button style="margin-left:700px;" class="btn btn-success" data-toogle="popover" title="<h4>Transferência de Arquivos</h4>" data-content="Transfira arquivos de um Servidor de Backup para outro Servidor!"> <i class="fas fa-question-circle"></i></button>
        <div class="form-horizontal form-label-left">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" ><span class="required"></span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">

                  <label class="checkbox-inline" onclick="transferencia_por_usuario()"><h4>Selecionar usuário</h4><input type="radio" name="transferencia_arquivos" id="transferencia_arquivos_usuario" value="0" ></label>
                  <label class="checkbox-inline" onclick="transferencia_por_setor()"><h4>Selecionar setor</h4><input type="radio" name="transferencia_arquivos" id="transferencia_arquivos_setor" value="1"></label>
                  
                  <br>
                
                <div id="transferencia_usuario">  
                <label> Selecione o usuário </label>
                <select id="comp_id" class="form-control selectpicker" data-actions-box="true" data-live-search="true" data-width = 100% title="" onchange="retorna_usuario_selecionado()">
                    <option value="">  </option>
                    <?php
                    $sql1=mysqli_query($conexao,"SELECT comp_id,comp_nome_usuario,comp_servidor_backup FROM computadores ORDER BY comp_nome_usuario");
                    while($dados=mysqli_fetch_array($sql1)){
                      echo "<option value='$dados[comp_id]'>$dados[comp_nome_usuario]</option>";

                    }

                    ?>
                </select>

                <br>
                
                <label> Servidor Atual</label>
                <br>
                <input type="text" id="servidor_atual" class="form-control" disabled>
                <br>
                <label> Selecione o Servidor de Destino </label>
                <select id="servidor_id" class="form-control selectpicker" data-live-search="true" data-actions-box="true" data-width = 100% title="">
                  <option value="">  </option>
                  <?php
                  $sql2 = mysqli_query($conexao,"SELECT servidor_id,servidor_nome FROM servidores ORDER BY servidor_nome");
                  while($servidor = mysqli_fetch_array($sql2)){

                    echo "<option value='$servidor[servidor_id]'>$servidor[servidor_nome]</option>";

                    }
                  ?>

                </select>
                               
            </div>


            <div id="transferencia_setor">  
                <label> Selecione o setor </label>
                <select id="setor_id" class="form-control selectpicker" data-actions-box="true" data-live-search="true" data-width = 100% title="" onchange="retorna_setor_selecionado()">
                    <option value="">  </option>
                    <?php
                    $sql1=mysqli_query($conexao,"SELECT * FROM setores ORDER BY setor_nome");
                    while($setor=mysqli_fetch_array($sql1)){
                      echo "<option value='$setor[setor_id]'>$setor[setor_nome]</option>";

                    }

                    ?>
                </select>
                <br>
                <label> Selecione o Servidor de Destino </label>
                <select id="servidor_id2" class="form-control selectpicker" data-live-search="true" data-actions-box="true" data-width = 100% title="">
                  <option value="">  </option>
                  <?php
                  $sql2 = mysqli_query($conexao,"SELECT servidor_id,servidor_nome FROM servidores ORDER BY servidor_nome");
                  while($servidor = mysqli_fetch_array($sql2)){

                    echo "<option value='$servidor[servidor_id]'>$servidor[servidor_nome]</option>";

                    }
                  ?>

                </select>
               <br>
                
            </div>  
          </div>
        </div>
        <button type="button" id="transferir" class="btn btn-success" onclick="transfere_arquivo()"> TRANSFERIR </button>
        <button type="button" id="cancelar" class="btn btn-warning" onclick="cancelar_transferencia_arquivos()"> CANCELAR </button>
    </div>
    <div id="gif" style="display:block; margin-top: 20px;"><br><br><h4>Aguarde ...</h4><br><img src="../imagens/gif.gif"></div> 
      
</div>
</center>
</div>
<script src="../../js/funcoes_diversas.js"></script>
<script>

  $('#transferencia_usuario').hide();
  $('#transferencia_setor').hide();
  $('#cancelar').prop('disabled',true);
  $('#transferir').prop('disabled',true);
  $('#gif').hide();

      $('[data-toogle="popover"]').popover({

         placement:"bottom",
         html:true
    });


</script>
</body>
</html>
