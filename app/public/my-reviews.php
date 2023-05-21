<?php
declare(strict_types=1);

include "_includes/database-connection.php";
include "_includes/global-functions.php";

session_start();


$title = "En webbsida med PHP";


$sql = "SELECT * FROM bom WHERE `user_id` = '$_SESSION[user_id]'";

$result = $pdo->prepare($sql);
$result->execute();
$rows = $result->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?>
    </title>
</head>

<body>

    <header>
        <h2>Explore</h2>
        <div>usericon</div>
    </header>

    <section>
        <?php
        echo $_SESSION['user_name'];
        foreach ($rows as $row) {
            echo "<div>";
            foreach ($row as $key) {
                echo $key;
            }
            echo "</div>";
        }
        ?>
    </section>

    <footer>
        <a href="explore.php">Explore</a>
        <a href="">+</a>
        <a href="my-reviews.php">My reviews</a>
    </footer>
</body>

</html>