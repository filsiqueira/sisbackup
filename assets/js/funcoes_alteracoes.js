/**************************************Funções da tela de Alteracao de Computadores **********************************************************/

function busca_computador(){

$.post('busca_computador.php').done(function(data){

$('#comp_id').html(data);

});

}

// Função Buscar da tela Manutenção de computador

function buscar_computador(){

	$('#comp_id').val("");
	$('#alert2').html(comp_id);
	$('#modal2').modal('show');

}
// Função para alterar o computador

function altera_computador(){
	if ($('#comp_nome_usuario').val() == "" || $('#comp_login').val() == "" || $('#comp_email').val() == "" || $('#comp_senha').val() == "" || $('#comp_ip').val() == "" || $('#comp_mac').val() == "" || $('#sistema_operacional_id').val() == "" || $('#comp_hora_backup').val() == "" || $('#servidor_id').val() == "" || $('#comp_liga_computador').val() == "" || $('#comp_desliga_computador').val() == "" || $('#comp_setor').val() == "" || $('#documento_id').val() == "" || $('#comp_usuario_adm').val() == "" || $('#comp_backup_ativo').val() == "" || $('#extensao_arquivo_id').val() == "") {

		alertify.error('Preencha todos os campos!');
		return;

	} else if ($('#dia0').is(':checked') == false && $('#dia1').is(':checked') == false && $('#dia2').is(':checked') == false && $('#dia3').is(':checked') == false
	&& $('#dia4').is(':checked') == false && $('#dia5').is(':checked') == false && $('#dia6').is(':checked') == false) {

		alertify.error('Informe pelo menos um dia para ser feito backup deste computador');
		return;

	} else {

/*************************************************************************************************************************************/
	// LICENCIAMENTO DE ESTACOES - 30 LICENCAS

	var total_licencas = 500;
	var b = (total_licencas/100) * 80;
	var licencas_restantes = 0;


		$.post('verifica_licenca.php').done(function(a){

			if(a >= total_licencas){


				swal("Atenção!","Seu limite  de "+ total_licencas +" cadastros já foi atingido! Entre em contato com o suporte para adquirir um novo licenciamento","error");
				return;


			} else if (a >= b && a < total_licencas) {

				ab = parseInt(a) + parseInt(1) ;
				licencas_restantes = total_licencas - ab;

				swal("Atenção!","Seu limite  de " + total_licencas + " cadastros já está se esgotando! Você possui ainda "+ licencas_restantes+" licenças. Entre em contato com o suporte para adquirir um novo licenciamento","warning");
			}


/****************************************************************************************************************************************/


		$.post('alterar_computador.php', {
			comp_id:$('#comp_id').val(),
			comp_nome_usuario: $('#comp_nome_usuario').val(),
			comp_login: $('#comp_login').val(),
			comp_email: $('#comp_email').val(),
			comp_senha: $('#comp_senha').val(),
			comp_ip: $('#comp_ip').val(),
			comp_mac: $('#comp_mac').val(),
			sistema_operacional_id: $('#sistema_operacional_id').val(),
			dia0: $('#dia0').is(':checked') == true ? '0' : '1',
			dia1: $('#dia1').is(':checked') == true ? '0' : '1',
			dia2: $('#dia2').is(':checked') == true ? '0' : '1',
			dia3: $('#dia3').is(':checked') == true ? '0' : '1',
			dia4: $('#dia4').is(':checked') == true ? '0' : '1',
			dia5: $('#dia5').is(':checked') == true ? '0' : '1',
			dia6: $('#dia6').is(':checked') == true ? '0' : '1',
			comp_hora_backup: $('#comp_hora_backup').val(),
			comp_servidor_backup: $('#servidor_id').val(),
			comp_liga_computador: $('#comp_liga_computador').val(),
			comp_desliga_computador: $('#comp_desliga_computador').val(),
			comp_setor: $('#comp_setor').val(),
			documento_id: $('#documento_id').val(),
			extensao_arquivo_id:$('#extensao_arquivo_id').val(),
			comp_usuario_adm: $('#comp_usuario_adm').val(),
			comp_backup_ativo: $('#comp_backup_ativo').val()



		}, function (data) {

			if (data == 'numero_maximo_licenca_atingido'){

				swal("Atenção!","Seu limite  de "+ total_licencas +" cadastros já foi atingido! Entre em contato com o suporte para adquirir um novo licenciamento","error");
				return;


			}

			if (data == 'cadastro_alterado_com_sucesso') {

				alertify.success('Cadastro alterado com sucesso!');
				$('.form-control').val("");
				$('.chosen-select').trigger("chosen:updated");
				$('.checkbox').prop('checked',false);
				busca_computador();


				return;

			} else {

				alertify.error('Erro ao alterar o cadastro!');
				return;
			}
		});

	});

	}
}




