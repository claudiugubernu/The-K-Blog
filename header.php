<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The K Blog</title>
        <link rel="stylesheet" href="static/app.css" />
    </head>
        <body>
        <nav>
            <div class="nav-wrapper site-width flex justify-between align-items-center">
                <a href="index.php">
                    <img src="assets/img/Logo2.png" class="site-logo" alt="Site logo"/>
                </a>
                <?php if (!isset($_SESSION["logged_in"])) { ?>
                <a href="admin" class="blue-btn">Sign In</a>
                <?php } ?>
            </div>
        </nav>