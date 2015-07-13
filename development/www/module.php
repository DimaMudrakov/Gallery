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
                            $this -> imageResize ($_FILES['upload']['tmp_name'], 'img_small/' . $_FILES['upload']['name'], 320, 500, 100);
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
        public function imageResize($source_path, $destination_path, $newwidth, $newheight, $quality)
        {
            ini_set("gd.jpeg_ignore_warning", 1);
            list($oldwidth, $oldheight, $type) = getimagesize($source_path);

            switch ($type)
            {
                case IMAGETYPE_JPEG: $typestr = 'jpeg'; break;
                case IMAGETYPE_JPG: $typestr = 'jpg' ; break;
                case IMAGETYPE_PNG: $typestr = 'png'; break;
            }

            $function = "imagecreatefrom$typestr";
            $src_resource = $function($source_path);

            if (!$newheight)
            {
                $newheight = round($newwidth * $oldheight/$oldwidth);
            }
            elseif (!$newwidth)
            {
                $newwidth = round($newheight * $oldwidth/$oldheight);
            }
            $destination_resource = imagecreatetruecolor($newwidth,$newheight);

            imagecopyresampled($destination_resource, $src_resource, 0, 0, 0, 0, $newwidth, $newheight, $oldwidth, $oldheight);

            if ($type = 2)
            {
                imageinterlace($destination_resource, 1);
                imagejpeg($destination_resource, $destination_path, $quality);
            }
            else
            {
                $function = "image$typestr";
                $function($destination_resource, $destination_path);
            }

            imagedestroy($destination_resource);
            imagedestroy($src_resource);
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
            if($this -> upLoadFile() == true)
            {
                for($i = 0; $i <count($file);$i++)
                {
                    echo '<img alt = "Фото" src = "img_small/'.$file .'">';
                }
            }
            else
            {
                echo "фото не загружено";
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