<?php

    class fileUpload
    {
        public function upLoadFile()
        {
            if(isset($_POST['submit']))
            {
                if(is_uploaded_file($_FILES['upload']['tmp_name']))
                {
                    if($_FILES['upload']['type'] == 'image/jpg' or $_FILES['upload']['type'] == 'image/jpeg' or $_FILES['upload']['type'] == 'image/png')
                    {
                        if($_FILES['upload']['size'] <= 1048576)
                        {
                            copy($_FILES["upload"]["tmp_name"], "images/".$_FILES["upload"]["name"]);
                            exit( "Фото загружено");
                        }
                        else
                        {
                            echo "Размер файла не должен превышать 1мб";
                        }
                    }
                    else
                    {
                        echo "Не верный формат файла";
                    }
                }
                else
                {
                    echo "Выберите файл";
                }

            }
            else
            {
                echo "Выберите файл и нажмите загрузить фотографию";
            }

        }
    }



    $file = new fileUpload;
    $file -> upLoadFile();

?>