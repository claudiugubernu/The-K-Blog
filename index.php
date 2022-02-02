<?php 

session_start();

include_once('includes/connection.php');
include_once('includes/posts.php');
include_once('functions.php');

$db_posts = new Posts;
$posts = $db_posts->fetch_all();
?>

<?php include('header.php'); ?>
<nav>
    <div class="nav-wrapper">
        <a href="index.php">
            <img src="" alt="Site logo"/>
        </a>
        <?php if (!isset($_SESSION["logged_in"])) { ?>
        <a href="admin">Sign In</a>
        <?php } ?>
    </div>
</nav>
<div id="content" class="archive-wrapper">
    <div class="post-grid">
        <?php 
            if($posts) {
                foreach ($posts as $post) { ?>
                    <a href="single.php?id=<?php echo $post['post_id'] ?>">
                        <div class="post-card" id="<?php echo $post['post_id'] ?>">
                            <div class="post-card-img">
                            <?php if($post['post_thumbnail']) { ?>
                                <img src="<?php echo url() . $post['post_thumbnail']?>" class="post-thumbnail">
                            <?php } ?>
                            </div>
                            <div class="post-card-title">
                                <p><?php echo $post['post_title'] ?></p>
                                <p class="post-date">Posted on: <?php echo date('F j, Y ', $post['post_timestamp']); ?></p>
                                <p>Read More</p>
                            </div>
                        </div>
                    </a>
                <?php 
                }
            } ?>
    </div>
</div>

<?php include('footer.php'); ?> 