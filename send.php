<?php
    $to = "yobenadda@gmail.com";
    $subjects = "Cheating";
    $body=
    "
    <html>  
        <head>
            <style>
                p{color:red};
            </style>
        </head>
        <body>
            <p style='color: red;'>Hello</p>
        </body>
    </html>
    "
    ;
    $from = "no-reply@42.fr";
    if(mail($to,$subjects,$body,"FROM: $from"));
        echo "Taaes";