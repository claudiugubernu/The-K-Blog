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
        <form method="post" class="user-update-form flex flex-column justify-center">
            <div class="form-row flex flex-column">
                <label for="username" class="mb-10 fs-16 c-light-grey">Username</label>
                <input type="text" name="username" class="mb-10 p-10 bg-senary c-light-grey tt-capitalize" value="<?php echo $_SESSION['username'] ?>" readonly/>
            </div>
            <div class="form-row flex flex-column">
                <label for="email" class="mb-10 fs-16 c-light-grey">Email</label>
                <input type="email" name="email" class="mb-10 p-10 bg-senary c-light-grey" value="<?php echo $_SESSION['email'] ?>" readonly/>
            </div>
            <div class="form-row flex flex-column">
                <label for="secret_word" class="mb-10 fs-16 c-light-grey">Secret Word</label>
                <input type="text" name="secret_word" class="mb-10 p-10 bg-senary c-light-grey" value="<?php echo $_SESSION['secret_word'] ?>" />
            </div>
            <div class="form-row flex flex-column">
                <label for="current_password" class="mb-10 fs-16 c-light-grey">Current Password</label>
                <input type="password" name="current_password" class="mb-10 p-10 bg-senary c-light-grey" />
            </div>
            <div class="form-row flex flex-column">
                <label for="new_password" class="mb-10 fs-16 c-light-grey">New Password</label>
                <input type="password" name="new_password" class="mb-10 p-10 bg-senary c-light-grey" />
            </div>
            <input type="submit" name="submit" value="UPDATE" class="btn green-btn mv-20"/>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>