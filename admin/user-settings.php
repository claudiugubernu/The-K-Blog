<?php

session_start();

include_once('../includes/connection.php');

if (isset($_SESSION["logged_in"])) { 
    $username = $_SESSION['username'];

    $query = $pdo->prepare('SELECT * FROM users WHERE user_name = ?');
    $query->bindValue(1, $username);
    $query->execute();

    $user_data = $query->fetchAll();

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
                <input type="text" name="username" class="mb-10 p-10 bg-senary c-light-grey tt-capitalize" value="<?php echo $user_data[0]['user_name'] ?>" readonly disabled/>
            </div>
            <div class="form-row flex flex-column">
                <label for="email" class="mb-10 fs-16 c-light-grey">Email</label>
                <input type="email" name="email" class="mb-10 p-10 bg-senary c-light-grey" value="<?php echo $user_data[0]['user_email'] ?>" readonly disabled/>
            </div>
            <div class="mv-20">
                <label class="fs-24 c-light-grey">Reset Secret Word</label>
            </div>
            <div class="form-row flex flex-column relative">
                <label for="secret_word" class="mb-10 fs-16 c-light-grey">Secret Word</label>
                <input type="text" id="secret-word" name="secret_word" class="mb-10 p-10 bg-senary c-light-grey" value="<?php echo $user_data[0]['user_secret_word'] ?>" />
                <div class="secret-word-blur absolute bg-senary p-10"></div>
                <p class="secret-word-btn fs-16 absolute c-light-grey">REMIND ME</p>
            </div>
            <div class="mv-20">
                <label class="fs-24 c-light-grey">Reset Password</label>
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