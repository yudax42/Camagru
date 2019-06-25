<?php 
    require_once "../Models/signup.php";
    include("header.view.php");
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == "true")
    {
        header("location: logged.view.php");
    }
?>
        <section class='register'>
            <div class="container">
                <div class="form">
                    <h1>Signup</h1>
                    <p>To see funny photos from your friends.</p>
                    <?php 
                        if(isset($user->username_err)) echo "<div class='btn_danger animated shake'>". $user->username_err . "</div>";
                        if(isset($user->email_err)) echo "<div class='btn_danger animated shake'>" . $user->email_err . "</div>";
                        if(isset($user->password_err)) echo "<div class='btn_danger animated shake'>". $user->password_err . "</div>";
                        if(isset($user->mail_status) && $user->mail_status == 1) 
                        {
                            echo "<div class='btn_success animated flash'>" . $user->mail_msg . "</div>"; 
                        }
                        else if(isset($mail_status) && $mail_status == 0)
                            echo "<div class='btn_danger animated shake'>" . $user->mail_msg . "</div>"; 

                    ?>
                    <form action="#" method="POST">
                        <label for="username" >Username</label>
                        <input type="text" name="username" autocomplete="off"> 
                        <label for="email">Email</label>
                        <input type="text" name="email" autocomplete="off">
                        <label for="password">Password</label>
                        <input type="password" name="password" autocomplete="off">
                        <input type="submit">
                    </form>
                    <span>Already Have an account? <a href="login.view.php">login</a></span>
                    
                </div>
            </div>
        </section>
        <footer>

        </footer>
    </body>
</html>