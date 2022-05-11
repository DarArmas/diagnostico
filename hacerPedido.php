<?php

//index.php

include('database_connection.php');
if(isset($_POST['selected_list'])){
    $herramientas = $_POST['selected_list'];
    $comentario = $_POST['comentario'];

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


    

     foreach($herramientas as $herramienta){

         $codigo = $herramienta['codigo'];
        
         $query3 = 'SELECT id FROM catalogo WHERE numserie = '. $codigo .' OR codigo = '. $codigo;
         $result3 = mysqli_query($connect, $query3); 
         if($result3){
            $id_array = mysqli_fetch_array($result3);
            $id = $id_array[0];
         }

         

         //UPDATE inventarioutl SET qtyc= (qtyc + 1), qtyf = (qtyco - qtyc) WHERE herramienta = 4350
        $query4 = 'UPDATE inventarioutl SET qtyc = (qtyc + ' . $herramienta['cantidad'] . '), qtyf = (qtyo - qtyc) WHERE herramienta = '. $id;
        
        $result4 = mysqli_query($connect, $query4);
        if(!$result4){
            die('Fallo al actualizar');
        }

         //Insertar registros en kardex_detalle
         $query5 = 'INSERT INTO kardex_detalle(id_kardex, id_herramienta, qty) VALUES('. $id_mov .','. $id .','. $herramienta['cantidad'].')';
         $result5 = mysqli_query($connect, $query5);
         if(!$result5){
             die('Fallo al insertar en kardex_detalle');
         }
     }
     
     echo "Pedido realizado correctamente";
   

 }

?>



