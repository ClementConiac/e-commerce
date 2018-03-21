<?php
require_once '../tools/common.php';


if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == 0){
    header('location:../index.php');
    exit;
}


if(isset($_POST['save'])){
    $query = $db->prepare('INSERT INTO item (category_item, category_kind, title, price, is_published, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
    $newItem = $query->execute(
        [
            $_POST['category_item'],
            $_POST['category_kind'],
            $_POST['title'],
            $_POST['price'],
            $_POST['is_published']

        ]
    );
    //redirection après enregistrement


    if($newItem){

        if (isset($_FILES['image'])){

            $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );


            $my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);


            if ( in_array($my_file_extension , $allowed_extensions) ){

                $new_file_name = md5(rand());

                    $destination = '../image/image-all' . $new_file_name . '.' . $my_file_extension;


                $result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);
                $lastInsertItemId = $db->lastInsertId();

                $query = $db->prepare('UPDATE item SET
                image = :image
                WHERE id = :id'
                );


                //données du formulaire
                $resultUpdateImage = $query->execute(
                    [
                        'image' => $new_file_name. '.' .$my_file_extension ,
                        'id' => $lastInsertItemId

                    ]
                );
            }
        }
        header('location:item-list.php');
        exit;
    }
    else{
        $message = "Impossible d'enregistrer le nouvel item...";
    }
}
?>

<?php
if(isset($_POST['update'])){

$query = $db->prepare('UPDATE item SET
category_item = :category_item,
category_kind = :category_kind,
title = :title,
price = :price,
is_published = :is_published
WHERE id = :id'
);


//mise à jour avec les données du formulaire
$resultItem = $query->execute(
[
'category_item' => $_POST['category_item'],
'category_kind' => $_POST['category_kind'],
'title' => $_POST['title'],
'price' => $_POST['price'],
'is_published' => $_POST['is_published'],
'id' => $_POST['id'],
]
);

if($resultItem){
header('location:item-list.php');
exit;
}
else{
$message = 'Erreur.';
}
}

//si on modifie un article, on doit séléctionner l'article en question (id envoyé dans URL) pour pré-remplir le formulaire plus bas
if(isset($_GET['item_id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){
$query = $db->prepare('SELECT * FROM item WHERE id = ?');
$query->execute(array($_GET['item_id']));
//$article contiendra les informations de l'article dont l'id a été envoyé en paramètre d'URL
$item = $query->fetch();
}
?>


<!DOCTYPE html>
<html>
<head>

    <title>Administration des items</title>

    <?php require 'partials/head_assets.php'; ?>

</head>
<body class="index-body">
<div class="container-fluid">

    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">

        <?php require 'partials/nav.php'; ?>

        <section class="col-9">
            <header class="pb-3">
                <!-- Si $article existe, on affiche "Modifier" SINON on affiche "Ajouter" -->
                <h4>Ajouter un item</h4>
            </header>

                <div class="bg-danger text-white">
                </div>



            <form action="item-form.php" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="title">Titre :</label>
                    <input class="form-control"<?php if (isset($item)): ?> value="<?php echo $item['title']; ?>"<?php endif; ?> type="text" placeholder="Titre" name="title" id="title" />
                </div>
                <div class="form-group">
                    <label for="price">Price :</label>
                    <input class="form-control"<?php if(isset($item)): ?> value="<?php echo $item['price']; ?>"<?php endif; ?> type="text" placeholder="Price" name="price" id="price" />
                </div>

                <div class="form-group">
                    <label for="category_item"> Catégorie Item : </label>
                    <select class="form-control" name="category_item" id="category_item">
                    <?php
                    $queryCategoryItem= $db ->query('SELECT * FROM category_item');
                    while($categoryItem = $queryCategoryItem->fetch()):
                    ?>
                    <option value="<?php echo $categoryItem['id']; ?>" <?php if(isset($item) && $item['category_item'] == $categoryItem['id']): ?>selected<?php endif; ?>> <?php echo $categoryItem['name']; ?> </option>
                    <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="category_kind"> Catégorie Kind : </label>
                    <select class="form-control" name="category_kind" id="category_kind">
                    <?php
                    $queryCategoryKind= $db ->query('SELECT * FROM category_kind');
                    while($categoryKind = $queryCategoryKind->fetch()):
                        ?>
                        <option value="<?php echo $categoryKind['id']; ?>"<?php if(isset($item) && $item['category_kind'] == $categoryKind['id']): ?>selected<?php endif; ?>> <?php echo $categoryKind['name']; ?> </option>
                    <?php endwhile; ?>

                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Image :</label>
                    <input class="form-control" type="file" name="image" id="image"/>
                </div>

                <div class="form-group">
                    <label for="is_published"> Publié ?</label>
                    <select class="form-control" name="is_published" id="is_published">
                        <option value="0" <?php if(isset($item) && $item['is_published'] == 0): ?>selected<?php endif; ?>>Non</option>
                        <option value="1" <?php if(isset($item) && $item['is_published'] == 1): ?>selected<?php endif; ?>>Oui</option>
                    </select>
                </div>

                <div class="text-right">
                    <!-- Si $article existe, on affiche un lien de mise à jour -->
                    <?php if(isset($item)): ?>
                        <input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />
                        <!-- Sinon on afficher un lien d'enregistrement d'un nouvel article -->
                    <?php else: ?>
                        <input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
                    <?php endif; ?>
                </div>

                <!-- Si $article existe, on ajoute un champ caché contenant l'id de l'article à modifier pour la requête UPDATE -->
                <?php if(isset($item)): ?>
                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
                <?php endif; ?>
            </form>
        </section>
    </div>
</div>
</body>
</html>