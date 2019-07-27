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
        $upload_status = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $upload_status = 1;
            } else {
                $err= "File is not an image.";
                $upload_status = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            $err= "Sorry, file already exists.";
            $upload_status = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $err= "Sorry, your file is too large.";
            $upload_status = 0;
        }
        // Allow certain file formats
        if($imageFileType != "png") {
            $err= "Sorry, only PNG files are allowed.";
            $upload_status = 0;
        }
        // Check if $upload_status is set to 0 by an error
        if ($upload_status == 0) {
            $noerr= 0;
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
                    $noerr = 1;
                }





            } else {
                $err= "Sorry, there was an error uploading your file.";
            }
        }
    }
    
?>