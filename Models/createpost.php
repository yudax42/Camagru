<?php
    session_start();
    if(!empty($_POST['hidden_data']) && !empty($_POST['img']))
    {
        $upload_dir = "upload/";
        $img = $_POST['hidden_data'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = $upload_dir . mktime() .$_POST['img']. ".png";
        if($_POST['img'] == 'hacker')
        {
            $src = imagecreatefrompng('../Assets/obj/hacker.png');
            imagecopymerge($data, $src, 10, 9, 0, 0, 181, 180, 100);
            $success = file_put_contents($file, $data);
        }
       
    }
    
?>