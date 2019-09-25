<?php

// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

// Incluindo arquivo de conexao com o banco de dados

include('../conexao/conexao.php');

// Recebendo os dados enviados via post

$nome_documento = $_POST['nome_documento'];
$diretorios = $_POST['diretorios'];


// Inserindo o nome do documento na tabela documentos

$insert_doc = mysqli_query($conexao," INSERT INTO documentos (documento_nome) VALUES (UCASE('$nome_documento'))");

if ($insert_doc){

$documento_id = mysqli_insert_id($conexao);

foreach ($diretorios as $key => $value) {
		
$sql = mysqli_query($conexao," INSERT INTO diretorio_documentos (diretorio_id_documentos,diretorio_id_sistema_operacional,diretorio_documentos) VALUES ('$documento_id','$value[id_so]', '$value[diretorio]') ");

if (! $sql){

	echo "erro_ao_cadastrar";
	exit();
}

	}


// Inserindo na tabela de auditoria de ações 
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','inclusao','Cadastro de Documentos',NOW(),'Documento $nome_documento cadastrado por $usuario') ");

if (!$registraAcao){

echo "false";	
exit();

}


	echo "cadastro_realizado_com_sucesso";

} else {


	echo "erro_ao_cadastrar";
}







	










?>