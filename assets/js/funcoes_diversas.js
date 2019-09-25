/*********************************************** Função para validar login ************************************************************/
function valida_login(){

    if($('#login').val() == "" || $('#senha').val() == ""){
      alertify.error('Preencha todos os campos');
      return;

    } else {

        $.post('php/login/validar_login.php',{login: $('#login').val(),senha: $('#senha').val()},function(data){

            if(data == 'usuario_bloqueado'){

                alertify.warning('Usuário Bloqueado!')
                return;

            } else if (data == 'dados_invalidos'){
                alertify.error('Usuário ou senha inválidos!');
                return;

            } else {

                window.location.href = "php/painel/home.php";
            }

        });
    }
}
/*********************************************************************************************************************************************/
/*********************************              Função Sair     ********************************************************************************/

function sair(){

    alertify.confirm('SAIR','DESEJA REALMENTE SAIR?',function(){
      window.location.href="../login/logout.php";
    },function(){
      alertify.warning('Operação cancelada pelo usuário.');
    })

}

/***************************************** Função Verificar atualização de sistema *******************************************************************/

function buscar_atualizacoes(){
  alertify.confirm('ATUALIZAÇÃO!','VERIFICAR ATUALIZAÇÕES PARA O SISTEMA? Certifique-se de estar conectado à internet!',function(){

  $('.gif').prop('hidden',false);

  $.post('../atualizacao/buscar_atualizacao.php').done(function(data){
      if(data == "true"){
        alertify.success('Atualização concluída com sucesso!');
        $('.gif').prop('hidden',true);
        return;

      } else if(data == "verifique_conexao"){
        alertify.error('Erro ao atualizar o sistema! Verifique sua conexão com a internet!');
        $('.gif').prop('hidden',true);
        return;

      } else {
        alertify.error('Erro ao atualizar o sistema! Tente novamente mais tarde ...');
        $('.gif').prop('hidden',true);
        return;
      }
  })

  },function(){
    alertify.warning('Operação cancelada pelo usuário!');
  })
}


/*******************************************************************************************************************************************/
/************************************************ Funcoes da Tela Executar Backup **********************************************************/
function testa_comunicacao(){

    if($('#comp_id').val() == ""){

        alertify.warning('Selecione um cadastro para testar a comunicação!');
        return;

    } else {

        $('.gif').prop('hidden',false);

        $.post('testar_comunicacao.php',{comp_id:$('#comp_id').val()}).done(function(data){

            if(data == 'comunicando'){
                alertify.success('Comunicação realizada com sucesso!');
                $('.gif').prop('hidden',true);
                return;

            } else {

                alertify.error('Sem comunicação com o computador!');
                $('.gif').prop('hidden',true);
                return;
            }
        })
    }
}
/********************************************************************************************************************************************/
/************************************************** Funcao de Limpar ************************************************************************/

function limpar_exec_bkp_usu(){

    $('#comp_id').val("");
    $('#comp_id').trigger("chosen:updated");
}

/********************************************************************************************************************************************/
/************************************************* Funcao Executar Backup *******************************************************************/

// Funcao executa_backup

function executa_backup(){


    if($('#comp_id').val() == ""){
        alertify.warning('Selecione um Cadastro para executar o Backup.');
        return;

    } else {

       $('.gif').prop('hidden',false);

       $.post('executa_backup.php',{comp_id:$('#comp_id').val()}).done(function (data){

      if(data == "inativo"){

         $('.gif').prop('hidden',true);
         alertify.warning('O backup deste usuário está Inativo. Verifique o cadastro.');
         return;

    } else  if(data == "erro_montagem"){
      $('.gif').prop('hidden',true);
      alertify.error('Erro ao montar o compartilhamento do Computador');
      return;


     } else {

       $('.gif').prop('hidden',true);
        alertify.success('<strong> BACKUP REALIZADO!</strong> Aguarde o email com mais detalhes.');
       return;
   }
})
   }
}


