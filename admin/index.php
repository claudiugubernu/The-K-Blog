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
                $error = 'Incorrect details entered';
            }
        }
    }
    ?>

<?php include('header.php'); ?>

<nav>
    <div class="nav-wrapper">
        <a href="index.php">
            <img src="../assets/img/Logo2 Admin.png" alt="Site logo"/>
        </a>
    </div>
</nav>

<?php if (isset($error)) { ?>
    <div class="login-error">
        <p><?php echo $error ?></p>
    </div>
<?php } ?>

    <form action="index.php" method="post"> 
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Login">
    </form>
    <div class="flex gap-10">
        <p class="fs-12">No account?</p>
        <a href="../index.php">Go back</a>
    </div>

<?php include('footer.php'); ?> 

<?php }


