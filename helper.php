<?php
function fetchAlbums($connect){
    $sql = "SELECT albums.id, albums.name, artists.name AS artist, albums.year, albums.score, albums.image FROM albums INNER JOIN artists ON albums.artist_id = artists.id ORDER BY id DESC";
    $results = mysqli_query($connect, $sql);
    $return = array();
    if($results && mysqli_num_rows($results) >= 1){
        $return = $results;
    }
    return $return;
}


function getAlbum($connect,$id){
    $sql= "SELECT albums.*, artists.name AS artist FROM albums ".
            "INNER JOIN artists ON albums.artist_id = artists.id ".
            "WHERE albums.id = $id";

    $album = mysqli_query($connect, $sql);
    
    $return = array();
    if($album && mysqli_num_rows($album) >= 1){
        $return = mysqli_fetch_assoc($album);
    }
    
    return $return;
}
?>