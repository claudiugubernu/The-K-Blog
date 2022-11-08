<nav>
    <div class="nav-wrapper site-width flex justify-between align-items-center">
        <a href="index.php">
            <img src="assets/img/Logo2.png" class="site-logo" alt="Site logo"/>
        </a>
        <?php if (isset($_SESSION["logged_in"])) { ?>
            <a href="admin" class="">
                <img src="static/icons/admin-with-cogwheels.png" class="icon-30" alt="Admin Panel Icon">
            </a>

        <?php } ?>
    </div>
</nav>