<?php
    require_once "View/index.html";

    class index{

        private $cookie;

        public function EchoCookie(){

            $this -> cookie = $_COOKIE['Error'];
            echo $this -> cookie;
            unset($this -> cookie);
        }
    }
    $index = new index();
    $index -> EchoCookie();
?>