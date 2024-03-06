<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Setup CMS</title>
      <link rel="shortcut icon" type="image/x-icon" href="./admin/<?php echo $cms_settings[0]['site_icon'] ?>"/>
      <link rel="stylesheet" href="static/app.css" />
    </head>
  <body>
    <div class="admin-bg-secondary">
        <div class="setup-cms site-width flex flex-column justify-center align-items-center m-auto">
          <a href="index.php">
            <img src="../assets/img/Logo1 Admin.png" alt="Site logo"/>
          </a>

          <div class="setup-instructions site-width c-white mv-50">
            <h1 class="mb-20">Congrats !</h1>
            <p>Welcome to your new CMS.</p>
            <p>To get it all working copy the following code to the connection.php file under</p>
            <p>// Include db_connection variables here.</p>
            <p>$server_name = '<?php echo $server_name ?>';</p>
            <p>$db_name = '<?php echo $db_name ?>';</p>
            <p>$db_username = '<?php echo $db_username ?>';</p>
            <p>$db_password = '<?php echo $db_password ?>';</p>
          </div>

          <a href='/cms-blog/admin/' class="btn green-btn w-100">Let's go</a>
        </div>
    </div>
    <script src="static/app.js"></script>
  </body>
</html>