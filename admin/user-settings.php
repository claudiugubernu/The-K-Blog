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

<div class="posts-wrapper admin-wrapper flex align-items-center bg-tertiary">
    <?php include('templates/admin-nav.php'); ?>
    <div class="admin-dashboard-wrapper p-30 flex flex-column">
        <form method="post">
            <div class="form-row flex flex-column">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo $_SESSION['username'] ?>" readonly/>
            </div>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>