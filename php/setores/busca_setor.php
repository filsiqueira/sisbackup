<?php

include('../conexao/conexao.php');

$str = "<option value=''> SELECIONE </option>";

$sql = mysqli_query($conexao,"SELECT setor_id,setor_nome FROM setores ORDER BY setor_nome");

while($dados = mysqli_fetch_array($sql)){

$str.="<option value='$dados[setor_id]'>$dados[setor_nome]</option>";

}

echo $str;


?>