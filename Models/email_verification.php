<?php
    require_once "../config/connect.php";
    // get the hash to verify
    include "../Class/Db.class.php";
    include "../Class/Form.class.php";
    include "../Class/User.class.php";
    if(isset($_GET['activation_code']))
    {
        if(User::verify_email($_GET['activation_code']) === 0)
        {
            header("location: signup.view.php");
        }
    }
    else
        header("location: signup.view.php");

?>
