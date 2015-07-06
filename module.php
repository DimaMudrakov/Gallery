<?php

    class file {
        public $path = './images';
        public function uploadFile($file){
            if(isset($_FILES['upload'])){
                if(isset($_POST['submit'])){
                    copy($_FILES['upload']['tmp_name'],$this->path);
                }
            }
            else{
                echo "Error";
            }

        }

    }

    $file = new file;
    $file->uploadFile($_FILES['upload']);
?>