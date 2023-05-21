<?php
declare(strict_types=1);

include "_includes/database-connection.php";
include "_includes/global-functions.php";

$title = "Sign in";

session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $user_name = trim($_POST['user_name']);
    $user_password = $_POST['user_password'];

    // kontrollera att minst 2 tecken finns i fältet för username
    if (strlen($user_name) >= 2) {

        // spara till databasen
        $sql = "SELECT * FROM `user` WHERE `user_name` = '$user_name'";

        try {
            // använd databaskopplingen för att spara till tabellen i databasen
            $result = $pdo->query($sql);
            $user = $result->fetch();
            

            if (!$user) {
                $_SESSION['message'] = "Username does not exsists";
                header("location: login.php");
                exit();
            }

            $correct_password = password_verify($user_password, $user['user_password']);

            if (!$correct_password) {
                $_SESSION['message'] = "Invalid password";
                header("location: login.php");
                exit();
            }

            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_id'] = $user['user_id'];
            header("location: explore.php");
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
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>

    <?php
    include "_includes/header.php";
    ?>

    <a href="index.php">back</a>

    <h1>
        <?= $title ?>
    </h1>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="text" name="user_name" id="user_name" placeholder="Username" required minlength="2" maxlength="25">
        <input type="password" name="user_password" id="user_password" placeholder="Password" required minlength="2" maxlength="255">
        <button type="submit">Sign in</button>
    </form>

    <?php
    include "_includes/footer.php";
    ?>

</body>

</html>