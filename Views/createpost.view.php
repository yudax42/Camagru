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
            <video id="video"  autoplay></video>
            <div>
                <input type="button" id ="snap" onclick="uploadEx()" value="Upload" />
            </div>

            <input class='obj' type="radio" name="obj" onclick="enable()" value="hacker"/>
            <li id='hacker'><img src="../Assets/obj/hacker.png"></li>
            <input class="obj" type="radio" name="obj" onclick="enable()" value="mail"/>
            <li id='mail'><img src="../Assets/mail.png"></li>


            <canvas id="canvas" width="640" height="480" hidden></canvas>
            <form method="post" accept-charset="utf-8" name="form1">
                <input name="img" id='img' type="hidden"/>
                <input name="hidden_data" id='hidden_data' type="hidden"/>
            </form>
            
        </div>
        <script src="../Scripts/cam.js"></script>
    </body>
</html>