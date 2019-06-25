<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="This is camagru website">
        <title>Signup</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../Styles/animate.css">
        <link rel="stylesheet" href="../Styles/style.css">
        <?php
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
            {
        ?>
            <link rel="stylesheet" href="../Styles/logged.css">  
        <?php
            }
        ?>
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
                            <li><a href="#">create Post</a></li>
                            <li><a href="editprofile.view.php">edit profile</a></li>
                            <li><a href="http://<?php echo $_SERVER["HTTP_HOST"]?>/camagru/Views/logged.view.php?action=logout">logout</a></li>
                        </ul>  


                    <?php
                        }
                        else
                        {
                    ?>
                        <ul>
                            <li><a href="http://<?php echo $_SERVER["HTTP_HOST"]?>/camagru/Views/login.view.php">Login</a></li>
                            <li><a href="http://<?php echo $_SERVER["HTTP_HOST"]?>/camagru/Views/signup.view.php">Signup</a></li>
                        </ul>

                    <?php
                        }
                    ?>
                </nav>
            </div>
        </header>