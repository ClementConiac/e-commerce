<?php
require_once 'tools/common.php';
if(!isset($_POST['search'])){
    header('location:index.php');
    exit;
}
$query = $db->prepare('SELECT * FROM  item WHERE title LIKE "(.$_POST["search"].)"');
$newSearch = $query->execute();


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Original'creatioN</title>
    <?php require 'partials/head_assets.php'; ?>
</head>

<body class="body">
<div class="container-fluid">
    <?php  require 'partials/header.php';?>
    <p>search result</p>
    <?php while ($newSearch) :?>

    <?php endwhile; ?>





    <?php require 'partials/footer.php';?>
    <?php require 'partials/footer_js.php';?>
</div>
</body>
</html>
