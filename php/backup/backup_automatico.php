<?php

// Arquivo de conexao com o banco de dados
include('../conexao/conexao.php');
include('funcoesPhp.php');

// Pegando dia da semana
$dia_semana = date("D");
$data_aux;

switch ($dia_semana) {

	case 'Sun':	$data_aux = "comp_dia_0";break;
	case 'Mon': $data_aux = "comp_dia_1";break;
	case 'Tue': $data_aux = "comp_dia_2";break;
	case 'Wed': $data_aux = "comp_dia_3";break;
	case 'Thu': $data_aux = "comp_dia_4";break;
	case 'Fri': $data_aux = "comp_dia_5";break;
	case 'Sat': $data_aux = "comp_dia_6";break;

	default:
	echo "";
	break;
}

// Pegando hora do backup
$hora = date("H");
$hora_aux;

switch ($hora) {

	case '00': $hora_aux = "0";break;
	case '01': $hora_aux = "01";break;
	case '02': $hora_aux = "02";break;
	case '03': $hora_aux = "03";break;
	case '04': $hora_aux = "04";break;
	case '05': $hora_aux = "05";break;
	case '06': $hora_aux = "06";break;
	case '07': $hora_aux = "07";break;
	case '08': $hora_aux = "08";break;
	case '09': $hora_aux = "09";break;
	case '10': $hora_aux = "10";break;
	case '10': $hora_aux = "11";break;
	case '12': $hora_aux = "12";break;
	case '13': $hora_aux = "13";break;
	case '14': $hora_aux = "14";break;
	case '15': $hora_aux = "15";break;
	case '16': $hora_aux = "16";break;
	case '17': $hora_aux = "17";break;
	case '18': $hora_aux = "18";break;
	case '19': $hora_aux = "19";break;
	case '20': $hora_aux = "20";break;
	case '21': $hora_aux = "21";break;
	case '22': $hora_aux = "22";break;
	case '23': $hora_aux = "23";break;

	default:
	echo "";
	break;
}



/**********************************************************************
Pegar plataforma do sistema operacional do usuario selecionado;
Pegar dados do usuario que sera executado o backup;
Pegar documentos do usuario que serao copiados;
Pegar caminho dos documentos que serao copiados;
***********************************************************************/


