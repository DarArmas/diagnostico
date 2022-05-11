<?php

//index.php

include('database_connection.php');
$query = 'SELECT catalogo.id, catalogo.descripcion, catalogo.codigo, catalogo.numserie, inventarioutl.qtyf FROM catalogo '  
	. 'INNER JOIN inventarioutl ON catalogo.id = inventarioutl.herramienta WHERE inventarioutl.qtyf > 0';
$result = mysqli_query($connect, $query);


if(!$result){
    die('Hubo un error '. mysqli_error($connect));
}

$json = array();

while($row = mysqli_fetch_array($result)){
    $json[] = array(
        'id' => $row['id'],
        'descripcion' => $row['descripcion'],
        'codigo' => $row['codigo'],
        'numserie' => $row['numserie'],
        'qtyf' => $row['qtyf']
    );    
}

$jsonstring =  json_encode($json);

echo $jsonstring;

?>



