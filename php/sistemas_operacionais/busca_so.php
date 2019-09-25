<?php

include('../conexao/conexao.php');

$str = "<option value=''> SELECIONE </option>";

$sql = mysqli_query($conexao,"SELECT * FROM sistemas_operacionais ORDER BY sistema_operacional_nome");
  
  while($sos = mysqli_fetch_array($sql)){

  $str.="<option value='$sos[sistema_operacional_id]'>$sos[sistema_operacional_nome]</option>";	

  }

  echo $str;
  
?>