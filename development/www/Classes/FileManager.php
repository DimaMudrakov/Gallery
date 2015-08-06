<?php

    require_once './upload.php';
class FileManager
{

    private $newPath;
    private $tmpName;

    public function CopyFile($tmpName, $newPath)
    {
        $this->newPath = $newPath;
        $this->tmpName = $tmpName;

        copy($this->tmpName, $this->newPath);

    }

    public function echoGallery($selectImage)
    {

        foreach ($selectImage as $uploadDate) {



            echo '<div class = "image">' . '<a href = "image/' . $uploadDate['UUIDName'] . '"><img width = "300px" height = "300px" alt = "Фото" src = "image/' . $uploadDate['UUIDName'] . '"></a>'

                .'<div class = "date">' . '<span class = "number">' . "Изображение №" . $uploadDate['id']. '</span>'  . '<br>' . "Время загрузки фотографии :" . " " . $uploadDate['CreateTS'] .'<br>' . "Название фотографии: " . " " . $uploadDate['BaseName'] .'</div>' . '</div>';


        }


    }
    public function echoComment($selectComment){

        foreach($selectComment as $Imgtext){

            echo '<div class = "comment"> '. '<span class = "commentText">' ."Ваш комментарий к фото №".$Imgtext['ImageID'] .'<br>'.$Imgtext['Imgtext']. '</span>'  . '</div>';
        }

        echo '<a class = "link" href = "./index.php">Нажмите сюда чтобы загрузить фотографию </a>';
    }
}

