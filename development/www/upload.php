<?php
    require_once 'View/upload.html';
    require_once 'Controller/UploadController.php';
    require_once 'Controller/GalleryController.php';
    require_once 'Classes/FileManager.php';
    require_once 'Classes/DisplaySelect.php';


    class Upload{

        private $displaySelect;
        private $UploadController;
        private $galleryController;
        private $filemanager;


        public function Redirect(){

            $this -> displaySelect = new DisplaySelect();
            $this -> UploadController = new UploadController();
            $this -> galleryController = new GalleryController();
            $this -> filemanager = new FileManager();

            if($this-> UploadController->CheckUploadStatus() == true) {

                $tmpName = $_FILES["upload"]["tmp_name"];
                $newName = "image/";
                $UUIDName = $this->galleryController->model->GetUUID();

                $this -> filemanager -> CopyFile($tmpName,$newName . $UUIDName);

                $BaseName = $_FILES["upload"]["name"];
                $CreateTS = date('Y-m-d H:i:s');


                $this -> galleryController->model->ProcessInsertImage($BaseName, $CreateTS, $UUIDName);
                $this -> galleryController->model->ProcessSelectImage($BaseName);

                $this -> filemanager -> echoGallery();

                exit();
            }
            elseif($this -> UploadController -> FileIsset() == false){
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
    }
$upload = new Upload();
$upload -> Redirect();
?>