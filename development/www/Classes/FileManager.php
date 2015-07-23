<?php

    require_once './upload.php';
class FileManager {

    private $newPath;
    private $tmpName;
    public function CopyFile($tmpName, $newPath)
    {
            $this->newPath = $newPath;
            $this->tmpName = $tmpName;

        copy($this->tmpName,$this->newPath);

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

        if ($this->getGallery() == true) {

            $images = $this-> getGallery();

            foreach ($images as $img) {
                    echo '<a href = "image/' . $img . '"><img width = "300px" height = "300px" alt = "Фото" src = "image/' . $img . '"></a>';
            }

        }
        else {
                     echo "фото не загружено";
        }
    }


}

