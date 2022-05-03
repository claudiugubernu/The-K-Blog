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

<div class="admin-wrapper flex md-flex-column align-items-center bg-tertiary">

    <?php include('admin-nav.php'); ?>

    <div class="admin-dashboard-wrapper p-30 flex flex-column">
        <?php include('templates/admin-logout.php'); ?> 
        <div class="admin-dashboard-bottom flex flex-column justify-center">
            <div class="dashboard-wrapper-top flex gap-30 mb-50">
                <div class="admin-left-card w-25 m-w-100 p-50 flex flex-column">
                    <p class="admin-left-card-title mb-10">Number of Posts</p>
                    <p class="admin-left-card-content fs-100 align-self-center"><?php echo $total_posts ?></p>
                </div>
                <div class="admin-right-card w-25 m-w-100 p-50 flex flex-column align-items-center">
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
            <div class="dashboard-wrapper-bottom w-100 p-50 flex flex-column justify-start">
                <p class="quick-link-title mb-20">Quick Links</p>
                <div class="quick-link-btns flex">
                    <a href="add-post.php" class="btn green-btn">ADD POST</a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include('footer.php') ?>
