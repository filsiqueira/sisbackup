/******************************************************************************************************************************************************/

// Funcao para retornar cadastro de computador

function retorna_computador(comp_id){

		$('#todos_os_dias').prop('checked',false);
		$('#dia0').prop('checked',false);
		$('#dia1').prop('checked',false);
		$('#dia2').prop('checked',false);
		$('#dia3').prop('checked',false);
		$('#dia4').prop('checked',false);
		$('#dia5').prop('checked',false);
		$('#dia6').prop('checked',false);



	$.post('retorna_computador.php',{comp_id}).done(function(data){data = JSON.parse(data);

		$('#comp_nome_usuario').val(data.comp_nome_usuario);
		$('#comp_login').val(data.comp_login);
		$('#comp_email').val(data.comp_email);
		$('#comp_senha').val(data.comp_senha);
		$('#comp_ip').val(data.comp_ip);
		$('#comp_mac').val(data.comp_mac);
		$('#sistema_operacional_id').val(data.comp_sistema_operacional);
		$('#dia0').val(data.dia0);
		$('#dia1').val(data.dia1);
		$('#dia2').val(data.dia2);
		$('#dia3').val(data.dia3);
		$('#dia4').val(data.dia4);
		$('#dia5').val(data.dia5);
		$('#dia6').val(data.dia6);
		$('#comp_hora_backup').val(data.comp_hora_backup);
		$('#servidor_id').val(data.comp_servidor_backup);
		$('#comp_liga_computador').val(data.comp_liga_computador);
		$('#comp_desliga_computador').val(data.comp_desliga_computador);
		$('#comp_setor').val(data.comp_setor);
		$('#documento_id').val(data.documento_id);
		$('#extensao_arquivo_id').val(data.extensao_arquivo_id);
		$('#comp_usuario_adm').val(data.comp_usuario_adm);
		$('#comp_backup_ativo').val(data.comp_backup_ativo);
		$('.chosen-select').trigger("chosen:updated");
		


		if(data.dia0 == 0 && data.dia1 == 0 && data.dia2 == 0 && data.dia3 == 0 && data.dia4 == 0 && data.dia5 == 0 && data.dia6 == 0){


			$('#todos_os_dias').prop('checked',true);
		}



		if(data.dia0 == 0){
			
			$('#dia0').prop('checked',true);

		} if (data.dia1 == 0){

			$('#dia1').prop('checked',true);

		} if (data.dia2 == 0){

			$('#dia2').prop('checked',true);

		} if (data.dia3 == 0){

			$('#dia3').prop('checked',true);

		} if (data.dia4 == 0){

			$('#dia4').prop('checked',true); 

		} if (data.dia5 == 0){

			$('#dia5').prop('checked',true); 

		} if (data.dia6 == 0){

			$('#dia6').prop('checked',true); 

		}

		
	});

}



// Funcao para retornar cadastro de computador

