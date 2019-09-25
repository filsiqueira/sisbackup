<?php

include('../conexao/conexao.php');

$setor_id = $_POST['setor_id'];
$json = array();

$sql = mysqli_query($conexao,"SELECT * FROM setores WHERE setor_id = $setor_id ");
$setores = mysqli_fetch_array($sql);

$json['setor_nome']      = $setores['setor_nome'];
$json['setor_descricao'] = $setores['setor_descricao'];

echo json_encode($json);





?>