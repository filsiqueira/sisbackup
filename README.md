# Distribuição homologada

Ubuntu 16.04

# Instalação via script
Você pode realizar a instalação através do script 'instala_sisbackup.sh'. Baixe o script e execute como root.<br>


# Instalação manual

# Atualizando Servidor e Instalando Dependências

sudo apt update -y && apt upgrade -y && apt dist-upgrade && sudo apt install rsync sshpass unzip wakeonlan wget lamp-server^ phpmyadmin

# Baixando e descompactando arquivos

wget https://github.com/filsiqueira/Sisbackup/archive/master.zip && unzip master.zip && mv sisbackup-master sisbackup && mv sisbackup /var/www/html/ && sudo chmod -R 775 /var/www/html/sisbackup && sudo chown -R www-data:www-data /var/www/html/sisbackup 

# Ajuste os seguinites arquivos substituindo "ColoqueSuaSenhaAqui" pela senha do seu Banco de Dados
/var/www/html/sisbackup/php/conexao/conexao.php<br>
/var/www/html/sisbackup/php/conexao/conexao_pdo.php<br>
/var/www/html/sisbackup/php/database/backup_database.php<br>
/var/www/html/sisbackup/php/database/exportar.php<br>
/var/www/html/sisbackup/php/database/restore_database.php <br>

# Ajustando script de backup no crontab
sudo crontab -e<br> 0 * * * * sh /var/www/html/sisbackup/php/backup/executa_backup.sh 

# Criando diretorios necessários no Servidor da Aplicação
sudo mkdir -p /home/sisbackup && sudo chown -R www-data:www-data /home/sisbackup && sudo mkdir -p /mnt/{cliente,servidor} && sudo chown -R www-data:www-data /mnt/cliente/ /mnt/servidor/ && sudo chmod -R 775 /mnt/cliente/ /mnt/servidor/

# Dando permissão ao usuário do apache para executar o comando sudo sem senha
sudo nano /etc/sudoers <br>
Adicione a seguinte linha:<br>
www-data ALL=(ALL:ALL) NOPASSWD:ALL 


# Criação do Banco de Dados
mysql -u root -p <br>
CREATE DATABASE sisbackup;<br>
quit;

# Importe o arquivo de Banco de Dados
mysql -h localhost -u root -p sisbackup < /var/www/html/sisbackup/php/database/script-bd/sisbackup.sql 

# Acessando o sistema
http://IPServidor/sisbackup 
login:admin <br>
senha: sisbackup 

# Alterando senha de usuário root cadastrado no sistema
Após acessar o sistema, acesse a tela "Servidores de Backup" e edite o servidor "Servidor Aplicação/Backup", alterando a senha de usuário root já pré-cadastrada (coloque a senha de usuário root do seu servidor).


# Requisitos Estações Clientes
Nos computadores clientes é necessário compartilhar o HD com o nome "HD".<br>

# Observações
O sistema permite ligar o computador cliente antes do backup e desligar ao terminar, para isso, é necessário ativar o telnet no windows (necessário para desligar o computador) e ativar a função wakeonlan na BIOS (necessário para ligar o computador)
