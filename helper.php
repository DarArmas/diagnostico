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


function getAlbum($conexion,$id){
    $sql= "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre,' ',u.apellidos) AS usuario FROM entradas e INNER JOIN categorias c ON e.categoria_id = c.id ".
            "INNER JOIN usuarios u ON e.usuario_id = u.id ".
            "WHERE e.id = $id";
    $entrada = mysqli_query($conexion, $sql);
    
    $resultado = array();
    if($entrada && mysqli_num_rows($entrada) >= 1){
        $resultado = mysqli_fetch_assoc($entrada);
    }
    
    return $resultado;
}
?>