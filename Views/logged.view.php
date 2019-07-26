<?php
    require_once "../Models/logged.php";
    include("header.view.php");
    if($_SESSION["loggedin"] != true)
        header("location: ../index.php");
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        global $conn;
        
        if(isset($_GET["like"]) && isset($_GET["id"]))
        {
            $condition = "post_id = " . $_GET["id"] . " AND  username = '" . $_SESSION["username"] . "'";
            $query = "SELECT * FROM `likes` WHERE post_id = " . $_GET["id"] . " AND  username = '" . $_SESSION["username"] . "'";
            $arr = 
            [
                "post_id" => $_GET["id"],
                "username"=> $_SESSION["username"],
                "status" => "liked"
            ];
            $stmt = $conn->prepare($query);
            if($stmt->execute())
            {
                if($stmt->rowCount() == 0)
                {
                    $post->insert_to_db("likes",$arr);
                }
                else if($stmt->rowCount() == 1)
                {
                    $content = $stmt->fetch();
                    if($content["status"] == "liked")
                    {
                        $post->update_element_in_db("likes","status","not liked",$condition);
                    }
                    else if($content["status"] == "not liked")
                    {
                        $post->update_element_in_db("likes","status","liked",$condition);
                    }
                }
            }
        }
    }
?>
    <head>
        <link rel="stylesheet" href="../Styles/main.css">
    </head>
    <body class="animated fadeIn">
        <h1>Welcome, <?php echo $_SESSION["username"];?></h1>
       <div class="container">
        <?php
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
                            echo "<img src='../Models/upload/".$row['image']."'/>";
                            echo "<section class=likes><a href='?like=yes&id=".$row['id']."'><img src='../Assets/like.png'/></a><span>" . $total ." likes</span></section>";
                            echo "<form action='#' method='POST'>
                            <section class=comment>". 
                            "<input type='text' name='comment'>"
                            ."<input type='hidden' name='id' value='".$row['id']
                            ."'/><button type='submit'>submit</button></section>
                            
                            </form>";
                            if($post->fetchcomments("comments",$row["id"]))
                            {
                                echo "<div class='allcomment'>";
                                foreach($post->fetch as $com)
                                {
                                    echo "<div class='pcomment'><span>". $com["username"] . "</span> " . $com["comment"]. "</div>";
                                }
                                echo "</div>";
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
        </div>
        </div>
    </body>
</html>