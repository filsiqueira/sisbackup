<?php

//Incluindo arquivo de conexão com o banco de dados
include('../conexao/conexao.php');

$dia_da_semana = mysqli_escape_string($conexao,$_POST['dia_da_semana']);
$hora_backup = mysqli_escape_string($conexao,$_POST['hora_backup']);
$sem_filtro = mysqli_escape_string($conexao,$_POST['sem_filtro']);

if ($sem_filtro == '0'){

$sql = mysqli_query($conexao,"UPDATE computadores SET comp_backup_ativo = 'SIM' ");

if($sql){

echo "sucesso";

} else {


echo "erro";
exit();

}

} else {

$sql = mysqli_query($conexao,"UPDATE computadores SET comp_backup_ativo = 'SIM' WHERE $dia_da_semana = 0 AND comp_hora_backup = '$hora_backup'");

if($sql){

echo "sucesso";

} else {

	echo "erro";
	exit();
}

	
}



?>