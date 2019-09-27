#!/bin/bash
#Script de instalacao do sistema Sisbackup
#Autor: Filipe Siqueira
#Verificando se esta sendo executado como root
echo "Verificando as permissoes do usuario ..."
if [ "$(id -u)" != "0" ]; then
echo

echo "Voce deve executar este script como root! "

else
# Testando a comunicacao
clear
echo "Testando a conexao com a Internet ..."

if ! ping -c 5 github.com >/dev/null; then

echo "Erro de conexao! Verifique sua internet."
exit

else
echo "Comunicacao realizada com sucesso!\n"
echo "Iniciando execucao do script."
sleep 3
clear

#Atualizando sistema
echo "Atualizando o Servidor ..."
apt update -y && apt upgrade -y && apt dist-upgrade -y

echo "------------------------------------------------------------\n"
echo "Servidor atualizado com sucesso"
sleep 3
clear
sleep 3

#Instalando dependências
echo "Instalando dependências ..."
apt install rsync sshpass unzip wakeonlan wget -y

echo "------------------------------------------------------------\n"
echo "Dependências instaladas com sucesso"
sleep 3
clear
sleep3

#Instalando Servidor Web
echo "Instalando Servidor Web ..."
apt install lamp-server^ phpmyadmin -y

echo "------------------------------------------------------------\n"
echo "Servidor web instalado com sucesso"
sleep 3
clear
sleep 3

#Baixando Codigo fonte do sistema
echo "Baixando Codigo fonte do sistema"
wget https://github.com/filsiqueira/Sisbackup/archive/master.zip

echo "------------------------------------------------------------\n"
echo "Codigo baixado com sucesso"
sleep 3
clear
sleep 3

#Descompactando arquivos
echo "Descompactando arquivos"
unzip master.zip

echo "------------------------------------------------------------\n"
echo "Codigo descompactado com sucesso"
sleep 3
clear
sleep 3

#Movendo Arquivos e ajustando permissoes
echo "Movendo Arquivos e ajustando permissoes"
mv sisbackup-master sisbackup && mv sisbackup /var/www/html/ && sudo chmod -R 775 /var/www/html/sisbackup && sudo chown -R www-data:www-data /var/www/html/sisbackup

echo "------------------------------------------------------------\n"
echo "Processo realizado com sucesso"
sleep 3
clear
sleep 3

#Ajustando arquivos do Banco de Dados
echo "Ajustando arquivos do Banco de Dados"
declare senhaBd

echo "Digite a senha de acesso ao seu Banco de Dados"
read -s senhaBd

echo "Ajustando os arquivos de conexao com o Banco de Dados ..."

find /var/www/html/sisbackup/php/conexao -type f -exec sed -i 's/ColoqueSuaSenhaAqui/'$senhaBd'/g' '{}' \;
find /var/www/html/sisbackup/php/database -type f -exec sed -i 's/ColoqueSuaSenha/'$senhaBd'/g' '{}' \;

echo "------------------------------------------------------------\n"
echo "Arquivos ajustados com sucesso"
sleep 3
clear
sleep 3

#Ajustando script de backup no crontab
echo "Ajustando script de backup no crontab"

echo "0 * * * * sh /var/www/html/sisbackup/php/backup/executa_backup.sh" >> /var/spool/cron/crontabs/root
chmod +x /var/spool/cron/crontabs/root

echo "------------------------------------------------------------\n"
echo "Arquivos ajustados com sucesso"
sleep 3
clear
sleep 3

#Criando Diretorios necessarios
echo "Criando Diretorios necessarios ..."

sudo mkdir -p /home/sisbackup && sudo chown -R www-data:www-data /home/sisbackup && sudo mkdir -p /mnt/{cliente,servidor} && sudo chown -R www-data:www-data /mnt/cliente/ /mnt/servidor/ && sudo chmod -R 775 /mnt/cliente/ /mnt/servidor/

echo "--------------------------------------------------------------"
echo "Diretorios criados com sucesso"
sleep 3
clear
sleep 3

#Ajustando o arquivo /etc/sudoers
echo "Ajustando o arquivo /etc/sudoers"
echo "www-data ALL=(ALL:ALL) NOPASSWD:ALL" >> /etc/sudoers

echo "--------------------------------------------------------------"
echo "Arquivo ajustado com sucesso"
sleep 3
clear
sleep 3

#Criando Banco de Dados
echo "Criando Banco de Dados"
mysql -u root -p$senhaBd -e "create database sisbackup";

echo "----------------------------------------------------------------"
echo "Banco de Dados criado com sucesso"
sleep 3
clear
sleep 3

#Importando arquivo de Banco de Dados
echo "Importando e Populando tabelas do Banco de Dados"
mysql -h localhost -u root -p$senhaBd sisbackup < /var/www/html/sisbackup/php/database/script-bd/sisbackup.sql


echo "----------------------------------------------------------------"
echo "Banco de Dados configurado com sucesso"
sleep 3
clear
sleep 3

echo "Para acessar seu sistema, abra o navegador e digite: IPSERVIDOR/sisbackup\n"
echo ""
echo "Obrigado por instalar nosso Sistema!"

fi
fi
