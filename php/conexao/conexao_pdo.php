<?php
function conectar(){
	try {
		$conexao = new PDO("mysql:host=localhost;dbname=sisbackup","root","ColoqueSuaSenhaAqui");
	} catch (PDOException $e) {
		$e->getMessage();
	}
	return $conexao;
}
?>
