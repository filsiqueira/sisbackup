<?php

include('../conexao/conexao.php');

$tabela = '<table class="table table-striped table-bordered table-hover " id="table">';
$tabela .= '<thead>'
$tabela .= '<tr>';
$tabela .= '<th scope="col"> NOME DO USUARIO </th>';
$tabela .= '<th scope="col"> SETOR DO USUARIO </th>';
$tabela .= '</tr>';


$tabela .= '<tr>';
$tabela .= '<td>Joao</td>';
$tabela .= '<td>Fianceiro</td>';
$tabela .= '</tr>';


echo $tabela;



?>