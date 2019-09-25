<?php


// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];
// Incluindo arquivo de conexao com o banco de dados
include('../conexao/conexao.php');

// Recendo os dados do formulario

$usuario_id       = $_POST['usuario_id'];
$usuario_nome     = $_POST['usuario_nome'];
$usuario_status   = $_POST['usuario_status'];
$usuario_id_setor = $_POST['usuario_id_setor'];
$usuario_email    = $_POST['usuario_email'];


// Alterando o cadastro


$sql = mysqli_query($conexao,"UPDATE usuarios SET usuario_nome = UCASE('$usuario_nome'), usuario_status = '$usuario_status' ,usuario_id_setor = '$usuario_id_setor',usuario_email = '$usuario_email',usuario_tentativas_invalidas = '0',usuario_data_bloqueio = '0000-00-00 00:00:00' WHERE usuario_id = '$usuario_id' ");

if ($sql){


// Inserindo na tabela de auditoria de ações
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','alteracao','Manutenção de Usuários',NOW(),'Usuário $usuario_nome alterado por $usuario') ");

if (!$registraAcao){

echo "false";
exit();

}

	echo "cadastro_alterado_com_sucesso";
} else {

	echo mysqli_error($conexao);
}

?>
