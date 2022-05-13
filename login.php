<?php


require_once 'database_connection.php';

$name = "admin";
$email = "admin@admin.com";
$password = "admin";

if(isset($_POST)){
    if(!isset($_SESSION)){
        session_start();
    }
    $email_user = trim($_POST['email']);
    $password_user = $_POST['password'];

    if($email_user == $email && $password_user == $password){
        $user = array("name"=>$name, "email"=>$email_user);
        $_SESSION['user'] = $user;
        header("Location: index.php");
    }
    
}

?>