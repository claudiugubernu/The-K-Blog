<?php

session_start();

include_once('../includes/connection.php');

// If user logged_in then fetch user data from DB
if (isset($_SESSION["logged_in"])) { 
    $username = $_SESSION['username'];

    $query = $pdo->prepare('SELECT * FROM users WHERE user_name = ?');
    $query->bindValue(1, $username);
    $query->execute();

    $user_data = $query->fetchAll();

    // Update user Secret Word
    if (isset($_POST['update_secret_word'])) {
        if (!empty($_POST['secret_word'])) {
            $secret_word = $_POST['secret_word'];
            // Prepare and run query
            $query = $pdo->prepare('UPDATE users SET user_secret_word = ? WHERE user_name = ?');
            $query->bindValue(1, $secret_word);
            $query->bindValue(2, $username);
            $query->execute();

            if($query->execute()) {  
                header('Location: user-settings.php');
            } else {
                $message = 'An error has occured. Please try again!';
            }
        } else {
            $message = 'Field required to help recovering the account.';
        }
    }

    // Update user Password
    if (isset($_POST['update_password'])) {
        if (!empty($_POST['current_password']) && !empty($_POST['new_password'])) {
            $current_password = md5($_POST['current_password']);
            $new_password = $_POST['new_password'];
            // Check to see if current_password and db password match
            if ($current_password == $user_data[0]['user_password']) {
                // Prepare and run query
                $query = $pdo->prepare('UPDATE users SET user_password = ? WHERE user_name = ?');
                $query->bindValue(1, md5($new_password));
                $query->bindValue(2, $username);
                $query->execute();
        
                if($query->execute()) {  
                    header('Location: user-settings.php');
                } else {
                    $message = 'An error has occured. Please try again!';
                }
            } else {
                $message = 'Entered password doesn\'t match records';
            }
        } else {
            $message = 'Passwords fields required.'; 
        }
    }
} else {
    header('Location: index.php');
}

?>

<?php include('header.php'); ?>

<div class="users-wrapper admin-wrapper flex align-items-center bg-tertiary">
    <?php include('templates/admin-nav.php'); ?>
    <div class="admin-dashboard-wrapper p-30 flex flex-column">
        <?php include('templates/admin-logout.php'); ?> 
        <?php if (isset($message)) { ?>
            <p class="fs-16 green mb-10"><?php echo $message ?></p>
        <?php } ?>
        <div class="user-update-form flex flex-column justify-center">
            <div class="form-row flex flex-column">
                <label for="username" class="mb-10 fs-16 c-light-grey">Username</label>
                <input type="text" name="username" class="mb-10 p-10 bg-senary c-light-grey tt-capitalize" value="<?php echo $user_data[0]['user_name'] ?>" readonly disabled/>
            </div>
            <div class="form-row flex flex-column">
                <label for="email" class="mb-10 fs-16 c-light-grey">Email</label>
                <input type="email" name="email" class="mb-10 p-10 bg-senary c-light-grey" value="<?php echo $user_data[0]['user_email'] ?>" readonly disabled/>
            </div>
        </div>
        <form action="user-settings.php" method="post" class="user-update-form flex flex-column justify-center">
            <div class="mv-20">
                <label class="fs-24 c-light-grey">Reset Secret Word</label>
            </div>
            <div class="form-row flex flex-column relative">
                <label for="secret_word" class="mb-10 fs-16 c-light-grey">Secret Word</label>
                <input type="text" id="secret-word" name="secret_word" class="mb-10 p-10 bg-senary c-light-grey" value="<?php echo $user_data[0]['user_secret_word'] ?>" />
                <div class="secret-word-blur absolute bg-senary p-10"></div>
                <p class="secret-word-btn fs-16 absolute c-light-grey">REMIND ME</p>
            </div>
            <input type="submit" name="update_secret_word" value="UPDATE" class="btn green-btn mv-20"/>
        </form>
        <form action="user-settings.php" method="post" class="user-update-form flex flex-column justify-center">
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
            <input type="submit" name="update_password" value="UPDATE" class="btn green-btn mv-20"/>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>