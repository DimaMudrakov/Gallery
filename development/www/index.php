<?php
    require_once "View/index.html";

    class index{

        private $cookie;

        public function EchoCookie(){

            if(isset($_COOKIE['Error'])) {
                $this -> cookie = $_COOKIE['Error'];
                echo $this->cookie;
                unset($this->cookie);
            }
            else{
                echo '<div class = "select_file">'."Выберите файл и нажмите загрузить фотографию" .'</div>';
            }

        }
    }
    $index = new index();
    $index -> EchoCookie();

?>