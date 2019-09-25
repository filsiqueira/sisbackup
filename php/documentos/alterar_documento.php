<?php

// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

// Incluindo arquivo de conexao com o banco de dados

include('../conexao/conexao.php');

// Recebendo os dados enviados via post
$documento_id   = $_POST['documento_id'];
$documento_nome = $_POST['documento_nome'];
$diretorios     = $_POST['diretorios'];


// Inserindo o nome do documento na tabela documentos
$update = mysqli_query($conexao," UPDATE documentos SET documento_nome = UCASE('$documento_nome') WHERE documento_id = '$documento_id' ");


if ($update){

$delete = mysqli_query($conexao,"DELETE  FROM diretorio_documentos WHERE diretorio_id_documentos = '$documento_id' ");


foreach ($diretorios as $key => $value) {

$sql = mysqli_query($conexao," INSERT INTO diretorio_documentos (diretorio_id_documentos,diretorio_id_sistema_operacional,diretorio_documentos) VALUES ('$documento_id','$value[id_so]', '$value[diretorio]') ");
if (! $sql){

	echo mysqli_error($conexao);
	exit();
}

	}


// Inserindo na tabela de auditoria de ações
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','alteracao','Manutenção de Documentos',NOW(),'Documento $documento_nome alterado por $usuario') ");

if (!$registraAcao){

echo "false";
exit();

}

	echo "true";

}

 else {


	echo "false";
}


















?>
