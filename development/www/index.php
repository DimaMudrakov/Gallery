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
                echo "Выберите файл и нажмите загрузить фотографию";
            }

        }
    }
    $index = new index();
    $index -> EchoCookie();

?>