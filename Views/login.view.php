<?php 
    require_once "../Models/login.php";
    include("header.view.php");
    
?>
    <head>
        <link rel="stylesheet" href="../Styles/main.css">
    </head>
    <body style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,166,208,1) 0%, rgba(96,202,212,1) 100%);">
        <section class='register'>
            <div class="container">
                <div class="form">
                    <h1>Login</h1>
                    <p>To see funny photos from your friends.</p>
                    <?php
                        if(isset($user->username_err)) echo "<div class='btn_danger animated shake'>". $user->username_err . "</div>";
                        if(isset($user->password_err)) echo "<div class='btn_danger animated shake'>". $user->password_err . "</div>";
                        if(isset($user->system_err)) echo "<div class='btn_danger animated shake'>". $user->system_err . "</div>";
                        if(isset($user->status_err)) echo "<div class='btn_danger animated shake'>". $user->status_err . "</div>";
                    ?>
                    <form action="" method="POST">
                        <label for="username" >Username</label>
                        <input type="text" name="username" autocomplete="off"> 
                        <label for="password">Password</label>
                        <input type="password" name="password" autocomplete="off">
                        <input type="submit" value="Login">
                    </form>
                    <span>Don't Have an account? <a href="signup.view.php">Signup</a></span>
                    
                </div>
            </div>
        </section>
<?php include("footer.view.php"); ?>