function limpar_reduzir_bkp(){

    $('#comp_id').val("");
    $('#comp_id').trigger('chosen:updated');
}
/************************************************* Funcao Executar Backup *******************************************************************/

// Funcao executa_backup

function restaurar_backup(){

    var selecione_comp = "<div class='alert alert-info alert-dismissible'><center><strong>ATENÇÃO!</strong> Selecione um Cadastro para restaurar o Backup.<button class='close' data-dismiss='modal'>&times</button></center></div>";
    var selecione_doc = "<div class='alert alert-info alert-dismissible'><center><strong>ATENÇÃO!</strong> Selecione o documento que deseja restaurar.<button class='close' data-dismiss='modal'>&times</button></center></div>";
    var erro_disp = "<div class='alert alert-danger alert-dismissible'><center><strong> OPS !</strong> Erro ao Disparar o Backup. Tente novamente. Se o erro persistir,contacte o Administrador do Sistema.<button class='close' data-dismiss='modal' onclick='mensagem_erro()'>&times</button></center></div>";
    var inativo = "<div class='alert alert-danger alert-dismissible'><center><strong> OPS !</strong> O backup deste usuário está Inativo. Verifique o cadastro.<button class='close' data-dismiss='modal' onclick='mensagem_erro()'>&times</button></center></div>";
    var bkp_rest = "<div class='alert alert-info alert-dismissible'><center><strong> BACKUP RESTAURADO!</strong> Confira na máquina do cliente ...<button class='close' data-dismiss='modal'>&times</button></center></div>";

    if($('#comp_id').val() == ""){

        $('#alert').html(selecione_comp);
        $('#modal').modal('show');
        return;

    } else if($('#documento_id').val() == "") {


        $('#alert').html(selecione_doc);
        $('#modal').modal('show');
        return;

    } else {

       $('#gif').show();
       $('#restaurar').attr('disabled',true);
       $('#comunicacao').attr('disabled',true);
       $('#cancelar').attr('disabled',true);

       $.post('restaura_backup.php',{comp_id:$('#comp_id').val(),documento_id:$('#documento_id').val()}).done(function (data){


      if(data == "inativo"){

         $('#gif').hide();
         $('#restaurar').attr('disabled',false);
         $('#comunicacao').attr('disabled',false);
         $('#cancelar').attr('disabled',false);
         $('#alert').html(inativo);
         $('#modal').modal('show');
         return;

    } else {

           $('#gif').hide();
           $('#restaurar').attr('disabled',false);
           $('#comunicacao').attr('disabled',false);
           $('#cancelar').attr('disabled',false);
           $('#alert').html(bkp_rest);
           $('#modal').modal('show');
           return;

    }

       })
   }
}


function limpar_restore_backup(){

    $('#comp_id').val("");
    $('#documento_id').val("");

}

/********************************************************************************************************************************************/


/********************************************************************************************************************************************/
/****************************************************** Funcoes da Tela Gerador de senha *****************************************************/

function gera_senha(){

    $.post('gerador_senha.php').done(function(data){$('#senha').show();$('#senha').val(data);$('#usuario_senha').val("");$('#usuario_confirma_senha').val("");});
}


/*******************************************************************************************************************************************/
/***************************************************** Funcoes da Tela Enviar Senha Por Email **********************************************/

// Funcao que retorna o email do usuario
function retorna_email_usuario(){
    $.post('retorna_usuario.php',{usuario_id:$('#usuario_id').val()}).done(function(data){$('#usuario_email').val(data)});
}


// Funcao para limpar os campos

function limpar_env_senha(){

    $('#usuario_id').val("");
    $('#usuario_id').trigger('chosen:updated');
    $('#usuario_email').val("");
}



