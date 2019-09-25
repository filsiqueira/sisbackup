<?php


// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

include('../conexao/conexao.php');

$servidor_id = mysqli_escape_string($conexao,$_POST['servidor_id']);
$sql = mysqli_query($conexao,"SELECT servidor_nome FROM servidores WHERE servidor_id = '$servidor_id' ");
$dados = mysqli_fetch_array($sql);
$servidor_nome = $dados['servidor_nome'];


// Consultando no banco de dados

$sql = mysqli_query($conexao,"SELECT comp_servidor_backup,servidor_id FROM computadores A JOIN servidores B ON A.comp_servidor_backup = B.servidor_id WHERE servidor_id = '$servidor_id' ");

$sos = mysqli_fetch_array($sql);

$count = mysqli_num_rows($sql);

if ($count !=0) {

	echo "comp_associado";
	exit();

} else {

if($delete = mysqli_query($conexao,"DELETE  FROM servidores WHERE servidor_id = '$servidor_id' ")){

// Inserindo na tabela de auditoria de ações 
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','exclusao','Servidores de Backup',NOW(),'Servidor de Backup $servidor_nome excluído por $usuario') ");

if (!$registraAcao){

echo "false";	
exit();

}


echo "true";

} else {

	echo "false";
	//echo mysqli_error($conexao);
}

}
?>