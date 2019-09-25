<?php

// Iniciando a sessão e incluindo arquivo de conexao com o banco de dados

session_start();
include('../conexao/conexao_pdo.php');
$conexao = conectar();

// Recebendo dados do formulario

$login = $_POST['login'];
$senha = md5($_POST['senha']);

//Realizando a consulta no Banco de Dados

$sql = $conexao->prepare("SELECT * FROM usuarios WHERE usuario_login = :login AND usuario_senha = :senha");
$sql->bindValue(":login",$login);
$sql->bindValue(":senha",$senha);

if($sql->execute()){
		$dados = $sql->fetch(PDO:: FETCH_ASSOC);
		$status = $dados["usuario_status"];
		$linhas = $sql->rowCount();

if($linhas != 0){

//Verificando o status do usuario (0-ativo, 1-bloqueado)
	if($status != "ATIVO"){
		die("usuario_bloqueado");

	} else {

//Se o usuario estiver ativo,cria a sessão e retorna true
		$_SESSION['login'] = $login;
		echo "true";
	}

//Se não existir usuario e senha informado, usuário recebe mensagem de erro (tratado no javascript)

} else {
	die("dados_invalidos");
}
}

?>
