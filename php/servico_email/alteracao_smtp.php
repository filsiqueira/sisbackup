<?php
include('../templates/template2.php');
include('../conexao/conexao.php');
?>
<body>
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
        <h1>Alterar Servidor de Envio de Emails</h1>
        <br><br>
        <form>
          <select class="form-control" id="usuario_id" onchange="retorna_usuario()">
            <option value="">Selecione um cadastro para alterar </option>

         </select>
         <br><br>
         <div class="form-row">
          <div class="form-group col-md-6">
            <label>Email Admin</label>
            <input type="text" class="form-control" id="smtp_email_admn">
          </div>
          <div class="form-group col-md-6">
            <label for="inputState">Porta de Envio</label>
            <select id="smtp_porta" class="form-control">
              <option value=""></option>
              <option value="587">587</option>
              <option value="25">25</option>
            </select>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="inputCity">Servidor smtp</label>
          <input type="email" class="form-control" id="smtp_endereco">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputCity">Senha</label>
            <input type="password" class="form-control" id="smtp_senha">
          </div>
        </div><br>                
        <button type="button" class="btn btn-success" onclick="cadastrar_usuario()">Cadastrar</button>
        <button type="" class="btn btn-info" onclick="limpar_usu()">Voltar</button>
      </form>
    </div>
  </div>
</div>
</center>
</div>
<script src="../../js/funcoes_alteracoes.js"></script>
<script src="../../js/funcoes_retorno.js"></script>
</body>
</html>
