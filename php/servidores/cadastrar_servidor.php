<?php


// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

// Arquivo de conexão com o banco de dados
include('../conexao/conexao.php');

if(empty($_POST['servidor_nome']) ||empty($_POST['servidor_ip']) || empty($_POST['servidor_user_privilegio']) || empty($_POST['servidor_senha_acesso']) || empty($_POST['servidor_nome_compartilhamento']) || empty($_POST['servidor_plataforma'])){
	die("false");
}

// Dados de entrada
$servidor_nome = mysqli_escape_string($conexao,$_POST['servidor_nome']);
$servidor_ip = mysqli_escape_string($conexao,$_POST['servidor_ip']);
$servidor_user_privilegio = mysqli_escape_string($conexao,$_POST['servidor_user_privilegio']);
$servidor_senha_acesso = mysqli_escape_string($conexao,base64_encode($_POST['servidor_senha_acesso']));
$servidor_nome_compartilhamento = mysqli_escape_string($conexao,($_POST['servidor_nome_compartilhamento']));
$servidor_plataforma = mysqli_escape_string($conexao,$_POST['servidor_plataforma']);


// Verificando se já exste este servidor cadastrado
$consulta = mysqli_query($conexao,"SELECT servidor_nome FROM servidores WHERE servidor_nome = '$servidor_nome' ");

if($linha = mysqli_num_rows($consulta) != 0){

echo "ja_existe";
exit();

} else {

$insert = mysqli_query($conexao,"INSERT INTO servidores (servidor_id,servidor_nome,servidor_ip,servidor_user_privilegio,servidor_senha_acesso,servidor_nome_compartilhamento,servidor_plataforma) VALUES (DEFAULT,'$servidor_nome','$servidor_ip','$servidor_user_privilegio','$servidor_senha_acesso','$servidor_nome_compartilhamento', '$servidor_plataforma')");

if($insert){

// Inserindo na tabela de auditoria de ações
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','inclusao','Cadastro de Servidor de Backup',NOW(),'Servidor de Backup $servidor_nome cadastrado por $usuario') ");

if (!$registraAcao){

echo "false";
exit();

}



	echo "true";
	exit();

} else {

	echo mysqli_error($conexao);
}

}
?>
