<?php

session_start(); 

include_once('../includes/connection.php');


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
        <input type="email" class="mb-10 p-10" name="email" placeholder="Email">
        <input type="text" class="mb-10 p-10" name="secret_word" placeholder="Secret Word">
        <input type="password" name="new_password" placeholder="New Password" class="mb-10 p-10" />
        <input type="password" name="repeat_new_password" placeholder="Repeat New Password" class="mb-10 p-10" />
        <input type="submit" class="mb-10 green-btn align-self-center" value="Submit">
    </form>
    <div class="flex align-items-center gap-10">
        <p class="fs-14 c-light-grey">Forgot Secret Word ?</p>
        <a href="reset-secret-word.php" class="c-light-blue">Remind me</a>
    </div>
</div>
<?php include('footer.php'); ?> 

