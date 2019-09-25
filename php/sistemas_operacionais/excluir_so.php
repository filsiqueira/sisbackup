<?php

session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

//Incluindo arquivo de conexao com o banco de dados
include('../conexao/conexao.php');

// Recebendo dados de entrada

$sistema_operacional_id = $_POST['sistema_operacional_id'];

//Pegando nome do sistema operacional a ser excluído
$consulta_so = mysqli_query($conexao,"SELECT sistema_operacional_nome FROM sistemas_operacionais WHERE sistema_operacional_id = $sistema_operacional_id");
$nome_so = mysqli_fetch_array($consulta_so);
$sistema_operacional_nome = $nome_so['sistema_operacional_nome'];

// Consultando no banco de dados

$sql = mysqli_query($conexao,"SELECT sistema_operacional_id,comp_sistema_operacional FROM sistemas_operacionais A JOIN computadores B ON A.sistema_operacional_id = B.comp_sistema_operacional WHERE sistema_operacional_id = '$sistema_operacional_id' ");

$sos = mysqli_fetch_array($sql);

$count = mysqli_num_rows($sql);

if ($count !=0) {

	echo "comp_associado";
	exit();

} else {

	$deleta_diretorio = mysqli_query($conexao,"DELETE FROM diretorio_documentos WHERE diretorio_id_sistema_operacional = '$sistema_operacional_id' ");

	if($deleta_diretorio){


	$deleta_so = mysqli_query($conexao,"DELETE FROM sistemas_operacionais WHERE sistema_operacional_id = '$sistema_operacional_id' ");


	if($deleta_so){



		// Inserindo na tabela de auditoria de ações
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','exclusao','Exclusão de Sistemas Operacionais',NOW(),'Sistema Operacional $sistema_operacional_nome excluído por $usuario') ");

if (!$registraAcao){

echo "false";
exit();

}

		echo "so_excluido_com_sucesso";

	} else {

		echo mysqli_error($conexao);

	}

	} else {

		echo mysqli_error($conexao);
	}

}




?>
