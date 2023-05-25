<?php
declare(strict_types=1);

include "_includes/database-connection.php";
include "_includes/global-functions.php";

session_start();



$page_title = "Edit review";

$title = "";
$author = "";
$year_published = "";
$review = "";






if ($_SERVER['REQUEST_METHOD'] === "POST") {

    print_r2($_POST);

    $user_id = $_POST['user_id'];
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $year_published = trim($_POST['year_published']);
    $review = trim($_POST['review']);
    $created_at = date("Y-m-d H:i:s");
    $book_id = isset($_POST['book_id']) ? $_POST['book_id'] : 0;

    $action_delete = isset($_POST['delete']) ? true : false;

    if ($action_delete) {
        $sql = "DELETE FROM bom WHERE `bom`.`book_id` = $book_id";

        try {
            // använd databaskopplingen för att spara till tabellen i databasen
            $result = $pdo->exec($sql);

            header("location: my-reviews.php");
        } catch (PDOException $error) {
            echo "There was a problem " . $error->getMessage();
        }
    }



    // kontrollera att minst 2 tecken finns i fältet för username
    if (strlen($title) >= 2) {

        // spara till databasen
        $sql = "UPDATE `bom` SET `title` = 'kalles', `author` = '$author', `year_published` = '$year_published', `review` = '$review' WHERE `bom`.`book_id` = $book_id";

        try {
            // använd databaskopplingen för att spara till tabellen i databasen
            $result = $pdo->exec($sql);

            header("location: my-reviews.php");
        } catch (PDOException $error) {
            echo "There was a problem " . $error->getMessage();
        }

    }
}



if ($_SERVER['REQUEST_METHOD'] === "GET") {

    $book_id = isset($_GET['book_id']) ? $_GET['book_id'] : 0;

    $sql = "SELECT * FROM `bom` WHERE book_id = $book_id";

    $result = $pdo->prepare($sql);
    $result->execute();
    $row = $result->fetch();

    if ($row) {
        // print_r2($row);
        // print_r2($book_id);
        $title = $row['title'];
        $author = $row['author'];
        $year_published = $row['year_published'];
        $review = $row['review'];
    }
}

$login_id_check1 = $row['user_id'];
$login_id_check2 = $_SESSION['user_id'];

echo $login_id_check1;
echo $login_id_check2;

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
    

    <h2>Create review</h2>

    <?php 

    if ($login_id_check1 === $login_id_check2) {
        // ($row['user_id'] = $_session['user_id'])
    ?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="text" name="title" id="title" placeholder="Title" required minlength="2" maxlength="255"
            value="<?= $title ?>">
        <input type="text" name="author" id="author" placeholder="Author" required minlength="2" maxlength="255"
            value="<?= $author ?>">
        <input type="number" name="year_published" id="year_published" placeholder="Publication year" required
            minlength="2" maxlength="255" min="0" value="<?= $year_published ?>">
        <textarea name="review" id="review" cols="30" rows="10" required minlength="2"
            maxlength="255"><?= $review ?></textarea>
        <input type="hidden" name="book_id" value="<?= $row['book_id'] ?>">
        <input type="submit" value="Spara ändringar">
        <input type="submit" value="Radera" name="delete">

        <a href=""></a>
    </form>

    <?php 
    }
    ?>

    <?php

    if (!$row) {
        echo "This Book id does not exist!";
    }

    if ($login_id_check1 != $login_id_check2) {
        header("location: my-reviews.php");
        echo "Touch some grass instead";
    }

    ?>
</body>

</html>