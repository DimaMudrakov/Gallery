<?php
class ConnectDatabases
{
    public function connectDatabase($host, $user, $password)
    {
          mysql_connect($host, $user, $password);
        return true;

    }
    public  function selectDataBase($DaBasename)
    {

             mysql_select_db($DaBasename);

            return true;
    }
}
class imageUpload extends ConnectDatabases
    {
        public function upLoadFile()
        {
            if (isset($_POST['submit'])) {
                if (is_uploaded_file($_FILES['upload']['tmp_name'])) {
                    if ($_FILES['upload']['type'] == 'image/jpg' or $_FILES['upload']['type'] == 'image/jpeg' or $_FILES['upload']['type'] == 'image/png') {
                        if ($_FILES['upload']['size'] <= 1048576) {
                            copy($_FILES["upload"]["tmp_name"], "images/" . $_FILES["upload"]["name"]);
                            $this->imageResize($_FILES['upload']['tmp_name'], 'img_small/' . $_FILES['upload']['name'], 450, 450, 100);
                            return true;
                        } else {
                            exit("Размер файла не должен превышать 1мб");
                        }
                    } else {
                        exit ("Не верный формат файла");
                    }
                } else {
                    exit ("Выберите файл");
                }

            } else {
                exit ("Выберите файл и нажмите загрузить фотографию");
            }

        }

        public function imageResize($source_path, $destination_path, $newwidth, $newheight, $quality)
        {
            ini_set("gd.jpeg_ignore_warning", 1);
            list($oldwidth, $oldheight, $type) = getimagesize($source_path);

            switch ($type) {
                case IMAGETYPE_JPEG:
                    $typestr = 'jpeg';
                    break;
                case IMAGETYPE_JPG:
                    $typestr = 'jpg';
                    break;
                case IMAGETYPE_PNG:
                    $typestr = 'png';
                    break;
            }

            $function = "imagecreatefrom$typestr";
            $src_resource = $function($source_path);

            if (!$newheight) {
                $newheight = round($newwidth * $oldheight / $oldwidth);
            } elseif (!$newwidth) {
                $newwidth = round($newheight * $oldwidth / $oldheight);
            }
            $destination_resource = imagecreatetruecolor($newwidth, $newheight);

            imagecopyresampled($destination_resource, $src_resource, 0, 0, 0, 0, $newwidth, $newheight, $oldwidth, $oldheight);

            if ($type = 2) {
                imageinterlace($destination_resource, 1);
                imagejpeg($destination_resource, $destination_path, $quality);
            } else {
                $function = "image$typestr";
                $function($destination_resource, $destination_path);
            }

            imagedestroy($destination_resource);
            imagedestroy($src_resource);
        }

        public function getGallery()
        {
            $images = array();

            $opendir = opendir('img_small');

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
            if ($this->upLoadFile() == true and $this->getGallery() == true) {
                $images = $this-> getGallery();
                foreach ($images as $img) {
                    echo '<a href = "images/' . $img . '"><img alt = "Фото" src = "img_small/' . $img . '"></a>';
                }
            } else {
                echo "фото не загружено";
            }
        }
        public function insertDBimg()
        {
            $this -> connectDatabase('localhost', 'root', 3333);
            $this -> selectDataBase('gallery');
            $this -> upLoadFile();
            if(isset($_FILES['upload']['name']))
            {
                $date = date('Y-m-d H:i:s');
                $name = $_FILES['upload']['name'];
                $rename = md5($name);
                $query = mysql_query("INSERT INTO image VALUES( '0','$date', '$name' , '$rename')") or die (mysql_error());
            }
            else
            {
                echo 'error';
            }
        }


    }

    $db = new ConnectDatabases;
    $imageUpload = new imageUpload;
    $imageUpload -> echoGallery();
    $imageUpload -> insertDBimg();

?>