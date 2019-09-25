<?php

// Incluindo arquivo de conexao com o banco de dados
include('../conexao/conexao.php');

// Recebendo o id do sistema operacional selecionado
$diretorio_id_sistema_operacional = $_POST['diretorio_id_sistema_operacional'];

// Consultando o sistema operacional e vendo se possui algum diretorio ja configurado
$sql = mysqli_query($conexao,"SELECT diretorio_id_sistema_operacional FROM diretorio_documentos WHERE diretorio_id_sistema_operacional = $diretorio_id_sistema_operacional");
$array= mysqli_fetch_array($sql);
$linhas = mysqli_num_rows($sql);

if ($linhas == 0){

	echo "0";

}

?>