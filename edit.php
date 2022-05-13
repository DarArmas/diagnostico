<?php
 require_once('database_connection.php');
 require_once('helper.php');

 if(isset($_GET["id"])){
    $id = $_GET["id"];
    $album = getAlbum($connect,$id);
    echo $album;
    die();
 }


?>