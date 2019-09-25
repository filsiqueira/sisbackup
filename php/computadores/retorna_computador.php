<?php

// Incluindo arquivo de conexao com o banco de dados

include('../conexao/conexao.php');

// Recebendo os dados e variavel array

$comp_id = $_POST['comp_id'];
$json = array();

// Consultando no banco de dados
$sql = mysqli_query($conexao,"SELECT * FROM computadores A JOIN  associar_doc_computador B ON A.comp_id = B.assoc_id_computador JOIN documentos C ON B.assoc_id_documentos = C.documento_id WHERE comp_id = '$comp_id' ORDER BY comp_nome_usuario");
$computadores = mysqli_fetch_array($sql);

$documento_id = mysqli_query($conexao,"SELECT documento_id FROM associar_doc_computador A JOIN documentos B ON A.assoc_id_documentos = B.documento_id WHERE assoc_id_computador = '$comp_id'");

$extensao_arquivo_id = mysqli_query($conexao,"SELECT extensao_arquivo_id FROM associar_extensao_arquivo_computador A JOIN extensao_arquivo B ON A.associar_extensao_id = B.extensao_arquivo_id WHERE associar_computador_id = '$comp_id' ");

// Retornando os dados

$json['comp_nome_usuario']       = $computadores['comp_nome_usuario'];
$json['comp_login']              = $computadores['comp_login'];
$json['comp_senha'] 			 = base64_decode($computadores['comp_senha']);
$json['comp_ip']				 = $computadores['comp_ip'];
$json['comp_mac']				 = $computadores['comp_mac'];
$json['comp_sistema_operacional'] = $computadores['comp_sistema_operacional'];
$json['dia0']                    = $computadores['comp_dia_0'];
$json['dia1']                    = $computadores['comp_dia_1'];
$json['dia2']                    = $computadores['comp_dia_2'];
$json['dia3']                    = $computadores['comp_dia_3'];
$json['dia4']                    = $computadores['comp_dia_4'];
$json['dia5']                    = $computadores['comp_dia_5'];
$json['dia6']                    = $computadores['comp_dia_6'];
$json['comp_hora_backup']        = $computadores['comp_hora_backup'];
$json['comp_servidor_backup']    = $computadores['comp_servidor_backup'];
$json['comp_liga_computador']	 = $computadores['comp_liga_computador'];
$json['comp_desliga_computador'] = $computadores['comp_desliga_computador'];
$json['comp_setor']	             = $computadores['comp_setor'];
$json['comp_usuario_adm']	     = $computadores['comp_usuario_adm'];
$json['comp_backup_ativo']       = $computadores['comp_backup_ativo'];

foreach ($documento_id as $key => $value) {

	$json['documento_id'][] = $value['documento_id'];
}

foreach ($extensao_arquivo_id as $key => $value) {
	$json['extensao_arquivo_id'][] = $value['extensao_arquivo_id'];
}

echo json_encode($json);

?>