function retorna_computador2(){


	
		$('#todos_os_dias').prop('checked',false);
		$('#dia0').prop('checked',false);
		$('#dia1').prop('checked',false);
		$('#dia2').prop('checked',false);
		$('#dia3').prop('checked',false);
		$('#dia4').prop('checked',false);
		$('#dia5').prop('checked',false);
		$('#dia6').prop('checked',false);



	$.post('retorna_computador.php',{comp_id: $('#comp_id').val()}).done(function(data){data = JSON.parse(data);

		
		$('#comp_email').val(data.comp_email);
		$('#comp_senha').val(data.comp_senha);
		$('#comp_ip').val(data.comp_ip);
		$('#comp_mac').val(data.comp_mac);
		$('#sistema_operacional_id').val(data.comp_sistema_operacional);
		$('#sistema_operacional_id').selectpicker('refresh');
		$('#dia0').val(data.dia0);
		$('#dia1').val(data.dia1);
		$('#dia2').val(data.dia2);
		$('#dia3').val(data.dia3);
		$('#dia4').val(data.dia4);
		$('#dia5').val(data.dia5);
		$('#dia6').val(data.dia6);
		$('#comp_hora_backup').val(data.comp_hora_backup);
		$('#servidor_id').val(data.comp_servidor_backup);
		$('#servidor_id').selectpicker('refresh');
		$('#comp_liga_computador').val(data.comp_liga_computador);
		$('#comp_desliga_computador').val(data.comp_desliga_computador);
		$('#comp_setor').val(data.comp_setor);
		$('#documento_id').val(data.documento_id);
		$('#extensao_arquivo_id').val(data.extensao_arquivo_id);
		$('#comp_usuario_adm').val(data.comp_usuario_adm);
		$('#comp_backup_ativo').val(data.comp_backup_ativo);
		$('.chosen-select').trigger("chosen:updated");


		if(data.dia0 == 0 && data.dia1 == 0 && data.dia2 == 0 && data.dia3 == 0 && data.dia4 == 0 && data.dia5 == 0 && data.dia6 == 0){


			$('#todos_os_dias').prop('checked',true);
		}

		if(data.dia0 == 0){
			
			$('#dia0').prop('checked',true);

		} if (data.dia1 == 0){

			$('#dia1').prop('checked',true);

		} if (data.dia2 == 0){

			$('#dia2').prop('checked',true);

		} if (data.dia3 == 0){

			$('#dia3').prop('checked',true);

		} if (data.dia4 == 0){

			$('#dia4').prop('checked',true); 

		} if (data.dia5 == 0){

			$('#dia5').prop('checked',true); 

		} if (data.dia6 == 0){

			$('#dia6').prop('checked',true); 

		}

		$('#pesquisar_cadastro_comp').prop('hidden',true);
	});

}
/*********************************************************************************************************************************************/
/************************************* Funcao para retornar o cadastro de usuarios na tela manutencao de usuarios *****************************/

// Funcao para retornar os usuarios

function retorna_usuario(){
	$.post('retorna_usuario.php',{usuario_id: $('#usuario_id').val()}).done (function (data){

		data = JSON.parse(data);

		$('#usuario_nome').val(data.usuario_nome);
		$('#usuario_login').val(data.usuario_login);
		$('#usuario_status').val(data.usuario_status);
		$('#usuario_status').selectpicker('refresh');
		$('#usuario_id_setor').val(data.usuario_id_setor);
		$('#usuario_id_setor').selectpicker('refresh');
		$('#usuario_email').val(data.usuario_email);
	})
}

/********************************************************************************************************************************************/
/************************************************ Funcao para retornar cadastro de setor na tela Manutencao de setores **********************/


// Funcao para retornar os setores cadastrados

function retorna_setor() {

	$.post('retorna_setor.php', {setor_id: $('#setor_id').val()}).done(function(data) {

		data = JSON.parse(data);
		$('#setor_nome').val(data.setor_nome);
		$('#descricao_setor').val(data.setor_descricao);

	});
}

/*********************************************************************************************************************************************/
/****************** *********************** Funcao para retornar cadastro de sistemas operacionais *******************************************/

// Funcao para retornar cadastro de sistemas operacionais

function retorna_so(){

	$.post('retorna_so.php',{sistema_operacional_id:$('#sistema_operacional_id').val()}).done(function(data){

		data = JSON.parse(data);

		$('#sistema_operacional_nome').val(data.sistema_operacional_nome);
		$('#sistema_operacional_plataforma').val(data.sistema_operacional_plataforma);
		$('#sistema_operacional_plataforma').selectpicker('refresh');

	})
}

/********************************************************************************************************************************************/
/***************************************** Funcao para retornar cadastro de Documentos ******************************************************/

function retorna_documento(){

	$('#documento_nome').val("");
	$('.so').val("");

	$.post('retorna_documentos.php',{documento_id:$('#documento_id').val()}).done(function(data){

		data = JSON.parse(data);
		

		$('#documento_nome').val(data.documento_nome);

		$('.diretorio_documentos').each(function(chave,valor){	

		//console.log(valor);		

		for(i=0; i< data.so.length; i++){

			if($(this).find('input').attr('data-id') == data.so[i].diretorio_id_sistema_operacional){

				console.log(data.so[i]);

				$(this).find('input').val(data.so[i].diretorio_documentos);



			}
		}	
	})
	})
}

/************************************************** Funcao da Tela Restaurar Backup de Usuarios *****************************************/

function retorna_docs_restaurar(){

$.post('retorna_docs_restaurar.php',{comp_id:$('#comp_id').val()}).done(function(data){

data = JSON.parse(data);

$('#documento_id').val(data.documento_id);

});

}

/****************************************************************************************************************************************/7
