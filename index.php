<?php
    require_once "./config/connect.php";
    include("./Views/header.view.php");

    // include "./Class/Db.class.php";
    // include "./Class/pagination.class.php";


    include "./Class/Db.class.php";
    include "./Class/Form.class.php";
    include "./Class/User.class.php";
    include "./Class/pagination.class.php";
 
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
        header("location: ./Views/logged.view.php");
?>
<head>
        <link rel="stylesheet" href="./Styles/animate.css">
        <link rel="stylesheet" href="./Styles/style.css">
         <link rel="stylesheet" href="./Styles/logged.css">
</head>
<body>
    <?php
            $post = new Database;
            $list_post = new Pagination(5,"posts");
            if(isset($_GET['page']) || !isset($_GET['page']))
            {
                if($list_post->paginate())
                {
                    foreach($list_post->fetch as $row)
                    {
                        if($post->total_likes("likes",$row["id"]) != '')
                        {
                            $total = $post->total_likes("likes",$row["id"]);
                        }
                        echo "<div class=post>";
                            echo "<section class=title>";
                                echo "<div class=name>".$row['username']."</div>";
                                echo "<div class=creationdate>".$row['creation_date']."</div>";
                            echo "</section>";
                            echo "<img src='./Models/upload/".$row['image']."'/>";
                            echo "<section class=likes><a href='./Views/login.view.php'><img src='./Assets/like.png'/></a> likes " . $total ."</section>";
                            echo "<form method='POST'>
                            <section class=comment>". 
                           "<input type='hidden' name='id' value='".$row['id']
                            ."'/><a href='./Views/login.view.php'>login to comment</a></section>
                            
                            </form>";
                            if($post->fetchcomments("comments",$row["id"]))
                            {
                                foreach($post->fetch as $com)
                                {
                                    echo $com["username"] . "=> " . $com["comment"]. "<br>";
                                }
                            }
                            
                        echo "</div>";
                    }
                    $page = 1;
                    echo "<div class='conpage'>";
                    while($page <= $list_post->total_pages)
                    {
                        echo '<a class=pagination href="?page=' . $page . '">' . $page . '</a>';
                        $page++;
                    }
                    echo "</div>";
                }
            }

        ?>
        </body>
</html>