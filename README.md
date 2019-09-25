# Sistema de Backup - Novo Layout e Correções

# Distribuições homologadas

Ubuntu 16.04 / Debian 9 

# Atualizando Servidor

sudo apt update -y && apt upgrade -y && apt dist-upgrade 

# Instalando Rsync,SSHPASS,Wget,wakeonlan e unzip

sudo apt install rsync sshpass unzip wakeonlan wget 

# Instalando Servidor Web (LAMP)

sudo apt install apache2 mariadb-server php libapache2-mod-php php-mysql php-cgi php-curl php-json phpmyadmin 

# Download Arquivos

Baixe o arquivo master.zip wget https://github.com/filsiqueira/Sisbackup/archive/master.zip <br>

# Descompacte o arquivo

unzip master.zip 

# Renomeie a pasta Sisbackup-master para sisbackup e mova-a para /var/www/html/

mv sisbackup-master sisbackup && mv sisbackup /var/www/html/ 

# Altere as permissões

sudo chmod -R 775 /var/www/html/sisbackup && sudo chown -R www-data:www-data /var/www/html/sisbackup 

# Arquivo de conexão com o Banco de Dados

Ajuste os arquivos /var/www/html/sisbackup/php/conexao/conexao.php e /var/www/html/sisbackup/php/conexao/conexao_pdo.php e coloque a senha de acesso ao seu Banco de dados 

# Ajustando script de backup no crontab

sudo crontab -e 0 * * * * sh /var/www/html/sisbackup/php/backup/executa_backup.sh 

# Criando diretorios de backup Servidor Aplicação

Caso deseje utilizar o servidor de aplicação como servidor de backup, é necessário criar uma pasta sisbackup em /home 

sudo mkdir -p /home/sisbackup <br>
sudo chown -R www-data:www-data /home/sisbackup <br>
sudo mkdir -p /mnt/cliente <br>
sudo mkdir -p /mnt/servidor <br>
sudo chown -R www-data:www-data /mnt/cliente <br> 
sudo chown -R www-data:www-data /mnt/servidor <br>
sudo chmod -R 775 /mnt/cliente <br>
sudo chmod -R 775 /mnt/servidor <br>

# Dando permissão ao usuário do apache para executar o comando sudo sem senha

sudo nano /etc/sudoers <br>

Adicione a seguinte linha:<br> 

www-data ALL=(ALL:ALL) NOPASSWD:ALL 

# Ajustando Erros 1698 e 1045 Mariadb-Server

mysql -u root -p <br>
use mysql <br>
update user set plugin='' where User='root'; <br>
FLUSH PRIVILEGES; <br>
quit; <br>
mysql -u root <br>
use mysql <br>
update user set password=PASSWORD("SuaSenha") where User='root'; <br>
FLUSH PRIVILEGES; 

# Criação do Banco de Dados

mysql -u root -p <br>
CREATE DATABASE sisbackup;<br>
quit;

# Importe o arquivo /var/www/html/sisbackup/php/database/script-bd/sisbackup.sql 
mysql -h localhost -u root -p sisbackup < /var/www/html/sisbackup/php/database/script-bd/sisbackup.sql 

# Acessando o sistema

http://IPServidor/sisbackup 
login:admin <br>
senha: sisbackup 

# Requisitos Estações Clientes

Nos computadores clientes é necessário compartilhar o HD com o nome "HD".<br>

# Observações

O sistema permite ligar o computador cliente antes do backup e desligar ao terminar, para isso, é necessário ativar o telnet no windows (necessário para desligar o computador) e ativar a função wakeonlan na BIOS (necessário para ligar o computador)
