<?php
    require_once 'View/upload.html';
    require_once 'Controller/UploadController.php';
    require_once 'Classes/FileManager.php';



    class Upload{

        private $UploadController;
        private $tmpName;
        private $newName;

        public function Redirect(){

            $this -> UploadController = new UploadController();

            if($this-> UploadController->CheckUploadStatus() == true) {
                $this -> tmpName = $_FILES["upload"]["tmp_name"];
                $this -> newName = "image/" . $_FILES["upload"]["name"];

                $filemanager = new FileManager();
                $filemanager -> CopyFile($this->tmpName,$this -> newName);
                $filemanager -> echoGallery();

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