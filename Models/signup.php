<?php
    session_start();
    require_once "../config/connect.php";
    include "../Class/Db.class.php";
    include "../Class/Form.class.php";
    include "../Class/User.class.php";
    
  
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $user_info = array
        (
            "username" => $_POST['username'],
            "email" => $_POST['email'],
            "password" => $_POST['password']
        );
        $user = new User($user_info);
        $user->signup();
    }
?>
