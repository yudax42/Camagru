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
            <input type="radio" onclick="enable()" id="obj" value="hacker"/>
                <li id='hacker'><img src="../Assets/obj/hacker.png"></li>

            <canvas id="canvas" width="640" height="480"></canvas>
            <form method="post" accept-charset="utf-8" name="form1">
                <input name="img" id='img' type="hidden"/>
                <input name="hidden_data" id='hidden_data' type="hidden"/>
            </form>
            
        </div>
        <script src="../Scripts/cam.js"></script>
    </body>
</html>