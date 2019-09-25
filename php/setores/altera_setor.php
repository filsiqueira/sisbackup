<?php


// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

include('../conexao/conexao.php');

$setor_id        = $_POST['setor_id'];
$setor           = mysqli_real_escape_string($conexao,$_POST['setor_nome']);
$setor_nome      = str_replace(" ", "_", "$setor");
$setor_descricao = $_POST['descricao_setor'];


// Alterando o cadastro

$update = mysqli_query($conexao,"UPDATE setores SET setor_nome = UCASE('$setor_nome'), setor_descricao = '$setor_descricao'  WHERE setor_id = '$setor_id' ");

if($update){

// Inserindo na tabela de auditoria de ações 
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','alteracao','Manutenção de Setor',NOW(),'Setor $setor_nome alterado por $usuario') ");

if (!$registraAcao){

echo "false";	
exit();

}	
    
    echo "cadastro_alterado_com_sucesso";

} else {
    
    echo mysqli_error($conexao);
}





?>