<?php
    require_once "View/index.html";
    require_once "Controller/GalleryController.php";
    require_once "Controller/UploadController.php";
    require_once "upload.php";

    class index{

        private $cookie;

        public function EchoCookie(){

            $this -> cookie = $_COOKIE['Error'];
            echo $this -> cookie;
            unset($this -> cookie);
        }
    }
    //$index = new index();
    //$index -> EchoCookie();
    //$uploadController = new UploadController();
    //$uploadController -> CheckUploadStatus();
?>