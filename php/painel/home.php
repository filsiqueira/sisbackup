<?php
// Iniciando sessão
session_start();
// Recuperando usuario logado
$usuario = $_SESSION['login'];
require_once("../login/verifica_sessao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Sisbackup</title>
    		<link rel="stylesheet" href="../../assets/css/bootstrap-datepicker3.min.css" />
    		<link rel="stylesheet" href="../../assets/css/bootstrap-timepicker.min.css" />
    		<link rel="stylesheet" href="../../assets/css/daterangepicker.min.css" />
    		<link rel="stylesheet" href="../../assets/css/bootstrap-datetimepicker.min.css" />
    		<link rel="stylesheet" href="../../assets/css/bootstrap-colorpicker.min.css" />
    		<link rel="stylesheet" href="../../assets/css/fonts.googleapis.com.css" />
        <link rel="stylesheet" href="../../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="../../assets/css/ace-skins.min.css" />
    		<link rel="stylesheet" href="../../assets/css/ace-rtl.min.css" />
        <script src="assets/js/ace-extra.min.js"></script>
        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="../../assets/css/jquery-ui.custom.min.css" />
        <link rel="stylesheet" href="../../assets/css/chosen.min.css" />
        <link rel="stylesheet" href="../../assets/css/fonts.googleapis.com.css" />
        <link rel="stylesheet" href="../../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="../../assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="../../assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="../../assets/css/alertify.min.css">
        <link rel="stylesheet" href="../../assets/css/default.min.css">
        <script src="../../assets/js/ace-extra.min.js"></script>

        <style>

                *{
            margin:0;
            padding:0;
        }
        #gif{
            position:absolute;
            top:0;
            left:0;
            z-index:11;
            background-color:#000;
            width:100%;
            height:100%;
            opacity: .20;
            filter: alpha(opacity=65);
        }

        #informacoes{
          margin-left:10px;


        }

        </style>
    </head>
    <body class="no-skin">
        <div id="navbar" class="navbar navbar-default navbar-collapse h-navbar ace-save-state">
            <div class="navbar-container ace-save-state" id="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="../painel/home.php" class="navbar-brand">
                        <small>
                            <!--img src="assets/images/logo.png" style="max-height:40px;"-->
                            <i class="menu-icon fa fa-home"></i>
                            Sisbackup - 2.0
                        </small>
                    </a>
                </div>
                <nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse"></nav>
            </div>
        </div>
        <div class="main-container ace-save-state" id="main-container" style="margin-top:-13px;">
            <script type="text/javascript">
                try{ace.settings.loadState('main-container')}catch(e){}
            </script>

            <div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <script type="text/javascript">
                    try{ace.settings.loadState('sidebar')}catch(e){}
                </script>

                <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                <ul class="nav nav-list">
                    <li class="hover">
                        <a href="../servico_email/servidor_smtp.php">
                            <i class="menu-icon fa fa-envelope-o"></i>
                            <span class="menu-text"> Serviço Email </span>
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="hover">
                        <a href="../servidores/servidores.php">
                            <i class="menu-icon fa fa-server"></i>
                            <span class="menu-text"> Servidores Backup </span>
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="hover">
                        <a href="../sistemas_operacionais/cadastro_sistema_operacional.php">
                            <i class="menu-icon fa fa-windows"></i>
                            <span class="menu-text"> Sist.Operacionais</span>
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="hover">
                        <a href="../documentos/documentos.php">
                            <i class="menu-icon fa fa-folder-o "></i>
                            <span class="menu-text"> Diretórios </span>
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="hover">
                        <a href="../setores/setores.php">
                            <i class="menu-icon fa fa-building"></i>
                            <span class="menu-text"> Setores </span>
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="hover">
                        <a href="../usuarios/usuarios.php">
                            <i class="menu-icon fa fa-users"></i>
                            <span class="menu-text"> Usuários</span>
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="hover">
                        <a href="../computadores/computadores.php">
                            <i class="menu-icon fa fa-desktop"></i>
                        <span class="menu-text">Computadores</span>
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-hdd-o"></i>
                            <span class="menu-text">
                                Backups
                            </span>
                        <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="hover"><a href="../backup/agenda_backup.php"><i class="menu-icon fa fa-caret-right"></i>Agenda de Backups</a><b class="arrow"></b></li>
                            <li class="hover"><a href="../backup/executar_backup.php"><i class="menu-icon fa fa-caret-right"></i>Executar Backup</a><b class="arrow"></b></li>
                            <li class="hover"><a href="../backup/reduzir_backup.php"><i class="menu-icon fa fa-caret-right"></i>Sincronizar Arquivos</a><b class="arrow"></b></li>
                            <li class="hover"><a href="../backup/manutencao_backup.php"><i class="menu-icon fa fa-caret-right"></i>Ativar/Desativar Backup</a><b class="arrow"></b></li>
                            <li class="hover"><a href="../backup/relatorio_backup.php"><i class="menu-icon fa fa-caret-right"></i>Listar Backups</a><b class="arrow"></b></li>
                        </ul>
                    </li>

                  <li class="hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-desktop"></i>
                            <span class="menu-text">Auditoria</span><b class="arrow fa fa-angle-down"></b>
                        </a><b class="arrow"></b>
                        <ul class="submenu">
                            <li class="hover">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-caret-right"></i>Cadastros<b class="arrow fa fa-angle-down"></b>
                                </a><b class="arrow"></b>
                                <ul class="submenu">
                                    <li class="hover"><a href="../auditoria/cadastro_servico_email.php">Serviço de Email</a></li>
                                    <li class="hover"><a href="../auditoria/cadastro_servidores_backup.php">Servidores de Backup</a></li>
                                    <li class="hover"><a href="../auditoria/cadastro_sistemas_operacionais.php">Sistemas Operacionais</a></li>
                                    <li class="hover"><a href="../auditoria/cadastro_documentos.php">Diretórios</a></li>
                                    <li class="hover"><a href="../auditoria/cadastro_setores.php">Setores</a></li>
                                    <li class="hover"><a href="../auditoria/cadastro_usuarios_sistema.php">Usuários de Sistema</a></li>
                                    <li class="hover"><a href="../auditoria/cadastro_computadores_clientes.php">Computadores Clientes</a></li>
                                </ul>
                            </li>
                            <li class="hover">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-caret-right"></i>Alterações<b class="arrow fa fa-angle-down"></b>
                                </a><b class="arrow"></b>
                                <ul class="submenu">
                                    <li class="hover"><a href="../auditoria/alteracao_servico_email.php">Serviço de Email</a></li>
                                    <li class="hover"><a href="../auditoria/alteracao_servidores_backup.php">Servidores de Backup</a></li>
                                    <li class="hover"><a href="../auditoria/alteracao_sistemas_operacionais.php">Sistemas Operacionais</a></li>
                                    <li class="hover"><a href="../auditoria/alteracao_documentos.php">Diretórios</a></li>
                                    <li class="hover"><a href="../auditoria/alteracao_setores.php">Setores</a></li>
                                    <li class="hover"><a href="../auditoria/alteracao_usuarios_sistema.php">Usuários de Sistema</a></li>
                                    <li class="hover"><a href="../auditoria/alteracao_computadores_clientes.php">Computadores Clientes</a></li>
                                </ul>
                            </li>
                            <li class="hover">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-caret-right"></i>Exclusões<b class="arrow fa fa-angle-down"></b>
                                </a><b class="arrow"></b>
                                <ul class="submenu">
                                    <li class="hover"><a href="../auditoria/exclusao_servico_email.php">Serviço de Email</a></li>
                                    <li class="hover"><a href="../auditoria/exclusao_servidores_backup.php">Servidores de Backup</a></li>
                                    <li class="hover"><a href="../auditoria/exclusao_sistemas_operacionais.php">Sistemas Operacionais</a></li>
                                    <li class="hover"><a href="../auditoria/exclusao_documentos.php">Diretórios</a></li>
                                    <li class="hover"><a href="../auditoria/exclusao_setores.php">Setores</a></li>
                                    <li class="hover"><a href="../auditoria/exclusao_computadores_clientes.php">Computadores Clientes</a></li>
                                </ul>
                            </li>
                            <li class="hover">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-caret-right"></i>Banco de Dados<b class="arrow fa fa-angle-down"></b>
                                </a><b class="arrow"></b>
                                <ul class="submenu">
                                    <li class="hover"><a href="../auditoria/backup_database.php"> Backup </a></li>
                                    <li class="hover"><a href="../auditoria/restore_database.php"> Restore </a></li>
                                </ul>
                            </li>
                    </ul>
                </li>
                    <li class="hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-key"></i>
                            <span class="menu-text">
                                Senhas
                            </span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="hover"><a href="../senha/alterar_senha.php"><i class="menu-icon fa fa-caret-right"></i>Alterar</a><b class="arrow"></b></li>
                            <li class="hover"><a href="../senha/enviar_por_email.php"><i class="menu-icon fa fa-caret-right"></i>Enviar por Email</a><b class="arrow"></b></li>
                        </ul>
                    </li>
                    <li class="hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-database"></i>
                            <span class="menu-text">
                                Banco de Dados
                            </span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="hover"><a href="../documentacao/Dicionario_Dados_SisBackup.pdf" target="_blank"><i class="menu-icon fa fa-caret-right"></i>Dicionário de Dados</a><b class="arrow"></b></li>
                            <li class="hover"><a href="#" onclick="backup_base_dados()">Backup Base de Dados</a></li>
                            <li class="hover"><a href="#" onclick="exporta_base_dados()">Exportar Base de Dados</a></li>
                            <li class="hover"><a href="../database/restaurar_base_dados.php">Restaurar Base de Dados</a></li>
                        </ul>
                    </li>
                    <li class="hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-pencil-square-o"></i>
                            <span class="menu-text">
                                Relatórios
                            </span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="hover"><a href="../relatorios/relacao_backup_usuario_servidor.php"><i class="menu-icon fa fa-caret-right"></i>Backup Usuario/ Servidor</a><b class="arrow"></b></li>
                            <li class="hover"><a href="../relatorios/relatorio_sistemas_operacionais_usuario.php"><i class="menu-icon fa fa-caret-right"></i>S.O /Usuários</a></li>
                            <li class="hover"><a href="../relatorios/relatorio_documentos_usuarios.php"><i class="menu-icon fa fa-caret-right"></i>Diretórios / Usuários</a></li>
                            <li class="hover"><a href="../relatorios/relatorio_usuarios_setor.php"><i class="menu-icon fa fa-caret-right"></i>Usuários / Setor</a></li>
                        </ul>
                    </li>
                    <li class="hover"><a href="#" onclick="sair()" ><i class="menu-icon fa fa-sign-out "></i><span class="menu-text">Sair</span></a><b class="arrow"></b></li>
                </div>
            </div>
        </div>
        <!--
        <hr>
        <div class="informacoes" id="informacoes">
          <br><br>
          <a href="#" class="btn  btn-primary">
            <i class="ace-icon fa fa-desktop bigger-230"></i>
						<br>
            <b>Computadores <br>
            <div id="info_pc"></div>
          </b>
          </a>&nbsp;&nbsp;&nbsp;
          <a href="#" class="btn  btn-success">
            <i class="ace-icon fa fa-windows bigger-230"></i>
            <br>
            <b>
            Sistemas Op.<br>
            <div id="info_so"></div>
          </b>
          </a>&nbsp;&nbsp;&nbsp;
          <a href="#" class="btn  btn-danger">
            <i class="ace-icon fa fa-building bigger-230">&nbsp;&nbsp;</i>
            <br><b>&nbsp;&nbsp;&nbsp;Setores<br>
            <div id="info_setor"></div><b>
          </a>&nbsp;&nbsp;&nbsp;
          <a href="#" class="btn  btn-purple">
            <i class="ace-icon fa fa-envelope-o bigger-230">&nbsp;&nbsp;</i>
            <br> <b>Serviço de Email<br>
            <div id="info_smtp"></div></b>
          </a>&nbsp;&nbsp;&nbsp;
          <a href="#" class="btn  btn-info">
            <i class="ace-icon fa fa-folder-o bigger-230">&nbsp;&nbsp;</i>
            <br><b>Diretórios<br>
            <div id="info_diretorios"></div></b>
          </a>&nbsp;&nbsp;&nbsp;
          <a href="#" class="btn  btn-purple">
            <i class="ace-icon fa fa-users bigger-230">&nbsp;&nbsp;</i>
            <br><b> Usuários&nbsp;&nbsp;<br>
              <div id="info_usuarios"></div></b>
          </a>&nbsp;&nbsp;&nbsp;
          <a href="#" class="btn  btn-danger">
            <i class="ace-icon fa fa-hdd-o bigger-230">&nbsp;&nbsp;</i>
            <br><b>Bkp Falha<br>
            <div id="bkp_falha"></div></b>
          </a>&nbsp;&nbsp;&nbsp;
          <a href="#" class="btn  btn-success">
            <i class="ace-icon fa fa-hdd-o bigger-230">&nbsp;&nbsp;</i>
            <br><b>Bkp Sucesso<br>
            <div id="bkp_sucesso"></div></b>
          </a>&nbsp;&nbsp;&nbsp;
          <a href="#" class="btn  btn-primary">
            <i class="ace-icon fa fa-server bigger-230">&nbsp;&nbsp;</i>
            <br><b>Servidores Backup<br>
            <div id="srv_bkp"></div></b>
          </a>
        </div>
        <hr>
      -->
        <div id="gif" class="gif" hidden="true"></div>
        <div hidden="true" class="gif" style="position: absolute; left: 40%; top: 35%;z-index:99999; background-color:#000 ; opacity: .30; border-radius: 10px;">
                <img src="../img/gif.gif" style="max-width:170px;">
                <h3 style="color:#fff; margin-top:0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aguarde ...</h3>
        </div>
 <script src="../../assets/js/jquery-3.3.1.min.js"></script>
 <script src="../../assets/js/popper.min.js"></script>
 <script src="../../assets/js/bootstrap.min.js"></script>
 <script src="../../assets/js/alertify.min.js"></script>
 <script src="../../assets/js/jquery.dataTables.min.js"></script>
 <script src="../../assets/js/jquery.dataTables.bootstrap.min.js"></script>
 <script src="../../assets/js/dataTables.buttons.min.js"></script>
 <script src="../../assets/js/funcoes_cadastro.js"></script>
 <script src="../../assets/js/funcoes_alteracoes.js"></script>
 <script src="../../assets/js/funcoes_diversas.js"></script>
 <script src="../../assets/js/funcoes_exclusao.js"></script>
 <script src="../../assets/js/funcoes_retorno.js"></script>
