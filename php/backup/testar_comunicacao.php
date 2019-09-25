<?php
	// Incluindo arquivo de conexao com o banco de dados	
	include('../conexao/conexao.php');

 	// Recebendo id do computador

 	$comp_id = $_POST['comp_id'];

 	// Consultando no banco de dados

 	$sql = mysqli_query($conexao,"SELECT comp_ip FROM computadores WHERE comp_id  = '$comp_id' ");

 	$ips = mysqli_fetch_array($sql);
	
	$ip = $ips[0];	

	// Executando teste de comunicacao com o host

	if(fsockopen($ip,135,$errno,$errstr,30)){

		echo "comunicando";

	} else {

		echo "false";

	}
 	


?>