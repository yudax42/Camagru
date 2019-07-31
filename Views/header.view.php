<?php
    $page_name = basename($_SERVER['PHP_SELF']);
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta name="description" content="This is camagru website">
        <title>Camagru</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

            <link rel="stylesheet" href="<?php if($page_name != "index.php") echo ".";?>./Styles/animate.css">
            <link rel="stylesheet" href="<?php if($page_name != "index.php") echo ".";?>./Styles/style.css">
        <?php
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == "true")
            {

        ?>
            <link rel="stylesheet" href="../Styles/logged.css">
            <?php } ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <header>
            <div class="container">
                <nav>
                    <div class="logo" >
                            <a href="http://<?php echo $_SERVER["HTTP_HOST"]?>/camagru/Views/logged.view.php"><img src="http://<?php echo $_SERVER["HTTP_HOST"]?>/camagru/Assets/logo.jpg" alt="Camagru"></a>
                    </div>
                    <?php
                        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == "true")
                        { 
                    ?>
                        <ul>
                            <li><a href="createpost.view.php"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
                            <li><a href="editprofile.view.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                            <li><a href="http://<?php echo $_SERVER["HTTP_HOST"]?>/camagru/Views/logged.view.php?action=logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                        </ul>  


                    <?php
                        }
                        else
                        {
                    ?>
                        <ul>
                            <li><a href="http://<?php echo $_SERVER["HTTP_HOST"]?>/camagru/Views/login.view.php"><i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
                            <li><a href="http://<?php echo $_SERVER["HTTP_HOST"]?>/camagru/Views/signup.view.php"><i class="fa fa-user-plus" aria-hidden="true"></i></a></li>
                        </ul>

                    <?php
                        }
                    ?>
                </nav>
            </div>
        </header>