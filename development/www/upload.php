<?php
    require_once 'View/upload.html';
    require_once 'Controller/UploadController.php';
    require_once 'Controller/GalleryController.php';
    require_once 'Classes/FileManager.php';


    class Upload{

        private $UploadController;
        private $galleryController;
        private $filemanager;


        public function Redirect(){

            $this -> UploadController = new UploadController();
            $this -> galleryController = new GalleryController();
            $this -> filemanager = new FileManager();

            if($this-> UploadController->CheckUploadStatus() == true) {

                $tmpName = $_FILES["upload"]["tmp_name"];
                $newName = "image/";
                $UUIDName = $this->galleryController->model->GetUUID();

                $this -> filemanager -> CopyFile($tmpName,$newName . $UUIDName);
                $this -> GotoDBImage($UUIDName);
                exit();
            }
            elseif($this -> UploadController -> FileIsset() == false){
                $this -> Recomment();
                setcookie("Error","Выберите файл и нажмите загрузить фотографию",time() + 3600 * 24);
                header('location: index.php');
                exit();
            }
            elseif($this -> UploadController -> IsUploadedFile() == false){
                setcookie("Error", "Выберите файл", time() + 3600 * 24);
                header('location: index.php');
                exit();
            }
            elseif($this -> UploadController -> SizeFile() == false){
                setcookie("Error", "Размер файла не должен превышать 1мб", time () + 3600 * 24);
                header('location: index.php');
                exit();
            }
            elseif($this -> UploadController -> TypeFile() == false){
                setcookie("Error", "Не верный формат файла", time() + 3600 * 24);
                header('location: index.php');
                exit();
            }
            else{
                echo "Файл не загружен";
            }
        }
        public function Recomment(){

            $this->UploadController  = new UploadController();
            $this->galleryController = new GalleryController();

            if($this->UploadController->CheckIssetRecomment() == true){

                //$this->galleryController->model->GetSelectRecomment();
                $this-> GotoDBRecomment();
            }
            else{
                setcookie("Error","Выберите файл и нажмите загрузить фотографию",time() + 3600 * 24);
                header('location: index.php');
                exit();
            }

        }
        public function GotoDBRecomment(){

            $this->UploadController = new UploadController();
            $this->galleryController = new GalleryController();

            $Imgtext = $_POST['recomment'];
            $ID = $_POST['IDcomment'];

            $this->galleryController->model->processUpdateComment($Imgtext, $ID);



        }
        public function GotoDBImage($UUIDName){

            $this->galleryController = new GalleryController();

            $BaseName = $_FILES["upload"]["name"];
            $CreateTS = date('Y-m-d H:i:s');

            $this -> galleryController->model->ProcessInsertImage($BaseName, $CreateTS, $UUIDName);
            $this -> galleryController->model->ProcessSelectImage();

        }

        public function GotoDBComment($selectImage){

            $this->galleryController = new GalleryController();

            $Imgtext = $_POST['comment'];
            $CreateTS = date('Y-m-d H:i:s');

            foreach($selectImage as $id){

                $ImageID = $id['id'];

            }
            $this -> galleryController->model->ProcessInsertComment($CreateTS, $Imgtext, $ImageID);
            $this -> galleryController->model->ProcessSelectComment();

        }

        public function GetCreateTS($selectImage){

            $this->filemanager = new FileManager();
            $this->filemanager->echoGallery($selectImage);

        }
        public function GetImgtext($selectComment){

            $this->filemanager = new FileManager();
            $this->filemanager->echoComment($selectComment);
        }

    }
$upload = new Upload();
$upload -> Redirect();
?>