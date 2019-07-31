<?php
    require_once "database.php";
    global $conn;
    $conn = new PDO($DB_DSN,$DB_USER,$DB_PASSWORD);
    try
    {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        die("ERROR: Could not connect. " . $e->getMessage());
    }
