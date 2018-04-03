<?php
require_once '../tools/common.php';

if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == 0){
    header('location:../index.php');
    exit;
}

if(isset($_POST['save'])){
    $query = $db->prepare('INSERT INTO category_kind (name, description) VALUES (?, ?)');
    $newCategoryKind = $query->execute(
        [
            $_POST['name'],
            $_POST['description'],
        ]
    );

    if($newCategoryKind){
        header('location:kind-list.php');
        exit;
    }
    else{
        $message = "Impossible d'enregistrer le nouvel utilisateur...";
    }
}


if(isset($_POST['update'])){

    $query = $db->prepare('UPDATE category_kind SET
		name = :name,
		description = :description,
		WHERE id = :id'
    );


    $result = $query->execute(
        [
            'name' => $_POST['name'],
            'description' => $_POST['description'],

        ]
    );

    if($result){
        header('location:kind-list.php');
        exit;
    }
    else{
        $message = 'Erreur.';
    }
}


if(isset($_GET['category_kind_id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){

    $query = $db->prepare('SELECT * FROM category_kind WHERE id = ?');
    $query->execute(array($_GET['category_kind_id']));

    $kind = $query->fetch();
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Administration des utilisateurs - Mon premier blog !</title>

    <?php require 'partials/head_assets.php'; ?>

</head>
<body class="index-body">
<?php require 'partials/header.php'; ?>
<div class="container-fluid">



    <div class="row my-3 index-content">

        <?php require 'partials/nav.php'; ?>

        <section class="col-9">
            <header class="pb-3">

                <h4><?php if(isset($kind)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> un utilisateur</h4>
            </header>

            <?php if(isset($message)): //si un message a été généré plus haut, l'afficher ?>
                <div class="bg-danger text-white">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>



            <form action="kind-form.php" method="post">
                <div class="form-group">
                    <label for="name">Name :</label>
                    <input class="form-control" <?php if(isset($kind)): ?>value="<?php echo $kind['name']?>"<?php endif; ?> type="text" placeholder="name" name="name" id="name" />
                </div>
                <div class="form-group">
                    <label for="description">Description : </label>
                    <input class="form-control" <?php if(isset($kind)): ?>value="<?php echo $kind['description']?>"<?php endif; ?> type="text" placeholder="description" name="description" id="description" />
                </div>

                <div class="text-right">

                    <?php if(isset($kind)): ?>
                        <input class="btn button-color" type="submit" name="update" value="Mettre à jour" />

                    <?php else: ?>
                        <input class="btn button-color" type="submit" name="save" value="Enregistrer" />
                    <?php endif; ?>
                </div>


                <?php if(isset($kind)): ?>
                    <input type="hidden" name="id" value="<?php echo $kind['id']?>" />
                <?php endif; ?>

            </form>
        </section>
    </div>

</div>
</body>
</html>