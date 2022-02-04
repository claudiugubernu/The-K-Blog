<?php 

session_start();

include_once('includes/connection.php');
include_once('includes/posts.php');
include_once('functions.php');

$posts_class = new Posts;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $posts_data = $posts_class->fetch_data($id);
?>

<?php include('header.php'); ?>

<div id="content" class="single-post-wrapper site-width mv-50">
    <div class="post-banner">
        <?php if($posts_data['post_thumbnail']) { ?>
            <img src="<?php echo $posts_data['post_thumbnail']?>" class="post-thumbnail">
        <?php } ?>
        <div class="post-info">
            <h1 class="post-title fs-50"><?php echo $posts_data['post_title']?></h1>
            <p class="post-date fs-14 tt-italic mv-20">Posted on: <?php echo date('F j, Y ', $posts_data['post_timestamp']); ?></p>
        </div>
    </div>
    <div class="post-content">
        <p><?php echo $posts_data['post_content']?></p>
        <a href="index.php" class="blue-btn mt-50">Back</a>
    </div>
</div>


<?php include('footer.php'); ?> 

<?php
    } else {
        header('Location: index.php');
        exit();
    }
?>