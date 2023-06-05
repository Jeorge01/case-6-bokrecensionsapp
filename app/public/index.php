<?php
declare(strict_types=1);

require_once "_includes/database-connection.php";
include "_includes/global-functions.php";

// setup table user and table book or movie
setup_user($pdo);
setup_bom($pdo);

// en variabel i php inleds med dollartecken
$title = "En webbsida med PHP";



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title; ?>
    </title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@700,500,300&display=swap" rel="stylesheet">
</head>

<body>


    <h1>
        <?php echo "Welcome!"; ?>
    </h1>

    <a href="login.php">Sign in</a>
    <a href="register.php">Sign up</a>

</body>

</html>