// Funcao para enviar senha por email
function enviar_senha(){

  if($('#usuario_id').val() == ""){

        alertify.warning('Selecione um usuário!');
        return;

    } else {

        $('.gif').prop('hidden',false);
        $.post('enviar_senha.php',{usuario_id:$('#usuario_id').val()}).done(function(data){

            if(data == 'true'){
                $('.gif').prop('hidden',true);
                alertify.success('Senha enviada para o email do usuário!');
                $('#usuario_id').val("");
                $('#usuario_id').trigger('chosen:updated');
                $('#usuario_email').val("");
                return;

            } else {
              alertify.error('Erro ao enviar a senha para o email do usuário!');
              return;
            }
        });
    }
}
/********************************************************************************************************************************************/
/********************************************************************************************************************************************/
/************************************************* Funcao Reduzir Backup *******************************************************************/

// Funcao reduzir_backup

function reduzir_backup(){

    if($('#comp_id').val() == ""){

        alertify.warning('Selecione um Cadastro para sincronizar os arquivos.');
        return;

    } else {

       $('.gif').prop('hidden',false);
       $.post('reduz_backup.php',{comp_id:$('#comp_id').val()}).done(function (data){

      if(data == "inativo"){

         $('.gif').prop('hidden',true);
         alertify.warning('Usuário inativo. Verifique o cadastro.');
         return;

    } else {

           $('.gif').prop('hidden',true);
           $('#comp_id').val("");
           $('#comp_id').trigger('chosen:updated');
           alertify.success('ARQUIVOS SINCRONIZADOS!');
           return;

            }

       })
   }
}


function reduzir_info(){

    alertify.dialog('alert').set({transition:'zoom',title:'Sincronizar Arquivos',message: 'Esta função apaga do Servidor, os Documentos que foram excluídos da máquina cliente,liberando espaço e deixando cliente e servidor com os mesmos arquivos.'}).show();



}


/********************************************************************************************************************************************/
/************************************ Função de EXecutar backup do Banco de Dados  *****************************************************/

function backup_base_dados(){

      $('.gif').prop('hidden',false);

    $.post('../database/backup_database.php').done(function(data){

      if(data == ''){

        $('.gif').prop('hidden',true);
        alertify.error('Erro ao executar o backup!');
        return;

      } else {

        $('.gif').prop('hidden',true);
        alertify.success('Backup realizado com sucesso!');
        return;

      }


    });
}
/************************************************************* Função de Exportar Base de Dados ***************************************************************/

/************************************ Função de EXecutar backup do Banco de Dados  *****************************************************/

function exporta_base_dados(){

      $('.gif').prop('hidden',false);

    $.post('../database/exportar.php').done(function(data){

      if(data == ''){

        $('.gif').prop('hidden',true);
        alertify.error('Erro ao exportar a base de dados!');
        return;

      } else {

        $('.gif').prop('hidden',true);
        alertify.success('Base exportada com sucesso!');

        var arquivo = JSON.parse(data);
        window.location.href=arquivo;

        return;

      }


    });
}


/********************************************** Funções da tela Restaurar Base de Dados ***********************************************************************/
function restaura_base(){

  if($('#registro_backup_id').val() == ""){

    alertify.warning('Selecione um arquivo de Backup para restaurar!');
    return;

  } else {

    alertify.confirm("A RESTAURAÇÃO SOBRESCREVERÁ SEUS DADOS !","DESEJA CONTINUAR?",function() {

         $('.gif').prop('hidden',false);

        $.post('restore_database.php',{registro_backup_id:$('#registro_backup_id').val()}).done(function(data){

          if (data == ''){

            $('.gif').prop('hidden',true);
            alertify.success('Backup restaurado com sucesso!');
            $('#registro_backup_id').val("");
            $('#registro_backup_id').trigger('chosen:updated');

        } else {

            $('.gif').prop('hidden',true);
            alertify.error('Erro ao restaurar a base de Dados!');
            return;


          }
        })
      },
      function() {
        alertify.warning('Operação cancelada pelo usuário!');
      }
    );
  }
}


