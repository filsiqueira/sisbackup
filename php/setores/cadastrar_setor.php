<?php

// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

// Incluindo arquivo de conexao com Banco de dados
include('../conexao/conexao.php');

$setor      = mysqli_real_escape_string($conexao,$_POST['nome_setor']);
$nome_setor = str_replace(" ", "_", "$setor");
$descricao_setor = $_POST['descricao_setor'];

$sql = mysqli_query($conexao,"SELECT setor_nome FROM setores WHERE setor_nome = '$nome_setor' ");
$setor = mysqli_num_rows($sql);

if($setor != 0){

	echo "ja_existe_setor";
	exit();

} else {

$insert = mysqli_query($conexao," INSERT INTO setores (setor_nome,setor_descricao) VALUES (UCASE('$nome_setor'),'$descricao_setor')");

	if($insert){


// Inserindo na tabela de auditoria de ações 
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','inclusao','Cadastro de Setor',NOW(),'Setor $nome_setor cadastrado por $usuario') ");

if (!$registraAcao){

echo "false";	
exit();

}		

		echo "cadastro_realizado_com_sucesso";

	} else {

		echo "erro_ao_cadastrar";

		exit();
	}

}






?>