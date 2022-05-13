<?php

//index.php

include('database_connection.php');
$sql = "SELECT albums.name, artists.name AS artist, albums.year, albums.score, albums.image FROM albums INNER JOIN artists ON albums.artist_id = artists.id";
$result = mysqli_query($connect, $sql);


if(!$result){
    die('There was a mistake '. mysqli_error($connect));
}

$json = array();

while($row = mysqli_fetch_array($result)){
    $json[] = array(
        'name' => $row['name'],
        'artist' => $row['artist'],
        'year' => $row['year'],
        'score' => $row['score'],
        'image' => $row['image']
    );    
}

$jsonstring =  json_encode($json);

echo $jsonstring;

?>


