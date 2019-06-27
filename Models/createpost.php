<?php
    session_start();
    if(!empty($_POST['hidden_data']) && !empty($_POST['img']))
    {
        $upload_dir = "upload/";
        $img = $_POST['hidden_data'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $name = mktime();
        $file = $upload_dir . $name . ".png";
        file_put_contents($file, $data);
        if($_POST['img'] == 'hacker')
        {
            $dest = imagecreatefrompng($file);
            $src = imagecreatefrompng("../Assets/obj/hacker.png");
            $srcTransparency = 100;
            list($srcWidth, $srcHeight) = getimagesize('../Assets/obj/hacker.png');
        
            $src_xPosition = -100;
            $src_yPosition = -50;
            $src_cropXposition = 0;
            $src_cropYposition = 0;
            imagecolortransparent($src,imagecolorat($src,0,0));
            imagecopymerge($dest,$src,$src_xPosition,$src_yPosition,$src_cropXposition,$src_cropYposition,$srcWidth,$srcHeight,$srcTransparency);
            imagejpeg($dest,$file,100);
        }
       
    }
    
?>