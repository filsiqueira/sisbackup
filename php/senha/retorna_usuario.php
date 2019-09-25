<?php
include('../conexao/conexao.php');

$usuario_id = $_POST['usuario_id'];

$sql = mysqli_query($conexao,"SELECT usuario_email FROM usuarios WHERE usuario_id = '$usuario_id' ");
$email = mysqli_fetch_array($sql);

echo $email[usuario_email];










?>