<?php
    session_start();
    require_once "../config/connect.php";
    include "../Class/Db.class.php";
    include "../Class/Form.class.php";
    include "../Class/User.class.php";
    include "../Class/pagination.class.php";
    $post = new Database;
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if(isset($_GET["action"]) && $_GET["action"] == "logout")
        {
            $_SESSION=array();
            session_destroy();
            header("location: ../Views/login.view.php");
        }
    }
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["comment"]) && !empty($_POST['comment']) && isset($_POST["id"]))
        {
            $comment = htmlentities($_POST["comment"]);
            $arr =
            [
                "post_id" => $_POST["id"],
                "username"=> $_SESSION["username"],
                "comment" => $comment
            ];
           
            if(!$post->insert_to_db("comments",$arr)) 
                echo "Error";
        }
    }
?>
