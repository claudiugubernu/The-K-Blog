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
?>

<?php include('header.php'); ?>

<div class="admin-wrapper flex align-items-center bg-tertiary">

    <?php include('templates/admin-nav.php'); ?>

    <div class="admin-dashboard-wrapper">
        <div class="admin-dashboard-top">
            <p class="admin-sign-out">Hello, <?php echo $username ?></p><a href="logout.php">(logout)</a>
        </div>
        <div class="admin-posts-btn">
            <a href="add-post.php" class="btn green-btn">ADD POST</a>
            <a href="edit-post.php" class="btn yellow-btn">EDIT POST</a>
            <a href="delete-post.php" class="btn red-btn">DELETE POST</a>
        </div>
        <div class="admin-posts-bottom">
            <div class="dashboard-posts-wrapper">
                <div class="post-list-grid">
                    <div class="grid-head">
                        <p>ID</p>          
                        <p>Title</p>          
                        <p>Date</p>
                    </div>
                    <?php foreach ($posts as $post) { ?> 
                        <a class="grid-body" href="edit-article.php">
                            <div class="grid-body-id">
                                <input type="checkbox" name="<?php $post['post_id'] ?>">
                                <p><?php echo $post['post_id'] ?></p>  
                            </div>   
                            <p><?php echo $post['post_title'] ?></p>          
                            <p><?php echo date('F j, Y ', $post['post_timestamp']); ?></p>    
                        </a>      
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>