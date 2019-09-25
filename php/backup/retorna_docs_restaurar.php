<?php

include('../conexao/conexao.php');

$comp_id = $_REQUEST['comp_id'];


// Buscando os documentos associados ao cadastro do computador
$documento_id = mysqli_query($conexao,"SELECT documento_id,documento_nome FROM associar_doc_computador A JOIN documentos B ON A.assoc_id_documentos = B.documento_id WHERE assoc_id_computador = '$comp_id'");

while ($documentos_id = mysqli_fetch_assoc($documento_id) ) {
		$json[] = array(
			'documento_id'	=> $documentos_id['documento_id'],
			'documento_nome' => utf8_encode($documentos_id['documento_nome']),
		);
	}
	
	echo(json_encode($json));

?>