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
    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $db = new Database;
        $status = $_GET["property"];
        if($status == 'yes')
            $db->update_element_in_db("users","property","active","username = '" . $_SESSION["username"] . "'");
        if($status == 'no')
            $db->update_element_in_db("users","property","not active","username = '" . $_SESSION["username"] . "'");
    }

    unset($stmt);
    unset($conn);
