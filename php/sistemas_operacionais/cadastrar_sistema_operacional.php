<?php

// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

// Arquivo de conexao com o banco de dados

include('../conexao/conexao.php');

// Recebendo os dados

$nome_so = $_POST['nome_so'];
$plataforma = $_POST['plataforma'];


// Verificando se ja existe o sistema operacional cadastrado no banco de dados

$sql = mysqli_query($conexao,"SELECT sistema_operacional_id FROM sistemas_operacionais WHERE sistema_operacional_nome = '$nome_so' ");
$row = mysqli_fetch_array($sql);
$count = mysqli_num_rows($sql);

if ($count != 0){

	echo "ja_existe_so";

} else {
	// Inserindo sistema operacional no banco de dados

$insert = mysqli_query($conexao,"INSERT INTO sistemas_operacionais (sistema_operacional_nome,sistema_operacional_plataforma) VALUES (UCASE('$nome_so'),UCASE('$plataforma'))");

	if ($insert){

	// Inserindo na tabela de auditoria de ações 
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','inclusao','Cadastro de Sistemas Operacionais',NOW(),'Sistema Operacional $nome_so cadastrado por $usuario') ");

if (!$registraAcao){

echo "false";	
exit();

}	

		echo "cadastro_realizado_com_sucesso";

	} else {

		echo "erro_ao_cadastrar";
		exit();
	}
}
?>