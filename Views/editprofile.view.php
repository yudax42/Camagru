<?php
    require_once "../Models/editprofile.php";
    include("header.view.php");
?>
<head>
    <link rel="stylesheet" href="../Styles/main.css">
</head>
<body class="animated fadein">
    <section class="usersettings container">
        <div class="left">
            <h2>User Settings</h2>
            <p>You can here modify your informations</p>
            <?php if(isset($update->username_update_status)) echo "<span>" . $update->username_update_status . "</span>"?></span>
            <?php if(isset($update->email_update_status)) echo "<span>" . $update->email_update_status . "</span>"?></span>
            <?php if(isset($update->pass_update_status)) echo "<span>" . $update->pass_update_status . "</span>"?></span>
            <form action="" method="POST">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo $username?>">
                <label for="email">Your email</label>
                <input type="text" name="email" value="<?php echo $email?>">
                <label for="password">Password</label>
                <input type="password" name="password">
                <button type="submit">Save</button>
            </form>
        </div>
        <div class="right">

            <div class="info">
                <div class="desactivate">
                    <img src="../Assets/message.png" alt="message">
                    <h4>Desactive comment email option!</h4>
                    <p>Note: you will not receive email notification when someone comment on your post</p>
                    <a href="?property=no"><button>Desactivate</button></a>
                    <a href="?property=yes"><button style="background-color:#87c787;margin-right:5px">activate</button></a>
                </div>
            </div>
        </div>
    </section>
    <div style="clear:both"></div>
<?php include("footer.view.php"); ?>

