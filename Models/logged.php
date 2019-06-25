<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if(isset($_GET["action"]) && $_GET["action"] == "logout")
        {
            $_SESSION=array();
            session_destroy();
            header("location: ../Views/login.view.php");
        }
    }
?>
