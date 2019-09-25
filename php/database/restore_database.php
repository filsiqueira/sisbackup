<?php

// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];


include('../conexao/conexao.php');

$registro_backup_id = mysqli_escape_string($conexao,$_POST['registro_backup_id']);

$sql = mysqli_query($conexao,"SELECT registro_backup FROM registro_backup WHERE registro_backup_id = '$registro_backup_id' ");

$arquivo_backup = mysqli_fetch_array($sql);

$restore = shell_exec("sudo mysql -u root -p05ad00sp sisbackup < /var/www/html/sisbackup/php/database/backups/'$arquivo_backup[registro_backup]'");

// Inserindo na tabela de auditoria de ações
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','restore','Restore de Banco de Dados',NOW(),'Backup do Banco de Dados restaurado por $usuario') ");

if (!$registraAcao){

echo "false";
exit();

}

?>
