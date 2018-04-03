<?php

require_once 'tools/common.php';

$queryShirtMan = $db->query('
							SELECT *
							FROM item
							WHERE is_published = 1 AND category_kind = 1 AND category_item = 1
							ORDER BY created_at
							LIMIT 0,12'
);
$queryShirtWoman = $db->query('
							SELECT *
							FROM item
							WHERE is_published = 1 AND category_kind = 2 AND category_item = 1
							ORDER BY created_at
							LIMIT 0,12'
);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Original'creatioN</title>
    <?php require 'partials/head_assets.php'; ?>
</head>

<body class="body">
<?php  require 'partials/header.php';?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12" id="main">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link <?php if(isset($_POST['man']) || !isset($_POST['woman'])): ?><?php endif; ?>" id="button-man" data-toggle="tab" href="#man" role="tab">Man</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(isset($_POST['woman'])): ?><?php endif; ?>" id="button-woman" data-toggle="tab" href="#woman" role="tab">Woman</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content">

            <div class="tab-pane  <?php if(isset($_POST['man']) || !isset($_POST['woman'])): ?>active<?php endif; ?>" id="man" role="tabpanel">
                <?php if (isset($_GET['man_shirt'])) : ?>
                <div class="row d-flex align-items-center justify-content-center" id="popular-shirt-man-latest">
                    <div class="container">
                        <div class="row">
                            <?php while($itemTeeshirt = $queryShirtMan->fetch()): ?>
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <?php if(!empty($itemTeeshirt['image'])): ?>
                                        <div class="d-flex align-items-center justify-content-around">
                                            <a href="item-page.php?item_id=<?php echo $itemTeeshirt['id']; ?>"><img class="rounded-circle rounded-circle-man rnd-crl-latest hvr-bounce-in"  src="image/image-all/<?php echo $itemTeeshirt['image']; ?>" alt="<?php echo $itemTeeshirt['title']; ?>"></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
        <div class="tab-pane <?php if(isset($_POST['woman'])): ?>active<?php endif; ?>" id="woman" role="tabpanel">
            <div class="row d-flex align-items-center justify-content-center" id="popular-shirt-woman-latest">
                <div class="container">
                    <div class="row">
                        <?php while($itemTeeshirt = $queryShirtWoman->fetch()): ?>
                            <div class="col-3 d-flex align-items-center justify-content-center">
                                <?php if(!empty($itemTeeshirt['image'])): ?>
                                    <div class="d-flex align-items-center justify-content-around">
                                        <a href="item-page.php?item_id=<?php echo $itemTeeshirt['id']; ?>"><img class="rounded-circle rounded-circle-woman rnd-crl-latest hvr-bounce-in" src="image/image-all/<?php echo $itemTeeshirt['image']; ?>" alt="<?php echo $itemTeeshirt['title']; ?>"></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <?php require 'partials/footer.php';?>
    <?php require 'partials/footer_js.php';?>
</div>
</body>
</html>