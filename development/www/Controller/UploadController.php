<?php
    require_once "./upload.php";

    class UploadController{

        public function CheckUploadStatus(){
            if($this -> FileIsset() == true and $this -> IsUploadedFile() == true and
                $this -> SizeFile() == true and $this -> TypeFile() == true ){
                return true;
            }
            else{
                return false;
            }
        }

        public  function FileIsset(){
            if(isset($_POST['submit'])){
                return true;
            }
            else{
                return false;
            }
        }
        public function IsUploadedFile(){
            if(is_uploaded_file($_FILES['upload']['tmp_name'])){
                return true;
            }
            else{
                return false;
            }

        }
        public function TypeFile(){
            if ($_FILES['upload']['type'] == 'image/jpg' or $_FILES['upload']['type'] == 'image/jpeg' or $_FILES['upload']['type'] == 'image/png'){
                return true;
            }
            else{
                return false;
            }
        }
        public function SizeFile(){
            if ($_FILES['upload']['size'] <= 1048576){
                return true;
            }
            else{
                return false;
            }
        }
        public function CheckIssetRecomment(){
            if(isset($_POST['buttomRecomment'])){
                return true;
            }
            else{
                return false;
            }
        }
        public function CheckIssetbuttonDelete(){
            if(isset($_POST['Delete'])){
                return true;
            }
            else{
                return false;
            }
        }
        public function CheckIssetButtonSort(){
            if(isset($_POST['buttonFilter'])){
                return true;
            }
            else{
                return false;
            }
        }

    }


?>