<?php
class Usuari{
    protected $USERNAME;
    protected $PASSWORD; 
    protected $NOM; 
    protected $COGNOM; 
    protected $ADRECA; 
    protected $EMAIL; 
    protected $TELEFON;
    public function __construct($USERNAME, $PASSWORD, $NOM, $COGNOM, $ADRECA, $EMAIL, $TELEFON){
        $this->USERNAME = $USERNAME;
        $this->NOM = $NOM;
        $this->PASSWORD = $PASSWORD;
        $this->COGNOM = $COGNOM;
        $this->ADRECA = $ADRECA;
        $this->EMAIL = $EMAIL;
        $this->TELEFON = $TELEFON;
    }
}
class Client extends Usuari{
    public function __construct($USERNAME, $PASSWORD, $NOM, $COGNOM, $ADRECA, $EMAIL, $TELEFON){
        parent::__construct($USERNAME, $PASSWORD, $NOM, $COGNOM, $ADRECA, $EMAIL, $TELEFON);
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
}

class Treballador extends Usuari{
    PRIVATE $ISADMIN;
    private $NUMSS;
    private $DATACON;
    private $SALARI;
    public function __construct($USERNAME, $PASSWORD, $NOM, $COGNOM, $ADRECA, $EMAIL, $TELEFON, $NUMSS, $DATACON, $SALARI){
        $this->ISADMIN = "false";
        $this->NUMSS = $NUMSS;
        $this->DATACON = $DATACON;
        $this->SALARI = $SALARI;
        parent::__construct($USERNAME, $PASSWORD, $NOM, $COGNOM, $ADRECA, $EMAIL, $TELEFON);
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
    public function getIsAdmin(){
        return $this->ISADMIN;
    }
    public function getNumSS(){
        return $this->NUMSS;
    }
    public function getDataCon(){
        return $this->DATACON;
    }
    public function getSalari(){
        return $this->SALARI;
    }
}

class Llibre{

}