<script src="../../assets/cleave.js-master/dist/cleave.min.js"></script>
<script src="../../assets/js/jquery-ui.custom.min.js"></script>
<script src="../../assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="../../assets/js/chosen.jquery.min.js"></script>
<script src="../../assets/js/spinbox.min.js"></script>
<script src="../../assets/js/bootstrap-datepicker.min.js"></script>
<script src="../../assets/js/bootstrap-timepicker.min.js"></script>
<script src="../../assets/js/moment.min.js"></script>
<script src="../../assets/js/daterangepicker.min.js"></script>
<script src="../../assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="../../assets/js/bootstrap-colorpicker.min.js"></script>
<script src="../../assets/js/jquery.knob.min.js"></script>
<script src="../../assets/js/autosize.min.js"></script>
<script src="../../assets/js/jquery.inputlimiter.min.js"></script>
<script src="../../assets/js/jquery.maskedinput.min.js"></script>
<script src="../../assets/js/bootstrap-tag.min.js"></script>
<script src="../../assets/js/ace-elements.min.js"></script>
<script src="../../assets/js/ace.min.js"></script>


<script type="text/javascript">
    jQuery(function($) {
//Informacoes da tela inicial
        //retorna_info_home();


        $('#id-disable-check').on('click', function() {
            var inp = $('#form-input-readonly').get(0);
            if(inp.hasAttribute('disabled')) {
                inp.setAttribute('readonly' , 'true');
                inp.removeAttribute('disabled');
                inp.value="This text field is readonly!";
            }
            else {
                inp.setAttribute('disabled' , 'disabled');
                inp.removeAttribute('readonly');
                inp.value="This text field is disabled!";
            }
        });


        if(!ace.vars['touch']) {
            $('.chosen-select').chosen({allow_single_deselect:true});
            //resize the chosen on window resize

            $(window)
            .off('resize.chosen')
            .on('resize.chosen', function() {
                $('.chosen-select').each(function() {
                     var $this = $(this);
                     $this.next().css({'width': $this.parent().width()});
                })
            }).trigger('resize.chosen');
            //resize chosen on sidebar collapse/expand
            $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                if(event_name != 'sidebar_collapsed') return;
                $('.chosen-select').each(function() {
                     var $this = $(this);
                     $this.next().css({'width': $this.parent().width()});
                })
            });


            $('#chosen-multiple-style .btn').on('click', function(e){
                var target = $(this).find('input[type=radio]');
                var which = parseInt(target.val());
                if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
                 else $('#form-field-select-4').removeClass('tag-input-style');
            });
        }




        autosize($('textarea[class*=autosize]'));

        $('textarea.limited').inputlimiter({
            remText: '%n character%s remaining...',
            limitText: 'max allowed : %n.'
        });

        $.mask.definitions['~']='[+-]';
        $('.input-mask-date').mask('99/99/9999');
        $('.input-mask-mac').mask('**:**:**:**:**:**');
        $('.input-mask-phone').mask('(999) 999-9999');
        $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
        $(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});



        $( "#input-size-slider" ).css('width','200px').slider({
            value:1,
            range: "min",
            min: 1,
            max: 8,
            step: 1,
            slide: function( event, ui ) {
                var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
                var val = parseInt(ui.value);
                $('#form-field-4').attr('class', sizing[val]).attr('placeholder', '.'+sizing[val]);
            }
        });

        $( "#input-span-slider" ).slider({
            value:1,
            range: "min",
            min: 1,
            max: 12,
            step: 1,
            slide: function( event, ui ) {
                var val = parseInt(ui.value);
                $('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
            }
        });

        $( "#slider-range" ).css('height','200px').slider({
            orientation: "vertical",
            range: true,
            min: 0,
            max: 100,
            values: [ 17, 67 ],
            slide: function( event, ui ) {
                var val = ui.values[$(ui.handle).index()-1] + "";

                if( !ui.handle.firstChild ) {
                    $("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
                    .prependTo(ui.handle);
                }
                $(ui.handle.firstChild).show().children().eq(1).text(val);
            }
        }).find('span.ui-slider-handle').on('blur', function(){
            $(this.firstChild).hide();
        });


        $( "#slider-range-max" ).slider({
            range: "max",
            min: 1,
            max: 10,
            value: 2
        });

        $( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
            // read initial values from markup and remove that
            var value = parseInt( $( this ).text(), 10 );
            $( this ).empty().slider({
                value: value,
                range: "min",
                animate: true

            });
        });

        $("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item


        $('#id-input-file-1 , #id-input-file-2').ace_file_input({
            no_file:'No File ...',
            btn_choose:'Choose',
            btn_change:'Change',
            droppable:false,
            onchange:null,
            thumbnail:false //| true | large
        });

        $('#id-input-file-3').ace_file_input({
            style: 'well',
            btn_choose: 'Drop files here or click to choose',
            btn_change: null,
            no_icon: 'ace-icon fa fa-cloud-upload',
            droppable: true,
            thumbnail: 'small'//large | fit
            ,
            preview_error : function(filename, error_code) {

            }

        }).on('change', function(){

        });

        $('#id-file-format').removeAttr('checked').on('change', function() {
            var whitelist_ext, whitelist_mime;
            var btn_choose
            var no_icon
            if(this.checked) {
                btn_choose = "Drop images here or click to choose";
                no_icon = "ace-icon fa fa-picture-o";

                whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
                whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
            }
            else {
                btn_choose = "Drop files here or click to choose";
                no_icon = "ace-icon fa fa-cloud-upload";

                whitelist_ext = null;//all extensions are acceptable
                whitelist_mime = null;//all mimes are acceptable
            }
            var file_input = $('#id-input-file-3');
            file_input
            .ace_file_input('update_settings',
            {
                'btn_choose': btn_choose,
                'no_icon': no_icon,
                'allowExt': whitelist_ext,
                'allowMime': whitelist_mime
            })
            file_input.ace_file_input('reset_input');

            file_input
            .off('file.error.ace')
            .on('file.error.ace', function(e, info) {
            });
        });

        $('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
        .closest('.ace-spinner')
        .on('changed.fu.spinbox', function(){
            //console.log($('#spinner1').val())
        });
        $('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
        $('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
        $('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});

        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
            $(this).prev().focus();
        });

        //or change it into a date range picker
        $('.input-daterange').datepicker({autoclose:true});


        //to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
        $('input[name=date-range-picker]').daterangepicker({
            'applyClass' : 'btn-sm btn-success',
            'cancelClass' : 'btn-sm btn-default',
            locale: {
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
            }
        })
        .prev().on(ace.click_event, function(){
            $(this).next().focus();
        });


        $('#timepicker1').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false,
            disableFocus: true,
            icons: {
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down'
            }
        }).on('focus', function() {
            $('#timepicker1').timepicker('showWidget');
        }).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });




        if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
         //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
         icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-arrows ',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
         }
        }).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });


        $('#colorpicker1').colorpicker();
        //$('.colorpicker').last().css('z-index', 2000);//if colorpicker is inside a modal, its z-index should be higher than modal'safe

        $('#simple-colorpicker-1').ace_colorpicker();

        $(".knob").knob();

        var tag_input = $('#form-field-tags');
        try{
            tag_input.tag(
              {
                placeholder:tag_input.attr('placeholder'),
                //enable typeahead by specifying the source array
                source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
              }
            )

            var $tag_obj = $('#form-field-tags').data('tag');
            $tag_obj.add('Programmatically Added');

            var index = $tag_obj.inValues('some tag');
            $tag_obj.remove(index);
        }
        catch(e) {
            //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
            tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
            //autosize($('#form-field-tags'));
        }
        $('#modal-form input[type=file]').ace_file_input({
            style:'well',
            btn_choose:'Drop files here or click to choose',
            btn_change:null,
            no_icon:'ace-icon fa fa-cloud-upload',
            droppable:true,
            thumbnail:'large'
        })
        $('#modal-form').on('shown.bs.modal', function () {
            if(!ace.vars['touch']) {
                $(this).find('.chosen-container').each(function(){
                    $(this).find('a:first-child').css('width' , '210px');
                    $(this).find('.chosen-drop').css('width' , '210px');
                    $(this).find('.chosen-search input').css('width' , '200px');
                });
            }
        })

        $(document).one('ajaxloadstart.page', function(e) {
            autosize.destroy('textarea[class*=autosize]')

            $('.limiterBox,.autosizejs').remove();
            $('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
        });

    });
</script>
