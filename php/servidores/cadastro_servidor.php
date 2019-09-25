<?php
require_once("../painel/painel.php");
?>

    <div class="page-header">
        <h1>Cadastro de Servidor de Backup</h1>
    </div>
    <div class="container">

        <div class="col-xs-12 col-sm-8" style="margin-left:180px;">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Dados do Servidor</h4>
                    <span style="margin-left:72%" class="help-button" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Servidor onde serão salvos os backups">?</span>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Dê um nome para a identificação deste servidor">Nome do Servidor</label>
                                <br>
                                <input type="text" id="servidor_nome" class="form-control">

                            </div>
                            <div class="col-sm-6">
                                <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Endereço IP do servidor">Ip do Servidor</label>
                                <br>
                                <input type="text" id="servidor_ip" class="form-control" />
                            </div>
                        </div>
                        <hr>
                        <div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Plataforma do SO deste servidor">Plataforma</label>
                                    <br>
                                    <select class="chosen-select form-control" id="servidor_plataforma">
                                        <option value=""> Selecione </option>
                                        <option value="Linux"> LINUX </option>
                                        <option value="Windows"> WINDOWS </option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Usuário com privilégios de Administrador do Servidor">Login do Servidor</label>
                                    <br>
                                    <input type="text" id="servidor_user_privilegio" class="form-control" />
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div>
                                    <div class="col-sm-6">
                                        <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Senha do usuário com privilégios de Administrador do Servidor">Senha</label>
                                        <br>
                                        <input type="password" id="servidor_senha_acesso" class="form-control" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="form-field-select-3" data-rel="popover" data-trigger="hover" data-placement="bottom" title="Compartilhamento onde será salvo os backups">Nome do Compartilhamento</label>
                                        <br>
                                        <input type="text" id="servidor_nome_compartilhamento" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="button" class="btn btn-primary" onclick="cadastrar_servidor()" id="cad_servidor">CADASTRAR</button>
                        <a type="button" id="cancelar" class="btn btn-default" href="servidores.php"> VOLTAR </a>
                    </center>
                    <br>
                </div>
            </div>
        </div>
