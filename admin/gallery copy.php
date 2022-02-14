<?php

session_start();

include_once('../includes/connection.php');
include_once('../includes/posts.php');

if (isset($_SESSION["logged_in"])) { 
    $username = $_SESSION['username'];

     // Get Posts so we're able to get necessary details for admin dashboard
     $db_posts = new Posts;
     $posts = $db_posts->fetch_all();

} else {
    header('Location: index.php');
}

$i=0;
?>

<?php include('header.php'); ?>

<div class="posts-wrapper admin-wrapper admin-gallery-wrapper flex align-items-center bg-tertiary">
    <?php include('templates/admin-nav.php'); ?>
        <div class="admin-gallery p-30 mv-50 grid">
        <?php foreach ($posts as $post) { ?> 
            <?php if ($post['post_thumbnail']) { ?>
                <div class="admin-gallery-img">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($post['post_thumbnail']); ?>" class="single-post-img" />
                </div>    
            <?php } ?>
        <?php } ?>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>