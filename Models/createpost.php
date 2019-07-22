<?php
    session_start();
    require_once "../config/connect.php";
    include "../Class/Db.class.php";
    include "../Class/Form.class.php";
    include "../Class/User.class.php";
    if(isset($_POST['hidden_data']) && !empty($_POST['hidden_data']) && !empty($_POST['img']))
    {
        $upload_dir = "upload/";
        $img = $_POST['hidden_data'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $name = mktime();
        $file = $upload_dir . $name . ".png";
        file_put_contents($file, $data);
        if($_POST['img'])
        {
            switch($_POST['img'])
            {
                case "bucket":
                    $obj = "bucket";
                    break;
                case "macaw":
                    $obj = "macaw";
                    break;
                case "sunset":
                    $obj = "sunset";
                    break;
                case "beach-ball":
                    $obj = "beach-ball";
                    break;
                case "compass":
                    $obj = "compass";
                    break;
            }
            $dest = imagecreatefrompng($file);
            $src = imagecreatefrompng("../Assets/obj/$obj.png");
            $srcTransparency = 100;
            list($srcWidth, $srcHeight) = getimagesize("../Assets/obj/$obj.png");
        
            $src_xPosition =  0;
            $src_yPosition = 50;
            $src_cropXposition = 0;
            $src_cropYposition = 0;
            imagecolortransparent($src,imagecolorat($src,0,0));
            imagecopymerge($dest,$src,$src_xPosition,$src_yPosition,$src_cropXposition,$src_cropYposition,$srcWidth,$srcHeight,$srcTransparency);
            imagejpeg($dest,$file,100);
            $arr = [
                "user_id" => $_SESSION["user_id"],
                "username"=> $_SESSION["username"],
                "image" => $name.'.png',
                "likes" => 0
            ];
            $t = new Database;
            if($t->insert_to_db("posts",$arr) == 1)
            {
                echo "ues";
            }
        } 
    }
    if(isset($_FILES["fileToUpload"]) && isset($_POST["img1"]))
    {
        $target_dir = "../Models/upload/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $file = $target_file;
                $name = basename($file);
                switch($_POST['img1'])
                {
                    case "bucket":
                        $obj = "bucket";
                        break;
                    case "macaw":
                        $obj = "macaw";
                        break;
                    case "sunset":
                        $obj = "sunset";
                        break;
                    case "beach-ball":
                        $obj = "beach-ball";
                        break;
                    case "compass":
                        $obj = "compass";
                        break;
                }
                $dest = imagecreatefrompng($file);
                $src = imagecreatefrompng("../Assets/obj/$obj.png");
                $srcTransparency = 100;
                list($srcWidth, $srcHeight) = getimagesize("../Assets/obj/$obj.png");
            
                $src_xPosition =  0;
                $src_yPosition = 50;
                $src_cropXposition = 0;
                $src_cropYposition = 0;
                imagecolortransparent($src,imagecolorat($src,0,0));
                imagecopymerge($dest,$src,$src_xPosition,$src_yPosition,$src_cropXposition,$src_cropYposition,$srcWidth,$srcHeight,$srcTransparency);
                imagejpeg($dest,$file,100);
                $arr = [
                    "user_id" => $_SESSION["user_id"],
                    "username"=> $_SESSION["username"],
                    "image" => $name,
                    "likes" => 0
                ];
                $t = new Database;
                if($t->insert_to_db("posts",$arr) == 1)
                {
                    echo "ues";
                }





            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    
?>