<?php

include('../conexao/conexao.php');

$sistema_operacional_id = $_POST['sistema_operacional_id'];

$documento_id = mysqli_query($conexao,"SELECT documento_id,documento_nome FROM documentos A JOIN diretorio_documentos B ON A.documento_id = diretorio_id_documentos WHERE diretorio_id_sistema_operacional = '$sistema_operacional_id' ORDER BY documento_nome");

while($docs = mysqli_fetch_array($documento_id)){

	$str.="<option value='$docs[documento_id]'>$docs[documento_nome]</option>";

}

echo $str;

?>