/*************************************************************************************************************************************************/
/**************************************Funções da tela de Alteracao de Usuarios **********************************************************/

function busca_usuario(){

$.post('busca_usuario.php').done(function(data){

$('#usuario_id').html(data);
$('#usuario_id').selectpicker('refresh');

});

}


function alterar_usuario(){


		if ($('#nome_usuario').val() == "" || $('#login').val() == "" || $('#setor').val() == "" || $('#usuario_email').val() == "" || $('#senha').val() == ""
		|| $('#confirma_senha').val() == "" || $('#status').val() == "") {
			alertify.error('Preencha todos os campos!');
			return;

		} else if ($('#senha').val() != $('#confirma_senha').val()) {

			alertify.warning('As senhas não correspondem! Tente novamente.');
			return;

		} else {
			$('#alterar_usuario').attr('disabled',true);
			//Enviando os dados para o servidor
			$.post('altera_usuario.php', { usuario_id:$('#usuario_id').val(),usuario_nome: $('#nome_usuario').val(),usuario_id_setor: $('#setor_id').val(), usuario_email: $('#usuario_email').val(), usuario_status: $('#status').val() }, function (data) {

				if (data == 'ja_existe_login') {
					alertify.error('Já existe um usuário com este login!');
					return;

				} else if (data == 'cadastro_alterado_com_sucesso') {
					$('#alterar_usuario').attr('disabled',false);
					alertify.success('Cadastro alterado com sucesso!');
					$('#nome_usuario').val("");
					$('#login').val("");
					$('#setor_id').val("");
					$('#setor_id').trigger("chosen:updated");
					$('#status').val("");
					$('#status').trigger("chosen:updated");
					$('#usuario_email').val("");
					return;

				} else {
					$('#alterar_usuario').attr('disabled',false);
					alertify.error('Erro ao alterar o cadastro!');
					return;
				}
			});
		}


}

// Funcao Limpar


function limpar_usu(){

	$('#usuario_id').val("");
	$('#usuario_id').selectpicker('refresh');
	$('#usuario_nome').val("");
	$('#usuario_login').val("");
	$('#usuario_status').val("");
	$('#usuario_status').selectpicker('refresh');
	$('#usuario_id_setor').val("");
	$('#usuario_id_setor').selectpicker('refresh');
	$('#usuario_email').val("");

}

/*******************************************************************************************************************************************/
/************************************************** Funcoes da tela de alteracao de senha **************************************************/




function altera_senha(){


	if($('#usuario_id').val() == ""){

		alertify.warning('Selecione um cadastro para alterar a senha!');
		return;

	} else if ($('#usuario_senha').val() == "" || $('#usuario_confirma_senha').val() == ""){

		alertify.warning('Preencha a senha e confirme!');
		return;

	} else if ($('#usuario_confirma_senha').val() != $('#usuario_senha').val()){

		alertify.error('As senhas não conferem! Tente novamente');
		return;

	} else {

		$.post('altera_senha.php',{usuario_id:$('#usuario_id').val(),usuario_senha:$('#usuario_senha').val()},function(data){

			if(data == 'cadastro_alterado_com_sucesso'){

				alertify.success('Senha alterada com sucesso!');
				$('#usuario_id').val("");
				$('#usuario_id').trigger('chosen:updated');
				$('#usuario_senha').val("");
				$('#usuario_confirma_senha').val("");
				return;


			}
		});
	}
}

//Funcao Limpar Tela
function limpar_alt_senha(){

	$('#usuario_id').val("");
	$('#usuario_id').trigger('chosen:updated');
	$('#usuario_senha').val("");
	$('#usuario_confirma_senha').val("");


}

/*******************************************************************************************************************************************/
/************************************************** Funcoes da tela de alteracao de Setores **************************************************/

function busca_setor(){

$.post('busca_setor.php').done(function(data){

$('#setor_id').html(data);
$('#setor_id').selectpicker('refresh');

});

}


