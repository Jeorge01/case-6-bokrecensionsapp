<?php
declare(strict_types=1);

include "_includes/database-connection.php";
include "_includes/global-functions.php";

session_start();


$title = "Create review";


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $img_url = trim($_POST['img_url']);
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $year_published = $_POST['year_published'];
    $review = trim($_POST['review']);
    $created_at = date("Y-m-d H:i:s");
    
    if ($img_url === "") {
        $img_url = "https://source.unsplash.com/random/?bookcover";
    }

    // kontrollera att minst 2 tecken finns i fältet för username
    if (strlen($title) >= 2) {

        // spara till databasen
        $sql = "INSERT INTO `bom` (`book_id`, `img_url`, `title`, `author`, `year_published`, `review`, `created_at`, `user_id`) VALUES (NULL, '$img_url', '$title', '$author', '$year_published', '$review', '$created_at', '$_SESSION[user_id]')";

        try {
            // använd databaskopplingen för att spara till tabellen i databasen
            $result = $pdo->exec($sql);

            header("location: my-reviews.php");
        } catch (PDOException $error) {
            echo "There was a problem " . $error->getMessage(); 
        }
        
    }
}


$year = date("Y");
// echo "$year";
    

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

    <h2>Create review</h2>

    

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="text" name="title" id="title" placeholder="Title" required minlength="2" maxlength="255">
        <input type="text" name="author" id="author" placeholder="Author" required minlength="2" maxlength="255">
        <input type="text" name="img_url" id="img_url" placeholder="Image URL" value="">
        <input type="number" name="year_published" id="year_published" placeholder="Publication year" required
            minlength="2" maxlength="4" min="0">
        <textarea name="review" id="review" cols="30" rows="5" required minlength="2" maxlength="255"></textarea>
        <input type="submit" value="Spara">
    </form>

    
</body>

</html>