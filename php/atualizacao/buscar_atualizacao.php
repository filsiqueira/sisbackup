<?php

// Executando teste de comunicacao com o github
$conectado = @ fsockopen('github.com',80,$numeroErro,$stringErro,10);

if(!$conectado){
  die("verifique_conexao");

} else {

// Fazendo backup dos arquivos do sistema
$data = date('d-m-Y');
$pasta_bkp = "sisbackup-bkp-atualiza-".$data;
$bkp_arq = "cp -r /var/www/html/sisbackup /var/www/html/$pasta_bkp";
$bkp_arq_sistema = shell_exec($bkp_arq);

if(!is_dir("/var/www/html/$pasta_bkp")){
  die("false");

} else {

// Fazendo backup do banco de dados
$backup = shell_exec("mysqldump -u root -p05ad00sp sisbackup > /var/www/html/sisbackup/php/database/backups/sisbackup-$data-$hora.sql");

// Verificando se houve atualização no Banco de Dados - Se necessário, faz a atualização do banco de dados no servidor do cliente

// Baixando os arquivos do github

// Alterar no servidor somente os arquivos que tiveram atualizações no reṕositório github

// Gravando data de alteração na tabela de atualização do sistema

// Retorno para o usuário


}
}

?>
