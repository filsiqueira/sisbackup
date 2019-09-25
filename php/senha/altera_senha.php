<?php

// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

include('../conexao/conexao.php');
// Recebendo id do usuario, senha e criptografando a senha em md5

$usuario_id = $_POST['usuario_id'];
$usuario_senha = md5($_POST['usuario_senha']);

$sql = mysqli_query($conexao,"SELECT usuario_nome FROM usuarios WHERE usuario_id = '$usuario_id' ");
$dados = mysqli_fetch_array($sql);
$usuario_nome = $dados['usuario_nome'];


// Alterando no banco de dados
$update = mysqli_query($conexao,"UPDATE usuarios SET usuario_senha = '$usuario_senha' WHERE usuario_id = '$usuario_id'");

// Se a alteracao for bem sucedida retorna true caso contrario retorna false
if ($update){


// Inserindo na tabela de auditoria de ações 
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','alteracao','Manutenção de Senha',NOW(),'Senha do usuário $usuario_nome alterada por $usuario') ");

if (!$registraAcao){

echo "false";	
exit();

}

	echo "cadastro_alterado_com_sucesso";

} else {

	echo mysqli_error($conexao);
}

?>