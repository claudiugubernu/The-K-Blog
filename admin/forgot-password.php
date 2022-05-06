<?php

session_start(); 

include_once('../includes/connection.php');

if (isset($_POST['submit'])) {
    // Check inputs
    if (empty($_POST['email']) || empty($_POST['secret_word']) || empty($_POST['new_password']) || empty($_POST['repeat_new_password'])) {
        $error = 'All Fields are Required';
    } else {
        // Get user inputs
        $email = $_POST['email'];
        $secret_word = $_POST['secret_word'];
        $new_password = $_POST['new_password'];
        $repeat_new_password = $_POST['repeat_new_password'];
        // Prepare and run query to check inputs against DB
        $query = $pdo->prepare('SELECT * FROM users WHERE user_email = ? AND user_secret_word = ?');
        $query->bindValue(1, $email);
        $query->bindValue(2, $secret_word);
        $query->execute();

        $num = $query->rowCount();

        // If inputs don't match run error else continue
        if ($num != 1) {
            $error = 'Email or Secret Word not matching. Please try again';
        } else {
            // Check the passwords are matching
            if($new_password === $repeat_new_password) {
                // Prepare and run query
                $query = $pdo->prepare('UPDATE users SET user_password = ? WHERE user_email = ? LIMIT 1');
                $query->bindValue(1, md5($repeat_new_password));
                $query->bindValue(2, $email);
                $query->execute();

                header('Location: index.php');
            } else {
                $error = 'Passwords don\'t match';
            }
        }
    }
}
?>

<?php include('header.php'); ?>

<div id="content" class="sign-in-wrapper site-width flex flex-column justify-center align-items-center m-auto">
    <a href="index.php">
        <img src="../assets/img/Logo1 Admin.png" alt="Site logo"/>
    </a>

    <?php if (isset($error)) { ?>
        <div class="login-error">
            <p class="error"><?php echo $error ?></p>
        </div>
    <?php } ?>

    <form action="forgot-password.php" method="post" class="mt-10 mb-30 flex flex-column">
        <input type="email" class="mb-10 p-10" name="email" placeholder="Email">
        <input type="text" class="mb-10 p-10" name="secret_word" placeholder="Secret Word">
        <input type="password" id="new-password" name="new_password" placeholder="New Password" class="mb-10 p-10" />
        <input type="password" id="repeat-new-password" name="repeat_new_password" placeholder="Repeat New Password" class="mb-10 p-10" />
        <input type="submit" name="submit" class="mb-10 green-btn align-self-center" value="Submit">
    </form>
    <div class="flex align-items-center gap-10">
        <p class="fs-14 c-light-grey">Forgot Secret Word ?</p>
        <a href="reset-secret-word.php" class="c-light-blue">Remind me</a>
    </div>
</div>
<?php include('footer.php'); ?> 

