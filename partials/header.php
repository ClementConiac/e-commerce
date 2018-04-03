<?php
require_once 'tools/common.php';
if(isset($_POST['search'])) {
}
else{
    $message = "Not found ...";
}

?>

<div class="row" id="menu">
    <div class="col-xl-4 col-lg-4  col-md-4 col-sm-4 col-xs-3 flex-wrap d-flex align-items-center justify-content-end">
        <nav class="navbar navbar-light">
            <form class="form-inline" action="search.php" method="post">
                <input class="form-control mr-sm-2" id="nav-search" type="text" placeholder="Search">
                <button class="btn btn-outline" id="button-search" type="submit" name="search">Search</button>
            </form>
        </nav>
    </div>
    <div class="col-xl-4 col-lg-4  col-md-4 col-sm-3 col-xs-3 flex-wrap d-flex align-items-center justify-content-center">
        <a href="index.php"><img src="image/utilitaire/logo.png" class="img-fluid" id="logo" alt="Responsive image"></a>
    </div>


    <div class="col-xl-2 col-lg-2  col-md-2 col-sm-3 col-xs-3 flex-wrap d-flex justify-content-center align-items-center">
        <?php if(isset($_SESSION['user'])): ?>
            <a class="d-block btn btn-danger button-logout" id="button-log-out" href="index.php?logout">Logout</a>
            <?php if($_SESSION['is_admin'] == 1): ?>
                <a class="d-block btn button-color" id="button-admin" href="admin/index.php">Administration</a>
            <?php else: ?>
                <a id="button-user" class="d-block btn btn-warning" href="user-information.php"><?php echo $_SESSION['user']; ?></a>
            <?php endif; ?>
        <?php else: ?>
            <a class="d-block btn" id="button-register-login" href="login-register.php">Login/Register</a>
        <?php endif; ?>
    </div>
    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-3 flex-wrap d-flex justify-content-center align-items-center">
        <a href="basket.php" id="basket"><img src="image/utilitaire/basket.png"></a>
    </div>

</div>

