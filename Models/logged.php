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
           
            if($post->insert_to_db("comments",$arr)) 
            {
                global $conn;
                $query = "SELECT users.username AS username,users.property AS property,users.email AS email, posts.image AS img FROM `users` INNER JOIN `posts` ON users.username = posts.username WHERE posts.id = " . $_POST["id"];
                $stmt = $conn->prepare($query);
                if($stmt->execute())
                {
                    if($stmt->rowCount() == 1)
                    {
                        $res = $stmt->fetch();
                        $user = $res["username"];
                        $email = $res["email"];
                        $img = $res["img"];
                        $property = $res["property"];
                        if($property == "active" && $user != $_SESSION["username"])
                        {
                            $message = "
                            hi " . $user . "<br>". "<p style='color:red'>" . $_SESSION["username"] . "</p> has commented in your post<br>"
                            . "<img style='width:100px' src='http://localhost/camagru/Models/upload/$img'>" 
                            ."comment : " . $comment;
                            "";
                            if(!mail($email,"Someone Comment on your post",$message,"FROM:root@camagru\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n"))
                                echo "no"; 
                        }
                    }
                    else    
                        echo 'not found';

                }
            }
        }
        if($_SERVER["REQUEST_METHOD"] == "GET")
        {
            global $conn;
         
            if(isset($_GET["like"]) && isset($_GET["id"]))
            {
                $query = "SELECT * FROM `likes` WHERE post_id = " . $_GET["id"] . " AND  username = " . $_SESSION["username"];
                $arr = 
                [
                    "post_id" => $_GET["id"],
                    "username"=> $_SESSION["username"],
                ];
                $stmt = $conn->prepare($query);
                if($stmt->rowCount() != 1 )
                {
                    $post->insert_to_db("likes",$arr);
                    echo "wtf";
                }
            }
        }
    }
?>
