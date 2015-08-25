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

    public function DeleteFile($UUIDName)
    {

        unlink('image/' . $UUIDName);

    }

    public function echoGallery($selectImage)
    {


        foreach ($selectImage as $uploadDate) {


            echo '<div class = "image">' . '<form method = "post" action="./upload.php">' . '<input class = "buttonDelete" type = "submit" name = "Delete" value = "Удалить изображение и комментарий">'

                . '<input type = "hidden" name = "ImageID" value = "' . $uploadDate['id'] . '">' . '<input type = "hidden" name = "UUIDName" value = "' . $uploadDate['UUIDName'] . '">' . '</form>'

                . '<div class = "image_block">' . '<a href = "image/' . $uploadDate['UUIDName'] . '"><img width = "300px" height = "300px" alt = "Фото" src = "image/' . $uploadDate['UUIDName'] . '"></a>' . '</div>'

                . '<div class = "date">' . '<span class = "number">' . "Изображение №" . $uploadDate['id'] . '</span>' . '<br>' . "Время загрузки изображения :" . " " . $uploadDate['CreateTS'] . '<br>' . "Название изображения : " . " " . $uploadDate['BaseName'] . '<br>'

                . "Размер изображения :" . " " . $uploadDate['FileSize'] . " " . "байта" . '</div>' . '</div>';


        }


    }

    public function echoComment($selectComment)
    {

        foreach ($selectComment as $Imgtext) {


            echo '<div class = "comment"> ' . '<span class = "commentText">' . "Ваш комментарий к изображению №" . $Imgtext['ImageID'] . '</span>' . '<br>' . '<form action = "./upload.php"  method="POST">'

                . '<br>' . '<textarea class = "commentText"  name = "recomment" maxlength = "200" >' . $Imgtext['Imgtext'] . '</textarea>'

                . '<input class = "buttomRecomment" type = "submit" name = "buttomRecomment" value = "Редактировать комментарий">'

                . '<input type = "hidden" name = "IDcomment" value = "' . $Imgtext['id'] . '">'

                . '</form>' . '</div>';
        }

        echo '<div class = link >' . '<a href = "./index.php">Нажмите сюда чтобы загрузить изображения </a>' . '</div>';
    }

    public function EchoSelect()
    {

        echo '<div class = "select">' . '<form method = "post" action = "./upload.php">' . '<span class = "sort">' . "Сортировка изображений по:" . '<br>'

            . '</span>' . " " . '<select class = "SizePhoto" name = "Filter">'

            . '<option value = "Size_from_small_to_big">' . " Возростанию размера изображения" . '</option>'

            . '<option value = "Size_from_big_to_small">  Убыванию размера изображения </option>'

            . '<option value = "Date_from_start_to_end">  Возростанию времени загрузки изображения</option>'

            . '<option value = "Date_from_end_to_start"> Убыванию времени загрузки изображения</option>'

            . '</select>'

            . '<input class = "buttonSort" type = "submit" name = "buttonFilter" value = "сортировать">'

            . '</form>' . '</div>';
    }

    public function EchoSelectAfterFilter1()
    {

        echo '<div class = "select">' . '<form method = "post" action = "./upload.php">' . '<span class = "sort">' . "Сортировка изображений по:" . '<br>'

            . '</span>' . " " . '<select class = "SizePhoto" name = "Filter">'

            . '<option value = "Size_from_big_to_small">  Убыванию размера изображения </option>'

            . '<option value = "Size_from_small_to_big">' . " Возростанию размера изображения" . '</option>'

            . '<option value = "Date_from_start_to_end">  Возростанию времени загрузки изображения</option>'

            . '<option value = "Date_from_end_to_start"> Убыванию времени загрузки изображения</option>'

            . '</select>'

            . '<input class = "buttonSort" type = "submit" name = "buttonFilter" value = "сортировать">'

            . '</form>' . '</div>';
    }
    public function EchoSelectAfterFilter2()
    {

        echo '<div class = "select">' . '<form method = "post" action = "./upload.php">' . '<span class = "sort">' . "Сортировка изображений по:" . '<br>'

            . '</span>' . " " . '<select class = "SizePhoto" name = "Filter">'

            . '<option value = "Date_from_start_to_end">  Возростанию времени загрузки изображения</option>'

            . '<option value = "Date_from_end_to_start"> Убыванию времени загрузки изображения</option>'

            . '<option value = "Size_from_big_to_small">  Убыванию размера изображения </option>'

            . '<option value = "Size_from_small_to_big">' . " Возростанию размера изображения" . '</option>'

            . '</select>'

            . '<input class = "buttonSort" type = "submit" name = "buttonFilter" value = "сортировать">'

            . '</form>' . '</div>';
    }
    public function EchoSelectAfterFilter3()
    {

        echo '<div class = "select">' . '<form method = "post" action = "./upload.php">' . '<span class = "sort">' . "Сортировка изображений по:" . '<br>'

            . '</span>' . " " . '<select class = "SizePhoto" name = "Filter">'

            . '<option value = "Date_from_end_to_start"> Убыванию времени загрузки изображения</option>'

            . '<option value = "Date_from_start_to_end">  Возростанию времени загрузки изображения</option>'

            . '<option value = "Size_from_big_to_small">  Убыванию размера изображения </option>'

            . '<option value = "Size_from_small_to_big">' . " Возростанию размера изображения" . '</option>'

            . '</select>'

            . '<input class = "buttonSort" type = "submit" name = "buttonFilter" value = "сортировать">'

            . '</form>' . '</div>';
    }

}

