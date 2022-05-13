<?php
if(isset($_POST) && !empty($_POST['id'])){
    require_once('database_connection.php');
    require_once('helper.php');

    if(isset($_SESSION['user'])){
        $id = $_POST['id'];
    if($id){
        $sql = "DELETE FROM albums where id =$id";
        $delete = mysqli_query($connect, $sql);
        if($delete){
            $albums = fetchAlbums($connect);
            $table = '';
                if(!empty($albums)){
                    while($album = mysqli_fetch_assoc($albums)){
                        $table .= "<tr>";
                        $table .= "<td></td>";
                        $table .= "<td>".$album['name']."</td>";
                        $table .= "<td>".$album['artist']."</td>";
                        $table .= "<td>".$album['year']."</td>";
                        $table .= "<td>".$album["score"]."</td>";
                        $table .= '<td>
                                    <a href="edit.php?id='.$album['id'].'" class="edit-album"><i class="fas fa-edit"></i></a>
											<a href="delete.php" class="delete-album" id='.$album['id'].'> 
												<i class="text-danger fas fa-trash"></i>
											</a>
										</td>
									</tr>';
                    }
                }
            echo $table;
        }
        }
    }
    

   
}
