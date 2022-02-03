<?php 

session_start();

include_once('includes/connection.php');
include_once('includes/posts.php');
include_once('functions.php');

$db_posts = new Posts;
$posts = $db_posts->fetch_all();
?>

<?php include('header.php'); ?>

<div id="content" class="archive-wrapper site-width mv-50 m-mv-40">
    <div class="post-grid grid">
        <?php
            if($posts) {
                foreach ($posts as $post) {?>
                    <div class="post-card inherit-link" id="<?php echo $post['post_id'] ?>">
                        <div class="post-card-img">
                        <?php if($post['post_thumbnail']) { ?>
                            <img src="<?php echo $post['post_thumbnail']?>" class="post-thumbnail">
                        <?php } ?>
                        </div>
                        <div class="post-card-title">
                            <p class="fs-36"><?php echo $post['post_title'] ?></p>
                            <p class="post-date fs-14 tt-italic mv-20">Posted on: <?php echo date('F j, Y ', $post['post_timestamp']); ?></p>
                            <a href="single.php?id=<?php echo $post['post_id'] ?>" class="blue-btn mt-20">Read More</a>
                        </div>
                    </div>
                <?php 
                }
            } ?>
    </div>
</div>

<?php include('footer.php'); ?> 