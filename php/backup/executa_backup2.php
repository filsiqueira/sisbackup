<?php
// Arquivo de conexao com o banco de dados
include ('../conexao/conexao.php');
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
	WHERE comp_id = '$comp_id' AND A.comp_sistema_operacional = E.diretorio_id_sistema_operacional");

while ($dados = mysqli_fetch_array($consulta)){

// Dados necessarios para o backup
	$data = date('d-m-Y');
	$hora = date('H:i:s');
	$plataforma = $dados['sistema_operacional_plataforma'];
	$ip = $dados['comp_ip'];
	$usuario = $dados['comp_login'];
	$senha = $dados['comp_senha'];
	$documentos[] = $dados['documento_nome'];
	$diretorio_documentos = $dados['diretorio_documentos'];
	$comp_nome_usuario = $dados['comp_nome_usuario'];
	$comp_liga_computador = $dados['comp_liga_computador'];
	$comp_desliga_computador = $dados['comp_desliga_computador'];
	$comp_mac = $dados['comp_mac'];
	$servidor_ip = $dados['servidor_ip'];
	$servidor_nome_compartilhamento = $dados['servidor_nome_compartilhamento'];
	$servidor_plataforma = $dados['servidor_plataforma'];
	$servidor_user_privilegio = $dados['servidor_user_privilegio'];
	$servidor_senha_acesso = base64_decode($dados['servidor_senha_acesso']);
	$comp_usuario_adm = $dados['comp_usuario_adm'];


// Criando Pasta para guardar os arquivos de log
	$criaPasta = shell_exec("mkdir -p /var/www/html/sisbackup/log/'$data'");
	$log = "/var/www/html/sisbackup/log/$data/'$comp_nome_usuario.txt'";
	$mensagensLog = array();

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
		$mount = shell_exec("sudo mount //$ip/HD /mnt/cliente -o username='$comp_usuario_adm',password='$senha'");

// Se o servidor do usuario for local,o backup sera feito no proprio servidor de aplicacao

		if($servidor_ip == "127.0.0.1"){

			foreach ($documentos as $value) {
				
			
			$rsync = shell_exec("sudo rsync -Crazvpt /mnt/cliente/Users/'$usuario'/$diretorio_documentos /home/$servidor_nome_compartilhamento/'$comp_nome_usuario' >>$log");

		}
// Se o servidor remoto for windows, montamos o compartilhamento no mnt/servidor e executamos o rsync do /mn/cliente para o /mnt/servidor

		} else {

			if($servidor_plataforma == "Windows"){

				$mountsrv = shell_exec("sudo mount //$servidor_ip/$servidor_nome_compartilhamento /mnt/servidor -o username='$servidor_user_privilegio',password='$servidor_senha_acesso'"); 	

				foreach ($documentos as $value) {
				
				$rsync = shell_exec("sudo rsync -Crazvpt /mnt/cliente/Users/'$usuario'/$diretorio_documentos /mnt/servidor/'$comp_nome_usuario' >>$log");
			}

// Se o servidor remoto for linux,executamos apenas o rsync
			} else if ($servidor_plataforma == "Linux"){

				$comp_nome_usuario_novo = str_replace(" ", "\\ ", "$comp_nome_usuario");

				foreach ($documentos as $value) {
			
				$rsync = shell_exec("sudo rsync -Crazvpt /mnt/cliente/Users/'$usuario'/$diretorio_documentos ssh  $servidor_user_privilegio@$servidor_ip:/home/$servidor_nome_compartilhamento/'$comp_nome_usuario_novo' >>$log");	
			}
			}
		}


// Desmontando os compartilhamentos
		$umount = shell_exec("sudo umount /mnt/cliente");
		$umount = shell_exec("sudo umount /mnt/servidor");


	} else if($plataforma == "LINUX"){

// Se a plataforma for Linux,utilizamos o sshpass para conectar via ssh na maquina

		if($servidor_ip == "127.0.0.1"){

			foreach ($documentos as $value) {
			

			$rsync = shell_exec("sudo rsync -Crazvpt root@$ip:/home/$usuario/$diretorio_documentos /home/$servidor_nome_compartilhamento/'$comp_nome_usuario' >>$log");

		}

		} else {


			if($servidor_plataforma == "Windows"){
 
				$mountsrv = shell_exec("sudo mount //$servidor_ip/$servidor_nome_compartilhamento /mnt/servidor -o username='$servidor_user_privilegio',password='$servidor_senha_acesso'"); 	

				foreach ($documentos as $value) {
				
				$rsync = shell_exec("sudo rsync -Crazvpt root@$ip:/home/$usuario/$diretorio_documentos /mnt/servidor/'$comp_nome_usuario' >>$log");
				
				}

				$umount = shell_exec("sudo umount /mnt/servidor");
			
			} else if ($servidor_plataforma == "Linux"){

				$con = ssh2_connect('$servidor_ip',22);
				$ssh = ssh2_auth_password($con, '$servidor_user_privilegio', '$servidor_senha_acesso');

				foreach ($documentos as $value) {
				
				$rsync = shell_exec("sudo rsync -Crazvpt root@$ip:/home/$usuario/$diretorio_documentos /home/$servidor_nome_compartilhamento/'$comp_nome_usuario' >>$log");
			}
			}
		}
	}

}



