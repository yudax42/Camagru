<?php
    require_once "../Models/createpost.php";
    include("header.view.php");
    if($_SESSION["loggedin"] != true)
        header("location: ../index.php");
?>
    <body>
        <video id="video" width="640" height="480" autoplay></video>
        <button id="snap" onclick="uploadEx()" value="Upload">Snap Photo</button>
        <canvas id="canvas" width="640" height="480"></canvas>  
        <form method="post" accept-charset="utf-8" name="form1">
            <input name="hidden_data" id='hidden_data' type="hidden"/>
        </form>




    <script>
        if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            // Not adding `{ audio: true }` since we only want video now
            navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
                //video.src = window.URL.createObjectURL(stream);
                video.srcObject = stream;
                video.play();
            });
        }
        var canvas = document.getElementById('canvas');
        var context = canvas.getContext('2d');
        var video = document.getElementById('video');

        // Trigger photo take
        document.getElementById("snap").addEventListener("click", function() {
            context.drawImage(video, 0, 0, 640, 480);
        });
        function uploadEx() {
                var canvas = document.getElementById("canvas");
                var dataURL = canvas.toDataURL("image/png");
                document.getElementById('hidden_data').value = dataURL;
                var fd = new FormData(document.forms["form1"]);
 
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../Models/createpost.php', true);
 
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        var percentComplete = (e.loaded / e.total) * 100;
                        console.log(percentComplete + '% uploaded');
                        alert('Succesfully uploaded');
                    }
                };
 
                xhr.onload = function() {
 
                };
                xhr.send(fd);
        };
    </script>
    </body>
</html>