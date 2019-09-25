<?php

// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

// Incluindo arquivo de conexao com o banco de dados
include('../conexao/conexao.php');

// Recebendo dados via POST
$setor_id = $_POST['setor_id'];
$sql = mysqli_query($conexao,"SELECT setor_nome FROM setores WHERE setor_id = '$setor_id' ");
$dados = mysqli_fetch_array($sql);
$setor_nome = $dados['setor_nome'];


// Verificando se existe cadastro associado ao setor

$sql = mysqli_query($conexao,"SELECT setor_id,comp_setor FROM setores A JOIN computadores B ON A.setor_id = B.comp_setor WHERE setor_id = '$setor_id' ");
$count = mysqli_num_rows($sql);


$aux = mysqli_query($conexao,"SELECT setor_id,usuario_id_setor FROM setores A JOIN usuarios B ON A.setor_id =  B.usuario_id_setor WHERE setor_id = '$setor_id' ");
$cont = mysqli_num_rows($aux);

if($count != 0 || $cont != 0){

	echo "comp_associado";
	exit();

} else {

$deleta_setor = mysqli_query($conexao,"DELETE FROM setores WHERE setor_id = '$setor_id' ");

	if($deleta_setor){



// Inserindo na tabela de auditoria de ações 
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','exclusao','Manutenção de Setor',NOW(),'Setor $setor_nome excluído por $usuario') ");

if (!$registraAcao){

echo "false";	
exit();

}


		echo "setor_excluido_com_sucesso";
	
	} else {

		echo mysqli_error($conexao);
		exit;
	}	
}








?>