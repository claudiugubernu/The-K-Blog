<?php 

include_once('../includes/connection.php');
include_once('../includes/posts.php');

$db_posts = new Posts;

if (isset($_SESSION["logged_in"])) { 
    $username = $_SESSION['username'];
    // Get Posts so we're able to get necessary details for admin dashboard
    $posts = $db_posts->fetch_all();
    $total_posts = count($posts);
    // Quick Delete Post
    if(isset($_POST['delete-post'])) {
        $id = $_POST['post-id'];
        $query = $pdo->prepare('DELETE FROM posts WHERE post_id = ?');
        $query->bindValue(1, $id);
        $query->execute();
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}

?>

<?php include('header.php'); ?>

<div class="admin-wrapper flex md-flex-column align-items-center admin-bg-primary">

    <?php include('admin-nav.php'); ?>

    <div class="admin-dashboard-wrapper flex flex-column">
        <?php include('templates/admin-logout.php'); ?> 
        <div class="admin-dashboard-bottom flex flex-column mh-50">
            <div class="dashboard-wrapper-top flex flex-wrap mb-30">
                <div class="admin-left-card admin-bg-secondary w-25 m-w-100 ph-40 flex flex-column mb-20 mr-30">
                    <div class="square-tile">
                        <img src="../../static/icons/add-post.svg" class="icon-40" alt="Add post icon">
                    </div>
                    <p class="admin-left-card-title mb-10">Number of Posts</p>
                    <p class="admin-left-card-content fs-100 align-self-center"><?php echo $total_posts ?></p>
                </div>
                <div class="admin-right-card admin-bg-secondary w-25 m-w-100 ph-40 flex flex-column mb-20">
                    <div class="square-tile">
                        <img src="../../static/icons/white-recycle-bin.svg" class="icon-40" alt="Add post icon">
                    </div>
                    <form action="index.php" method="post" class="flex flex-column justify-between">
                        <label class="admin-right-card-title mb-10">Quick Delete</label>
                        <select name="post-id">
                            <option disabled selected>Select a post</option>
                            <?php  foreach ($posts as $post) {?> 
                                <option value="<?php echo $post['post_id'] ?>"><?php echo $post['post_title'] ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" class="btn red-btn" name="delete-post" value="DELETE POST">
                    </form>
                </div>
            </div>
            <div class="dashboard-wrapper-bottom admin-bg-secondary w-100 p-50 flex flex-column justify-start">
                <p class="quick-link-title mb-20">Quick Links</p>
                <div class="quick-link-btns flex">
                    <a href="add-post.php" class="btn green-btn">ADD POST</a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include('footer.php') ?>
