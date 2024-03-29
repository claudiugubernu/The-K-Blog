<?php

session_start();

include_once('includes/connection.php');
include_once('includes/posts.php');
include_once('functions.php');

$db_posts = new Posts;
$posts = $db_posts->fetch_all();

?>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<div id="content" class="archive-wrapper site-width mv-50 m-mv-40">
    <div class="post-grid grid">
        <?php
            if($posts) {
                foreach ($posts as $post) {?>
                    <div class="post-card inherit-link" id="<?php echo $post['post_id'] ?>">
                        <div class="post-card-img">
                        <?php if($post['post_thumbnail_path']) { ?>
                            <img src="./admin/<?php echo $post['post_thumbnail_path']; ?>" class="single-post-img" />
                        <?php } ?>
                        </div>
                        <div class="post-card-title">
                            <time  datetime="<?php echo date('j F Y', $post['post_timestamp']); ?>" class="post-date block fs-14 tt-italic mv-10">Posted on: <?php echo date('j F Y', $post['post_timestamp']); ?></time>
                            <p class="fs-36"><?php echo $post['post_title'] ?></p>
                            <a href="single.php?id=<?php echo $post['post_id'] ?>" class="button-front-end mt-20">Read More</a>
                        </div>
                    </div>
                <?php 
                }
            } ?>
    </div>
</div>

<?php include('footer.php'); ?> 
