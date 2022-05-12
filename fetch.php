<?php

//fetch.php

include('database_connection.php');

$query = "SELECT * FROM albums ORDER BY id DESC";
$statement = $connect->prepare($query);
$statement->execute();
//$result = $statement->fetchAll();
// $total_row = $statement->rowCount();
// $output = '';
// if($total_row > 0)
// {
// 	foreach($result as $row)
// 	{
// 		$output .= '
// 		<tr>
// 			<td>'.$row["herramienta_id"].'</td>
// 			<td>'.$row["herramienta"].'</td>
// 			<td>'.$row["cantidad"].'</td>
// 			<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Eliminar</button></td>
// 		</tr>
// 		';
// 	}
// }
// else
// {
// 	$output .= '
// 	<tr>
// 		<td colspan="4" align="center">Agrega al menos una herramienta</td>
// 	</tr>
// 	';
// }

// echo $output; //equivalente a return

?>