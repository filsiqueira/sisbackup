<?php
require_once("../conexao/conexao_pdo.php");
require_once("../painel/painel.php");
$conexao = conectar();
$sql = $conexao->prepare("SELECT * FROM smtp ORDER BY smtp_nome");
$sql->execute();
?>

    <div class="page-header">
        <h1>Cadastro de Serviço de Email</h1>
    </div>
    <div class="container">

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
                                <input type="text" id="smtp_nome" class="form-control" />
                            </div>
                            <div class="col-sm-6">
                                <label for="form-field-select-3">Email</label>
                                <br>
                                <input type="text" id="smtp_email_admin" class="form-control" />
                            </div>
                        </div>
                        <hr>
                        <div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="form-field-select-3">Porta de Envio</label>
                                    <br>
                                    <select class="chosen-select form-control" id="smtp_porta">
                                        <option value=""> Selecione </option>
                                        <option value="25"> 25 </option>
                                        <option value="587"> 587 </option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="form-field-select-3">Servidor SMTP</label>
                                    <br>
                                    <input type="text" id="smtp_endereco" class="form-control" />
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div>
                                    <div class="col-sm-6">
                                        <label for="form-field-select-3">Senha</label>
                                        <br>
                                        <input type="password" id="smtp_senha" class="form-control" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="form-field-select-3">Confirme a senha</label>
                                        <br>
                                        <input type="password" id="smtp_confirma_senha" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="button" class="btn btn-primary" onclick="cadastrar_smtp()" id="cad_smtp">CADASTRAR</button>
                        <a type="" class="btn btn-default" href="servidor_smtp.php"> VOLTAR </a>
                    </center>
                    <br>
                </div>
            </div>
        </div>
        <?php
        if($linhas = $sql->rowCount() != 0){
        ?>
        <script>
        $('#cad_smtp').attr('disabled',true);
        </script>
        <?php } ?>
