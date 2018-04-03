<?php
require_once 'tools/common.php';

if(isset($_GET['item_id'] ) ){


    $queryItem = $db->prepare('
		SELECT item.* , category_item.description
		FROM item
		JOIN category_item
		WHERE item.id = ? AND item.is_published = 1');
    $queryItem->execute( array( $_GET['item_id'] ) );

    $item = $queryItem->fetch();

    if(!$item){
        header('location:index.php');
        exit;
    }
}

        $queryImage = $db->query('SELECT * FROM item WHERE is_published = 1 LIMIT 1');
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

        <div class="col-4 d-flex flex-column justify-content-start align-items-center">
        </div>

        <?php while($items = $queryImage->fetch()): ?>
            <div class="col-4 d-flex justify-content-center align-items-center">
                <?php if(!empty($item['image'])): ?>
                    <div>
                        <img id="image-main-item" src="image/image-all/<?php echo $item['image']; ?>" class="img-fluid" alt="Responsive image">
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>


        <div class="col-4 d-flex flex-column justify-content-center align-items-start">
            <form action="basket.php" method="post" enctype="multipart/form-data">
                <div id="information">
                    <h1><?php echo $item['title']; ?></h1>
                    <h2 class="d-flex justify-content-center align-items-center"><?php echo $item['price']; ?>$</h2>
                    <h5 class="d-flex justify-content-center align-items-center"><?php echo $item['description']; ?></h5>

                    <div class="form-group d-flex justify-content-center align-items-center">
                        <label for="sizes"></label>
                        <select class="form-control" name="sizes" id="sizes">
                            <option disabled selected value>Size</option>
                            <option>S</option>
                            <option>M</option>
                            <option>L</option>
                            <option>XL</option>
                        </select>
                    </div>
                    <div class="form-group d-flex justify-content-center align-items-center">
                        <label for="quantity"></label>
                        <select class="form-control" name="quantity" id="quantity">
                            <option disabled selected value>Quantity</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <input class="btn button-color " type="submit" name="update" value="Add to basket"/>
                        <input type="hidden" name="item_id" value="<?php echo $item['id'] ?>">
                    </div>

                </div>
            </form>
        </div>
    </div>
    <?php require 'partials/footer.php';?>
    <?php require 'partials/footer_js.php';?>

</div>
</body>
</html>