function reload(){

window.location.reload();

}

function limpar_rest_bkp(){

$('#registro_backup_id').val("");
$('#registro_backup_id').trigger('chosen:updated');

}
/*************************************** Funções da Tela de Agenda de Backup  *************************************************/
function lista_backup(){

    // Se o checkbox "Não aplicar filtros" estiver desmarcado, o usuário é obrigado a informar o dia e hora que deseja consultar

if($('#filtro').is(':checked') == false){

    if($('#dia_da_semana').val() == "" || $('#hora_backup').val() == ""){

        alertify.warning('Você deve selecionar o dia e a hora para visualizar a agenda de backups, ou marcar a opção * Não aplicar filtros *.');
        return;
    }
}

$.post('retorna_agenda.php',{dia_da_semana:$('#dia_da_semana').val(),hora_backup:$('#hora_backup').val(),filtro:$('#filtro').is(':checked') == true ? '0':'1'}).done(function(data){


    alertify.dialog('alert').set({startMaximized:true, transition:'slide',title:'AGENDA DE BACKUPS',message: data}).show();

});
}


function limpar_agenda_backup(){

$('#dia_da_semana').val("");
$('#dia_da_semana').trigger("chosen:updated");
$('#hora_backup').val("");
$('#hora_backup').trigger("chosen:updated");
$('#filtro').prop('checked',false);

}

function desmarca_checkbox(){

if($('#dia_da_semana') != "" || $('#hora_backup').val() != ""){

    $('#filtro').prop('checked',false);

}
}

function ajusta_filtros(){

if($('#filtro').is(':checked') == true){

    $('#dia_da_semana').val("");
    $('#dia_da_semana').trigger("chosen:updated");
    $('#hora_backup').val("");
    $('#hora_backup').trigger("chosen:updated");

}


}

/********************************************************************************************************************************/

/*************************************** Funções da Tela de Ativar/Desativar Backups  *************************************************/

function sem_filtro(){

if($('#sem_filtro').is(':checked') == true){

    $('#dia_da_semana').val("");
    $('#dia_da_semana').trigger('chosen:updated');
    $('#hora_backup').val("");
    $('#hora_backup').trigger('chosen:updated');


}
}

function desmarca_checkbox_manut(){

if($('#dia_da_semana') != "" || $('#hora_backup').val() != ""){

    $('#sem_filtro').prop('checked',false);
}
}

function limpar_manut_backup(){

$('#dia_da_semana').val("");
$('#dia_da_semana').trigger('chosen:updated');
$('#hora_backup').val("");
$('#hora_backup').trigger('chosen:updated');
$('#sem_filtro').prop('checked',false);

}

function ativa_backup(){
// Se o checkbox "Não aplicar filtros" estiver desmarcado, o usuário é obrigado a informar o dia e hora que deseja consultar

if($('#sem_filtro').is(':checked') == false){

    if($('#dia_da_semana').val() == "" || $('#hora_backup').val() == ""){

        alertify.warning('Você deve selecionar o dia e a hora para ativar os backups ou marcar a opção * Ativar/Desativar todos *.');
        return;
    }
}

$.post('ativa_backup.php',{dia_da_semana:$('#dia_da_semana').val(),hora_backup:$('#hora_backup').val(),sem_filtro:$('#sem_filtro').is(':checked') == true ? '0':'1'}).done(function(data){

if(data == 'sucesso'){

    alertify.success('Backups ativados com sucesso!');
    $('.chosen-select').val("");
    $('.chosen-select').trigger('chosen:updated');
    return;


} else {

    alertify.error('Erro ao ativar os backups');
    return;

}

});



}


