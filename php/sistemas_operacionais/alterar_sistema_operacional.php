<?php
require_once("../painel/painel.php");
require_once("../conexao/conexao.php");

if(isset($_GET['sistema_operacional_id'])){

  $sistema_operacional_id = mysqli_escape_string($conexao, $_GET['sistema_operacional_id']);

  $sql = mysqli_query($conexao,"SELECT * FROM sistemas_operacionais WHERE sistema_operacional_id = '$sistema_operacional_id' ");
  $dados = mysqli_fetch_array($sql);

}
?>

    <div class="page-header">
        <h1> Alterar Cadastro de Sistemas Operacionais</h1>
    </div>
    <div class="container">
<input type="text" hidden="true" id="sistema_operacional_id" value="<?php echo $dados['sistema_operacional_id']?>">
        <div class="col-xs-12 col-sm-8" style="margin-left:180px;">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Dados do Sistema Operacional</h4>
                    <span style="margin-left:57%" class="help-button" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Cadastre os Sistemas Operacionais existentes em sua rede de computadores">?</span>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="form-field-select-3">Nome do Sistema Operacional</label>
                                <br>
                                <input type="text" id="nome_so" value="<?php echo $dados['sistema_operacional_nome']?>" class="form-control" />
                            </div>
                        </div>
                        <hr>
                        <div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="form-field-select-3">Plataforma</label>
                                    <br>
                                    <select class="chosen-select form-control"  id="plataforma" data-placeholder="Selecione">
                                        <option value="<?php echo $dados['sistema_operacional_plataforma']?>"><?php echo $dados['sistema_operacional_plataforma']?></option>
                                        <?php
                                          if($dados['sistema_operacional_plataforma'] == "WINDOWS"){
                                            echo "<option value='LINUX'>LINUX</option>";
                                          } else{
                                            echo "<option value='WINDOWS'>WINDOWS</option>";
                                          }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <center>
                        <button type="button" class="btn btn-primary" onclick="alterar_so()" id="cad_so">ALTERAR</button>
                        <a type="button" id="cancelar" class="btn btn-default" href="cadastro_sistema_operacional.php"> VOLTAR </a>
                    </center>
                    <br>
                </div>
            </div>
        </div>
