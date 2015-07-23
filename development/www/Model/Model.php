<?php

class Model {

    private $dbProvider;
    private $dbConnection;
    //public $select;

    public  function __construct($dbProvider){

        $this->dbProvider = $dbProvider;
        $this->dbConnection = $this->dbProvider->GetConnection();
    }



    public function InsertImage($image)
    {

        $cmd = $this->dbConnection->prepare("INSERT INTO image(CreateTS, BaseName, UUIDName) VALUES(:createTS, :baseName, :uuidName)");

        $cmd->bindParam(":createTS", $image->CreateTS);
        $cmd->bindParam(":baseName", $image->BaseName);
        $cmd->bindParam(":uuidName", $image->UUIDName);

        $cmd->execute();

    }
    public function SelectImage($image){

        $cmd = $this->dbConnection->prepare("SELECT CreateTS FROM image WHERE BaseName = :BaseName");

        $cmd->bindParam(":BaseName", $image->BaseName);

        $cmd->execute();

        return $cmd->fetch();


    }
    public function GetUUID() {

        try {
            $cmd = $this->dbConnection->query("select UUID() as uuid");
            $result = $cmd->fetch();
            return $result["uuid"];
        } catch (Exception $e) {

            $this->logger->fatal("Exception in model ", $e);
            throw $e;
        }
    }

}