<?php

include('../conexao/conexao.php');

$dia_da_semana = mysqli_escape_string($conexao,$_POST['dia_da_semana']);
$hora_backup = mysqli_escape_string($conexao,$_POST['hora_backup']);
$filtro = mysqli_escape_string($conexao,$_POST['filtro']);


if($filtro == '0'){



$sql = mysqli_query($conexao,"SELECT comp_nome_usuario,setor_nome,servidor_nome,comp_hora_backup,comp_dia_0,comp_dia_1,comp_dia_2,comp_dia_3,comp_dia_4,comp_dia_5,comp_dia_6 FROM computadores A JOIN setores B ON A.comp_setor = B.setor_id JOIN servidores C ON A.comp_servidor_backup = C.servidor_id WHERE comp_backup_ativo = 'SIM' ORDER BY comp_dia_0,comp_dia_1,comp_dia_2,comp_dia_3,comp_dia_4,comp_dia_5,comp_dia_6 ");

$tabela1 = ' <table class="table table-hover table-striped" id="tabela" style="color: #0d20fb">';
$tabela1 .= '<thead>';
$tabela1 .= '<tr>';
$tabela1 .= '<th scope="col"> Nome do Usuário </th>';
$tabela1 .= '<th scope="col"> Hora do Backup </th>';
$tabela1 .= '<th scope="col"> Dia do Backup </th>';
$tabela1 .= '</tr>';
$tabela1 .= '<tbody>';

while($dados = mysqli_fetch_array($sql)){

if ($dados[comp_dia_0] == '0'){

$tabela1 .= '<tr>';
$tabela1 .= '<td>'.$dados['comp_nome_usuario'].'</td>';
$tabela1 .= '<td>'.$dados['comp_hora_backup'].':00 HS </td>';
$tabela1 .= '<td> Domingo </td>';
$tabela1 .= '</tr>';

}

if ($dados[comp_dia_1] == '0'){

$tabela1 .= '<tr>';
$tabela1 .= '<td>'.$dados['comp_nome_usuario'].'</td>';
$tabela1 .= '<td>'.$dados['comp_hora_backup'].':00 HS </td>';
$tabela1 .= '<td> Segunda-feira </td>';
$tabela1 .= '</tr>';

}

if ($dados[comp_dia_2] == '0'){

$tabela1 .= '<tr>';
$tabela1 .= '<td>'.$dados['comp_nome_usuario'].'</td>';
$tabela1 .= '<td>'.$dados['comp_hora_backup'].':00 HS </td>';
$tabela1 .= '<td> Terça-feira </td>';
$tabela1 .= '</tr>';

}

if ($dados[comp_dia_3] == '0'){

$tabela1 .= '<tr>';
$tabela1 .= '<td>'.$dados['comp_nome_usuario'].'</td>';
$tabela1 .= '<td>'.$dados['comp_hora_backup'].':00 HS </td>';
$tabela1 .= '<td> Quarta-feira </td>';
$tabela1 .= '</tr>';

}

if ($dados[comp_dia_4] == '0'){

$tabela1 .= '<tr>';
$tabela1 .= '<td>'.$dados['comp_nome_usuario'].'</td>';
$tabela1 .= '<td>'.$dados['comp_hora_backup'].':00 HS </td>';
$tabela1 .= '<td> Quinta-feira </td>';
$tabela1 .= '</tr>';

}

if ($dados[comp_dia_5] == '0'){

$tabela1 .= '<tr>';
$tabela1 .= '<td>'.$dados['comp_nome_usuario'].'</td>';
$tabela1 .= '<td>'.$dados['comp_hora_backup'].':00 HS </td>';
$tabela1 .= '<td> Sexta-feira </td>';
$tabela1 .= '</tr>';

}

if ($dados[comp_dia_6] == '0'){

$tabela1 .= '<tr>';
$tabela1 .= '<td>'.$dados['comp_nome_usuario'].'</td>';
$tabela1 .= '<td>'.$dados['comp_hora_backup'].':00 HS </td>';
$tabela1 .= '<td> Sábado </td>';
$tabela1 .= '</tr>';

}

}

$tabela1 .= '</tbody>';
echo $tabela1;




} else {




$sql = mysqli_query($conexao,"SELECT comp_nome_usuario,setor_nome,servidor_nome FROM computadores A JOIN setores B ON A.comp_setor = B.setor_id JOIN servidores C ON A.comp_servidor_backup = C.servidor_id WHERE $dia_da_semana = 0 AND comp_hora_backup = '$hora_backup' AND comp_backup_ativo = 'SIM' ORDER BY comp_nome_usuario ");


$tabela = ' <table class="table table-hover table-striped" id="tabela" style="color: #0d20fb">';
$tabela .= '<thead>';
$tabela .= '<tr>';
$tabela .= '<th scope="col"> Nome do Usuário </th>';
$tabela .= '<th scope="col"> Setor do Usuário </th>';
$tabela .= '</tr>';
$tabela .= '<tbody>';

while($dados = mysqli_fetch_array($sql)){
$tabela .= '<tr>';
$tabela .= '<td>'.$dados['comp_nome_usuario'].'</td>';
$tabela .= '<td>'.$dados['setor_nome'].'</td>';
$tabela .= '</tr>';

}

$tabela .= '</tbody></table>';
echo $tabela;

}



?>