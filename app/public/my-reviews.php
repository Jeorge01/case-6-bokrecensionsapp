<?php
declare(strict_types=1);

include "_includes/database-connection.php";
include "_includes/global-functions.php";

session_start();

$page_title = "My reviews";


$sql = "SELECT * FROM bom WHERE `user_id` = '$_SESSION[user_id]'";

// echo "$sql";

$result = $pdo->prepare($sql);
$result->execute();
$rows = $result->fetchAll();




// $book_id = $rows['book_id'];
// echo "$_SESSION[book_id]";



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

    <header>
        <h2>
            <?= $page_title ?>
        </h2>
        <div>
            <?= "<a href=\"edit-profile.php?user_id=$_SESSION[user_id]\">Profile</a>"; ?>
        </div>
    </header>

    
    <section>
        <?php
       
        foreach ($rows as $row) {
            $book_id = $row['book_id'];
            
            echo '<div class="card">

                <div class="img_container">
                    <img src="' . $row['img_url'] . '">
                    <a href="edit-review.php?book_id=' . $book_id . '">Edit</a>
                </div>

                <div class="info_container">

                    <div class="title_container">
                    <h3>' . $row['title'] . '<h3>
                    </div>

                    <div class="review_container">
                    <p>' . $row['review'] . '</p>
                    </div>

                    <div class="author_and_year_container">
                    <p>By ' . $row['author'] . ' and published year ' . $row['year_published'] . '</p>
                    </div>

                    <p class="review_created_at_text">Review created at: ' . $row['created_at'] . '<P>

                </div>

            </div>';
        }
        
        ?>
    </section>

    <footer>
        <a href="explore.php">Explore</a>
        <a href="create.php">+</a>
        <a href="my-reviews.php">My reviews</a>
    </footer>
</body>

</html>