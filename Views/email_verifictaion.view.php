<?php 
    session_start();
    require_once "../Models/email_verification.php";
    include("header.view.php");
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == "true")
    {
        header("location: logged.view.php");
    }
        
?>
    <body>
        <div class="succes_mail_box animated zoomInDown">

            <img class="animated zoomInUp" src="../Assets/<?php if(User::$email_status == 1) echo "mail_verified";else echo "like";?>.png" alt="mail_icon">
            <h2 class="animated zoomInUp">Cool ! you can now login</h2>
            <p class="animated zoomInUp"><?php echo User::$email_msg;?></p>
            <a class="animated zoomInUp" href="login.view.php">login</a>
        </div>

    </body>

</html>