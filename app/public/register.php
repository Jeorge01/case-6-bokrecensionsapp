<?php
declare(strict_types=1);

require_once "_includes/database-connection.php";
include "_includes/global-functions.php";

// setup table user and table book or movie
setup_user($pdo);
setup_bom($pdo);

// en variabel i php inleds med dollartecken
$title = "Sign up";

$user_name = "";


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $user_name = trim($_POST['user_name']);
    $hashed_user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

    // if ($user_name === "Lasse" || "lasse") {
    //     echo "Men hur ska Lasse logga in?";
    //     exit();
    // }


    // kontrollera att minst 2 tecken finns i fältet för username
    if (strlen($user_name) >= 2) {

        

        // spara till databasen
        $sql = "INSERT INTO `user` (`user_name`, `user_password`) VALUES ('$user_name', '$hashed_user_password')";

        try {
            // använd databaskopplingen för att spara till tabellen i databasen
            $result = $pdo->exec($sql);

            header("location: login.php");
        } catch (PDOException $error) {
            echo "There was a problem " . $error->getMessage(); 
        }
        
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

    <a href="index.php"><</a>


    <h1><?= $title ?></h1>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="text" name="user_name" id="user_name" placeholder="Username" required minlength="2" maxlength="25">
        <input type="password" name="user_password" id="user_password" placeholder="Password" required minlength="2" maxlength="255">
        
        <button type="submit">Sign up</button>
    </form>


</body>
</html>