<?php

// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

include('../conexao/conexao.php');

$smtp_id = mysqli_escape_string($conexao,$_POST['smtp_id']);
$sql = mysqli_query($conexao,"SELECT smtp_nome FROM smtp WHERE smtp_id = '$smtp_id'");
$dados = mysqli_fetch_array($sql);
$smtp_nome = $dados['smtp_nome'];

if($delete = mysqli_query($conexao,"DELETE  FROM smtp WHERE smtp_id = '$smtp_id' ")){

// Inserindo na tabela de auditoria de ações 
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','exclusao','Cadastro de Serviço de Envio de Email',NOW(),'Serviço de Email $smtp_nome excluído por $usuario') ");

if (!$registraAcao){

echo "false";	
exit();

}
echo "true";

} else {

	echo "false";
}
?>