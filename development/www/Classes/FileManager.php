<?php

    require_once './upload.php';
class FileManager {

    private $upload;

    public function Copy()
    {
        $this -> upload = new Upload();
        if($this -> upload -> Redirect() == true){
            copy($_FILES["upload"]["tmp_name"], "image/" . $_FILES["upload"]["name"]);
            return true;
        }
        else{
            return false;
        }
    }
    public function getGallery()
    {
        $images = array();

        $opendir = opendir('image');

        if ($opendir != false) {
            while (false !== ($file = readdir($opendir))) {
                if ($file != '.' && $file != '..')
                    $images[] = $file;
        }
            closedir($opendir);
        }

        return $images;
    }

    public function echoGallery()
    {

        if ($this->Copy() == true and $this->getGallery() == true) {

            $images = $this-> getGallery();

            foreach ($images as $img) {
                    echo '<a href = "image/' . $img . '"><img width = "300px" height = "300px" alt = "Фото" src = "image/' . $img . '"></a>';

            }

        } else {
            echo "фото не загружено";
        }
    }


}
$filemanager = new FileManager();
$filemanager->Copy();
$filemanager->echoGallery();
