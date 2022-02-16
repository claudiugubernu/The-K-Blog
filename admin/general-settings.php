<?php

session_start();

include_once('../includes/connection.php');

if (isset($_SESSION["logged_in"])) { 
    $username = $_SESSION['username'];
} else {
    header('Location: index.php');
}

?>

<?php include('header.php'); ?>

<div class="users-wrapper admin-wrapper flex align-items-center bg-tertiary">
    <?php include('templates/admin-nav.php'); ?>
    <div class="admin-dashboard-wrapper p-30 flex flex-column">
        <?php include('templates/admin-logout.php'); ?> 
        <form method="post" class="cms-update-form flex flex-column justify-center">
            Banner img settings <br>
            Site title settings<br>
            Theme change selector ?<br>
            site favicon ?<br>
            <input type="submit" name="submit" value="UPDATE" class="btn green-btn mv-20"/>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>