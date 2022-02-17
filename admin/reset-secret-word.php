<?php

session_start(); 

include_once('../includes/connection.php');

if (isset($_POST['submit'])) {
    // Check for email input
    if (empty($_POST['email'])) {
        $error = 'Email Required';
    } else {
        // Get the input email and look for it in the DB
        $email = $_POST['email'];

        // Prepare and run query to DB
        $query = $pdo->prepare('SELECT user_secret_word FROM users WHERE user_email = ?');
        $query->bindValue(1, $email);
        $query->execute();
        
        $user_data = $query->fetch();
        $num = $query->rowCount();

        // If record not found error
        if($num != 1) {
            $error = 'No records found. Please try again'; 
        } else {
            // Send email with the secret_word
            $to = $email;
            $subject = "Secret Word Reminder | The K Blog Admin";
            nl2br($txt = "Hi, " . $email . ".\r\n As requested by you this is a remider of your Secret Word to reset your current password. \r\n If you did not requested this please ignore this email.\r\n Your Secret Word is: " . $user_data['user_secret_word']);
            $headers = 'From: thekblog.com' . "\r\n" .
            'Reply-To: thekblog.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

            mail($to,$subject,$txt,$headers);

            $success = 'An email has been sent to your email address with your Secret Word.';

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

    <?php if (isset($success)) { ?>
        <p class="green"><?php echo $success ?></p>   
        <a href="forgot-password.php" class="c-light-blue mv-20">Back to Password Reset</a> 
    <?php } else { ?>
        <form action="reset-secret-word.php" method="post" class="mt-10 mb-30 flex flex-column"> 
            <input type="email" class="mb-10 p-10" name="email" placeholder="Email">
            <input type="submit" name="submit" class="mb-10 green-btn align-self-center" value="Remind Me">
        </form>
        <div class="flex align-items-center gap-10">
            <p class="fs-14 c-light-grey">Enter your email address to find out your Secret Word</p>
            <a href="index.php" class="c-light-blue">Back</a>
        </div>
    <?php } ?>

    
</div>

<?php include('footer.php'); ?> 

