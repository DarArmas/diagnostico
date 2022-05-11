<?php

//index.php

include('database_connection.php');
$query = 'SELECT * FROM catalogo';
$result = mysqli_query($connect, $query);


if(!$result){
    die('Hubo un error '. mysqli_error($connect));
}

$json = array();

while($row = mysqli_fetch_array($result)){
    $json[] = array(
        'id' => $row['id'],
        'nombre' => $row['nombre'],
    );    
}

$jsonstring =  json_encode($json);

echo $jsonstring;

?>



