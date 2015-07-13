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
                            return true;
                        }
                        else
                        {
                            exit( "Размер файла не должен превышать 1мб");
                        }
                    }
                    else
                    {
                        exit ("Не верный формат файла");
                    }
                }
                else
                {
                    exit ("Выберите файл");
                }

            }
            else
            {
                exit ("Выберите файл и нажмите загрузить фотографию");
            }

        }
    }
    class ConnectDatabases
    {
        public function connectDatabase($host, $user, $password)
        {
            $connect =  mysql_connect($host, $user, $password);
            return $connect ;

        }
        public  function selectDataBase($DaBa)
        {
            $select = mysql_select_db($DaBa);
            return $select;
        }
    }
    class displayImage extends fileUpload
    {
        public function getDisplayimg($file)
        {
            $this -> upLoadFile();
            if($this -> upLoadFile() == true)
            {
                for($i = 0; $i <count($file);$i++)
                {
                    echo '<img alt = "Фото" src = "images/.$file">';
                }
                echo "фото загружено";
            }
        }
    }



    $file = new fileUpload;
    $file -> upLoadFile();
    $db = new ConnectDatabases;
    $db -> connectDatabase('localhost','root', '3333');
    $db -> selectDataBase('gallery');
    $displayimg = new displayImage;
    $displayimg -> getDisplayimg($_FILES['upload']['name']);



?>