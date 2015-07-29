<?php

    require_once './Controller/GalleryController.php';

   class DisplaySelect{

       public function echoCreateTS($select)
       {
           echo $select['CreateTS'];
       }
    }
?>
