<?php

// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

include('../conexao/conexao.php');

$documento_id = $_POST['documento_id'];
$sql = mysqli_query($conexao,"SELECT documento_nome FROM documentos WHERE documento_id = '$documento_id' ");
$dados = mysqli_fetch_array($sql);
$documento_nome = $dados['documento_nome'];

$sql = mysqli_query($conexao,"SELECT comp_id,assoc_id_computador,assoc_id_documentos FROM computadores A JOIN associar_doc_computador B ON A.comp_id = B.assoc_id_computador WHERE assoc_id_documentos = '$documento_id' ");

if($cont = mysqli_num_rows($sql) != 0){

	echo "comp_associado";
	exit();

} else {

	$del_doc = mysqli_query($conexao,"DELETE FROM documentos WHERE documento_id = '$documento_id' ");

	if($del_doc){



	
// Inserindo na tabela de auditoria de ações 
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','exclusao','Manutenção de Documentos',NOW(),'Documento $documento_nome excluído por $usuario') ");

if (!$registraAcao){

echo "false";	
exit();

}	
	

	$del_dir = mysqli_query($conexao,"DELETE FROM diretorio_documentos WHERE diretorio_id_documentos = '$documento_id' ");		

		if ($del_dir){
		echo "doc_excluido_com_sucesso";
		exit();

	} else {

		echo "false";
	}

	} else {

		echo mysqli_error($conexao);
		exit();
	} 


} 






?>