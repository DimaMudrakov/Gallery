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

            echo '<div class = "comment"> '. '<span class = "commentText">' ."Ваш комментарий к фото №".$Imgtext['ImageID']  .'</span>'.'<br>' .'<form action = "./upload.php"  method="POST">' .'<br>'.'<textarea class = "commentText"  name = "recomment" maxlength = "200" >' .$Imgtext['Imgtext'] . '</textarea>'
                .'<input class = "buttonRecomment" type = "submit" name = "buttonRecomment" value = "Редактировать комментарий">' .'</form>'. '</div>';
        }

        echo '<a class = "link" href = "./index.php">Нажмите сюда чтобы загрузить фотографию </a>';
    }
}

