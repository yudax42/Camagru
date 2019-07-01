<?php
    require_once "../Models/createpost.php";
    include("header.view.php");
    if($_SESSION["loggedin"] != true)
        header("location: ../index.php");
?>
    <head>
        <link rel="stylesheet" href="../Styles/createpost.css">
    </head>
    <body>
        <div class="container">
            <div class="left">
            <video id="video"  autoplay></video>
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
                <form method="post" accept-charset="utf-8" name="form1">
                    <!-- <input type="image" class="posimg"> -->
                    <input name="img" id='img' type="hidden"/>
                    <input name="hidden_data" id='hidden_data' type="hidden"/>
                </form>
            </div>
            <div class="right">
            <?php
                $post = new Database;
                if($post->fetch_user_table("posts",$_SESSION['username']))
                {
                    foreach($post->fetch as $row)
                    {
                        echo "<img src='../Models/upload/".$row['image']."'/>";
                    }
                }

            ?>
            </div>
        </div>



        <script src="../Scripts/cam.js"></script>
    </body>
</html>