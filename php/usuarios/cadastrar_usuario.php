<?php

// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

// Incluindo arquivo de conexao
include('../conexao/conexao.php');


// Recebendo os dados de entrada

$nome_usuario  = $_POST['nome_usuario'];
$login 		   = $_POST['login'];
$setor         = $_POST['setor'];
$senha         = md5($_POST['senha']);
$status        = $_POST['status'];
$usuario_email = $_POST['usuario_email'];


// Verificando se ja existe aquele usuario no banco de dados

$sql = mysqli_query($conexao," SELECT usuario_id FROM usuarios WHERE usuario_login = '$login' ");
$row = mysqli_fetch_array($sql);
$count = mysqli_num_rows($sql);

if ($count != 0 ){

	echo "ja_existe_login";
	exit();

} else {

// Inserindo usuario no banco de dados
$insert = mysqli_query($conexao,"INSERT INTO usuarios (usuario_nome,usuario_login,usuario_senha,usuario_status,usuario_id_setor,usuario_email,usuario_tentativas_invalidas,usuario_data_bloqueio) VALUES ( UCASE('$nome_usuario'),'$login','$senha','$status','$setor','$usuario_email','0','1900-01-01 00:00:00')");

	if($insert){


// Inserindo na tabela de auditoria de ações 
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','inclusao','Cadastro de Usuários',NOW(),'Usuário $nome_usuario cadastrado por $usuario') ");

if (!$registraAcao){

echo "false";	
exit();

}		

		echo "cadastro_realizado_com_sucesso";

	} else {

		echo "erro_ao_cadastrar";

	}


} 




?>
