<?php
// Incluindo arquivo de conexao com o banco de dados
include('../conexao/conexao.php');

$comp_id = $_POST['comp_id'];
$servidor_id = $_POST['servidor_id'];
$json = array();

$sql = mysqli_query($conexao,"SELECT comp_nome_usuario,servidor_nome FROM computadores A JOIN servidores B ON A.comp_servidor_backup = B.servidor_id WHERE comp_id = '$comp_id' ");
$dados = mysqli_fetch_array($sql);

$sql2 = mysqli_query($conexao,"SELECT servidor_nome FROM servidores WHERE servidor_id = '$servidor_id' ");
$srv_dest=mysqli_fetch_array($sql2);

$json['nome_usuario'] = $dados['comp_nome_usuario'];
$json['srv_orig'] = $dados['servidor_nome'];
$json['srv_dest'] = $srv_dest['servidor_nome'];

echo json_encode($json);











?>