function desativa_backup(){
// Se o checkbox "Não aplicar filtros" estiver desmarcado, o usuário é obrigado a informar o dia e hora que deseja consultar

if($('#sem_filtro').is(':checked') == false){

    if($('#dia_da_semana').val() == "" || $('#hora_backup').val() == ""){

        alertify.warning('Você deve selecionar o dia e a hora para ativar os backups ou marcar a opção * Ativar/Desativar todos *.');
        return;
    }
}

$.post('desativa_backup.php',{dia_da_semana:$('#dia_da_semana').val(),hora_backup:$('#hora_backup').val(),sem_filtro:$('#sem_filtro').is(':checked') == true ? '0':'1'}).done(function(data){

if(data == 'sucesso'){

    alertify.success('Backups desativados com sucesso!');
    $('.chosen-select').val("");
    $('.chosen-select').trigger('chosen:updated');
    return;


} else {

    alertify.error('Erro ao desativar os backups');
    return;

}

});
}

/******************************************* Funções da Tela de Cadastro/Manutenção de computadores ****************************/

function marca_dias_semana(){

    if($('#todos_os_dias').is(':checked') == true){

        $('#dia0').prop('checked',true);
        $('#dia1').prop('checked',true);
        $('#dia2').prop('checked',true);
        $('#dia3').prop('checked',true);
        $('#dia4').prop('checked',true);
        $('#dia5').prop('checked',true);
        $('#dia6').prop('checked',true);

    } else {

        $('#dia0').prop('checked',false);
        $('#dia1').prop('checked',false);
        $('#dia2').prop('checked',false);
        $('#dia3').prop('checked',false);
        $('#dia4').prop('checked',false);
        $('#dia5').prop('checked',false);
        $('#dia6').prop('checked',false);

    }
}


/************************************************Funcoes da tela de transferência de arquivos ***********************************/

function transferencia_por_usuario(){

    $('#transferencia_setor').hide();
    $('#transferencia_usuario').show();
    $('#cancelar').prop('disabled',false);
    $('#transferir').prop('disabled',false);

}

function transferencia_por_setor(){

    $('#transferencia_usuario').hide();
    $('#transferencia_setor').show();
    $('#cancelar').prop('disabled',false);
    $('#transferir').prop('disabled',false);

}


function cancelar_transferencia_arquivos(){

    $('#transferencia_arquivos_usuario').prop('checked',false);
    $('#transferencia_arquivos_setor').prop('checked',false);
    $('#cancelar').prop('disabled',true);
    $('#transferir').prop('disabled',true);
    $('#comp_id').val("");
    $('#comp_id').selectpicker('refresh');
    $('#servidor_id').val("");
    $('#servidor_id').selectpicker('refresh');
    $('#servidor_atual').val("");
    $('#setor_id').val("");
    $('#setor_id').selectpicker('refresh');
    $('#servidor_id2').val("");
    $('#servidor_id2').selectpicker('refresh');
    $('#transferencia_usuario').hide();
    $('#transferencia_setor').hide();

}

function retorna_usuario_selecionado(){

    $.post('retorna_servidor_atual.php',{comp_id:$('#comp_id').val()}).done(function(data){

    data = JSON.parse(data);

    $('#servidor_atual').val(data.servidor_atual);

    });
}

