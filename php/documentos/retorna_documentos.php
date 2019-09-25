<?php
include('../conexao/conexao.php');

$documento_id = $_POST['documento_id'];
$json = array();


$sql = mysqli_query($conexao,"SELECT documento_nome FROM documentos WHERE documento_id = '$documento_id' ");
$dados = mysqli_fetch_array($sql);
$diretorio_documentos = mysqli_query($conexao,"SELECT diretorio_documentos,diretorio_id_sistema_operacional FROM diretorio_documentos WHERE diretorio_id_documentos = '$documento_id' ");

$json['documento_nome'] = $dados['documento_nome'];

foreach ($diretorio_documentos as $key => $value) {
	
		
	$aux = array();
	
	$aux ['diretorio_documentos'] = $value[diretorio_documentos] ;

	$aux ['diretorio_id_sistema_operacional'] = $value[diretorio_id_sistema_operacional];

	$json['so'] [] = $aux;
}

echo json_encode($json);







?>