<?php

include('../conexao/conexao.php');

$str="<option value=''> SELECIONE </option>";

$sql = mysqli_query($conexao,"SELECT documento_id,documento_nome FROM documentos ORDER BY documento_nome");

while($dados = mysqli_fetch_array($sql)){

$str.="<option value='$dados[documento_id]'>$dados[documento_nome]</option>";


}

echo $str;

?>                 