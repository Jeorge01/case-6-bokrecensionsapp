<?php
declare(strict_types=1);

require_once "_includes/database-connection.php";
include "_includes/global-functions.php";

session_start();



$page_title = "Edit profile";





if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $user_name = trim($_POST['user_name']);
    $user_password = trim($_POST['user_password']);
    $hashed_user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

    // kontrollera att minst 2 tecken finns i fältet för username
    if (strlen($user_name) >= 2 && strlen($user_password) >= 2) {

        // spara till databasen
        $sql = "UPDATE `user` SET `user_name` = '$user_name', `user_password` = '$hashed_user_password' WHERE `user_id` = $_SESSION[user_id]";

        try {
            // använd databaskopplingen för att spara till tabellen i databasen
            $result = $pdo->exec($sql);
            echo "Username and password has been changed!";
            
            $_SESSION['user_name'] = $user_name;
            header("location: edit-profile.php");
        } catch (PDOException $error) {
            echo "There was a problem " . $error->getMessage();
        }

    }

    else if (strlen($user_name) >= 2 && strlen($user_password) < 2) {

        $sql = "UPDATE `user` SET `user_name` = '$user_name' WHERE `user_id` = $_SESSION[user_id]";

        try {
            // använd databaskopplingen för att spara till tabellen i databasen
            $result = $pdo->exec($sql);
            echo "Username has been changed!";
            
            $_SESSION['user_name'] = $user_name;
            header("location: edit-profile.php");
        } catch (PDOException $error) {
            echo "There was a problem " . $error->getMessage();
        }
    }

    else if (strlen($user_name) < 2 && strlen($user_password) >= 2) {

        $sql = "UPDATE `user` SET `user_password` = '$hashed_user_password' WHERE `user_id` = $_SESSION[user_id]";

        try {
            // använd databaskopplingen för att spara till tabellen i databasen
            $result = $pdo->exec($sql);
            echo "Password has been changed!";
            
            header("location: edit-profile.php");
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
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@700,500,300&display=swap" rel="stylesheet">
</head>

<body>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <header>
            <a href="my-reviews.php"><ion-icon name="chevron-back"></ion-icon></a>
            <h3>
                <?= $page_title ?>
            </h3>
            <input type="submit" value="Apply">
        </header>
        <?php

        // if ($login_id_check1 === $login_id_check2) {
        // ($row['user_id'] = $_session['user_id'])
        ?>

        <div class="edit_profile_container">
            <div>
                <h3>Username</h3> <input type="text" name="user_name" id="user_name" placeholder="New username"
                    value="<?= $_SESSION['user_name'] ?>">
            </div>
            <div>
                <h3>Password</h3> <input type="password" name="user_password" id="user_password"
                    placeholder="New password" value="">
            </div>
        </div>
    </form>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="sign_out_delete_container">
            <a class="log_out_button" href="login.php?logout=success">Sign out</a>
            <a class="delete_user_button" href="">Delete user</a>
        </div>
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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>