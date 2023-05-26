<?php
declare(strict_types=1);

include "_includes/database-connection.php";
include "_includes/global-functions.php";

session_start();



$page_title = "Edit profile";





if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $user_name = trim($_POST['user_name']);
    $hashed_user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

    // kontrollera att minst 2 tecken finns i fältet för username
    if (strlen($user_name) >= 2) {

        // spara till databasen
        $sql = "UPDATE `user` SET `user_name` = '$user_name', `user_password` = '$hashed_user_password' WHERE `user_id` = $_SESSION[user_id]";

        try {
            // använd databaskopplingen för att spara till tabellen i databasen
            $result = $pdo->exec($sql);
            echo "Shit asså";
            echo "$sql";
            // header("location: my-reviews.php");
        } catch (PDOException $error) {
            echo "There was a problem " . $error->getMessage();
        }

    }
}

// $login_id_check1 = $row['user_id'];
$login_id_check2 = $_SESSION['user_id'];

// echo $login_id_check1;
// echo $login_id_check2;

// echo "$_SESSION[user_id]";

// echo "$row[user_id]";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $page_title ?>
    </title>
</head>

<body>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <header>
            <a href="my-reviews.php">cancel</a>
            <h2>
                <?= $page_title ?>
            </h2>
            <input type="submit" value="Apply">
        </header>
        <?php

        // if ($login_id_check1 === $login_id_check2) {
        // ($row['user_id'] = $_session['user_id'])
        ?>


        <h3>Username</h3> <input type="text" name="user_name" id="user_name" placeholder="New username"
            value="<?= $_SESSION['user_name'] ?>">
        <h3>Password</h3> <input type="password" name="user_password" id="user_password" placeholder="New password" value="">
    </form>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">

        <a href="login.php">Sign out</a>
        <a href="">Delete user</a>
    </form>

    <?php
    // }
    ?>

    <?php

    // if ($login_id_check1 != $login_id_check2) {
    //     header("location: my-reviews.php");
    //     echo "Touch some grass instead";
    // }
    
    ?>
</body>

</html>