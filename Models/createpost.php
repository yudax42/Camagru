<?php
    session_start();
    if(!empty($_POST['hidden_data']))
    {
        $upload_dir = "upload/";
        $img = $_POST['hidden_data'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = $upload_dir . mktime() . ".png";
        $success = file_put_contents($file, $data);
    }
    file_put_contents("name", $_POST['img']);
?>