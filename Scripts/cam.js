var video = document.getElementById('video');
    // Get access to the camera!
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
    document.getElementById("snap").addEventListener("load", function() {
        context.drawImage(video, 0, 0, 640, 480);
    });


    if(document.getElementById('obj').checked) {
        document.getElementById("snap").disabled = false;
    }
    else
        document.getElementById("snap").disabled = true;
    function enable()
    {
        document.getElementById("snap").disabled = false;
    }

function uploadEx() {
    context.drawImage(video, 0, 0, 640, 480);
    if(document.getElementById('obj').checked) {
        var dataURL = canvas.toDataURL("image/png");
        document.getElementById('img').value = document.getElementById('obj').value;
        console.log(document.getElementById('img').value);
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
    }
};
