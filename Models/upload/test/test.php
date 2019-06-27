<?php

    // imagealphablending($photo, false);
    // imagealphablending($watermark, false);
    // $offset = 10;
    // imagecopymerge($photo, $watermark, 0, 0, 100, 0, 10, 10, 100);
    // header('Content-Type: image/png');
    // imagejpeg($photo,'out.jpg');
    // function merge_png($sourceImage,$destImage)
    // {


    $dest = imagecreatefrompng("y.png");
    $src = imagecreatefrompng("../../../Assets/obj/hacker.png");
    $srcTransparency = 100;
    list($srcWidth, $srcHeight) = getimagesize('../../../Assets/obj/hacker.png');

    $src_xPosition = -100;
    $src_yPosition = -50;
    $src_cropXposition = 0;
    $src_cropYposition = 0;
    imagecolortransparent($src,imagecolorat($src,0,0));
    imagecopymerge($dest,$src,$src_xPosition,$src_yPosition,$src_cropXposition,$src_cropYposition,$srcWidth,$srcHeight,$srcTransparency);
    imagejpeg($dest,'result.jpeg',100);




    // }
    // merge_png($photo,$watermark);

// function merge_jpg($sourceImage,$destImage)
// {
//     $srcTransparency = 100;
//     list($srcWidth, $srcHeight) = getimagesize($sourceImage);
//     $src = imagecreatefrompng($sourceImage);
//     $dest = imagecreatefromjpeg($destImage);
//     $src_xPosition = 10;
//     $src_yPosition = 50;
//     $src_cropXposition = 0;
//     $src_cropYposition = 0;
//     imagecolortransparent($src,imagecolorat($src,0,0));
//     imagecopymerge($dest,$src,$src_xPosition,$src_yPosition,$src_cropXposition,$src_cropYposition,$srcWidth,$srcHeight,$srcTransparency);
//     imagejpeg($dest,'result.jpeg',100);
// }

