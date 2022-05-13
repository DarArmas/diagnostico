<?php
if(isset($_POST)){
    require_once('database_connection.php');
    require_once('helper.php');
    
    $name = isset($_POST['name']) ? mysqli_real_escape_string($connect, $_POST['name']) : false;
    $artist_string = isset($_POST['artist']) ? strtolower(mysqli_real_escape_string($connect, $_POST['artist'])) : false;
    $year = isset($_POST['year']) ? mysqli_real_escape_string($connect, $_POST['year']) : false;
    $score = isset($_POST['score']) ? mysqli_real_escape_string($connect, $_POST['score']) : false;
    $photo = NULL;

    $file = $_FILES['image'];
    $file_name = $file['name'];
    $type =$file['type'];

    if($type == "image/jpg" || $type == "image/jpeg" || $type == "image/png" || $type == "image/gif"){
        if(!is_dir('assets/images')){     
            mkdir('assets/images',0777);
        }
        move_uploaded_file($file['tmp_name'], 'assets/images/'.$file_name);
        $photo = $file_name;
    }

    
    if(isset($_GET['edit'])){
        $artist = isset($_POST['artist']) ? $_POST['artist'] : false;
        $id_album = $_GET['edit'];
        $sql= "UPDATE albums SET name='$name', artist_id=$artist, year='$year', score='$score'".
        "WHERE id=$id_album";
        $update = mysqli_query($connect, $sql);
        if($update){
            header("Location: index.php");
        }
    }else{
        $sql = "SELECT * FROM artists WHERE name = '$artist_string'";
        $artist_id = mysqli_query($connect, $sql);
        $artist = '';
        if($artist_id && mysqli_num_rows($artist_id) >= 1){
            $artist_id = mysqli_fetch_assoc($artist_id);
            $artist = $artist_id["id"];
        }else{
            $sql = "INSERT INTO artists VALUES(NULL,'$artist_string')";
            mysqli_query($connect, $sql);
            $artist = mysqli_insert_id($connect);
        }
    
        if(!empty($name) && !empty($artist) && !empty($year) && !empty($score)){
            $sql= "INSERT INTO albums VALUES(NULL, '$name', $artist, '$year', '$score', '$photo');";
            $save = mysqli_query($connect, $sql);
            if($save){
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

?>



