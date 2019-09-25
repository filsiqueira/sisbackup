<?php

// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

// Incluindo arquivo de conexao com o banco de dados

include('../conexao/conexao.php');


//Verificando se ainda possui licencas disponiveis - 30 LICENCAS

$sql = mysqli_query($conexao,"SELECT comp_id FROM computadores");

$array = mysqli_fetch_array($sql);

$licencas = mysqli_num_rows($sql);

if ($licencas >= 500){

echo "numero_maximo_licenca_atingido";

echo json_encode($licencas);
exit();

}


// Recebendo os dados enviados via post

$comp_nome_usuario       = $_POST['comp_nome_usuario'];
$comp_login              = $_POST['comp_login'];
$comp_senha              = base64_encode($_POST['comp_senha']);
$comp_ip                 = $_POST['comp_ip'];
$comp_mac                = $_POST['comp_mac'];
$comp_sistema_operacional= $_POST['sistema_operacional_id'];
$dia0                    = $_POST['dia0'];
$dia1                    = $_POST['dia1'];
$dia2                    = $_POST['dia2'];
$dia3                    = $_POST['dia3'];
$dia4                    = $_POST['dia4'];
$dia5                    = $_POST['dia5'];
$dia6                    = $_POST['dia6'];
$comp_hora_backup        = $_POST['comp_hora_backup'];
$comp_servidor_backup    = $_POST['comp_servidor_backup'];
$comp_liga_computador    = $_POST['comp_liga_computador'];
$comp_desliga_computador = $_POST['comp_desliga_computador'];
$comp_setor              = $_POST['comp_setor'];
$documento_id            = $_POST['documento_id'];
$extensao_arquivo_id     = $_POST['extensao_arquivo_id'];
$comp_usuario_adm        = $_POST['comp_usuario_adm'];
$comp_backup_ativo       = $_POST['comp_backup_ativo'];


// inserindo cadastro

$insert = mysqli_query($conexao,"INSERT INTO computadores VALUES (DEFAULT,UCASE('$comp_nome_usuario'),'$comp_login','$comp_senha','$comp_ip','$comp_mac','$comp_sistema_operacional','$dia0','$dia1','$dia2','$dia3','$dia4','$dia5','$dia6','$comp_hora_backup','$comp_servidor_backup','$comp_liga_computador','$comp_desliga_computador','$comp_setor',NOW(),'0000-00-00 00:00:00','$comp_usuario_adm', '$comp_backup_ativo')");

if ($insert){

	//Criando Pasta com nome do usuario

	$diretorio = "$comp_diretorio_backup/$comp_nome_usuario";

	$criarPasta = shell_exec(mkdir($diretorio));

	$comp_id = mysqli_insert_id($conexao);

	// Associando documentos do usuario na tabela 'associar_doc_computador'

	foreach ($documento_id as $key => $value) {

		$sql = mysqli_query($conexao," INSERT INTO associar_doc_computador VALUES (DEFAULT,'$comp_id','$value')");

		if (! $sql){

			echo mysqli_error($conexao);
			exit();
		}

	}

	// Associando extensao de arquivos que nao serao copiados


		foreach ($extensao_arquivo_id as $key => $value) {

		$sql2 = mysqli_query($conexao," INSERT INTO associar_extensao_arquivo_computador VALUES (DEFAULT,'$value','$comp_id')");


		if (! $sql2){

			echo mysqli_error($conexao);
			exit();
		}

	}

	//$sql3 = mysqli_query($conexao," INSERT INTO associar_extensao_arquivo_computador VALUES (DEFAULT,'99999','$comp_id')");



// Inserindo na tabela de auditoria de ações
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','inclusao','Cadastro de Computadores',NOW(),'Computador do usuário $comp_nome_usuario cadastrado por $usuario') ");

if (!$registraAcao){

echo "false";
exit();

}


	echo "cadastro_realizado_com_sucesso";



} else {

	echo mysqli_error($conexao);
}


?>
