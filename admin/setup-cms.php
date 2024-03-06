<?php

if(isset($_POST['servername']) && isset($_POST['dbname']) && isset($_POST['username']) && isset($_POST['admin_user']) && isset($_POST['admin_email']) && isset($_POST['admin_password']) && isset($_POST['admin_password_2']) && isset($_POST['secret_word']) ) {
    $server_name = $_POST['servername'];
    $db_name = $_POST['dbname'];
    $db_username = $_POST['username'];
    $db_password = $_POST['password'];

    $admin_user = $_POST['admin_user'];
    $admin_email = $_POST['admin_email'];
    $admin_password = md5($_POST['admin_password']);
    $admin_password_2 = $_POST['admin_password_2'];
    $secret_word = $_POST['secret_word'];

    if (empty($server_name) or empty($db_name) or empty($db_username) or empty($admin_user) or empty($admin_email) or empty($admin_password) or empty($admin_password_2) or empty($secret_word)) {
        $error = 'All fields are required';
    } else {
        include_once('./includes/database-script.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Setup CMS</title>
        <link rel="shortcut icon" type="image/x-icon" href="./admin/<?php echo $cms_settings[0]['site_icon'] ?>"/>
        <link rel="stylesheet" href="../static/app.css" />
    </head>
        <body>
            <div class="admin-bg-secondary">
                <div class="setup-cms site-width flex flex-column justify-center align-items-center m-auto">
                    <a href="index.php">
                        <img src="./assets/img/Logo1 Admin.png" alt="Site logo"/>
                    </a>

                    <div class="setup-instructions site-width c-white mv-50">
                        <h1 class="mb-20">Hi there,</h1>
                        <p>Thank you for choosing our CMS ! Please complete the setup to start using the CMS.</p>
                    </div>
                    <?php if (isset($error)) { ?>
                        <div class="error mv-10">
                            <p><?php echo $error ?></p>
                        </div>  
                    <?php } ?>
                    <form action="setup-cms.php" method="post" class="site-width mt-10 mb-30 flex m-flex-column gap-30 c-white"> 
                        <div class="flex flex-column w-100">
                            <p class="mb-10">Server Setup</p>
                            <input type="text" class="mb-10 p-10" name="servername" placeholder="Servername">
                            <input type="text" class="mb-10 p-10" name="dbname" placeholder="Database Name">
                            <input type="text" class="mb-10 p-10" name="username" placeholder="Username">
                            <input type="password" class="mb-10 p-10" name="password" placeholder="Password">
                        </div>
                        <div class="flex flex-column w-100">
                            <p class="mb-10">CMS Setup</p>
                            <input type="text" class="mb-10 p-10" name="admin_user" placeholder="Admin User">
                            <input type="email" class="mb-10 p-10" name="admin_email" placeholder="Admin Email">
                            <input type="password" id="new-password" class="mb-10 p-10" name="admin_password" placeholder="Admin Password">
                            <input type="password" id="repeat-new-password" class="mb-10 p-10" name="admin_password_2" placeholder="Re-Enter Admin Password">
                            <input type="text" name="secret_word" class="mb-10 p-10" placeholder="Secret Word" />
                            <input type="submit" class="mb-10 green-btn align-self-end" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        <script src="static/app.js"></script>
    </body>
</html>