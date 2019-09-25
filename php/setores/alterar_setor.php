<?php
require_once("../painel/painel.php");
require_once("../conexao/conexao.php");


if(isset($_GET['setor_id'])){

  $setor_id = mysqli_escape_string($conexao, $_GET['setor_id']);
  $sql = mysqli_query($conexao,"SELECT * FROM setores WHERE setor_id = '$setor_id' ");
  $dados = mysqli_fetch_array($sql);

}
?>

    <div class="page-header">
        <h1>Alterar Setor</h1>
    </div>
    <div class="container">
<input type="text" hidden="true" id="setor_id" value="<?php echo $dados['setor_id']?>">
        <div class="col-xs-12 col-sm-8" style="margin-left:180px;">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Dados do Setor</h4>
                    <span style="margin-left:75%" class="help-button" data-rel="popover" data-trigger="hover" data-placement="bottom" title="O sistema irá organizar os backups no Servidor separando por setor">?</span>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="form-field-select-3">Nome do Setor</label>
                                <br>
                                <input type="text" id="setor_nome" class="form-control" placeholder="Não deve conter espaços !!" value="<?php echo $dados['setor_nome']?>">
                            </div>
                        </div>
                        <hr>
                        <div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="form-field-select-3">Descrição</label>
                                    <br>
                                    <textarea  class="form-control" rows="5" id="descricao_setor" value="<?php echo $dados['setor_descricao']?>"><?php echo $dados['setor_descricao']?></textarea>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <center>
                        <button type="button" class="btn btn-primary" onclick="alterar_setor()" id="cad_setor">ALTERAR</button>
                        <a type="button" id="cancelar" class="btn btn-default" href="setores.php"> VOLTAR </a>
                    </center>
                    <br>
                </div>
            </div>
        </div>
