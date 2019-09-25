<?php

// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

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
if($comp_id == "todos"){

$consulta = mysqli_query($conexao, "SELECT * FROM computadores A 
    JOIN sistemas_operacionais B ON A.comp_sistema_operacional = B.sistema_operacional_id 
    JOIN associar_doc_computador C ON A.comp_id = C.assoc_id_computador
    JOIN documentos D ON D.documento_id = C.assoc_id_documentos
    JOIN diretorio_documentos E ON E.diretorio_id_documentos = D.documento_id
    JOIN servidores F ON A.comp_servidor_backup = F.servidor_id
    JOIN setores G ON A.comp_setor = G.setor_id
    WHERE A.comp_sistema_operacional = E.diretorio_id_sistema_operacional");

} else {


$consulta = mysqli_query($conexao, "SELECT * FROM computadores A 
    JOIN sistemas_operacionais B ON A.comp_sistema_operacional = B.sistema_operacional_id 
    JOIN associar_doc_computador C ON A.comp_id = C.assoc_id_computador
    JOIN documentos D ON D.documento_id = C.assoc_id_documentos
    JOIN diretorio_documentos E ON E.diretorio_id_documentos = D.documento_id
    JOIN servidores F ON A.comp_servidor_backup = F.servidor_id
    JOIN setores G ON A.comp_setor = G.setor_id
    WHERE comp_id = '$comp_id' AND A.comp_sistema_operacional = E.diretorio_id_sistema_operacional");

}

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
    $comp_email = $dados['comp_email'];
    $comp_liga_computador = $dados['comp_liga_computador'];
    $comp_desliga_computador = $dados['comp_desliga_computador'];
    $comp_mac = $dados['comp_mac'];
    $servidor_ip = $dados['servidor_ip'];
    $servidor_nome_compartilhamento = $dados['servidor_nome_compartilhamento'];
    $servidor_plataforma = $dados['servidor_plataforma'];
    $servidor_user_privilegio = $dados['servidor_user_privilegio'];
    $servidor_senha_acesso = base64_decode($dados['servidor_senha_acesso']);
    $comp_usuario_adm = $dados['comp_usuario_adm'];
    $comp_backup_ativo = $dados['comp_backup_ativo'];
    $nome_setor = $dados['setor_nome'];




    // Ajustando diretorio dos documentos   

    $diretorio_documentos = str_replace("C:/", "", $diretorio_documentos);
    $diretorio_documentos = str_replace("c:/", "", $diretorio_documentos);
    $diretorio_documentos = str_replace("Usuario", $usuario, $diretorio_documentos);
    $diretorio_documentos = str_replace("usuario", $usuario, $diretorio_documentos);
    $diretorio_documentos = str_replace(" ", "\ ", $diretorio_documentos);

    
    if($comp_backup_ativo == 'NÃO'){

        echo "inativo";
        exit();

    }


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

            $rsync = shell_exec("sudo rsync -Crazvpt --delete /mnt/cliente/'$diretorio_documentos' /home/$servidor_nome_compartilhamento/'$nome_setor'/'$comp_nome_usuario' >>$log");

// Se o servidor remoto for windows, montamos o compartilhamento no mnt/servidor e executamos o rsync do /mn/cliente para o /mnt/servidor

        } else {

            if($servidor_plataforma == "Windows"){

                $mountsrv = shell_exec("sudo mount //$servidor_ip/$servidor_nome_compartilhamento /mnt/servidor -o username='$servidor_user_privilegio',password='$servidor_senha_acesso'");    

                $rsync = shell_exec("sudo rsync -Crazvpt --delete /mnt/cliente/'$diretorio_documentos' /mnt/servidor/'$nome_setor'/'$comp_nome_usuario' >>$log");


// Se o servidor remoto for linux,executamos apenas o rsync
            } else if ($servidor_plataforma == "Linux"){

                $comp_nome_usuario_novo = str_replace(" ", "\\ ", "$comp_nome_usuario");

                $rsync = shell_exec("sudo rsync -Crazvpt --delete /mnt/cliente/'$diretorio_documentos' ssh  $servidor_user_privilegio@$servidor_ip:/home/$servidor_nome_compartilhamento/'$nome_setor'/'$comp_nome_usuario_novo' >>$log");  

            }
        }


// Desmontando os compartilhamentos
        $umount = shell_exec("sudo umount /mnt/cliente");
        $umount = shell_exec("sudo umount /mnt/servidor");


    } else if($plataforma == "LINUX"){

// Se a plataforma for Linux,utilizamos o sshpass para conectar via ssh na maquina

        if($servidor_ip == "127.0.0.1"){

            $rsync = shell_exec("sudo rsync -Crazvpt --delete root@$ip:/'$diretorio_documentos' /home/$servidor_nome_compartilhamento/'$nome_setor'/'$comp_nome_usuario' >>$log");

        } else {


            if($servidor_plataforma == "Windows"){
 
                $mountsrv = shell_exec("sudo mount //$servidor_ip/$servidor_nome_compartilhamento /mnt/servidor -o username='$servidor_user_privilegio',password='$servidor_senha_acesso'");    

                $rsync = shell_exec("sudo rsync -Crazvpt --delete root@$ip:/'$diretorio_documentos' /mnt/servidor/'$nome_setor'/'$comp_nome_usuario' >>$log");
                
                $umount = shell_exec("sudo umount /mnt/servidor");
            
            } else if ($servidor_plataforma == "Linux"){

               $connection = ssh2_connect($servidor_ip, 22); ssh2_auth_password($connection, $servidor_user_privilegio,$servidor_senha_acesso); $stream = ssh2_exec($connection, "rsync -Crazvpt --delete $comp_usuario_adm@$ip:/'$diretorio_documentos' /home/$servidor_nome_compartilhamento/'$nome_setor'/'$comp_nome_usuario' ", false); stream_set_blocking ($stream, true); 
            }
        }
    }

}

// Inserindo na tabela de auditoria de ações 
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','reduz_backup','Reduzir Backup',NOW(),'Backup do usuário $comp_nome_usuario reduzido por $usuario') ");

if (!$registraAcao){

echo "false";   
exit();

}

?>