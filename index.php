<?php

require_once 'tools/common.php';

if(isset($_GET['logout']) && isset($_SESSION['user'])){

    unset($_SESSION["user"]);
    unset($_SESSION["is_admin"]);
}
$queryImage = $db->query('
							SELECT item.*
							FROM item
							WHERE item.is_published = 1
							ORDER BY created_at DESC '
);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Original'creatioN</title>
    <?php require 'partials/head_assets.php'; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
</head>
<body class="body">
<div class="container-fluid ctnr-fld-mar-padgn">
    <?php  require 'partials/header.php';?>
    <div class="row">
        <section class="block">
            <div class="carousel slide" id="featured" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active item">
                        <img class="d-block img-fluid" src="image/utilitaire/background-carousel-1.jpg" alt="slider1">
                    </div>
                    <div class="carousel-item item">
                        <img class="d-block img-fluid" src="image/utilitaire/background-carousel-2.jpg" alt="slider2">
                    </div>
                    <div class="carousel-item item">
                        <img class="d-block img-fluid" src="image/utilitaire/background-carousel-3.jpg" alt="slider2">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#featured" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true">
                <span class="sr-only">Previous</span>
            </span>
                </a>
                <a class="carousel-control-next" href="#featured" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true">
                <span class="sr-only">Next</span>
            </span>
                </a>
            </div>
        </section>
    </div>


    <div class="row main-index" >
        <div class="container d-flex">
            <div class="row">
                <?php while($item = $queryImage->fetch()): ?>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 test1">
                    <?php if(!empty($item['image'])): ?>
                    <div class="style-hover cont d-flex justify-content-center align-items-center">
                        <a href="item-page.php?item_id=<?php echo $item['id']; ?>" >
                            <img class="image-index" src="image/image-all/<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                        </a>
                    </div>
                    <?php endif; ?>


                    <?php if(!empty($item['image'])): ?>
                        <div class="style-hover cont d-flex justify-content-center align-items-center">
                            <a href="item-page.php?item_id=<?php echo $item['id']; ?>" >
                                <img class="image-index" src="image/image-all/<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($item['image'])): ?>
                        <div class="style-hover cont d-flex justify-content-center align-items-center">
                            <a href="item-page.php?item_id=<?php echo $item['id']; ?>" >
                                <img class="image-index" src="image/image-all/<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($item['image'])): ?>
                        <div class="style-hover cont d-flex justify-content-center align-items-center">
                            <a href="item-page.php?item_id=<?php echo $item['id']; ?>" >
                                <img class="image-index" src="image/image-all/<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <?php $queryImage->closeCursor(); ?>
                <?php endwhile; ?>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 test2">
                    <div class="style-hover cont d-flex justify-content-center align-items-center">
                        <a href="#">
                            <img class="image-index" src="image/image-all/">
                        </a>
                    </div>
                    <div class="style-hover cont d-flex justify-content-center align-items-center">
                        <a href="#">
                            <img class="image-index" src="image/image-all/">
                        </a>
                    </div>
                    <div class="style-hover cont d-flex justify-content-center align-items-center">
                        <a href="#">
                            <img class="image-index" src="image/image-all/">
                        </a>
                    </div>
                    <div class="style-hover cont d-flex justify-content-center align-items-center">
                        <a href="#">
                            <img class="image-index" src="image/image-all/">
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 test3">
                    <div class="style-hover cont d-flex justify-content-center align-items-center">
                        <a href="#">
                            <img class="image-index" src="image/image-all/">
                        </a>
                    </div>
                    <div class="style-hover cont d-flex justify-content-center align-items-center">
                        <a href="#">
                            <img class="image-index" src="image/image-all/">
                        </a>
                    </div>
                    <div class="style-hover cont d-flex justify-content-center align-items-center">
                        <a href="#">
                            <img class="image-index" src="image/image-all/">
                        </a>
                    </div>
                    <div class="style-hover cont d-flex justify-content-center align-items-center">
                        <a href="#">
                            <img class="image-index" src="image/image-all/">
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>





































    <?php require 'partials/footer.php';?>
    <?php require 'partials/footer_js.php';?>
</div>
</body>
</html>