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
                    echo $row['username'];
                    echo "<img src='../Models/upload/".$row['image']."'/>";
                    echo $row['likes'];
                    echo "<br>";
                }
            }
        ?>
    </body>
</html>