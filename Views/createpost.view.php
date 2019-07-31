<?php
    require_once "../Models/createpost.php";
    include("header.view.php");
    if($_SESSION["loggedin"] != true)
        header("location: ../index.php");
    $post = new Database;
    if($_SERVER['REQUEST_METHOD'] == "GET" )
    {
        if(isset($_GET['delete']) && !empty($_GET['delete']))
        {
             
            if($post->delete_element_from_db("posts","id",$_GET['delete'],$_SESSION['username']) == 1)
                $status = 1;
        }
    }
?>
    <head>
        <link rel="stylesheet" href="../Styles/createpost.css">
        <link rel="stylesheet" href="../Styles/main.css">
        <link rel="stylesheet" href="../Styles/animate.css">
    </head>
    <body>
        <div class="container">
            <?php
                if(isset($err) && !empty($err)) echo "<div class='error animated shake'>".$err. "</div>";
            ?>
            <div id='err' class='error animated shake' hidden></div>
            <div class="left">
            <video id="video"  autoplay></video>
            <p>Or upload image PNG</p>
            <form action="#" method="post" enctype="multipart/form-data">
                <input name="img1" id='img1' type="hidden"/>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form>
                <label>
                    <input class='obj' type="radio" name="obj" onclick="enable()" value="bucket"/>
                    <img src="../Assets/obj/bucket.png">
                </label>
                <label>
                    <input class="obj" type="radio" name="obj" onclick="enable()" value="macaw"/>
                    <img src="../Assets/obj/macaw.png">
                </label>
                <label>
                    <input class="obj" type="radio" name="obj" onclick="enable()" value="sunset"/>
                    <img src="../Assets/obj/sunset.png">
                </label>
                <label>
                    <input class="obj" type="radio" name="obj" onclick="enable()" value="beach-ball"/>
                    <img src="../Assets/obj/beach-ball.png">
                </label>
                <label>
                    <input class="obj" type="radio" name="obj" onclick="enable()" value="compass"/>
                    <img src="../Assets/obj/compass.png">
                </label>
                <input type="button" id ="snap" onclick="uploadEx()" value="Upload" />
                <!-- hidden element -->
                <canvas id="canvas" width="640" height="480" hidden></canvas>
                <canvas id='blank' style='display:none'></canvas>
                <form method="post" accept-charset="utf-8" name="form1">
                    <!-- <input type="image" class="posimg"> -->
                    <input name="img" id='img' type="hidden"/>
                    <input name="hidden_data" id='hidden_data' type="hidden"/>
                </form>
            </div>
            <div class="right">
            <?php
               
                if($post->fetch_user_table("posts",$_SESSION['username']))
                {
                    foreach($post->fetch as $row)
                    {
                        echo "<div class='myimgs'>";
                        echo "<img src='../Models/upload/".$row['image']."'/>";
                        echo "<a href='?delete=".$row['id']."'><i class='fa fa-trash' aria-hidden='true'></i></a>";
                        echo "</div>";
                    }
                }

            ?>
            </div>
            <div style="clear:both"></div>
        </div>



        <script src="../Scripts/cam.js"></script>
<?php include("footer.view.php"); ?>