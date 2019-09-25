<?php
//Função autoload para carregar todos os arquivos de classe
function __autoload($class){
  require_once "{$class}.class.php";
}

//Conexão com o Banco de Dados
abstract class ConDB{

//Variável estática
  private static $conexao;

  private function setCon(){
//Se não existir conexao instância da conexão na variavel, ela será instanciada
    if(self::$conexao){
      self::$conexao = new PDO("mysql:host=localhost;dbname=sisbackup","root","05ad00sp");
    } else {
      return self::$conexao;
    }
  }

  public function getCon(){
    return $this->setCon();
  }
}
?>
