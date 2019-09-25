<?php

class Crud extends ConDB{

  private $query;

//Prepare e execute
  private function prepExec($prepare,$execute){
    $this->query=$this->getCon()->prepare($prepare);
    $this->query->execute($execute);

  }

//Metodo Select
public function select ($campos,$tabela,$prepare,$execute){
  $this->prepExec("SELECT $campos FROM $tabela $prepare",$execute);
  return $this->query;
}


}



?>
