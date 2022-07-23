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

<div id="content" class="single-post-wrapper mb-50">
    <div class="post-banner relative">
        <div class="post-info">
            <time  datetime="<?php echo date('j F Y', $posts_data['post_timestamp']); ?>" class="post-date fs-14 tt-italic mv-20"><?php echo date('j F Y', $posts_data['post_timestamp']); ?></time>
            <h1 class="post-title fs-50"><?php echo $posts_data['post_title']?></h1>
        </div>
        <?php if($posts_data['post_thumbnail_path']) { ?>
            <img src="./admin/<?php echo $posts_data['post_thumbnail_path']; ?>" class="single-post-img" />
        <?php } ?>
    </div>
    <div class="post-content site-width mv-50">
        <p class="w-50 m-w-100"><?php echo $posts_data['post_content']?></p>
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