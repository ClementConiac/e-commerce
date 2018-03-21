<?php
require_once 'tools/common.php';

if(isset($_GET['item_id'] ) ){


    $queryItem = $db->prepare('
		SELECT item.* , category_item.*
		FROM item
		JOIN category_item
		ON item.category_item = category_item.id
		WHERE item.id = ? AND item.is_published = 1');
    $queryItem->execute( array( $_GET['item_id'] ) );

    $item = $queryItem->fetch();

    if(!$item){
        header('location:index.php');
        exit;
    }
}



if(isset($_POST['submit']) && isset($_SESSION["user_firstname"])){
    $query = $db->prepare('INSERT INTO orders (item_title, user_firstname, user_lastname, sizes, quantity) VALUES (?, ?, ?, ?, ?)');
    $newOrder = $query->execute(
        [
            $_POST['item_title'],
            $_POST['user_firstname'],
            $_POST['user_lastname'],
            $_POST['sizes'],
            $_POST['quantity']
        ]
    );

if($newOrder){
    header('location:index.php');
    exit;
}
    else {
        $messages = "Impossible de continuer, veuillez vous connecter";
    }
}
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
<?php
        $queryImage = $db->query('
        SELECT item.* , category_item.name AS category_name
        FROM item
        JOIN category_item
        ON item.category_item = category_item.id
        WHERE is_published = 1
        LIMIT 1'
        );
$message = "Impossible de continuer, veuillez vous connecter"
?>
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
            <form action="item-page.php" method="post" enctype="multipart/form-data">
                <div id="information">
                    <h1><?php echo $item['title']; ?></h1>


                    <h2><?php echo $item['price']; ?>$</h2>

                    <h5><?php echo $item['description']; ?></h5>

                    <div class="form-group">
                        <label for="sizes"> Sizes : </label>
                        <select class="form-control" name="sizes" id="sizes">
                            <option>S</option>
                            <option>M</option>
                            <option>L</option>
                            <option>XL</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity"> Quantity : </label>
                        <select class="form-control" name="quantity" id="quantity">
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

                    <div class="text-right">

                        <?php if(isset($_SESSION['user_firstname'])): ?>
                            <input class="btn" id="button-main-item" type="submit" name="submit" value="Add to basket"/>
                            <div class="form-group">
                                <label for="user_firstname"></label>
                                <input class="form-control" value="<?php echo $_SESSION['user_firstname']?>" type="hidden" name="user_firstname"/>
                            </div>
                            <div class="form-group">
                                <label for="user_lastname"></label>
                                <input class="form-control" value="<?php echo $_SESSION['user_lastname']?>" type="hidden" name="user_lastname"/>
                            </div>
                        <?php else: ?>
                                <?php if(isset($message)): //si un message a été généré plus haut, l'afficher ?>
                                    <div class="p-2 mb-4 text-center" id="message-error">
                                        <?php echo $message; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                    </div>

                    <div class="text-right">

                    </div>
                    <div class="form-group">
                        <label for="item_title"></label>
                        <input class="form-control" value="<?php echo $item['title']?>" type="hidden" name="item_title"/>
                    </div>


                </div>
            </form>
        </div>
    </div>
    <?php require 'partials/footer.php';?>
    <?php require 'partials/footer_js.php';?>
    <?php require 'partials/footer_sociaux.php' ?>
</div>
</body>
</html>














































</body>
</html>