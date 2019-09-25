<?php

include('../conexao/conexao.php');


$str = "<option value=''> SELECIONE </option>";

$sql = mysqli_query($conexao,"SELECT usuario_id,usuario_nome,usuario_login FROM usuarios WHERE usuario_login <> 'sisbackup' ORDER BY usuario_nome");

while($dados =  mysqli_fetch_array($sql)){

$str.="<option value='$dados[usuario_id]'>$dados[usuario_nome]</option>";

}
echo $str;

?>