if($comp_desliga_computador == "SIM" AND $plataforma == "WINDOWS"){ 

	$mensagensLog = shell_exec("echo '\nDesligando computador ... - $hora \n \n' >>$log ");   

	$script = fopen("/var/www/html/sisbackup/paginas/backup/desligar.sh", "w");
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
	exec("expect -f /var/www/html/sisbackup/paginas/backup/desligar.sh", $erro);
	return $erro[13];


} else if($comp_desliga_computador == "SIM" AND $plataforma == "LINUX"){

	$desliga = shell_exec("sshpass -p '$senha' ssh $usuario@$ip 'sudo shutdown -h now' ");

} 
/***************************************************** Enviando Email *******************************************************/

require_once '../../vendor/autoload.php';

$consulta = mysqli_query($conexao,"SELECT * FROM smtp");
$email = mysqli_fetch_array($consulta);
$smtp = $email['smtp_endereco'];
$porta = $email['smtp_porta'];
$username = $email['smtp_email_admin'];
$senha = base64_decode($email['smtp_senha']);
$msg = "<h3>Olá Administrador,</h3><br><h4> Segue informações referentes aos Backups realizados</h4><br><br><table data-mysignature-version='2018-08-25T13:21:30.840Z | 0' cellspacing='0' width='500' cellpadding='0' border='0'><tr>  <td style='font-size:1em;padding:0 0 0 12px;vertical-align: top;border-left: 1px solid #3d85c6;' valign='top'><table cellspacing='0' cellpadding='0' border='0' style='line-height: 1.4;font-family:'Lucida Console', Monaco, monospace;font-size:80%;color: #000001;'><tr><td><span style='font-weight: 600;font-size:1.5em;color:#3d85c6;'>Administração do Sistema</span></td></tr><tr><td style='color:#000001;padding: 8px 0;'> (32)99989 - 5800  |  SISBACKUP   </td></tr></table></td></tr></table>";

// Criando o transporte
$transport = (new Swift_SmtpTransport($smtp, $porta, 'tls'))->setUsername($username)->setPassword($senha);

// Crie o Mailer usando o seu transporte criado
$mailer = new Swift_Mailer($transport);

// Criando a mensagem
$message = (new Swift_Message('Backup de Arquivos  ' . $data))->setFrom([$username => 'Suporte SISBACKUP'])->setTo([$username])->setBody($msg, 'text/html');

// Anexando arquivo de log
$message -> attach (Swift_Attachment::fromPath("/var/www/html/sisbackup/log/$data/$comp_nome_usuario.txt"));

// Enviando email
$result = $mailer->send($message);

// Inserindo na tabela de controle de backups (backups_realizados)
$insert = mysqli_query($conexao, "INSERT INTO backups_realizados VALUES (DEFAULT,'$comp_id',NOW(),'MANUAL')");



?>