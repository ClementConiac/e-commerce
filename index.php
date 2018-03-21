<?php

require_once 'tools/common.php';


if(isset($_GET['logout']) && isset($_SESSION['user_firstname'])){


    unset($_SESSION["user_firstname"]);
    unset($_SESSION['user_lastname']);
    unset($_SESSION["is_admin"]);
}
/*if(isset($_GET['category_kind']) ){


    $query = $db->prepare('SELECT * FROM category_kind WHERE id = ?');
    $query->execute( array($_GET['category_kind']) );

    $currentCategory = $query->fetch();

    if($currentCategory){


        $query = $db->prepare('SELECT * FROM item WHERE category_kind = ? AND is_published = 1 ORDER BY created_at DESC');
        $result = $query->execute( array($_GET['category_kind']) );

        $item = $query->fetchAll();
    }
    else{
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
*/
    $queryShirtMan = $db->query('
							SELECT item.* , category_item.name AS category_name
							FROM item
							JOIN category_item
							ON item.category_item = category_item.id
							WHERE is_published = 1 AND category_kind = 1 AND category_item = 1
							ORDER BY created_at DESC
							LIMIT 0, 4'
    );

    $querySweatMan = $db->query('
							SELECT item.* , category_item.name AS category_name
							FROM item
							JOIN category_item
							ON item.category_item = category_item.id
							WHERE is_published = 1 AND category_kind = 1 AND category_item = 2
							ORDER BY created_at DESC
							limit 0,4'
);

    $queryShirtWoman = $db->query('
							SELECT item.* , category_item.name AS category_name
							FROM item
							JOIN category_item
							ON item.category_item = category_item.id
							WHERE is_published = 1 AND category_kind = 2 AND category_item = 1
							ORDER BY created_at DESC
							LIMIT 0, 4'
);

    $querySweatWoman = $db->query('
							SELECT item.* , category_item.name AS category_name
							FROM item
							JOIN category_item
							ON item.category_item = category_item.id
							WHERE is_published = 1 AND category_kind = 2 AND category_item = 2
							ORDER BY created_at DESC
							limit 0,4'

);
/*$queryKindId = $db->query('
							SELECT item.* , category_kind.*
							FROM item
							JOIN category_kind
							ON item.category_kind = category_kind.id
							WHERE item.category_kind = 1');


$Kind = $queryKindId->fetch();

$queryItemId = $db->query('
							SELECT item.* , category_item.*
							FROM item
							JOIN category_item
							ON item.category_item = category_item.id 
							WHERE item.category_item = 1');


$Item = $queryItemId->fetch();
*/
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
    <div class="row" id="header">
        <div class="col-12 d-flex align-items-center justify-content-center" id="create-buy">
            <h1>Original'creatioN</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12" id="main">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link <?php if(isset($_POST['man']) || !isset($_POST['woman'])): ?>active<?php endif; ?>" id="button-man" data-toggle="tab" href="#man" role="tab">Man</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(isset($_POST['woman'])): ?>active<?php endif; ?>" id="button-woman" data-toggle="tab" href="#woman" role="tab">Woman</a>
                </li>
            </ul>
        </div>
    </div>

        <div class="tab-content">
            <div class="tab-pane  <?php if(isset($_POST['man']) || !isset($_POST['woman'])): ?>active<?php endif; ?>" id="man" role="tabpanel">
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
                        <div class="row d-flex justify-content-end align-items-center more-items">
                            <a href="latest-item.php?category_kind_id=1?category_item_id=1">Our latest tee-shirt ></a>
                        </div>
                    </div>
                </div>


                <div class="row d-flex align-items-center justify-content-center" id="popular-sweat-man">
                    <div class="container">
                        <div class="row">
                            <?php while($itemSweatshirt = $querySweatMan->fetch()): ?>
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <?php if(!empty($itemSweatshirt['image'])): ?>
                                        <div class="d-flex align-items-center justify-content-around">
                                            <a href="item-page.php?item_id=<?php echo $itemSweatshirt['id']; ?>"><img class="rounded-circle rounded-circle-man" src="image/image-all/<?php echo $itemSweatshirt['image']; ?>" alt="<?php echo $itemSweatshirt['title']; ?>"></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <div class="row d-flex justify-content-end align-items-center more-items">
                            <a href="latest-item.php?category_kind_id=1?category_item_id=2">Our latest sweat-shirt ></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane <?php if(isset($_POST['woman'])): ?>active<?php endif; ?>" id="woman" role="tabpanel">
                <div class="row d-flex align-items-center justify-content-center" id="popular-shirt-woman">
                    <div class="container">
                        <div class="row">
                            <?php while($itemTeeshirt = $queryShirtWoman->fetch()): ?>
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <?php if(!empty($itemTeeshirt['image'])): ?>
                                        <div class="d-flex align-items-center justify-content-around">
                                            <a href="item-page.php?item_id=<?php echo $itemTeeshirt['id']; ?>"><img class="rounded-circle rounded-circle-woman" src="image/image-all/<?php echo $itemTeeshirt['image']; ?>" alt="<?php echo $itemTeeshirt['title']; ?>"></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <div class="row d-flex justify-content-end align-items-center more-items">
                            <a href="latest-item.php?category_kind_id=2?category_item_id=1">Our latest tee-shirt ></a>
                        </div>
                    </div>
                </div>
                <div class="row d-flex align-items-center justify-content-center" id="popular-sweat-woman">
                    <div class="container">
                        <div class="row">
                            <?php while($itemSweatshirt = $querySweatWoman->fetch()): ?>
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <?php if(!empty($itemSweatshirt['image'])): ?>
                                        <div class="d-flex align-items-center justify-content-around">
                                            <a href="item-page.php?item_id=<?php echo $itemSweatshirt['id']; ?>"><img class="rounded-circle rounded-circle-woman" src="image/image-all/<?php echo $itemSweatshirt['image']; ?>" alt="<?php echo $itemSweatshirt['title']; ?>"></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <div class="row d-flex justify-content-end align-items-center more-items">
                            <a href="latest-item.php?category_kind_id=2?category_item_id=2">Our latest sweat-shirt ></a>
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