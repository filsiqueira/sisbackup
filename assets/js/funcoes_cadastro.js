/*********************     Funções da tela de cadastro de Sistema Operacional       ***********************************************************/
// Função cadastrar sistema operacional

function cadastrar_so() {

if ($('#nome_so').val() == "" || $('#plataforma').val() == "") {

	alertify.error('Preencha todos os campos');
	return;

	} else {
		$('#cad_so').attr('disabled',true);
		$.post('cadastrar_sistema_operacional.php', { nome_so: $('#nome_so').val(), plataforma: $('#plataforma').val() }, function (data) {

			if (data == 'ja_existe_so') {

				alertify.warning('Já existe um sistema operacional cadastrado com este nome!');
				return;

			} else if (data == 'erro_ao_cadastrar') {

				alertify.error('Erro ao cadastrar o sistema operacional!');
				return;

			} else if (data == 'cadastro_realizado_com_sucesso') {

				alertify.success('Cadastro realizado com sucesso!');
				$('#cad_so').attr('disabled',false);
				$('#nome_so').val("");
				$('#plataforma').val("");
				$('#plataforma').trigger("chosen:updated");

// Verificando se já existem documento cadastrado na base de dados. Se existir,é exibido uma mensagem para o usuario configurar o diretorio dos documentos neste novo SO
		setTimeout(function () {

				$.post('consulta_doc.php').done(function(data){

					if(data == 'true'){

						alertify.warning('Associe os diretórios cadastrados à este novo Sistema Operacinal');

					} else {

					}

				});
		}, 1000);

			}

		});
	}
}

// Função Limpar dados do formulario

function limpar_so() {

	$('#nome_so').val("");
	$('#plataforma').val("");
	$('#plataforma').selectpicker('refresh');
}

/*********************************************************************************************************************************************/


/*********************     Funções da tela de cadastro de Documentos     *********************************************************************/

// Funcao Limpar

function limpar() {

	$('#nome_documento').val("");
	$('#sos').val("");

}

// Funcao cadastrar documentos
function cadastrar_documento() {
	// Verificando se já existem sistemas operacionais cadastrados (só é possível cadastrar documento se já existir Sistema Operacional Cadastrado)

	$.post('verifica_so.php').done(function(data){

	if(data == 'nao_existe_so_cadastrado'){

		alertify.warning('Antes de configurar documentos você deve cadastrar os SISTEMAS OPERACIONAIS. Acesse : * Sistemas Operacionais > Cadastrar *');
		return;
	}
	});

	// Verificando se o campo nome do documento foi preenchido
	if ($('#nome_documento').val() == "") {

		alertify.error('Informe o nome do Diretório!');
		return;

	} else {
		// Pegando os valores dos inputs pela classe

		var sos = $(".so");
		var contSos = 0;
		var diretorios = [];
		// Percorrendo o array
		$.each(sos, function (index, value) {
			if ($(this).val() != "") {
				contSos++;
				diretorios.push({
					id_so: $(this).attr('data-id'),
					diretorio: $(this).val()
				})
			}
		});

		if (contSos == 0) {

			alertify.error('Informe o caminho em pelo menos 1 sistema operacional!');
			return;

		}
		// Enviando via post
		$.post('cadastrar_documento.php', { nome_documento: $('#nome_documento').val(), diretorios: diretorios }, function (data) {

			if (data == 'cadastro_realizado_com_sucesso') {

				alertify.success('Cadastro realizado com sucesso!');
				$('#nome_documento').val("");
				$('.so').val("");

			} else {

				alertify.error('Erro ao realizar o cadastro!');
				return;

			}
		});
	}
}

// Funcao limpar

function limpar_doc() {

	$('#nome_documento').val("");
	$('.so').val("");


}
/*******************************************************************************************************************************************/

/*********************     Funções da tela de cadastro de Usuários     *********************************************************************/

// Função para cadastrar usuários

function cadastrar_usuario() {

	if ($('#nome_usuario').val() == "" || $('#login').val() == "" || $('#setor').val() == "" || $('#usuario_email').val() == "" || $('#senha').val() == ""
	|| $('#confirma_senha').val() == "" || $('#status').val() == "") {
		alertify.error('Preencha todos os campos!');
		return;

	} else if ($('#senha').val() != $('#confirma_senha').val()) {

		alertify.warning('As senhas não correspondem! Tente novamente.');
		return;

	} else {
		$('#cadastrar_usuario').attr('disabled',true);
		//Enviando os dados para o servidor
		$.post('cadastrar_usuario.php', { nome_usuario: $('#nome_usuario').val(), login: $('#login').val(), setor: $('#setor').val(), senha: $('#senha').val(), usuario_email: $('#usuario_email').val(), status: $('#status').val() }, function (data) {

			if (data == 'ja_existe_login') {
				$('#alert').html(ja_existe_login);
				$('#modal').modal('show');
				return;

			} else if (data == 'cadastro_realizado_com_sucesso') {
				$('#cadastrar_usuario').attr('disabled',false);
				alertify.success('Cadastro realizado com sucesso!');
				$('#nome_usuario').val("");
				$('#login').val("");
				$('#setor').val("");
				$('#setor').trigger("chosen:updated");
				$('#senha').val("");
				$('#confirma_senha').val("");
				$('#status').val("");
				$('#status').trigger("chosen:updated");

				$('#usuario_email').val("");
				return;

			} else {
				$('#alterar_usuario').attr('disabled',false);
				alertify.error('Erro ao realizar o cadastro!');
				return;
			}
		});
	}
}
// Funcao limpar formulario

