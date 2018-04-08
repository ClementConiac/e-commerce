<?php
require_once 'tools/common.php';

if(isset($_GET['item_id'] ) ){

    $queryItem = $db->prepare('
		SELECT item.* , category_item.description
		FROM item
		JOIN category_item
		WHERE item.id = ? AND item.is_published = 1
		 ');
    $queryItem->execute( array( $_GET['item_id'] ) );

    $item = $queryItem->fetch();
    //si pas d'article trouvé dans la base de données, renvoyer l'utilisateur vers la page index
    if(!$item['id']){
        header('location:index.php');
        exit;
    }

    //récupération des images

    $query = $db->prepare('
		SELECT image.*
		FROM image
		JOIN item ON image.item_id = item.id 
		WHERE item.id = ? AND image.model = 0
		ORDER BY image.id
	');
    $query->execute( array( $_GET['item_id'] ) );

    $images = $query->fetchAll();
}


$queryImage1 = $db->query('
            SELECT *
            FROM item
            WHERE item.is_published = 1
            ORDER BY RAND()
            LIMIT 4'
);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Homepage - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>
</head>

<body class="body">
<div class="container-fluid">
    <?php  require 'partials/header.php';?>
    <div class="row" id="main-item">
        <div class="col-4 d-flex flex-column justify-content-start align-items-end contain-other ">
            <?php foreach ($images as $image): ?>
                <!--<a class="" data-fancybox="gallery" href="image/image-all/<?php echo $image['name']; ?>">-->
                    <img class="img-fluid image-item" src="image/image-all/<?php echo $image['name']; ?>" alt="<?php echo $image['caption']; ?>" />
                <!--</a>-->
            <?php endforeach; ?>
        </div>


        <div class="col-4 d-flex justify-content-center align-items-center">
            <?php if(!empty($item['image'])): ?>
                <div>
                    <img id="image-main-item" src="image/image-all/<?php echo $item['image']; ?>" class="img-fluid" alt="Responsive image">
                </div>
            <?php endif; ?>
        </div>



        <div class="col-4 d-flex flex-column justify-content-start align-items-start">
            <form action="basket.php" method="post" enctype="multipart/form-data">
                <div id="information">
                    <h1 class="d-flex justify-content-start align-items-center"><?php echo $item['title']; ?></h1>
                    <h5 class="d-flex justify-content-start align-items-center"><?php echo $item['description']; ?></h5>
                    <h3 class="d-flex justify-content-start align-items-center"><?php echo $item['price']; ?>€</h3>


                    <div class="form-group d-flex justify-content-start align-items-center pb-3">
                        <label for="sizes"></label>
                        <select class="form-control" name="sizes" id="sizes">
                            <option disabled selected value>Size</option>
                            <option>S</option>
                            <option>M</option>
                            <option>L</option>
                            <option>XL</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-start align-items-center">
                        <input class="btn button-color " type="submit" name="update" value="Add to basket"/>
                        <input type="hidden" name="item_id" value="<?php echo $item['id'] ?>">
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="row suggest">
        <h3 class="suggest-text">Vous pouriez aussi aimer :</h3>
        <?php while($item1 = $queryImage1->fetch()): ?>
            <?php if(!empty($item1['image'])): ?>
                <div class="suggest-item  justify-content-center align-items-center hvr-glow">
                    <a href="item-page.php?item_id=<?php echo $item1['id']; ?>" >
                        <img class="suggest-image" src="image/image-all/<?php echo $item1['image']; ?>" alt="<?php echo $item1['title']; ?>">
                    </a>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
    <?php require 'partials/footer.php';?>
    <?php require 'partials/footer_js.php';?>

</div>
</body>
</html>