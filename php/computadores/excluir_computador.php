<?php

// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

include('../conexao/conexao.php');

$comp_id = $_POST['comp_id'];
$sql = mysqli_query($conexao,"SELECT comp_nome_usuario FROM computadores WHERE comp_id = '$comp_id' ");
$dados = mysqli_fetch_array($sql);
$comp_nome_usuario = $dados['comp_nome_usuario'];



if($del_comp = mysqli_query($conexao,"DELETE FROM computadores WHERE comp_id = '$comp_id' ")){

	if($del_assoc = mysqli_query($conexao,"DELETE FROM associar_doc_computador WHERE assoc_id_computador = '$comp_id' ")){

		$del_assoc_extensao = mysqli_query($conexao,"DELETE FROM associar_extensao_arquivo_computador WHERE associar_computador_id = '$comp_id' ");

		if(!$del_assoc_extensao){

			echo "false";

		}
	
// Inserindo na tabela de auditoria de ações 
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','exclusao','Manutenção de Computadores',NOW(),'Computador do usuário $comp_nome_usuario excluído do sistema por $usuario') ");

if (!$registraAcao){

echo "false";	
exit();

}		
		echo "true";
		
	} else {

		echo "false";
		exit();
	}




} else {

	echo mysqli_error($conexao);
	exit();
}

?>