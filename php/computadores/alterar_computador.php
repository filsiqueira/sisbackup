<?php

// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

// Incluindo arquivo de conexao com o banco de dados

include('../conexao/conexao.php');


// Recebendo os dados enviados via post
$comp_id                 = $_POST['comp_id'];
$comp_nome_usuario       = $_POST['comp_nome_usuario'];
$comp_login              = $_POST['comp_login'];
$comp_senha              = base64_encode($_POST['comp_senha']);
$comp_ip                 = $_POST['comp_ip'];
$comp_mac                = $_POST['comp_mac'];
$comp_sistema_operacional= $_POST['sistema_operacional_id'];
$comp_dia0               = $_POST['dia0'];
$comp_dia1               = $_POST['dia1'];
$comp_dia2               = $_POST['dia2'];
$comp_dia3               = $_POST['dia3'];
$comp_dia4               = $_POST['dia4'];
$comp_dia5               = $_POST['dia5'];
$comp_dia6               = $_POST['dia6'];
$comp_hora_backup        = $_POST['comp_hora_backup'];
$comp_servidor_backup    = $_POST['comp_servidor_backup'];
$comp_liga_computador    = $_POST['comp_liga_computador'];
$comp_desliga_computador = $_POST['comp_desliga_computador'];
$comp_setor              = $_POST['comp_setor'];
$documento_id            = $_POST['documento_id'];
$extensao_arquivo_id     = $_POST['extensao_arquivo_id'];
$comp_usuario_adm        = $_POST['comp_usuario_adm'];
$comp_backup_ativo       = $_POST['comp_backup_ativo'];


// Alterando cadastro

$update = mysqli_query($conexao,"UPDATE computadores SET 
	comp_nome_usuario        = UCASE('$comp_nome_usuario'),
	comp_login               = '$comp_login',
	comp_senha               = '$comp_senha',
	comp_ip                  = '$comp_ip',
	comp_mac                 = '$comp_mac',
	comp_sistema_operacional = '$comp_sistema_operacional',
	comp_dia_0               = '$comp_dia0',
	comp_dia_1               = '$comp_dia1',
	comp_dia_2               = '$comp_dia2',
	comp_dia_3               = '$comp_dia3',
	comp_dia_4               = '$comp_dia4',
	comp_dia_5               = '$comp_dia5',
	comp_dia_6               = '$comp_dia6',
	comp_hora_backup         = '$comp_hora_backup',
	comp_servidor_backup     = '$comp_servidor_backup',
	comp_liga_computador     = '$comp_liga_computador',
	comp_desliga_computador  = '$comp_desliga_computador',
	comp_setor               = '$comp_setor',
	comp_data_alteracao      = NOW(),
	comp_usuario_adm         = '$comp_usuario_adm',
	comp_backup_ativo        = '$comp_backup_ativo'
	WHERE comp_id = '$comp_id' ");

if($update){


	$delete = mysqli_query($conexao,"DELETE FROM associar_doc_computador WHERE assoc_id_computador = '$comp_id' ");
	$delete2 = mysqli_query($conexao,"DELETE FROM associar_extensao_arquivo_computador WHERE associar_computador_id = '$comp_id' ");

	if ($delete){

		foreach ($documento_id as $key => $value) {

			$sql = mysqli_query($conexao," INSERT INTO associar_doc_computador VALUES (DEFAULT,'$comp_id','$value')");

			if (! $sql){

				echo "erro_ao_cadastrar";
				exit();
			}
		}


		foreach ($extensao_arquivo_id as $key => $value) {

			$sql = mysqli_query($conexao," INSERT INTO associar_extensao_arquivo_computador VALUES (DEFAULT,'$value','$comp_id')");
			//$sql2 = mysqli_query($conexao," INSERT INTO associar_extensao_arquivo_computador VALUES (DEFAULT,'99999','$comp_id')");

			if (! $sql){

				echo "erro_ao_cadastrar";
				exit();
			}
		}
	}


// Inserindo na tabela de auditoria de ações 
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','alteracao','Manutenção de Computadores',NOW(),'Computador do usuário <b>$comp_nome_usuario </b> alterado por $usuario') ");

if (!$registraAcao){

echo "false";	
exit();

}



	echo "cadastro_alterado_com_sucesso";

} else {

	echo mysqli_error($conexao);
}


?>