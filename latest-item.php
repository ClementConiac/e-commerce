<?php

require_once 'tools/common.php';

if(isset($_GET['category_kind_id']) && isset($_GET['category_item_id'])){

    $queryItem = $db->prepare('
		SELECT category_kind.* , category_item.*
		FROM category_kind
		JOIN category_item
		ON category_kind.id = category_item.id
		WHERE category_kind.id = ? AND category_item.id = ?');
    $queryItem->execute( array( $_GET['category_kind_id'] && $_GET['category_item_id']));

    $item = $queryItem->fetch();

    if(!$item){
        header('location:index.php');
        exit;
    }
}

else{
    $query = $db->query('SELECT item.* , category_kind.name AS category_name
						FROM item
						JOIN category_kind 
						ON item.category_kind = category_kind.id 
						WHERE is_published = 1 
						ORDER BY created_at DESC');
    $item = $query->fetchAll();
}

$queryShirtMan = $db->query('
							SELECT item.* , category_item.name AS category_name
							FROM item
							JOIN category_item
							ON item.category_item = category_item.id
							WHERE is_published = 1 AND category_kind = 1 AND category_item = 1
							ORDER BY created_at DESC
							LIMIT 0, 8'
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
    <div class="col-12" id="main">
        <div class="tab-content">
            <div class="tab-pane  active" id="man" role="tabpanel">
                <div class="row d-flex align-items-center justify-content-center" id="popular-shirt-man">
                    <div class="container">
                        <div class="row" >
                            <?php while($itemTeeshirt = $queryShirtMan->fetch()): ?>
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <?php if(!empty($itemTeeshirt['image'])): ?>
                                        <div class="d-flex align-items-center justify-content-around">
                                            <a href="item-page.php?item_id=<?php echo $itemTeeshirt['id']; ?>"><img class="rounded-circle rounded-circle-man"  src="image/image-all/<?php echo $itemTeeshirt['image']; ?>" alt="<?php echo $itemTeeshirt['title']; ?>"></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>


                <div class="row d-flex align-items-center justify-content-center" id="popular-sweat-man">
                    <div class="container">
                        <div class="row">
                            <?php while($itemTeeshirt = $queryShirtMan->fetch()): ?>
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <?php if(!empty($itemTeeshirt['image'])): ?>
                                        <div class="d-flex align-items-center justify-content-around">
                                            <a href="item-page.php?item_id=<?php echo $itemTeeshirt['id']; ?>"><img class="rounded-circle rounded-circle-man" src="image/image-all/<?php echo $itemTeeshirt['image']; ?>" alt="<?php echo $itemTeeshirt['title']; ?>"></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>

    <?php require 'partials/footer.php';?>
    <?php require 'partials/footer_js.php';?>
    <?php require 'partials/footer_sociaux.php' ?>
</div>
</body>
</html>
