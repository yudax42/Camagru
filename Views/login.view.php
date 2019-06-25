<?php 
    require_once "../Models/login.php";
    include("header.view.php");
    
?>
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
                        <input type="submit">
                    </form>
                    <span>Don't Have an account? <a href="signup.view.php">Signup</a></span>
                    
                </div>
            </div>
        </section>
        <footer>

        </footer>
    </body>
</html>