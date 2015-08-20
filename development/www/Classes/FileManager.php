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
    public function DeleteFile($UUIDName){

        unlink('image/' . $UUIDName);

    }

    public function echoGallery($selectImage)
    {

        foreach ($selectImage as $uploadDate) {



            echo  '<div class = "image">' .'<form method = "post" action="./upload.php">'.'<input class = "buttonDelete" type = "submit" name = "Delete" value = "Удалить изображение и комментарий">'

                .'<input type = "hidden" name = "ImageID" value = "' .$uploadDate['id'] . '">' .'<input type = "hidden" name = "UUIDName" value = "'.$uploadDate['UUIDName']  .'">' .'</form>'

                .'<div class = "image_block">'  .'<a href = "image/' . $uploadDate['UUIDName'] . '"><img width = "300px" height = "300px" alt = "Фото" src = "image/' . $uploadDate['UUIDName'] . '"></a>' .'</div>'

                .'<div class = "date">' . '<span class = "number">' . "Изображение №" . $uploadDate['id']. '</span>'  . '<br>' . "Время загрузки фотографии :" . " " . $uploadDate['CreateTS'] .'<br>' . "Название фотографии: " . " " . $uploadDate['BaseName'] .'<br>'

                ."Размер фотографии :" ." " .$uploadDate['FileSize'] . " "  ."байта" .'</div>' . '</div>';


        }


    }
    public function echoComment($selectComment){

        foreach($selectComment as $Imgtext){

            echo '<div class = "comment"> '. '<span class = "commentText">' ."Ваш комментарий к фото №".$Imgtext['ImageID']  .'</span>'.'<br>' .'<form action = "./upload.php"  method="POST">'

                .'<br>'.'<textarea class = "commentText"  name = "recomment" maxlength = "200" >' .$Imgtext['Imgtext'] . '</textarea>'

                .'<input class = "buttomRecomment" type = "submit" name = "buttomRecomment" value = "Редактировать комментарий">'

                . '<input type = "hidden" name = "IDcomment" value = "' . $Imgtext['id'] . '">'

                .'</form>'. '</div>';
        }

        echo '<a class = "link" href = "./index.php">Нажмите сюда чтобы загрузить фотографию </a>';
    }
}

