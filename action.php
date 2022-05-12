<?php

//action.php <- obtener un registro (1 herramienta) con su cantidad disponible
include('database_connection.php');


if(isset($_POST))
{	
	$codigo_serie = $_POST["codigo_serie"];

	$query = 'SELECT catalogo.id, catalogo.descripcion, inventarioutl.qtyf FROM catalogo ' 
		. 'INNER JOIN inventarioutl ON catalogo.id = inventarioutl.herramienta '
		. 'WHERE catalogo.numserie = "'.$codigo_serie.'" OR catalogo.codigo = "' . $codigo_serie . '"';

	$resultado = mysqli_query($connect, $query);

	if(!$resultado){
        die('Hubo un error '. mysqli_error($connect));
    }

	$json = array();

	while($row = mysqli_fetch_array($resultado)){
        $json[] = array(
            'id' => $row['id'],
            'descripcion' => $row['descripcion'],
            'qtyf' => $row['qtyf']
        );    
    }

	$jsonstring =  json_encode($json[0]);

	echo $jsonstring;
	
	
}

?>