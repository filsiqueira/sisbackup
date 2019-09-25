<?php

// Incluindo arquivo de conexão com o banco de dados
include('../conexao/conexao.php');

$sql = mysqli_query($conexao,"SELECT comp_id FROM computadores");

$array = mysqli_fetch_array($sql);

$licencas = mysqli_num_rows($sql);


echo json_encode($licencas);






?>