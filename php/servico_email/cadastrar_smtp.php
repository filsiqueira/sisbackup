<?php
//Iniciando a sessão
session_start();
// Recuperando usuario logado
$usuario = $_SESSION['login'];
//Incluindo arquivo de conexão com o banco de dados
require_once("../conexao/conexao_pdo.php");
$conexao = conectar();

//Verificando se houve POST
if(!isset($_POST['smtp_nome']) || !isset($_POST['smtp_email_admin']) || !isset($_POST['smtp_endereco']) || !isset($_POST['smtp_porta']) || !isset($_POST['smtp_senha'])){
  die("false");
}


//Recebendo os dados digitados pelo usuário
$smtp_nome = $_POST['smtp_nome'];
$smtp_email_admin = $_POST['smtp_email_admin'];
$smtp_endereco = $_POST['smtp_endereco'];
$smtp_porta = $_POST['smtp_porta'];
$smtp_senha = base64_encode($_POST['smtp_senha']);

//Iniciando as transações
$conexao->beginTransaction();

//Inserindo na tabela smtp
$insert_smtp = $conexao->prepare("INSERT INTO smtp (smtp_nome,smtp_email_admin,smtp_endereco,smtp_porta,smtp_senha) VALUES (UCASE(:smtp_nome),:smtp_email_admin,:smtp_endereco,:smtp_porta,:smtp_senha)");
$insert_smtp->bindValue(":smtp_nome",$smtp_nome);
$insert_smtp->bindValue(":smtp_email_admin",$smtp_email_admin);
$insert_smtp->bindValue(":smtp_endereco",$smtp_endereco);
$insert_smtp->bindValue(":smtp_porta",$smtp_porta);
$insert_smtp->bindValue(":smtp_senha",$smtp_senha);

if(!$insert_smtp->execute()){
  die("false");

} else {

// Inserindo na tabela de auditoria de ações
$data_hora = date("Y-m-d H:i:s");
$insert_acao = $conexao->prepare("INSERT INTO auditoria_acoes (auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (:auditoria_usuario,:auditoria_acao,:auditoria_tela,:auditoria_data_hora,:auditoria_descricao)");
$insert_acao->bindValue(":auditoria_usuario",$usuario);
$insert_acao->bindValue(":auditoria_acao","inclusao");
$insert_acao->bindValue(":auditoria_tela","Cadastro de Serviço de Envio de Email");
$insert_acao->bindValue(":auditoria_data_hora",$data_hora);
$insert_acao->bindValue(":auditoria_descricao","Serviço de Email $smtp_nome cadastrado por $usuario");

if(!$insert_acao->execute()){
  $conexao->rollBack();
  die("false");

} else {
  $conexao->commit();
  echo "true";
}
}
?>
