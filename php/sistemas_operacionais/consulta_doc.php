<?php
// Incluindo arquivo de conexão
include('../conexao/conexao.php');

// Verficando se existe documentos cadastrados na base de dados

$sql = mysqli_query($conexao,"SELECT * FROM diretorio_documentos");
$linhas = mysqli_num_rows($sql);

if($linhas != '0'){

	echo "true";

} else {

	echo "false";
}

?>