$consulta = mysqli_query($conexao,"SELECT * FROM computadores A
	JOIN sistemas_operacionais B ON A.comp_sistema_operacional = B.sistema_operacional_id
	JOIN associar_doc_computador C ON A.comp_id = C.assoc_id_computador
	JOIN documentos D ON D.documento_id = C.assoc_id_documentos
	JOIN diretorio_documentos E ON E.diretorio_id_documentos = D.documento_id
	JOIN servidores F ON A.comp_servidor_backup = F.servidor_id
	JOIN setores G ON A.comp_setor = G.setor_id
	WHERE comp_hora_backup = $hora_aux AND $data_aux = 0 AND comp_backup_ativo = 'SIM' AND A.comp_sistema_operacional = E.diretorio_id_sistema_operacional  ORDER BY comp_nome_usuario");




while ($dados = mysqli_fetch_array($consulta)){

// Dados necessarios para o backup
	$data = date('d-m-Y');
	$hora = date('H:i:s');
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
	//$diretorio_documentos = str_replace(" ", "\ ", $diretorio_documentos);

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

// Montando compartilhamento do usuario
	$backup_status = "SUCESSO";
	$assunto = "Backup de arquivos";
	$msg = "<h3>Olá Administrador,</h3><br><h4> Segue informações referentes ao Backup de $comp_nome_usuario, do setor $setor_nome</h4><br><br><table data-mysignature-version='2018-08-25T13:21:30.840Z | 0' cellspacing='0' width='500' cellpadding='0' border='0'><tr>  <td style='font-size:1em;padding:0 0 0 12px;vertical-align: top;border-left: 1px solid #3d85c6;' valign='top'><table cellspacing='0' cellpadding='0' border='0' style='line-height: 1.4;font-family:'Lucida Console', Monaco, monospace;font-size:80%;color: #000001;'><tr><td><span style='font-weight: 600;font-size:1.5em;color:#3d85c6;'>Administração do Sistema</span></td></tr><tr><td style='color:#000001;padding: 8px 0;'> (32)99989 - 5800  |  SISBACKUP   </td></tr></table></td></tr></table>";

  $mount = shell_exec("sudo mount //$ip/HD /mnt/cliente -o username='$comp_usuario_adm',password='$senha',vers='2.1'");


//Verificar se o diretorio do usuario foi montado no /mnt/cliente
	$mntCliente = shell_exec("sh verifica_montagem.sh");

	if($mntCliente[0] == "e"){
		$backup_status = "FALHA";
		$registro_anterior = date("Y-m-d");

	} else {
		// Excluindo arquivo de log caso exista
			$mv = shell_exec("rm -rf /var/www/html/sisbackup/log/$data/'$comp_nome_usuario.txt'");
			// Criando Pasta para guardar os arquivos de log
			$criaPasta = shell_exec("sudo mkdir -p /var/www/html/sisbackup/log/'$data';sudo chown -R www-data:www-data /var/www/html/sisbackup/log/'$data';sudo chmod 777 -R /var/www/html/sisbackup/log/'$data'");
		//Criando novo arquivo de log
			$log = "/var/www/html/sisbackup/log/$data/'$comp_nome_usuario.txt'";
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

// Montando compartilhamento do usuario
		$mount = shell_exec("sudo mount //$ip/HD /mnt/cliente -o username='$comp_usuario_adm',password='$senha',vers='2.1'");

// Se o servidor do usuario for local,o backup sera feito no proprio servidor de aplicacao

		if($servidor_ip == "127.0.0.1"){

			$pastaNomeSetor = shell_exec("mkdir -p /home/$servidor_nome_compartilhamento/'$setor_nome'");
			$rsync = shell_exec("sudo rsync -Crazvpt $exclude /mnt/cliente/'$diretorio_documentos' /home/$servidor_nome_compartilhamento/'$setor_nome'/'$comp_nome_usuario' >>$log");


// Se o servidor remoto for windows, montamos o compartilhamento no mnt/servidor e executamos o rsync do /mn/cliente para o /mnt/servidor

		} else {

			if($servidor_plataforma == "Windows"){

				$mountsrv = shell_exec("sudo mount //$servidor_ip/$servidor_nome_compartilhamento /mnt/servidor -o username='$servidor_user_privilegio',password='$servidor_senha_acesso',vers='2.1'");
				$pastaNomeSetor = shell_exec("sudo mkdir -p /mnt/servidor/'$setor_nome'");
				$rsync = shell_exec("sudo rsync -Crazvpt $exclude /mnt/cliente/'$diretorio_documentos' /mnt/servidor/'$setor_nome'/'$comp_nome_usuario' >>$log");


// Se o servidor remoto for linux,executamos apenas o rsync
			} else if ($servidor_plataforma == "Linux"){

				$comp_nome_usuario_novo = str_replace(" ", "\\ ", "$comp_nome_usuario");
				$connection = ssh2_connect($servidor_ip, 22); ssh2_auth_password($connection, $servidor_user_privilegio,$servidor_senha_acesso); $stream = ssh2_exec($connection, "mkdir -p /home/$servidor_nome_compartilhamento/'$setor_nome'; chmod -R 777 /home/$servidor_nome_compartilhamento/ ; chown -R www-data:www-data /home/$servidor_nome_compartilhamento/", false); stream_set_blocking ($stream, true);
				$rsync = shell_exec("sudo rsync -Crazvpt $exclude /mnt/cliente/'$diretorio_documentos' ssh $servidor_user_privilegio@$servidor_ip:/home/$servidor_nome_compartilhamento/'$setor_nome'/'$comp_nome_usuario_novo' >>$log ");

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

				$mountsrv = shell_exec("sudo mount //$servidor_ip/$servidor_nome_compartilhamento /mnt/servidor -o username='$servidor_user_privilegio',password='$servidor_senha_acesso',vers='2.1'");
				$criaPasta = shell_exec("sudo mkdir -p /mnt/servidor/'$setor_nome'");
				$rsync = shell_exec("sudo rsync -Crazvpt $exclude $comp_usuario_adm@$ip:/'$diretorio_documentos' /mnt/servidor/'$setor_nome'/'$comp_nome_usuario' >>$log");
				$umount = shell_exec("sudo umount /mnt/servidor");


			} else if ($servidor_plataforma == "Linux"){

				$con = ssh2_connect('$servidor_ip',22);
				$ssh = ssh2_auth_password($con, '$servidor_user_privilegio', '$servidor_senha_acesso');

				foreach ($documentos as $value) {

					$rsync = shell_exec("sudo rsync -Crazvpt $exclude root@$ip:/'$diretorio_documentos' /home/$servidor_nome_compartilhamento/'$comp_nome_usuario' >>$log");
				}
			}
		}
	}

// Ajustando tabela de controle de backups (backups_realizados)
	$registro_anterior = date("Y-m-d");
	$delete = mysqli_query($conexao, "DELETE FROM backups_realizados WHERE backup_id_computador = '$comp_id' and backup_data like '%$registro_anterior%' and backup_origem = 'AUTOMATICO' ");
	$insert = mysqli_query($conexao, "INSERT INTO backups_realizados VALUES (DEFAULT,'$comp_id',NOW(),'AUTOMATICO','$backup_status')");


}


	if($comp_desliga_computador == "SIM" AND $plataforma == "WINDOWS"){

		$mensagensLog = shell_exec("echo '\nDesligando computador ... - $hora \n \n' >>$log ");

		$script = fopen("/var/www/html/sisbackup/php/backup/desligar.sh", "w");
//fwrite($script, "#!/usr/bin/expect\n");
		fwrite($script, "spawn telnet $ip\n");
		fwrite($script, "expect \"login:\"\n");
		fwrite($script, "send \"$comp_usuario_adm\\r\"\n");
		fwrite($script, "expect \"password:\"\n");
		fwrite($script, "send \"$senha\\r\"\n");
		fwrite($script, "expect -r \">\"\n");
		fwrite($script, "send \"shutdown -s -f -t 01\\r\"\n");
		fwrite($script, "expect eof\n");
		fclose($script);
		exec("expect -f /var/www/html/sisbackup/php/backup/desligar.sh", $erro);
		return $erro[13];


	} else if($comp_desliga_computador == "SIM" AND $plataforma == "LINUX"){

		$connection = ssh2_connect($ip, 22); ssh2_auth_password($connection,$comp_usuario_adm,$senha); $stream = ssh2_exec($connection, "sudo poweroff ", false); stream_set_blocking ($stream, true);
	}

/********************************* Preparando para enviar email para o admin *******************************************************/

// Compactando o diretorio com os logs de backup

$compactar = shell_exec("sh /var/www/html/sisbackup/log/compacta.sh");

/***************************************************** Enviando Email *******************************************************/
$backup_origem = "AUTOMATICO";
enviar_email_log_backup($comp_nome_usuario,$setor_nome,$assunto,$data,$msg,$backup_origem);


?>
