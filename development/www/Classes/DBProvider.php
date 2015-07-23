<?php
class DBProvider {

    private $dbConnection;


    public function Open($host, $user, $password, $dbName){

        $this->dbConnection = new PDO("mysql:host=$host;dbname=$dbName;charset=UTF8", $user, $password,array(PDO::ATTR_PERSISTENT => true));
    }

    public function Close(){
        if(isset($this->dbConnection)){
            $this->dbConnection = null;
        }
    }

    public function GetConnection(){

        return $this->dbConnection;
    }




}