function limpar_usu() {

	$('#nome_usuario').val("");
	$('#login').val("");
	$('#setor').val("");
	$('#setor').selectpicker('refresh');
	$('#senha').val("");
	$('#confirma_senha').val("");
	$('#usuario_email').val("");
	$('#status').val("");
	$('#status').selectpicker('refresh');


}
/********************************************************************************************************************************************/

/*********************     Funções da tela de cadastro de Setor     *************************************************************************/

// Funcao para limpar o formulario

function limpar_setor() {
	$('#nome_setor').val("");
	$('#descricao_setor').val("")
}

// Funcao cadastrar setor

function cadastrar_setor() {

	if ($('#nome_setor').val() == "" || $('#descricao_setor').val() == "") {

		alertify.warning('Informe o nome do setor e uma descrição');
		return;

	} else {

		$.post('cadastrar_setor.php', { nome_setor: $('#setor_nome').val(), descricao_setor: $('#descricao_setor').val() }, function (data) {

			if (data == 'ja_existe_setor') {

				alertify.warning('Já existe um setor cadastrado com este nome!');
				return;

			} else if (data == 'cadastro_realizado_com_sucesso') {

				alertify.success('Cadastro realizado com sucesso!');
				$('#setor_nome').val("");
				$('#descricao_setor').val("");

			} else {

				alertify.error('Erro ao realizar o cadastro!');
				return;

			}

		})
	}
}
/********************************************************************************************************************************************/
/**************************************Funções da tela de cadastro de Computadores **********************************************************/

function busca_computador(){

$.post('busca_computador.php').done(function(data){

$('#comp_id').html(data);

});

}


// Função para cadastrar o computador

function cadastrar_computador() {

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


		$.post('cadastrar_computador.php', {
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

			if (data == 'cadastro_realizado_com_sucesso') {

				alertify.success('Cadastro realizado com sucesso!');
				$('.form-control').val("");
				$('.chosen-select').trigger("chosen:updated");
				$('.checkbox').prop('checked',false);
				busca_computador();


				return;

			} else {

				alertify.error('Erro ao realizar o cadastro!');
				return;
			}
		});

	});

	}
}

// Função Limpar
function limpar_comp() {

	$('#comp_id').val("");
	$('#comp_nome_usuario').val("");
	$('#comp_login').val("");
	$('#comp_senha').val("");
	$('#comp_usuario_adm').val("");
	$('#comp_ip').val("");
	$('#comp_mac').val("");
	$('#sistema_operacional_id').val("");
	$('#sistema_operacional_id').selectpicker('refresh');
	$('#comp_hora_backup').val("");
	$('#comp_hora_backup').selectpicker('refresh');
	$('#comp_servidor_backup').val("");
	$('#comp_servidor_backup').selectpicker('refresh');
	$('#comp_liga_computador').val("");
	$('#comp_liga_computador').selectpicker('refresh');
	$('#comp_desliga_computador').val("");
	$('#comp_desliga_computador').selectpicker('refresh');
	$('#comp_setor').val("");
	$('#comp_setor').selectpicker('refresh');
	$('#todos_os_dias').prop("checked", false);
	$('#dia0').prop("checked", false);
	$('#dia1').prop("checked", false);
	$('#dia2').prop("checked", false);
	$('#dia3').prop("checked", false);
	$('#dia4').prop("checked", false);
	$('#dia5').prop("checked", false);
	$('#dia6').prop("checked", false);
	$('#documento_id').val("");
	$('#documento_id').selectpicker('refresh');
	$('#extensao_arquivo_id').val("");
	$('#extensao_arquivo_id').selectpicker('refresh');
	$('#comp_backup_ativo').val("");
	$('#comp_backup_ativo').selectpicker('refresh');
	$('#servidor_id').val("");
	$('#servidor_id').selectpicker('refresh');


}


// Funcao Copiar cadastro de computador

function copiar_computador(){

	$('#comp_id').val("");
	$('#alert2').html(pesquisar_cadastro_comp);
	$('#modal2').modal('show');
	$('#pesquisar_cadastro_comp').show();

}






/*************************************************************************************************************************************************/
/************************************* Funcoes da Tela de Associar Documentos/Computador ****************************************************/

