<?php
require_once("../conexao/conexao_pdo.php");
$conexao = conectar();
require_once("../painel/painel.php");

if(isset($_GET['smtp_id'])){

$smtp_id = $_GET['smtp_id'];

$sql = $conexao->prepare("SELECT * FROM smtp WHERE smtp_id = :smtp_id ");
$sql->bindValue(":smtp_id",$smtp_id);
$sql->execute();
$dados = $sql->fetch(PDO:: FETCH_ASSOC);

}
?>
    <div class="page-header">
        <h1> Alterar Cadastro de Serviço de Email</h1>
    </div>
    <div class="container">
<input type="text" hidden="true" id="smtp_id" value="<?php echo $dados['smtp_id']?>">
        <div class="col-xs-12 col-sm-8" style="margin-left:180px;">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Dados da Conta</h4>
                    <span style="margin-left:75%" class="help-button" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Esta conta enviará e receberá os emails de notificações do Sistema">?</span>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="form-field-select-3">Nome</label>
                                <br>
                                <input type="text" id="smtp_nome" value="<?php echo $dados['smtp_nome']?>" class="form-control" />
                            </div>
                            <div class="col-sm-6">
                                <label for="form-field-select-3">Email</label>
                                <br>
                                <input type="text" id="smtp_email_admin" value="<?php echo $dados['smtp_email_admin']?>" class="form-control" />
                            </div>
                        </div>
                        <hr>
                        <div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="form-field-select-3">Porta de Envio</label>
                                    <br>
                                    <select class="chosen-select form-control" id="smtp_porta" data-placeholder="Selecione">
                                        <option value="<?php echo $dados['smtp_porta']?>"><?php echo $dados['smtp_porta']?></option>
                                        <?php
                                          if($dados['smtp_porta'] == "25"){
                                            echo "<option value='587'>587</option>";
                                          } else {
                                            echo "<option value='25'>25</option>";
                                          }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="form-field-select-3">Servidor SMTP</label>
                                    <br>
                                    <input type="text" id="smtp_endereco" value="<?php echo $dados['smtp_endereco']?>" class="form-control" />
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div>
                                    <div class="col-sm-6">
                                        <label for="form-field-select-3">Senha</label>
                                        <br>
                                        <input type="password" id="smtp_senha" value="<?php echo base64_decode($dados['smtp_senha'])?>" class="form-control" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="form-field-select-3">Confirme a senha</label>
                                        <br>
                                        <input type="password" id="smtp_confirma_senha" value="<?php echo base64_decode($dados['smtp_senha'])?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="button" class="btn btn-primary" onclick="alterar_smtp()" id="cad_smtp">ALTERAR</button>
                        <a type="" class="btn btn-default" href="servidor_smtp.php"> VOLTAR </a>
                    </center>
                    <br>
                </div>
            </div>
        </div>
