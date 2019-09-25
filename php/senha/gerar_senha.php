<?php
include('../templates/template2.php');

session_start();
?>
 <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12"></div>
    </div>
    <center>
      <div class="row">
        <div id="modal" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog" role="document" style="min-width: 95%">
            <div class="modal-content">                    
              <div id="alert" style="height: 50px;"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-8" style="float: none">
          <br><br>
          <h1>Gerador de Senhas</h1>
          <br><br>
          <div class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label for="comment"><h3>Senha:</h3></label>
                  <textarea class="form-control" rows="2" id="senha" style="font-size: 20px; text-align: center;"></textarea>
                </div>
              </div>
            </div>
            <br><br>
            <button onclick="gera_senha()" class="btn btn-success"> GERAR </button>
            <button onclick="limpar_senha()" class="btn btn-warning"> LIMPAR </button>
          </div>
        </div>
      </center>
    </div>
  <script src="../../js/funcoes_retorno.js"></script>
  <script src="../../js/funcoes_diversas.js"></script>
</body>
</html>