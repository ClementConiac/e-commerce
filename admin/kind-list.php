<?php

require_once '../tools/common.php';

if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == 0){
    header('location:../index.php');
    exit;
}

//supprimer l'article dont l'ID est envoyé en paramètre URL
if(isset($_GET['category_kind_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){

    $query = $db->prepare('DELETE FROM category_kind WHERE id = ?');
    $result = $query->execute(
        [
            $_GET['category_kind_id']
        ]
    );
    //générer un message à afficher plus bas pour l'administrateur
    if($result){
        $message = "Suppression efféctuée.";
    }
    else{
        $message = "Impossible de supprimer la séléction.";
    }
}

//séléctionner tous les articles pour affichage de la liste
$query = $db->query('SELECT * FROM category_kind');
$category_kind = $query->fetchall();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administration des catégories kind - Original's Creation !</title>
    <?php require 'partials/head_assets.php'; ?>
</head>
<body class="index-body">
<div class="container-fluid">

    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">

        <?php require 'partials/nav.php'; ?>

        <section class="col-9">
            <header class="pb-4 d-flex justify-content-between">
                <h4>Liste des categories kind</h4>
                <a class="btn btn-primary" href="kind-form.php">Ajouter une categorie kind</a>
            </header>

            <?php if(isset($message)): //si un message a été généré plus haut, l'afficher ?>
                <div class="bg-success text-white p-2 mb-4">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <?php if($category_kind): ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>


                <?php foreach($category_kind as $category_kinds): ?>

                    <tr>
                        <!-- htmlentities sert à écrire les balises html sans les interpréter -->
                        <th><?php echo htmlentities($category_kinds['id']); ?></th>
                        <td><?php echo htmlentities($category_kinds['name']); ?></td>
                        <td><?php echo htmlentities($category_kinds['description']); ?></td>
                        <td>
                            <a href="kind-form.php?category_kind_id=<?php echo $category_kinds['id']; ?>&action=edit" class="btn btn-warning">Modifier</a>
                            <a onclick="return confirm('Are you sure?')" href="kind-list.php?category_kind_id=<?php echo $category_kinds['id']; ?>&action=delete" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>

                <?php endforeach; ?>
                <?php else: ?>
                    Aucun item enregistré.
                <?php endif; ?>

                </tbody>
            </table>

        </section>

    </div>

</div>
</body>
</html>
