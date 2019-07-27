<?php
    $target_dir = "./upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $upload_status = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $err =  "File is an image - " . $check["mime"] . ".";
            $upload_status = 1;
        } else {
            $err = "File is not an image.";
            $upload_status = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $err = "Sorry, file already exists.";
        $upload_status = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $err = "Sorry, your file is too large.";
        $upload_status = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
    {
        $err ="Sorry, only JPG, JPEG, PNG files are allowed.";
        $upload_status = 0;
    }
    // Check if $upload_status is set to 0 by an error
    if ($upload_status == 0) {
        $err = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $err = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            $err = "Sorry, there was an error uploading your file.";
        }
    }

?>