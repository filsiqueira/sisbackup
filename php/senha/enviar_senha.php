<?php

/*********************************** Gerando a Nova senha Para o usuario ********************************************************************/

function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){

  $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
  $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
  $nu = "0123456789"; // $nu contem os números
  $si = "!@#$%*"; // $si contem os símbolos

  if ($maiusculas){
        // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
  	$senha .= str_shuffle($ma);
  }

  if ($minusculas){
        // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
  	$senha .= str_shuffle($mi);
  }

  if ($numeros){
        // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
  	$senha .= str_shuffle($nu);
  }

  if ($simbolos){
        // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
  	$senha .= str_shuffle($si);
  }

    // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
  return substr(str_shuffle($senha),0,$tamanho);
}

$nova_senha =  gerar_senha(8, true, true, true, true);

/************************************** Pegando dados do usuario e alterando a senha no Banco de Dados ***************************************/ 
include('../conexao/conexao.php');

$usuario_id = $_POST['usuario_id'];
$sql = mysqli_query($conexao,"SELECT * FROM usuarios WHERE usuario_id = '$usuario_id' ");
$dados = mysqli_fetch_array($sql);

$usuario_nome  = $dados['usuario_nome'];
$usuario_login = $dados['usuario_login'];
$usuario_email = $dados['usuario_email'];
$usuario_senha = md5($nova_senha);

if($update = mysqli_query($conexao,"UPDATE usuarios SET usuario_senha = '$usuario_senha' WHERE usuario_id = '$usuario_id' ")){


/******************************************** Enviando email com a nova senha do usuário *******************************************************/

require_once '../../vendor/autoload.php';

$consulta = mysqli_query($conexao,"SELECT * FROM smtp");
$email = mysqli_fetch_array($consulta);
$smtp = $email['smtp_endereco'];
$porta = $email['smtp_porta'];
$username = $email['smtp_email_admin'];
$senha = base64_decode($email['smtp_senha']); 
$msg      = "<h2> Olá  " .$usuario_nome. "</h2><br> Seus dados de acesso foram redefinidos!<br><br> Login: " .$usuario_login. "<br>Senha: " .$nova_senha. "<br><br> Este é um email automático, por favor não responda.<br><br><table data-mysignature-version='2018-08-25T13:21:30.840Z | 0' cellspacing='0' width='500' cellpadding='0' border='0'><tr>  <td style='font-size:1em;padding:0 0 0 12px;vertical-align: top;border-left: 1px solid #3d85c6;' valign='top'><table cellspacing='0' cellpadding='0' border='0' style='line-height: 1.4;font-family:'Lucida Console', Monaco, monospace;font-size:80%;color: #000001;'><tr><td><span style='font-weight: 600;font-size:1.5em;color:#3d85c6;'>Administração do Sistema</span></td></tr><tr><td style='color:#000001;padding: 8px 0;'> (32)99989 - 5800  |  SISBACKUP   </td></tr></table></td></tr></table>";


// Create the Transport
$transport = (new Swift_SmtpTransport($smtp, 587, 'tls'))
->setUsername($username)
->setPassword($senha)
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$data = date('d/m/Y');
$message = (new Swift_Message('Dados de Acesso SISBACKUP  ' .$data))
->setFrom([$username => 'Suporte SISBACKUP'])
->setTo([$usuario_email])
->setBody($msg,'text/html')
;

// Send the message
if ($result = $mailer->send($message)){
	echo "true";

} else {

	echo "false";
}

} else {

	echo "false";
	exit();
}


?>