<?php require_once '../../models/comp.php';  
require_once '../../models/I.php';?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php foreach ($companies as $company) 
    echo '<title> '.$company->Name.'</title>' ?>
    <link rel="stylesheet" href="/view/css/main.css">
</head>

<body>
    <?php require_once "../blocks/header.php"; ?>
    <div class="wrapper">
        <div class="feedback">
            <div class="container">
                <?php foreach ($companies as $company)
                    echo '<h2>'.$company->Name.'</h2>
                        <h2><img src="/view/img/'.$company->Img_path.'" alt=""style="width: 300px; height: 300px;"></h2>
                        <h3 style="white-space: pre-wrap;">'.$company->Info.'</h3>' ?>
                <h1>Отзовы</h1> 
                <?php 
                    if ($_SESSION['role'] != 'guest' && $_SESSION['role'] != null) { 
                        $foundReview = null; // Initialize variable to hold the found review
                        
                        // Loop through reviews to find the user's review
                        foreach ($rev as $review) {
                            if ($review->Id_user == $_SESSION["Id_user"]) {
                                $foundReview = $review; 
                                break; 
                            }
                        }
                        if ($foundReview != null) { ?>
                            <form method="post" action="/controls/Updaterev.php">
                                <label>Мой отзыв</label>
                                <?php echo'<input type="hidden" name="id" value="'.$foundReview->Id_review.'">
                                <textarea class="one-line" name="rev" style="height: 200px;"  required>'.$foundReview->Review.'</textarea>'?>
                                <button type="submit">Изменить</button>
                            </form>
                        <?php } else { ?>
                            <form method="post" action="/controls/Addcomment.php?id=<?php echo $id; ?>">
                                <label>Мой отзыв</label>
                                <textarea class="one-line" name="rev" style="height: 200px;" required></textarea>
                                <button type="submit">Отправить</button>
                            </form>
                        <?php } 
                    } ?>
                    
                <?php require_once '../../models/revincomp.php';?>
            </div>
        </div>
        <h2> <?php require_once '../../controls/page.php'; ?> </h2>
    </div>
    <?php require_once "../blocks/footer.php"; ?>

</body>

</html>