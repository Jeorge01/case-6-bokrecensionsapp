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



    // kontrollera att minst 2 tecken finns i fältet för username
    if (strlen($user_name) >= 2) {

        function taken_user_name($user_name) {
            global $pdo;

            $sql_select = $pdo->prepare("SELECT COUNT(*) FROM `user` WHERE `user_name` = :user_name");
            $sql_select->bindParam(':user_name', $user_name);
            $sql_select->execute();
            $count = $sql_select->fetchColumn();
            return $count > 0;
        }

        $taken = taken_user_name($user_name);
        

        if ($taken) {
            header("location: register.php?username_already_exists");
        }



        // spara till databasen
        $sql = "INSERT INTO `user` (`user_name`, `user_password`) VALUES ('$user_name', '$hashed_user_password')";

        try {
            // använd databaskopplingen för att spara till tabellen i databasen
            $result = $pdo->exec($sql);

            header("location: login.php?register=success");
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
    <title>
        <?php echo $title; ?>
    </title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@700,500,300&display=swap" rel="stylesheet">
</head>

<body>

    <!-- <a href="index.php"><</a> -->

    <div class="start_container">
        <div class="log_reg_container">
            <h1>
                <?= $title ?>
            </h1>
        </div>

        <div class="log_form_container">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="text" name="user_name" id="user_name" placeholder="Username" required minlength="2"
                    maxlength="25">
                <input type="password" name="user_password" id="user_password" placeholder="Password" required
                    minlength="2" maxlength="255">

                <button type="submit">Sign up</button>
                <div class="log_reg">
                    <a href="login.php">Sign in</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>