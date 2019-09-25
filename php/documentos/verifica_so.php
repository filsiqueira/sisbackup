<?php

// Incluindo arquivo de conexão com o banco de dados
include('../conexao/conexao.php');

// Verificando se já existe algum sistema operacional cadastrado

$sql = mysqli_query($conexao,"SELECT sistema_operacional_id FROM sistemas_operacionais");
$linhas = mysqli_num_rows($sql);

if($linhas == '0'){

	echo "nao_existe_so_cadastrado";
	exit();

} else {

	echo "";
} 

?>