function alterar_setor(){

if ($('#setor_nome').val() == "" || $('#descricao_setor').val() == ""){

		alertify.warning('Preencha o nome do setor e uma descrição!');
		return;

	} else {

		$.post('altera_setor.php',{setor_id:$('#setor_id').val(),setor_nome:$('#setor_nome').val(),descricao_setor:$('#descricao_setor').val()}).done(function(data){

			if(data == 'cadastro_alterado_com_sucesso'){

				alertify.success('Cadastro alterado com sucesso!');
				$('#setor_nome').val("");
				$('#descricao_setor').val("");
			} else {
				alertify.error('Erroi ao alterar o cadastro!');
				return;
			}
		});
	}
}

// Funcao Limpar

function limpar_setor(){

	$('#setor_id').val("");
	$('#setor_id').selectpicker('refresh');
	$('#setor_nome').val("");
	$('#descricao_setor').val("");
}

// Funcao Recarregar
function recarregar_alt_setor(){

	window.location.reload();
}


/*******************************************************************************************************************************************/
/************************************************** Funcoes da tela de alteracao de Sistemas Operacionais **********************************/

//Funcao para alterar cadastro de sistema operacional


function busca_so(){

$.post('busca_so.php').done(function(data){

$('#sistema_operacional_id').html(data);
$('#sistema_operacional_id').selectpicker('refresh');

});

}

function retorna_doc_a_partir_do_so(){

$.post('retorna_doc_a_partir_do_so.php',{sistema_operacional_id:$('#sistema_operacional_id').val()}).done(function(data){


	$('#documento_id').html(data);
	$('#documento_id').trigger("chosen:updated");

});

}

function retorna_doc_a_partir_do_so2(){

	$.post('retorna_doc_a_partir_do_so.php',{sistema_operacional_id:$('#sistema_operacional_id').val()}).done(function(data){


		$('#documento_id').html(data);
		$('#documento_id').trigger("chosen:updated");
		alertify.warning("Ao alterar o Sistema Operacional do usuário, você deve ajustar os diretórios que devem ser copiados!");

	});

	}

function alterar_so(){

		if ($('#nome_so').val() == "" || $('#plataforma').val() == "") {

			alertify.error('Preencha todos os campos');
			return;

			} else {

		$.post('altera_so.php',{sistema_operacional_id:$('#sistema_operacional_id').val(),sistema_operacional_nome:$('#nome_so').val(),sistema_operacional_plataforma:$('#plataforma').val()}).done(function(data){

			if(data == 'cadastro_alterado_com_sucesso'){

				alertify.success('Cadastro alterado com sucesso!');
				$('#nome_so').val("");
				$('#plataforma').val("");
				$('#plataforma').trigger("chosen:updated");
				return;

			}	else if (data == 'ja_existe_so') {

				alertify.warning('Já existe um sistema operacional cadastrado com este nome!');
				return;

			} else {

				alertify.error('Erro ao alterar o cadastro!');
				$('#modal').modal('show');
				return;
			}
		});
	}
}

//Funcao limpar
function limpar_so(){

	$('#sistema_operacional_id').val("");
	$('#sistema_operacional_id').selectpicker('refresh');
	$('#sistema_operacional_nome').val("");
	$('#sistema_operacional_plataforma').val("");
	$('#sistema_operacional_plataforma').selectpicker('refresh');

}


/*******************************************************************************************************************************************/
/************************************************ Funcoes da Tela MAnutencao de Documentos *************************************************/

function busca_diretorio(){

$.post('busca_diretorio.php').done(function(data){

$('#documento_id').html(data);
$('#documento_id').selectpicker('refresh');

});

}



function alterar_documento(){

 if ($('#nome_documento').val() == ""){

	 			alertify.error('Informe o nome do Diretório!');
      	return;

      } else {

      // Pegando os valores dos inputs pela classe

      var sos = $(".so");
      var contSos = 0;
      var diretorios = [];
      // Percorrendo o array
      $.each(sos,function(index,value){
      	if ($(this).val() != ""){
      		contSos ++;
      		diretorios.push({
      			id_so:$(this).attr('data-id'),
      			diretorio: $(this).val()
      		})
      	}
      });

      if (contSos == 0){

				alertify.error('Informe o diretório em pelo menos um Sistema Operacional');
      	return;

      }
      // Enviando via post
      $.post('alterar_documento.php',{documento_id:$('#documento_id').val(),documento_nome: $('#nome_documento').val(),diretorios: diretorios},function(data){

      	if (data =='true'){

					alertify.success('Cadastro alterado com sucesso!');
      		$('#nome_documento').val("");
      		$('.so').val("");

      	} else {

					alertify.error('Erro ao alterar o cadastro!');
      		return;

      	}
      });
  }

}


