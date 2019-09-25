<?php

include('../conexao/conexao.php');

$usuario_id = $_POST['usuario_id'];
$json = array();

$sql = mysqli_query($conexao,"SELECT usuario_nome,usuario_login,usuario_status,usuario_id_setor,usuario_email FROM usuarios WHERE usuario_id = $usuario_id");
$usuarios = mysqli_fetch_array($sql);




$json['usuario_nome'] = $usuarios['usuario_nome'];
$json['usuario_login']        = $usuarios['usuario_login'];
$json['usuario_status']       = $usuarios['usuario_status'];
$json['usuario_id_setor'] = $usuarios['usuario_id_setor'];
$json['usuario_email']    = $usuarios['usuario_email'];
echo json_encode($json);



?>