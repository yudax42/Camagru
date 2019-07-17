<?php
    include("./Views/header.view.php");
    include "./Class/Db.class.php";
    include "./Class/pagination.class.php";
 
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
        header("location: ./Views/logged.view.php");
?>
<html>
    <head>  
        <link rel="stylesheet" href="./Styles/style.css">
        <link rel="stylesheet" href="./Styles/animate.css">
    </head>
    <?php
            $list_post = new Pagination(5,"posts");
            if(isset($_GET['page']) || !isset($_GET['page']))
            {
                if($list_post->paginate())
                {

                    foreach($list_post->fetch as $row)
                    {
                        echo "<div class=post>";
                            echo "<section class=title>";
                                echo "<div class=name>".$row['username']."</div>";
                                echo "<div class=creationdate>".$row['creation_date']."</div>";
                            echo "</section>";
                            echo "<img src='../Models/upload/".$row['image']."'/>";
                            echo "<section class=likes><a href='?like=yes'><img src='../Assets/like.png'/></a> likes " . $row['likes'] ."</section>";
                            echo "<form action='#' method='POST'>
                            <section class=comment>". 
                            "<input type='text' name='comment'>"
                            ."<input type='hidden' name='id' value='".$row['id']
                            ."'/><button type='submit'>submit</button></section>
                            
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
</html>