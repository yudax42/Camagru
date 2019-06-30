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
                    <input class='obj' type="radio" name="obj" onclick="enable()" value="hacker"/>
                    <img src="../Assets/obj/hacker.png">
                </label>
                <label>
                    <input class="obj" type="radio" name="obj" onclick="enable()" value="mail"/>
                    <img src="../Assets/obj/mail.png">
                </label>
                <label>
                    <input class="obj" type="radio" name="obj" onclick="enable()" value="code"/>
                    <img src="../Assets/obj/code.png">
                </label>
                <label>
                    <input class="obj" type="radio" name="obj" onclick="enable()" value="1337"/>
                    <img src="../Assets/obj/1337.png">
                </label>
                <label>
                    <input class="obj" type="radio" name="obj" onclick="enable()" value="basma"/>
                    <img src="../Assets/obj/basma.png">
                </label>
                <input type="button" id ="snap" onclick="uploadEx()" value="Upload" />
                <!-- hidden element -->
                <canvas id="canvas" width="640" height="480" hidden></canvas>
                <form method="post" accept-charset="utf-8" name="form1">
                    <input type="image" class="posimg">
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