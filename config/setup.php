<?php
    require_once "database.php";
    $DB_DSN = 'mysql:host=localhost';
	$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	);
	try
	{
		$conn = new PDO($DB_DSN,$DB_USER,$DB_PASSWORD,$options);

		$q = "		
				CREATE DATABASE IF NOT EXISTS camagru;
				use camagru;
				CREATE TABLE IF NOT EXISTS users(
					id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
					username varchar(50) NOT NULL UNIQUE,
					email varchar(255) NOT NULL,
					password varchar(255) NOT NULL,
					property enum('not active','active') NOT NULL,
					user_activation_code varchar(255) NOT NULL,
					status enum('not verified','verified') NOT NULL
				);
				CREATE TABLE IF NOT EXISTS posts(
					id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
					user_id int NOT NULL,
					username varchar(50) NOT NULL,
					creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
					image BLOB NOT NULL,
					likes INT NOT NULL
				);
				CREATE TABLE IF NOT EXISTS comments(
					id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
					post_id int NOT NULL,
					comment TINYTEXT NOT NULL
				);
		";
		$conn->exec($q);
		$q2 = "
			use camagru;
			ALTER TABLE posts ADD FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE;
			ALTER TABLE comments ADD FOREIGN KEY (post_id) REFERENCES posts(id) ON UPDATE CASCADE ON DELETE CASCADE;
        ";
        $conn->exec($q2);
        echo "<h1>Database Schema Created sucessfuly</h1>";
        echo "Table Created:<br>";
        echo "users √ <br>";
        echo "posts √ <br>" ;
        echo "comments √<br>";
	}
	catch(PDOException $e)
	{
		echo 'Failed ' . $e->getMessage();
	}