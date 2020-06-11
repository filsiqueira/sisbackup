<?php

// Iniciando sessão
session_start();

// Recuperando usuario logado
$usuario = $_SESSION['login'];

include('../conexao/conexao.php');


$data = date('d-m-Y');
$hora = date('H:i:s');

$registro_backup = "sisbackup-".$data."-".$hora.".sql";

$grava_backup = mysqli_query($conexao,"INSERT INTO registro_backup (registro_backup_id,registro_backup) VALUES (DEFAULT,'$registro_backup')");

$backup = shell_exec("mysqldump -u root -pColoqueSuaSenhaAqui sisbackup > /var/www/html/sisbackup/php/database/backups/sisbackup-$data-$hora.sql");

$arquivo = "../database/backups/sisbackup-$data-$hora.sql";

// Inserindo na tabela de auditoria de ações
$registraAcao = mysqli_query($conexao,"INSERT INTO auditoria_acoes (auditoria_id, auditoria_usuario, auditoria_acao, auditoria_tela, auditoria_data_hora, auditoria_descricao) VALUES (DEFAULT,'$usuario','backup','Backup de Banco de Dados',NOW(),'Backup do Banco de Dados executado por $usuario') ");

if (!$registraAcao){

echo "false";
exit();

}
echo json_encode($arquivo);

?>
