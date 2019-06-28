<?php
    require_once "../Models/logged.php";
    include("header.view.php");
    if($_SESSION["loggedin"] != true)
        header("location: ../index.php");
?>
    <body class="animated fadeIn">
        <h1>Welcome, <?php echo $_SESSION["username"];?></h1>
       
        <?php
            if($post->fetchpost("posts"))
            {
                foreach($post->fetch as $row)
                {
                    echo "<div class=post>";
                        echo "<section class=title>";
                            echo "<div class=name>".$row['username']."</div>";
                            echo "<div class=creationdate>".$row['creation_date']."</div>";
                        echo "</section>";
                        echo "<img src='../Models/upload/".$row['image']."'/>";
                        echo "<section class=likes> likes " . $row['likes'] ."</section>";
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
            }
        ?>
        </div>
    </body>
</html>