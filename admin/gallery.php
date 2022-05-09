<?php

session_start();

include_once('../includes/connection.php');

if (isset($_SESSION["logged_in"])) { 
    $username = $_SESSION['username'];
    $dir = './uploads/*';
    $images = glob( $dir );

} else {
    header('Location: index.php');
}

?>

<?php include('header.php'); ?>

<div class="posts-wrapper admin-wrapper admin-gallery-wrapper flex align-items-center admin-bg-primary">
    <?php include('templates/admin-nav.php'); ?>
    <div class="admin-dashboard-wrapper flex flex-column">
        <?php include('templates/admin-logout.php'); ?> 
        <div class="admin-gallery grid">
        <?php foreach ($images as $image) { ?> 
            <?php if ($image) { ?>
                <div class="admin-gallery-img relative">
                    <img src="<?php echo $image ?>" class="single-post-img" />
                </div>    
            <?php } ?>
        <?php } ?>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>