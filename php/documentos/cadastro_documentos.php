<?php
require_once("../painel/painel.php");
require_once("../conexao/conexao.php");
?>

    <div class="page-header">
        <h1>Cadastro de Diretórios</h1>
    </div>
    <div class="container">

        <div class="col-xs-12 col-sm-8" style="margin-left:180px;">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Dados do Diretório</h4>
                    <span style="margin-left:72%" class="help-button" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Cadastre os diretórios que deseja que sejam copiados">?</span>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Ex: Àrea de Trabalho, Meus Documentos, Minhas Imagens ...">Nome do Diretório</label>
                                <br>
                                <input type="text" id="nome_documento" class="form-control" />
                            </div>
                        </div>
                        <hr>
                            <div class="row">
                              <div class="col-sm-12">
                                  <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Ex: Àrea de Trabalho -> C:/Users/usuario/Desktop; Meus Documentos -> C:/Users/usuario/Documents">Diretório nos Sistemas Operacionais</label>
                                  <hr>
                                  <br>
                                  <?php
                                  $sql = mysqli_query($conexao," SELECT sistema_operacional_id,sistema_operacional_nome FROM sistemas_operacionais ORDER BY sistema_operacional_nome");
                                  while($sos = mysqli_fetch_array($sql))
                                    echo "<div class='form-group'><label class='control-label col-md-3 col-sm-3 col-xs-12' >$sos[sistema_operacional_nome]<span class='required'></span></label><div class='col-md-6 col-sm-6 col-xs-12'><input  type='text' data-id='$sos[sistema_operacional_id]' class='form-control col-md-7 col-xs-12 so' placeholder='Ex: C:/Users/usuario ...'></div></div><br><hr>"
                                  ?>
                              </div>
                            </div>
                            <hr>
                    </div>
                    <center>
                        <button type="button" class="btn btn-primary" onclick="cadastrar_documento()" id="cad_servidor">CADASTRAR</button>
                        <a type="button" id="cancelar" class="btn btn-default" href="documentos.php"> VOLTAR </a>
                    </center>
                    <br>
                </div>
            </div>
        </div>
