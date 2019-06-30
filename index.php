<?php
    include("./Views/header.view.php");
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
        header("location: ./Views/logged.view.php");
?>
<html>
    <head>  
        <link rel="stylesheet" href="./Styles/style.css">
        <link rel="stylesheet" href="./Styles/animate.css">
    </head>
</html>