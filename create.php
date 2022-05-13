<?php
if(isset($_POST)){
    require_once('database_connection.php');

    $name = isset($_POST['name']) ? mysqli_real_escape_string($connect, $_POST['name']) : false;
    $artist_string = isset($_POST['artist']) ? strtolower(mysqli_real_escape_string($connect, $_POST['artist'])) : false;
    $year = isset($_POST['year']) ? mysqli_real_escape_string($connect, $_POST['year']) : false;
    $score = isset($_POST['score']) ? mysqli_real_escape_string($connect, $_POST['score']) : false;

    $sql = "SELECT * FROM artists WHERE name = '$artist_string'";
    $artist_id = mysqli_query($connect, $sql);

    $artist = '';
    if($artist_id && mysqli_num_rows($artist_id) >= 1){
        $artist_id = mysqli_fetch_assoc($artist_id);
        $artist = $artist_id["id"];
    }else{
        $sql = "INSERT INTO artists VALUES(NULL,'$artist_string')";
        mysqli_query($connect, $sql);
        $artist = mysqli_insert_id($connect);
    }

    if(!empty($name) && !empty($artist) && !empty($year) && !empty($score) ){
        $sql= "INSERT INTO albums VALUES(NULL, '$name', $artist, '$year', '$score', NULL);";
        $save = mysqli_query($connect, $sql);
        if($save){
            echo "Album added to your list";
        }
    }
 }

?>



