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

// Delete Posts
if (isset($_POST['delete_post'])) {
    if(isset($_POST['selected-post_id'])) {
        // Get all selected checkboxes(ids) in an array
        $post_ids = $_POST['selected-post_id'];
   
        if($post_ids) {
            foreach ($post_ids as $id) {
                // Build and Run query
                $query = $pdo->prepare('DELETE FROM posts WHERE post_id = ?');
                $query->bindValue(1, $id);
                $query_execute = $query->execute();
        
                if ($query_execute) {
                    $succes_message = 'Record(s) deleted successfully';
                    header('Location: posts.php');
                } else {
                    $error_message = 'Unable to delete record(s). Please try again.';
                }
            }
        } else {
            $error_message = 'Unable to delete record(s). Please try again.';
        } 
    } else {
        $error_message = 'Unable to delete record(s). Please try again.';
    }
}

?>

<?php include('header.php'); ?>

<div class="posts-wrapper admin-wrapper flex md-flex-column align-items-center admin-bg-primary">
    <?php include('templates/admin-nav.php'); ?>
    <div class="admin-dashboard-wrapper flex flex-column">
        <?php include('templates/admin-logout.php'); ?> 
        <?php if (!empty($posts)) { ?>
            <form action="posts.php" method="post" class="mh-50">
                <div class="admin-posts-btn flex gap-30 mb-50">
                    <a href="add-post.php" class="btn green-btn">ADD POST</a>
                    <input class="btn red-btn" type="submit" name="delete_post" value="DELETE POST">
                </div>
        <?php } ?>
                <div class="session-status">
                <?php if (isset($succes_message)) { ?>
                    <p class="ff-16 c-add"><?php echo $succes_message ?> </p>
                <?php   } 
                    if (isset($error_message)) { ?>
                        <p class="ff-16 c-error"><?php echo $error_message; ?> </p>
                <?php } ?>
                </div>
                <div class="admin-posts-bottom mv-50">
                    <div class="dashboard-posts-wrapper">
                        <?php if (!empty($posts)) { ?>
                            <div class="post-list-grid">
                                <div class="grid-head grid mb-20 ph-10 admin-c-tertiary">
                                    <p>ID</p>          
                                    <p>Title</p>          
                                    <p>Date</p>
                                </div>
                        <?php } ?>
                            <?php if (empty($posts)) {?>
                                <div class="site-width flex gap-10 align-items-end admin-c-tertiary">
                                    <p>So empty.</p>
                                    <a href="add-post.php" class="btn green-btn">ADD POST</a>
                                    <p>your first post.</p>
                                </div>
                            <?php } ?>
                            <?php foreach ($posts as $post) { ?>
                                <div class="post-row grid-body grid admin-c-tertiary pv-10 ph-10 <?php if ( $i % 2 !=0 ) { echo "admin-bg-secondary c-light-grey"; } ?> ">
                                    <div class="grid-body-id flex align-items-center gap-10">
                                        <input type="checkbox" name="selected-post_id[]" value="<?php echo $post['post_id'] ?>">
                                        <p><?php echo $post['post_id'] ?></p>  
                                        <a href="edit-post.php?post_id=<?php echo $post['post_id']?>" class="edit-link yellow-link fs-14">EDIT POST</a>
                                    </div>   
                                    <p><?php echo $post['post_title'] ?></p>     
                                    <p><?php echo date('F j, Y ', $post['post_timestamp']); ?></p>    
                                </div>  
                            <?php $i++; } ?>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>

<?php include('footer.php'); ?>