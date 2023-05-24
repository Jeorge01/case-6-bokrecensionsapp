<?php

$servername = "mysql";
$database = "db_case";
$username = "db_user";
$password = "db_password";

$dsn = "mysql:host=$servername;dbname=$database";

try {
    $pdo = new PDO($dsn, $username, $password);

    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function setup_user($pdo)
{
    $sql = "CREATE TABLE IF NOT EXISTS `user` (
        `user_id` int(11) NOT NULL AUTO_INCREMENT,
        `user_name` varchar(25) NOT NULL,
        `user_password` varchar(255) NOT NULL,
        UNIQUE KEY `user_id` (`user_id`),
        UNIQUE KEY `user_name` (`user_name`)
       ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

       $result = $pdo->exec($sql);
}

function setup_bom($pdo)
{
    $sql = "CREATE TABLE IF NOT EXISTS `db_case`.`bom` 
    (`book_id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) 
    NOT NULL , `author` VARCHAR(255) NOT NULL , `year_published` 
    YEAR NOT NULL , `review` TEXT NOT NULL , `created_at` 
    DATETIME NOT NULL , `user_id` INT NOT NULL , PRIMARY KEY 
    (`book_id`)) ENGINE = InnoDB;";

    $result = $pdo->exec($sql);
}