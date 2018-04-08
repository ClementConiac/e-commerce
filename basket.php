<?php require_once 'tools/common.php';

$_SESSION['basket'][$item['id']] = $item;

if (isset($_SESSION['basket'][])) {

    $total = 0;

    foreach ($_SESSION['basket'] as $item) {

        echo $item['image'];
        echo $item['title'];
        echo $item['price'];
        echo $item['qty'];

        $total += (float)$item['price'] * (int)$item['qty'];

    }
}

echo $total;
?>





