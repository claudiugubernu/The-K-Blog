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

<div class="posts-wrapper admin-wrapper flex align-items-center bg-tertiary">
    <?php include('templates/admin-nav.php'); ?>
    <div class="admin-dashboard-wrapper p-30 flex flex-column">
        <?php include('templates/admin-logout.php'); ?> 
        <div class="admin-posts-btn flex gap-30 mv-50">
            <a href="add-post.php" class="btn green-btn">ADD POST</a>
            <a href="edit-post.php" class="btn yellow-btn">EDIT POST</a>
            <a href="delete-post.php" class="btn red-btn">DELETE POST</a>
        </div>
        <div class="admin-posts-bottom mv-50">
            <div class="dashboard-posts-wrapper">
                <div class="post-list-grid">
                    <div class="grid-head grid mb-20 ph-10 c-light-grey">
                        <p>ID</p>          
                        <p>Title</p>          
                        <p>Date</p>
                    </div>
                    <?php foreach ($posts as $post) { ?> 
                        <div class="grid-body grid c-light-grey pv-10 ph-10 <?php if ( $i % 2 !=0 ) { echo "bg-senary"; } ?> ">
                            <div class="grid-body-id flex align-items-center gap-10">
                                <input type="checkbox" name="selected-post" value="<?php $post['post_id'] ?>">
                                <p><?php echo $post['post_id'] ?></p>  
                            </div>   
                            <p><?php echo $post['post_title'] ?></p>     
                            <p><?php echo date('F j, Y ', $post['post_timestamp']); ?></p>    
                    </div>      
                    <?php $i++; } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>