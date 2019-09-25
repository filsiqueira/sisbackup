<?php

session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

// Incluindo arquivo de conexao com o banco de dados
include('../conexao/conexao.php');

// Recendo os dados do formulario

$sistema_operacional_id         = $_POST['sistema_operacional_id'];
$sistema_operacional_nome       = $_POST['sistema_operacional_nome'];
$sistema_operacional_plataforma = $_POST['sistema_operacional_plataforma'];

// Verificando se ja existe o sistema operacional cadastrado no banco de dados
$sql = mysqli_query($conexao,"SELECT sistema_operacional_id FROM sistemas_operacionais WHERE sistema_operacional_nome = '$sistema_operacional_nome'  AND sistema_operacional_id != $sistema_operacional_id");
$row = mysqli_fetch_array($sql);
$count = mysqli_num_rows($sql);

if ($count != 0){

	echo "ja_existe_so";
	exit();

}

// Alterando o cadastro

$sql = mysqli_query($conexao,"UPDATE sistemas_operacionais SET sistema_operacional_nome = UCASE('$sistema_operacional_nome'), sistema_operacional_plataforma  = '$sistema_operacional_plataforma' WHERE sistema_operacional_id = '$sistema_operacional_id' ");

if ($sql){

	// Inserindo na tabela de auditoria de ações
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','alteracao','Alteração de Sistemas Operacionais',NOW(),'Sistema Operacional $sistema_operacional_nome alterado por $usuario') ");

if (!$registraAcao){

echo "false";
exit();

}

	echo "cadastro_alterado_com_sucesso";
} else {

	echo mysqli_error($conexao);
}

?>
