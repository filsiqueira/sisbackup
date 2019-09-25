<?php
// Arquivo de conexao com o banco de dados
include('../conexao/conexao.php');
include('funcoesPhp.php');
// Dados de entrada
$comp_id = $_POST['comp_id'];

/**********************************************************************
Pegar plataforma do sistema operacional do usuario selecionado;
Pegar dados do usuario que sera executado o backup;
Pegar documentos do usuario que serao copiados;
Pegar caminho dos documentos que serao copiados;
***********************************************************************/
$consulta = mysqli_query($conexao, "SELECT * FROM computadores A
	JOIN sistemas_operacionais B ON A.comp_sistema_operacional = B.sistema_operacional_id
	JOIN associar_doc_computador C ON A.comp_id = C.assoc_id_computador
	JOIN documentos D ON D.documento_id = C.assoc_id_documentos
	JOIN diretorio_documentos E ON E.diretorio_id_documentos = D.documento_id
	JOIN servidores F ON A.comp_servidor_backup = F.servidor_id
	JOIN setores G ON A.comp_setor = G.setor_id
	JOIN associar_extensao_arquivo_computador H ON A.comp_id = H.associar_computador_id
	WHERE comp_id = '$comp_id' AND A.comp_sistema_operacional = E.diretorio_id_sistema_operacional");

// Pegando as extensões que não devem ser copiadas

$extensao = mysqli_query($conexao,"SELECT extensao_arquivo FROM extensao_arquivo A
JOIN associar_extensao_arquivo_computador B ON A.extensao_arquivo_id = B.associar_extensao_id
JOIN computadores C ON B.associar_computador_id = C.comp_id
WHERE B.associar_computador_id = '$comp_id' ");

$extensoes = mysqli_fetch_all($extensao);
$exclude="";

for ($i=0; $i < count($extensoes) ; $i++) {

	$exclude.= "--exclude '*".$extensoes[$i][0]."' ";

}


// Iniciando o Backup

while ($dados = mysqli_fetch_array($consulta)){

// Dados necessarios para o backup
	$data = date('d-m-Y');
	$hora = date('H:i:s');
	$plataforma = $dados['sistema_operacional_plataforma'];
	$ip = $dados['comp_ip'];
	$usuario = $dados['comp_login'];
	$senha = base64_decode($dados['comp_senha']);
	$documentos[] = $dados['documento_nome'];
	$comp_nome_usuario = $dados['comp_nome_usuario'];
	$comp_liga_computador = $dados['comp_liga_computador'];
	$comp_desliga_computador = $dados['comp_desliga_computador'];
	$comp_id = $_POST['comp_id'];
	$comp_mac = $dados['comp_mac'];
	$servidor_ip = $dados['servidor_ip'];
	$servidor_nome_compartilhamento = $dados['servidor_nome_compartilhamento'];
	$servidor_plataforma = $dados['servidor_plataforma'];
	$servidor_user_privilegio = $dados['servidor_user_privilegio'];
	$servidor_senha_acesso = base64_decode($dados['servidor_senha_acesso']);
	$comp_usuario_adm = $dados['comp_usuario_adm'];
	$comp_backup_ativo = $dados['comp_backup_ativo'];
	$diretorio_documentos = $dados['diretorio_documentos'];
	$setor_nome = $dados['setor_nome'];
	$backup_origem = "MANUAL";



	// Ajustando diretorio dos documentos

	$usuarioAjustado = $usuario."/";
	$diretorio_documentos = str_replace("C:/", "", $diretorio_documentos);
	$diretorio_documentos = str_replace("c:/", "", $diretorio_documentos);
	$diretorio_documentos = str_replace("usuario/", $usuarioAjustado, $diretorio_documentos);
	$diretorio_documentos = str_replace("Usuario/", $usuarioAjustado, $diretorio_documentos);
	$diretorio_documentos = str_replace("usuario/", $usuarioAjustado, $diretorio_documentos);
	$diretorio_documentos = str_replace("Usuario/", $usuarioAjustado, $diretorio_documentos);
	//$diretorio_documentos = str_replace(" ", "\ ", $diretorio_documentos);



// Verifica se o status do backup está ativo

	if($comp_backup_ativo == 'NÃO'){

		echo "inativo";
		exit();

	}

// Montando compartilhamento do usuario
	$backup_status = "SUCESSO";
	$assunto = "Backup de arquivos - $comp_nome_usuario";
	$msg = "<h3>Olá Administrador,</h3><br><h4> Segue informações referentes ao Backup de $comp_nome_usuario, do setor $setor_nome</h4><br><br><table data-mysignature-version='2018-08-25T13:21:30.840Z | 0' cellspacing='0' width='500' cellpadding='0' border='0'><tr>  <td style='font-size:1em;padding:0 0 0 12px;vertical-align: top;border-left: 1px solid #3d85c6;' valign='top'><table cellspacing='0' cellpadding='0' border='0' style='line-height: 1.4;font-family:'Lucida Console', Monaco, monospace;font-size:80%;color: #000001;'><tr><td><span style='font-weight: 600;font-size:1.5em;color:#3d85c6;'>Administração do Sistema</span></td></tr><tr><td style='color:#000001;padding: 8px 0;'> (32)99989 - 5800  |  SISBACKUP   </td></tr></table></td></tr></table>";

  $mount = shell_exec("sudo mount //$ip/HD /mnt/cliente -o username='$comp_usuario_adm',password='$senha'");
// Criando Pasta para guardar os arquivos de log
	$criaPasta = shell_exec("sudo mkdir -p /var/www/html/sisbackup/log/'$data';sudo chown -R www-data:www-data /var/www/html/sisbackup/log/'$data';sudo chmod 777 -R /var/www/html/sisbackup/log/'$data'");
	$criaLog = shell_exec("sudo touch /var/www/html/sisbackup/log/$data/'$comp_nome_usuario.txt'");
	$log = "/var/www/html/sisbackup/log/$data/'$comp_nome_usuario.txt'";

//Verificar se o diretorio do usuario foi montado no /mnt/cliente
	$mntCliente = shell_exec("sh verifica_montagem.sh");

	if($mntCliente[0] == "e"){
		$backup_status = "FALHA";
		$assunto = "Falha no Backup";
		$msg = "<h3>Olá Administrador,</h3><br><h4> Falha ao executar o backup de $comp_nome_usuario, do setor $setor_nome</h4><br><br><table data-mysignature-version='2018-08-25T13:21:30.840Z | 0' cellspacing='0' width='500' cellpadding='0' border='0'><tr>  <td style='font-size:1em;padding:0 0 0 12px;vertical-align: top;border-left: 1px solid #3d85c6;' valign='top'><table cellspacing='0' cellpadding='0' border='0' style='line-height: 1.4;font-family:'Lucida Console', Monaco, monospace;font-size:80%;color: #000001;'><tr><td><span style='font-weight: 600;font-size:1.5em;color:#3d85c6;'>Administração do Sistema</span></td></tr><tr><td style='color:#000001;padding: 8px 0;'> (32)99989 - 5800  |  SISBACKUP   </td></tr></table></td></tr></table>";
		$insert = mysqli_query($conexao, "INSERT INTO backups_realizados VALUES (DEFAULT,'$comp_id',NOW(),'MANUAL','$backup_status')");

		enviar_email_log_backup($comp_nome_usuario,$setor_nome,$assunto,$data,$msg,$backup_origem);
		echo "erro_montagem";
		exit();

	}


	/******************************************************** Executando o Backup *******************************************************/
// Se precisar ligar a maquina, executa o comando wakeonlan e aguarda 3 minutos para continuar a executar o script

	if($comp_liga_computador == "SIM"){

		$mensagensLog = shell_exec("echo '\nLigando computador ... - $hora \n' >>$log ");

		$ligar= shell_exec("sudo wakeonlan $comp_mac");

		sleep(180);
	}

	if ($plataforma == 'WINDOWS'){

// Mensagem de inicio de backup
		$mensagensLog = shell_exec("echo '\n \nRotina de Backup iniciada às - $hora \n \n' >>$log ");

// Se o servidor do usuario for local,o backup sera feito no proprio servidor de aplicacao

		if($servidor_ip == "127.0.0.1"){

			$pastaNomeSetor = shell_exec("mkdir -p /home/$servidor_nome_compartilhamento/'$setor_nome'");
			$rsync = shell_exec("sudo rsync -Crazvpt $exclude /mnt/cliente/'$diretorio_documentos' /home/$servidor_nome_compartilhamento/'$setor_nome'/'$comp_nome_usuario' >>$log");


// Se o servidor remoto for windows, montamos o compartilhamento no mnt/servidor e executamos o rsync do /mnt/cliente para o /mnt/servidor

		} else {


			if($servidor_plataforma == "Windows"){

				$mountsrv = shell_exec("sudo mount //$servidor_ip/$servidor_nome_compartilhamento /mnt/servidor -o username='$servidor_user_privilegio',password='$servidor_senha_acesso'");
				$pastaNomeSetor = shell_exec("sudo mkdir -p /mnt/servidor/'$setor_nome'");
				$rsync = shell_exec("sudo rsync -Crazvpt $exclude /mnt/cliente/'$diretorio_documentos' /mnt/servidor/'$setor_nome'/'$comp_nome_usuario' >>$log");


// Se o servidor remoto for linux,executamos apenas o rsync

			} else if ($servidor_plataforma == "Linux"){

				$comp_nome_usuario_novo = str_replace(" ", "\\ ", "$comp_nome_usuario");
				$setor_nome_ajustado = "'$setor_nome'";
    		$connection = ssh2_connect($servidor_ip, 22); ssh2_auth_password($connection, $servidor_user_privilegio,$servidor_senha_acesso); $stream = ssh2_exec($connection, "mkdir -p /home/$servidor_nome_compartilhamento/$setor_nome_ajustado; chmod -R 777 /home/$servidor_nome_compartilhamento/ ; chown -R www-data:www-data /home/$servidor_nome_compartilhamento/", false); stream_set_blocking ($stream, true);
     		$rsync = shell_exec("sudo rsync -Crazvpt $exclude /mnt/cliente/'$diretorio_documentos' ssh $servidor_user_privilegio@$servidor_ip:/home/$servidor_nome_compartilhamento/$setor_nome_ajustado/'$comp_nome_usuario_novo'/ >>$log ");

			}
		}


// Desmontando os compartilhamentos
		$umount = shell_exec("sudo umount /mnt/cliente");
		$umount = shell_exec("sudo umount /mnt/servidor");


	} else if($plataforma == "LINUX"){

// Se a plataforma for Linux,utilizamos o sshpass para conectar via ssh na maquina

		if($servidor_ip == "127.0.0.1"){


			// Ajustando diretorios e realizando o backup

			$diretorio_documentos = str_replace("usuario", "$comp_nome_usuario", "$diretorio_documentos");
			$criaPasta = shell_exec("mkdir -p /home/$servidor_nome_compartilhamento/'$setor_nome'");
			$rsync = shell_exec("sudo rsync -Crazvpt $exclude $comp_usuario_adm@$ip:/'$diretorio_documentos' /home/$servidor_nome_compartilhamento/'$setor_nome'/'$comp_nome_usuario' >>$log");

		} else {


			if($servidor_plataforma == "Windows"){

				$mountsrv = shell_exec("sudo mount //$servidor_ip/$servidor_nome_compartilhamento /mnt/servidor -o username='$servidor_user_privilegio',password='$servidor_senha_acesso'");
				$criaPasta = shell_exec("sudo mkdir -p /mnt/servidor/'$setor_nome'");
				$rsync = shell_exec("sudo rsync -Crazvpt $exclude $comp_usuario_adm@$ip:/'$diretorio_documentos' /mnt/servidor/'$setor_nome'/'$comp_nome_usuario' >>$log");
				$umount = shell_exec("sudo umount /mnt/servidor");

			} else if ($servidor_plataforma == "Linux"){

				$comp_nome_usuario_novo = str_replace(" ", "\\ ", "$comp_nome_usuario");
				$connection = ssh2_connect($servidor_ip, 22); ssh2_auth_password($connection, $servidor_user_privilegio,$servidor_senha_acesso); $stream = ssh2_exec($connection, "mkdir -p /home/$servidor_nome_compartilhamento/'$setor_nome'; chmod -R 777 /home/$servidor_nome_compartilhamento/'$setor_nome' ; chown -R www-data:www-data /home/$servidor_nome_compartilhamento/'$setor_nome'; rsync -Crazvpt --exclude '*$extensao_arquivo' $comp_usuario_adm@$ip:/'$diretorio_documentos' /home/$servidor_nome_compartilhamento/'$setor_nome'/$comp_nome_usuario_novo", false); stream_set_blocking ($stream, true);



			}
		}
	}

}

// Ajustando tabela de controle de backups (backups_realizados)

//$delete = mysqli_query($conexao, "DELETE FROM backups_realizados WHERE backup_id_computador = '$comp_id' and backup_data = ");
$insert = mysqli_query($conexao, "INSERT INTO backups_realizados VALUES (DEFAULT,'$comp_id',NOW(),'MANUAL','$backup_status')");


if($comp_desliga_computador == "SIM" AND $plataforma == "WINDOWS"){

	$mensagensLog = shell_exec("echo '\nDesligando computador ... - $hora \n \n' >>$log ");

	$script = fopen("/var/www/html/sisbackup/paginas/backup/desligar.sh", "w");

	fwrite($script, "spawn telnet $ip\n");
	fwrite($script, "expect \"login:\"\n");
	fwrite($script, "send \"$comp_usuario_adm\\r\"\n");
	fwrite($script, "expect \"password:\"\n");
	fwrite($script, "send \"$senha\\r\"\n");
	fwrite($script, "expect -r \">\"\n");
	fwrite($script, "send \"shutdown -s -f -t 01\\r\"\n");
	fwrite($script, "expect eof\n");
	fclose($script);
	exec("expect -f /var/www/html/sisbackup/paginas/backup/desligar.sh", $erro);
	return $erro[13];


} else if($comp_desliga_computador == "SIM" AND $plataforma == "LINUX"){

	$connection = ssh2_connect($ip, 22); ssh2_auth_password($connection,$comp_usuario_adm,$senha); $stream = ssh2_exec($connection, "poweroff ", false); stream_set_blocking ($stream, true);

}
/***************************************************** Enviando Email *******************************************************/

enviar_email_log_backup($comp_nome_usuario,$setor_nome,$assunto,$data,$msg,$backup_status);
?>
