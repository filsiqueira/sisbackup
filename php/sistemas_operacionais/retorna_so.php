<?php
include('../conexao/conexao.php');

$sistema_operacional_id = $_POST['sistema_operacional_id'];
$json = array();

$sql = mysqli_query($conexao,"SELECT * FROM sistemas_operacionais WHERE sistema_operacional_id = '$sistema_operacional_id' ");
$sos = mysqli_fetch_array($sql);

$json['sistema_operacional_nome'] = $sos['sistema_operacional_nome'];
$json['sistema_operacional_plataforma'] = $sos['sistema_operacional_plataforma'];

echo json_encode($json);



?>