function transfere_arquivo(){

    var selecione_usuario = "<div class='alert alert-info alert-dismissible'><center><strong>ATENÇÃO!</strong> Selecione um usuário para realizar a transferência de arquivos.<button class='close' data-dismiss='modal'>&times</button></center></div>";
    var selecione_servidor_destino = "<div class='alert alert-info alert-dismissible'><center><strong>ATENÇÃO!</strong> Selecione o Servidor de Destino para realizar a transferência de arquivos.<button class='close' data-dismiss='modal'>&times</button></center></div>";
    var servidor_igual = "<div class='alert alert-danger alert-dismissible'><center><strong>ATENÇÃO!</strong> O Servidor de Destino não pode ser igual ao Servidor Atual.<button class='close' data-dismiss='modal'>&times</button></center></div>";
    var sucesso = "<div class='alert alert-success alert-dismissible'><center><strong>MUITO BOM!</strong> Arquivos transferidos com sucesso!!.<button class='close' data-dismiss='modal'>&times</button></center></div>";
    var erro = "<div class='alert alert-danger alert-dismissible'><center><strong>OPS!</strong> Erro a realizar a transferência. Tente novamente,se o erro persistir, contacte o administrador do sistema!<button class='close' data-dismiss='modal'>&times</button></center></div>";

    if($('#comp_id').val() == ""){

        $('#alert').html(selecione_usuario);
        $('#modal').modal('show');
        return;

    } else if($('#servidor_id').val() == ""){

        $('#alert').html(selecione_servidor_destino);
        $('#modal').modal('show');
        return;

    } else {

        $.post('retorna_info_transferencia.php',{comp_id:$('#comp_id').val(),servidor_id:$('#servidor_id').val()}).done(function(data){

            data = JSON.parse(data);

            var usuario= data.nome_usuario;
            var srv_orig = data.srv_orig;
            var srv_dest = data.srv_dest;



        $.confirm({
        title: "CONFIRMA A TRANSFERÊNCIA DE ARQUIVOS?",
        text: "<b>USUÁRIO:</b>" + usuario +"<br><b>SERVIDOR ORIGEM:</b>" + srv_orig + "<br><b>SERVIDOR DESTINO:</b>" + srv_dest ,
        confirmButton: "TRANSFERIR",
        cancelButton: "CANCELAR",
        confirm: function() {


        $('#gif').show();
        $.post('transfere_arquivos.php',{comp_id:$('#comp_id').val(),servidor_id:$('#servidor_id').val()}).done(function(data){

         if(data == "servidor_igual"){

            $('#gif').hide();
            $('#alert').html(servidor_igual);
            $('#modal').modal('show');
            return;

        } else if(data == "sucesso"){

            $('#gif').hide();
            $('#transferencia_arquivos_usuario').prop('checked',false);
            $('#transferencia_arquivos_setor').prop('checked',false);
            $('#cancelar').prop('disabled',true);
            $('#transferir').prop('disabled',true);
            $('#comp_id').val("");
            $('#comp_id').selectpicker('refresh');
            $('#servidor_id').val("");
            $('#servidor_id').selectpicker('refresh');
            $('#servidor_atual').val("");
            $('#setor_id').val("");
            $('#setor_id').selectpicker('refresh');
            $('#servidor_id2').val("");
            $('#servidor_id2').selectpicker('refresh');
            $('#transferencia_usuario').hide();
            $('#transferencia_setor').hide();
            $('#alert').html(sucesso);
            $('#modal').modal('show');

            return;
        } else {


            $('#gif').hide();
            $('#alert').html(erro);
            $('#modal').modal('show');
            return;
        }
        });
        },
        cancel: function() {

        }
    });

    });

    }


}
/*******************************************Funcoes da Tela de restaurar arquivos ***************************************************/
function retorna_rest_arquivos(){



}

function limpar_rest_bkp_usu(){

$('#comp_id').val("");
$('#comp_id').selectpicker('refresh');

}


/*************************************************************************************************************************************/

function verifica_plat_servidor_bkp(){

if($('#servidor_plataforma').val() == "Linux"){

    $('#inst_sshpass').show(250);

} else {

    $('#inst_sshpass').hide();
}

}
/******************************************************************************************************************************************************/
function retorna_info_home(){
  $.post('retorna_info_home.php').done(function(data){

    data = JSON.parse(data);
    $('#info_pc').html(data.info_pc);
    $('#info_so').html(data.info_so);
    $('#info_setor').html(data.info_setor);
    $('#info_smtp').html(data.info_smtp);
    $('#info_diretorios').html(data.info_diretorios);
    $('#info_usuarios').html(data.info_usuarios);
    $('#bkp_falha').html(data.bkp_falha);
    $('#bkp_sucesso').html(data.bkp_sucesso);
    $('#srv_bkp').html(data.srv_bkp);



  })
}
