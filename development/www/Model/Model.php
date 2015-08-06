<?php

    require_once 'Comment.php';
    require_once 'Image.php';
    require_once './Controller/GalleryController.php';
    require_once './upload.php';


class Model {

    private $dbProvider;
    private $dbConnection;
    private $image;
    private $comment;
    private $controller;
    private $upload;


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
    public function InsertComment($comment){

        $cmd = $this->dbConnection->prepare("INSERT INTO comment(CreateTS, Imgtext, ImageID) VALUES (:createTS, :Imgtext, :ImageID )");

        $cmd->bindParam(":createTS", $comment->CreateTS);
        $cmd->bindParam(":Imgtext", $comment->Imgtext);
        $cmd->bindParam(":ImageID", $comment->ImageID);

        $cmd->execute();
    }

    public function ProcessInsertImage($BaseName, $CreateTS, $UUIDName){

        $this->image = new Image();
        $this->controller = new GalleryController();

        $this->image->BaseName = $BaseName;
        $this->image->CreateTS = $CreateTS;
        $this->image->UUIDName = $UUIDName;

        $this->controller->model->InsertImage($this->image);

    }
    public function ProcessInsertComment($CreateTS, $Imgtext, $ImageID){

        $this -> comment = new Comment();
        $this -> controller = new GalleryController();

        $this->comment->ImageID = $ImageID;
        $this ->comment->CreateTS = $CreateTS;
        $this ->comment->Imgtext = $Imgtext;

        $this->controller->model->InsertComment($this->comment);

    }
    public function SelectImage(){

        $cmd = $this->dbConnection->prepare("SELECT * FROM image");

        $cmd->execute();

        return $cmd->fetchall();


    }
    public function SelectComment(){

        $cmd = $this->dbConnection->prepare("SELECT Imgtext, ImageID FROM comment");

        $cmd->execute();

        return $cmd->fetchall();
    }
    public function ProcessSelectImage(){

        $this->upload = new Upload();

        $this->controller = new GalleryController();
        $selectImage = $this->controller->model->SelectImage();

        $this->upload->GetCreateTS($selectImage);
        $this->upload->GotoDBComment($selectImage);

    }
    public function ProcessSelectComment(){

        $this->upload = new Upload();
        $this->controller = new GalleryController();

        $selectComment = $this->controller->model->SelectComment();

        $this->upload->GetImgtext($selectComment);


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