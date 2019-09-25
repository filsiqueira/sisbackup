<?php

//Incluindo arquivo de conexão com o banco de dados
include('../conexao/conexao.php');

$comp_id = $_POST['comp_id'];
$servidor_id = $_POST['servidor_id'];



// Verificando se o servidor de destino é igual ao servidor atual

$sql = mysqli_query($conexao,"SELECT comp_servidor_backup FROM computadores WHERE comp_servidor_backup = '$servidor_id' AND comp_id = '$comp_id' ");

$linhas = mysqli_num_rows($sql);

if($linhas != 0){

	echo "servidor_igual";
	exit;
}

/* Buscando os dados do usuário selecionado	
	
	*Nome
	*Setor
*/

$buscar = mysqli_query($conexao,"SELECT comp_nome_usuario,comp_setor FROM computadores WHERE comp_id = '$comp_id' ");
$dados_usuario = mysqli_fetch_array($buscar);

$nome_usuario = $dados_usuario['comp_nome_usuario'];	
$setor        = $dados_usuario['comp_setor'];


/* Buscando dados do servidor de origem do usuario selecionado

	*IP
	*Nome do Compartilhamento
	*Usuario Adm
	*Senha Adm

*/

$buscar = mysqli_query($conexao,"SELECT servidor_ip,servidor_nome_compartilhamento,servidor_user_privilegio,servidor_senha_acesso,servidor_plataforma FROM servidores A JOIN computadores B ON A.servidor_id = B.comp_servidor_backup WHERE comp_id = '$comp_id' ");
$dados_servidor_origem = mysqli_fetch_array($buscar);

$ip_servidor_origem = $dados_servidor_origem['servidor_ip'];
$compart_servidor_origem = $dados_servidor_origem['servidor_nome_compartilhamento'];
$user_adm_servidor_origem = $dados_servidor_origem['servidor_user_privilegio'];
$senha_acesso_servidor_origem = $dados_servidor_origem['servidor_senha_acesso'];
$plataforma_servidor_origem = $dados_servidor_origem['servidor_plataforma'];


/* Buscando dados do servidor de destino escolhido

	*IP
	*Nome do Compartilhamento
	*Usuario Adm
	*Senha Adm

*/

$buscar = mysqli_query($conexao,"SELECT servidor_ip,servidor_nome_compartilhamento,servidor_user_privilegio,servidor_senha_acesso,servidor_plataforma FROM servidores WHERE servidor_id = '$servidor_id' ");
$dados_servidor_destino = mysqli_fetch_array($buscar);

$ip_servidor_destino = $dados_servidor_destino['servidor_ip'];
$compart_servidor_destino = $dados_servidor_destino['servidor_nome_compartilhamento'];
$user_adm_servidor_destino = $dados_servidor_destino['servidor_user_privilegio'];
$senha_acesso_servidor_destino = base64_decode($dados_servidor_destino['servidor_senha_acesso']);
$plataforma_servidor_destino = $dados_servidor_destino['servidor_plataforma'];




/* Inicio da Transferencia dos arquivos
	
	* Verificando se o Servidor de destino é windows

*/

if($plataforma_servidor_destino == 'Windows'){

//Montando compartilhamento do servidor de destino
$mount = shell_exec("sudo mount //$ip_servidor_destino/$compart_servidor_destino /mnt/cliente -o username='$user_adm_servidor_destino',password='$senha_acesso_servidor_destino' ");

}


?>