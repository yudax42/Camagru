<?php

    require_once "../config/connect.php";
    include "../Class/Db.class.php";
    include "../Class/Form.class.php";
    include "../Class/User.class.php";
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: ../Views/logged.view.php");
        exit;
    }
    if($_SERVER["REQUEST_METHOD"] == 'POST')
    {
        $user_info = array
        (
            "username" => $_POST['username'],
            "password" => $_POST['password']
        );
        $user = new User($user_info);
        if($user->login())
        {
            echo "yes";
            header("location: ../Views/logged.view.php");
        }
    }
?>
