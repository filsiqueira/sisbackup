<?php
// Incluindo arquivo de conexao

include('../conexao/conexao.php');

$comp_id = $_POST['comp_id'];
$json = array();


$sql = mysqli_query($conexao,"SELECT servidor_nome FROM servidores A JOIN computadores B ON A.servidor_id = B.comp_servidor_backup WHERE comp_id = '$comp_id' ");
$servidor_atual = mysqli_fetch_array($sql);

$json['servidor_atual'] = $servidor_atual['servidor_nome'];

echo json_encode($json);









?>