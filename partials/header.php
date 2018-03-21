<div class="row" id="menu">
    <div class="col-3 d-flex align-items-center justify-content-center">
        <a href="index.php"><img src="image/utilitaire/logo.png" class="img-fluid" id="logo" alt="Responsive image"></a>
    </div>
    <div class="col-7"></div>
    <div class="col-2 d-flex justify-content-around align-items-center">
        <?php if(isset($_SESSION['user_firstname'])): ?>
            <p><a id="button-logout" class="d-block btn btn-danger" href="index.php?logout">Logout</a></p>
            <?php if($_SESSION['is_admin'] == 1): ?>
                <a class="d-block btn btn-warning mb-4 mt-2" href="admin/index.php">Administration</a>
            <?php else: ?>
                <p><a id="button-user" class="d-block btn btn-warning" href="user-information.php"><?php echo $_SESSION['user_firstname']; ?></a></p>
            <?php endif; ?>
        <?php else: ?>
            <a class="d-block btn btn mb-4 mt-2" id="button-register-login" href="login-register.php">Login/Register</a>
        <?php endif; ?>
        <a href="#"><img src="image/utilitaire/basket-commerce.png" alt=""></a>
    </div>
</div>