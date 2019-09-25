<?php
function conectar(){
	try {
		$conexao = new PDO("mysql:host=localhost;dbname=sisbackup","root","05ad00sp");
	} catch (PDOException $e) {
		$e->getMessage();
	}
	return $conexao;
}
?>
