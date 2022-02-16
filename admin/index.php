<?php

session_start(); 

include_once('../includes/connection.php');

if (isset($_SESSION["logged_in"])) {
    include('templates/admin-dashboard.php');
} else {
    if (isset($_POST['username'], $_POST['password'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        if (empty($username) or empty($password)) {
            $error = 'All fields are required';
        } else {
            $query = $pdo->prepare('SELECT * FROM users WHERE user_name = ? AND user_password = ?');
            $query->bindValue(1, $username);
            $query->bindValue(2, $password);
            $query->execute();
            $num = $query->rowCount();
            if ($num == 1) {
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $username;
                header('Location: index.php');
                exit();
            } else {
                $error = 'Username/Password details incorrect';
            }
        }
    }
?>

<?php include('header.php'); ?>

<div id="content" class="sign-in-wrapper site-width flex flex-column justify-center align-items-center m-auto">
    <a href="index.php">
        <img src="../assets/img/Logo2 Admin.png" alt="Site logo"/>
    </a>

    <?php if (isset($error)) { ?>
        <div class="login-error">
            <p class="error"><?php echo $error ?></p>
        </div>
    <?php } ?>

    <form action="index.php" method="post" class="mt-10 mb-30 flex flex-column"> 
        <input type="text" class="mb-10 p-10" name="username" placeholder="Username">
        <input type="password" class="mb-10 p-10" name="password" placeholder="Password">
        <input type="submit" class="mb-10 green-btn align-self-center" value="Login">
    </form>
    <div class="flex align-items-center gap-10">
        <p class="fs-14 c-light-grey">Forgot Password ?</p>
        <a href="forgot-password.php" class="c-light-blue">Reset Password</a>
    </div>
</div>
<?php include('footer.php'); ?> 

<?php }


