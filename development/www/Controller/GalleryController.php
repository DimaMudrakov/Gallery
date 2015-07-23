<?php
include_once "./Classes/DBProvider.php";
include_once "./Classes/FileManager.php";
include_once "./Model/Model.php";
include_once "./Model/Image.php";
include_once "./Model/Comment.php";

class GalleryController
{

    private $dbProvider;
    public $model;


    public function __construct()
    {
        $this->dbProvider = new DBProvider();

        $this->dbProvider->Open('localhost', 'root', 3333, 'gallery');

        $this->model = new Model($this->dbProvider);


    }

    public function __destruct()
    {
        $this->dbProvider->Close();
    }

}
$controller = new GalleryController();
?>