function associar_documento() {

	var selecione_usuario = "<div class='alert alert-info alert-dismissible'><center><strong> ATENÇÃO !</strong> Selecione o usuario.<button class='close' data-dismiss='modal'>&times</button></center></div>";
	var selecione_documento = "<div class='alert alert-info alert-dismissible'><center><strong> ATENÇÃO !</strong> Selecione os documentos para associar com este computador.<button class='close' data-dismiss='modal'>&times</button></center></div>";
	var erro_ao_associar = "<div class='alert alert-danger alert-dismissible'><center><strong> OPS !</strong> Erro ao associar os documentos ao cadastro. Entre em contato com o Administrador do Sistema <button class='close' data-dismiss='modal'>&times</button></center></div>";
	var associacao_realizada_com_sucesso = "<div class='alert alert-success alert-dismissible'><center><strong> MUITO BOM !</strong> Associação realizada com sucesso.<button class='close' data-dismiss='modal'>&times</button></center></div>";

	if ($('#comp_id').val() == "") {

		$('#alert').html(selecione_usuario);
		$('#modal').modal('show');
		return;

	} else if ($('#documento_id').val() == "") {

		$('#alert').html(selecione_documento);
		$('#modal').modal('show');
		return;
	} else {

		$.post('associar_documento.php', { comp_id: $('#comp_id').val(), documento_id: $('#documento_id').val() }, function (data) {

			if (data == 'associacao_realizada_com_sucesso') {

				$('#alert').html(associacao_realizada_com_sucesso);
				$('#modal').modal('show');
				$('#comp_id').val("");
				$('#documento_id').val("");

			} else {

				$('#alert').html(erro_ao_associar);
				$('#modal').modal('show');
				return;
			}

		});
	}
}

// Funcao Limpar

function limpar_doc() {

	$('#comp_id').val("");
	$('#documento_id').val("");

}

/************************************************* Funcao da Tela de Cadastro de SMTP*********************************************************/

function cadastrar_smtp() {

		if ($('#smtp_nome').val() == "" || $('#smtp_email_admin').val() == "" || $('#smtp_porta').val() == "" || $('#smtp_endereco').val() == "" || $('#smtp_senha').val() == ""
	|| $('#smtp_confirma_senha').val() == "") {

		alertify.error('Preencha todos os campos!');
		return;

	} else if ($('#smtp_confirma_senha').val() != $('#smtp_senha').val()) {
		alertify.warning('As senhas não conferem!');
		return;

	} else {
			$('#cad_smtp').attr('disabled',true);
		$.post('cadastrar_smtp.php', { smtp_nome: $('#smtp_nome').val(), smtp_email_admin: $('#smtp_email_admin').val(), smtp_porta: $('#smtp_porta').val(), smtp_endereco: $('#smtp_endereco').val(), smtp_senha: $('#smtp_senha').val() }).done(function (data) {

			if (data == "true") {

				alertify.success('Cadastro realizado com sucesso!');
				$('#smtp_nome').val("");
				$('#smtp_email_admin').val("");
				$('#smtp_porta').val("");
				$('#smtp_porta').trigger("chosen:updated");
				$('#smtp_endereco').val("");
				$('#smtp_senha').val("");
				$('#smtp_confirma_senha').val("");


			} else {
				alertify.error('Erro ao realizar o cadastro!');
				return;
			}
		});
	}
}



/************************************************* Funções da Tela de Cadastro de Servidores de Backup *********************************************/
function cadastrar_servidor() {

	if ($('#servidor_nome').val() == "" || $('#servidor_ip').val() == "" || $('#servidor_plataforma').val() == "" || $('#servidor_user_privilegio').val() == "" || $('#servidor_senha_acesso').val() == ""
	||$('#servidor_nome_compartilhamento').val() == "" || $('#servidor_plataforma').val() == "") {

		alertify.error('Preencha todos os campos!');
		return;

	}  else {

		$('#cad_servidor').attr('disabled', true);
		$('#cancelar').attr('disabled', true);


		$.post('cadastrar_servidor.php', { servidor_nome: $('#servidor_nome').val(), servidor_ip: $('#servidor_ip').val(), servidor_plataforma: $('#servidor_plataforma').val(), servidor_user_privilegio: $('#servidor_user_privilegio').val(), servidor_senha_acesso: $('#servidor_senha_acesso').val(), servidor_nome_compartilhamento: $('#servidor_nome_compartilhamento').val(), servidor_plataforma: $('#servidor_plataforma').val() }).done(function (data) {


			if (data == "ja_existe") {
				alertify.error('Já existe este servidor cadastrado em nossa Base de Dados');
				$('#cad_servidor').attr('disabled', false);
				$('#cancelar').attr('disabled', false);
				return;

			} else if (data == "true") {

				$('#cad_servidor').attr('disabled', false);
				$('#cancelar').attr('disabled', false);
				alertify.success('Cadastro realizado com sucesso!');
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
				alertify.error('Erro ao realizar o cadastro!');
				return;
			}
		});
	}
}

function recarrega_servidor() {

	window.location.href = "servidores.php";
}
