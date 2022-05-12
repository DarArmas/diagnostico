<?php

//index.php
if(isset($_POST)){
    require_once('database_connection.php');

    $name = isset($_POST['name']) ? mysqli_real_escape_string($connect, $_POST['name']) : false;
    $artist = isset($_POST['artist']) ? mysqli_real_escape_string($connect, $_POST['artist']) : false;
    $year = isset($_POST['year']) ? mysqli_real_escape_string($connect, $_POST['year']) : false;
    $score = isset($_POST['score']) ? mysqli_real_escape_string($connect, $_POST['score']) : false;
    

    //echo $_POST["artist_selected"];
    echo $_POST["artist_selected"];
    die();

    if(!empty($name) && !empty($year) && !empty($score) ){
        echo "estoy entrando";
        $sql= "INSERT INTO albums VALUES('$name', 1, '$year', '$score', NULL);";
        $guardar = mysqli_query($db, $sql);
    }
     echo "Album added to your list";
 }

?>



