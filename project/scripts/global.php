<?php

class Client{
    private $USERNAME;
    private $PASSWORD; 
    private $NOM; 
    private $COGNOM; 
    private $ADRECA; 
    private $EMAIL; 
    private $TELEFON;
    
    public function __construct($USERNAME, $NOM, $COGNOM, $ADRECA, $EMAIL, $TELEFON){
        $this->USERNAME = $USERNAME;
        $this->NOM = $NOM;
        $this->PASSWORD = 1234;
        $this->COGNOM = $COGNOM;
        $this->ADRECA = $ADRECA;
        $this->EMAIL = $EMAIL;
        $this->TELEFON = $TELEFON;
    }
    public function getUserName(){
        return $this->USERNAME;
    }
    public function getPassword(){
        return $this->PASSWORD;
    }
    public function getNom(){
        return $this->NOM;
    }
    public function getCognom(){
        return $this->COGNOM;
    }
    public function getAdreca(){
        return $this->ADRECA;
    }
    public function getEmail(){
        return $this->EMAIL;
    }
    public function getTelefon(){
        return $this->TELEFON;
    }
    public function __toString(){
        return "{$this->USERNAME},1234,{$this->NOM},{$this->COGNOM},{$this->ADRECA},{$this->EMAIL},{$this->TELEFON},false,0,0";
    }
}

class Treballador{

}

class Llibre{

}

class Sessio{

}