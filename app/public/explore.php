<?php
declare(strict_types=1);

include "_includes/database-connection.php";
include "_includes/global-functions.php";

session_start();

// echo "$_SESSION[user_id]";

$title = "Explore";


$sql = "SELECT * FROM bom";

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
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@700,500,300&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <div></div>
        <h2>
            <?= $title ?>
        </h2>
        <div>
            <?= "<a href=\"edit-profile.php?user_id=$_SESSION[user_id]\"><ion-icon name=\"person-circle-outline\"></ion-icon></a>"; ?>
        </div>
    </header>

    <section>
        <?php
        // echo $_SESSION['user_name'];
        // echo $_SESSION['user_id'];
        foreach ($rows as $row) {
            $book_id = $row['book_id'];

            echo '<div class="card">

                <div class="img_container">
                    <img src="' . $row['img_url'] . '">
                </div>

                <div class="info_container">

                    <div class="title_container">
                    <h3>' . $row['title'] . '<h3>
                    </div>

                    <div class="review_container">
                    <p>' . $row['review'] . '</p>
                    </div>

                    <div class="author_container">
                    <p>Author: ' . $row['author'] . '</p>
                    </div>

                    <div class="year_container">
                    <p>Publication year: ' . $row['year_published'] . '</p>
                    </div>

                    <div class="user_name_container">
                    <p>Review created by ' . "kalle" . '</p>
                    </div>

                    <p class="review_created_at_text">' . substr($row['created_at'], 0, -9) . '</p>
                </div>

            </div>';
        }
        ?>
    </section>

    <footer>
        <a href="explore.php">Explore</a>
        <a href="create.php"><ion-icon name="add-circle-outline"></ion-icon></a>
        <a href="my-reviews.php">My reviews</a>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>