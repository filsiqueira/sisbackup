<?php
// Incluindo arquivo de conexao com o banco de dados
include('../conexao/conexao.php');

$json  = array();

// Total de computadores
$sql1 = mysqli_query($conexao,"select * from computadores");
$info_pc = mysqli_num_rows($sql1);

//Total de sistemas operacionais
$sql2 = mysqli_query($conexao,"select * from sistemas_operacionais");
$info_so = mysqli_num_rows($sql2);

//Total de setores
$sql3 = mysqli_query($conexao,"select * from setores");
$info_setor = mysqli_num_rows($sql3);

//Total de serviço de email
$sql4 = mysqli_query($conexao,"select * from smtp");
$info_smtp = mysqli_num_rows($sql4);

//Total de diretorios
$sql5 = mysqli_query($conexao,"select * from documentos");
$info_diretorios = mysqli_num_rows($sql5);

//Total de usuarios
$sql6 = mysqli_query($conexao,"select * from usuarios where usuario_id != 1");
$info_usuarios = mysqli_num_rows($sql6);

//Total de backup com falha
$sql7 = mysqli_query($conexao,"select * from backups_realizados where backup_status = 'FALHA' ");
$bkp_falha = mysqli_num_rows($sql7);

//Total de backup com sucesso
$sql8 = mysqli_query($conexao,"select * from backups_realizados where backup_status = 'SUCESSO' ");
$bkp_sucesso = mysqli_num_rows($sql8);

//Total de servidores de backup
$sql9 = mysqli_query($conexao,"select * from servidores ");
$srv_bkp = mysqli_num_rows($sql9);


$json['info_pc'] = $info_pc;
$json['info_so'] = $info_so;
$json['info_setor'] = $info_setor;
$json['info_smtp'] = $info_smtp;
$json['info_diretorios'] = $info_diretorios;
$json['info_usuarios'] = $info_usuarios;
$json['bkp_falha'] = $bkp_falha;
$json['bkp_sucesso'] = $bkp_sucesso;
$json['srv_bkp'] = $srv_bkp;
echo json_encode($json);


?>