//Funcao Limpar
function limpar_doc(){

	$('#documento_id').val("");
	$('#documento_id').selectpicker('refresh');
	$('#documento_nome').val("");
	$('.so').val("");
}

/************************************************* Funcao da Tela de Alteração de SMTP*********************************************************/

function alterar_smtp(){

	if ($('#smtp_nome').val() == "" || $('#smtp_email_admin').val() == "" || $('#smtp_porta').val() == "" || $('#smtp_endereco').val() == "" || $('#smtp_senha').val() == ""
|| $('#smtp_confirma_senha').val() == "") {

	alertify.error('Preencha todos os campos!');
	return;

} else if ($('#smtp_confirma_senha').val() != $('#smtp_senha').val()) {
	alertify.warning('As senhas não conferem!');
	return;

} else {

	$.post('altera_smtp.php', { smtp_id:$('#smtp_id').val(),smtp_nome: $('#smtp_nome').val(), smtp_email_admin: $('#smtp_email_admin').val(), smtp_porta: $('#smtp_porta').val(), smtp_endereco: $('#smtp_endereco').val(), smtp_senha: $('#smtp_senha').val() }).done(function (data) {

		if (data == "true") {

			alertify.success('Cadastro alterado com sucesso!');
			$('#smtp_nome').val("");
			$('#smtp_email_admin').val("");
			$('#smtp_porta').val("");
			$('#smtp_porta').trigger("chosen:updated");
			$('#smtp_endereco').val("");
			$('#smtp_senha').val("");
			$('#smtp_confirma_senha').val("");


		} else {
			alertify.error('Erro ao alterar o cadastro!');
			return;
		}
	});
}
}

/***********************************************************Funções da Tela de Alteração de Servidor de Backup ****************************************/
function alterar_servidor(){

	if ($('#servidor_nome').val() == "" || $('#servidor_ip').val() == "" || $('#servidor_plataforma').val() == "" || $('#servidor_user_privilegio').val() == "" || $('#servidor_senha_acesso').val() == ""
	||$('#servidor_nome_compartilhamento').val() == "" || $('#servidor_plataforma').val() == "") {

		alertify.error('Preencha todos os campos!');
		return;

	}  else {

		$('#alt_servidor').attr('disabled', true);
		$('#cancelar').attr('disabled', true);


		$.post('altera_servidor.php', {servidor_id:$('#servidor_id').val(),servidor_nome: $('#servidor_nome').val(), servidor_ip: $('#servidor_ip').val(), servidor_plataforma: $('#servidor_plataforma').val(), servidor_user_privilegio: $('#servidor_user_privilegio').val(), servidor_senha_acesso: $('#servidor_senha_acesso').val(), servidor_nome_compartilhamento: $('#servidor_nome_compartilhamento').val(), servidor_plataforma: $('#servidor_plataforma').val() }).done(function (data) {


			if (data == "ja_existe") {
				alertify.error('Já existe este servidor cadastrado em nossa Base de Dados');
				$('#alt_servidor').attr('disabled', false);
				$('#cancelar').attr('disabled', false);
				return;

			} else if (data == "true") {

				$('#alt_servidor').attr('disabled', false);
				$('#cancelar').attr('disabled', false);
				alertify.success('Cadastro alterar com sucesso!');
				$('#servidor_nome').val("");
				$('#servidor_ip').val("");
				$('#servidor_plataforma').val("");
				$('#servidor_plataforma').trigger("chosen:updated");
				$('#servidor_user_privilegio').val("");
				$('#servidor_senha_acesso').val("");
				$('#servidor_nome_compartilhamento').val("");
				$('#servidor_nome_plataforma').val("");
				return;

			} else {
				$('#alt_servidor').attr('disabled', false);
				$('#cancelar').attr('disabled', false);
				alertify.error('Erro ao alterar o cadastro!');
				return;
			}
		});
	}
}

function recarrega_servidor(){

    window.location.href="servidores.php";
}
