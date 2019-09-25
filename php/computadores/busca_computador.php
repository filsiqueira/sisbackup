<?php

include('../conexao/conexao.php');

$str = "<option value=''> SELECIONE </option>";

$sql = mysqli_query($conexao,"SELECT comp_id,comp_nome_usuario FROM computadores ORDER BY comp_nome_usuario");

while($dados = mysqli_fetch_array($sql)){

$str.="<option value='$dados[comp_id]'>$dados[comp_nome_usuario]</option>";


}

echo $str;

?>