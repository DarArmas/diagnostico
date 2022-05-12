<?php

//index.php

include('database_connection.php');
if(isset($_POST)){
    $name = $_POST['name'];
    $artist = $_POST['artist'];
    $year = $_POST['year'];


    if($comentario == ""){
        $query1 = 'INSERT INTO kardex(movimiento, descripcion) VALUES (1, "Prestamo de material comun")';
    }else{
        $query1 = 'INSERT INTO kardex(movimiento, descripcion) VALUES (1, "'.$comentario.'")';
    }

   
    $result1 = mysqli_query($connect, $query1);
    if(!$result1){
        die('Fallo al crear movimiento en kardex');
    }

    $result2 = mysqli_query($connect, "SELECT id FROM kardex ORDER BY fecha DESC LIMIT 1");

    if($result2){
        $id_mov_array = mysqli_fetch_array($result2);//obtener el id de kardex
        $id_mov = $id_mov_array[0];
    }


     
     echo "Pedido realizado correctamente";

 }

?>



