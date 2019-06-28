<?php
    require_once "../config/connect.php";
    include "../Class/Db.class.php";
    include "../Class/Form.class.php";
    include "../Class/User.class.php";
    require_once "../Models/logged.php";
    include("header.view.php");
    if($_SESSION["loggedin"] != true)
        header("location: ../index.php");
?>
    <body class="animated fadeIn">
        <h1>Welcome, <?php echo $_SESSION["username"];?></h1>
       
        <?php
            $post = new Database;
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
                        echo "<section class=likes>" . $row['likes'] ."</section>";
                        echo "<section class=comments>". "</section>";
                    echo "</div>";
                }
            }
        ?>
        </div>
    </body>
</html>