<?php

// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

include('../conexao/conexao.php');

$smtp_id = mysqli_escape_string($conexao,$_POST['smtp_id']);
$smtp_nome = mysqli_escape_string($conexao,$_POST['smtp_nome']);
$smtp_email_admin = mysqli_escape_string($conexao,$_POST['smtp_email_admin']);
$smtp_endereco = mysqli_escape_string($conexao,$_POST['smtp_endereco']);
$smtp_porta = mysqli_escape_string($conexao,$_POST['smtp_porta']);
$smtp_senha = mysqli_escape_string($conexao,base64_encode($_POST['smtp_senha']));

if($update = mysqli_query($conexao,"UPDATE smtp SET smtp_nome = UCASE('$smtp_nome'), smtp_email_admin = '$smtp_email_admin', smtp_endereco = '$smtp_endereco',smtp_porta = '$smtp_porta', smtp_senha = '$smtp_senha' WHERE smtp_id = '$smtp_id' ")){

// Inserindo na tabela de auditoria de ações 
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','alteracao','Alteração de Serviço de Envio de Email',NOW(),'Serviço de Email $smtp_nome alterado por $usuario') ");

if (!$registraAcao){

echo "false";	
exit();

}




echo "true";

} else {

echo mysqli_error($conexao);

}

?>