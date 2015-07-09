<?php

    class file
    {
        public function upLoadFile()
        {
            if(isset($_POST['submit']))
            {
                if(is_uploaded_file($_FILES['upload']['tmp_name']))
                {
                    copy($_FILES["upload"]["tmp_name"], "images/".$_FILES["upload"]["name"]);
                    exit( "Фото загружено");
                }
                else
                {
                    echo 'Фото не загружено';
                }
            }
            else
            {
                echo "Выберите файл и нажмите загрузить фотографию";
            }


        }
    }

    $file = new file;
    $file -> upLoadFile();

?>