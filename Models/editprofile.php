<?php
    session_start();
    require_once "../config/connect.php";
    include "../Class/Db.class.php";
    include "../Class/Form.class.php";
    include "../Class/User.class.php";

    $query = "SELECT username,email FROM users WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $_SESSION["username"]);
    if($stmt->execute())
    {
        $result = $stmt->fetchAll();
        foreach($result as $row);
        {
            $username = $row["username"];
            $email = $row["email"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["username"] = $row["username"];
        }
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $user_info = array
        (
            "username" => $_POST['username'],
            "email" => $_POST['email'],
            "password" => $_POST['password']
        );
        $update = new User($user_info);
        $update->update_info();
    }

    unset($stmt);
    unset($conn);
