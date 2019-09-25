<?php

//Incluindo arquivo de conexao com o banco de dados
include('../conexao/conexao.php');

//Recebendo ID do usuario selecionado
$comp_id = $_POST['comp_id'];

//Pegando dados do usuario


$consulta = mysqli_query($conexao,"SELECT * FROM computadores A 
	JOIN sistemas_operacionais B ON A.comp_sistema_operacional = B.sistema_operacional_id 
	JOIN associar_doc_computador C ON A.comp_id = C.assoc_id_computador
	JOIN documentos D ON D.documento_id = C.assoc_id_documentos
	JOIN diretorio_documentos E ON E.diretorio_id_documentos = D.documento_id
	JOIN servidores F ON A.comp_servidor_backup = F.servidor_id
	JOIN setores G ON A.comp_setor = G.setor_id
	WHERE A.comp_sistema_operacional = E.diretorio_id_sistema_operacional AND comp_id = '$comp_id' ");

$dados = mysqli_fetch_array($consulta);

$plataforma = $dados['sistema_operacional_plataforma'];
	$ip = $dados['comp_ip'];
	$usuario = $dados['comp_login'];
	$senha = base64_decode($dados['comp_senha']);
	$documentos[] = $dados['documento_nome'];
	$diretorio_documentos = $dados['diretorio_documentos'];
	$comp_nome_usuario = $dados['comp_nome_usuario'];
	$comp_id = $dados['comp_id'];
	$comp_liga_computador = $dados['comp_liga_computador'];
	$comp_desliga_computador = $dados['comp_desliga_computador'];
	$comp_mac = $dados['comp_mac'];
	$servidor_ip = $dados['servidor_ip'];
	$servidor_nome_compartilhamento = $dados['servidor_nome_compartilhamento'];
	$servidor_plataforma = $dados['servidor_plataforma'];
	$servidor_user_privilegio = $dados['servidor_user_privilegio'];
	$servidor_senha_acesso = base64_decode($dados['servidor_senha_acesso']);
	$comp_usuario_adm = $dados['comp_usuario_adm'];
	$setor_nome = $dados['setor_nome'];



	// Ajustando diretorio dos documentos

	$usuarioAjustado = $usuario."/";
	$diretorio_documentos = str_replace("C:/", "", $diretorio_documentos);
	$diretorio_documentos = str_replace("c:/", "", $diretorio_documentos);
	$diretorio_documentos = str_replace("usuario/", $usuarioAjustado, $diretorio_documentos);
	$diretorio_documentos = str_replace("Usuario/", $usuarioAjustado, $diretorio_documentos);
	$diretorio_documentos = str_replace("usuario/", $usuarioAjustado, $diretorio_documentos);
	$diretorio_documentos = str_replace("Usuario/", $usuarioAjustado, $diretorio_documentos);
	$diretorio_documentos = str_replace(" ", "\ ", $diretorio_documentos);


//Listar arquivos do usuario no servidor de backup

//Verifiar se o servidor de backup do usuario é o proprio servidor de aplicacao
if($servidor_ip == '127.0.0.1'){

	$dir = "/home/sisbackup/$setor_nome/$comp_nome_usuario/";	
	$abre_dir = ($_GET['dir'] != '' ? $_GET['dir'] : $dir);
	$open_dir = dir($abre_dir);

	echo "<table class='table table-striped table-bordered table-hover'>";
	
	while($arq = $open_dir ->read()){

	echo "<tr>";
	echo "<td>.$arq.</td>";
	echo "</tr>";	
		


	}

	echo "</table>";

	$open_dir -> close();
	

}	





?>