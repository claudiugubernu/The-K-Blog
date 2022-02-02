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

<div class="admin-wrapper">

    <?php include('admin-nav.php'); ?>

    <div class="admin-dashboard-wrapper">
        <div class="admin-dashboard-top">
            <p class="admin-sign-out">Hello, <?php echo $username ?> </p><a href="logout.php" class="admin-sign-out-link">(logout)</a>
        </div>
        <div class="admin-dashboard-bottom">
            <div class="dashboard-wrapper-top">
                <div class="admin-left-card half-card">
                    <p class="admin-left-card-title">Number of Posts</p>
                    <p class="admin-left-card-content"><?php echo $total_posts ?></p>
                </div>
                <div class="admin-right-card half-card">
                    <form action="index.php" method="post">
                        <label class="admin-right-card-title">Quick Delete</label>
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
            <div class="dashboard-wrapper-bottom">
                <p class="quick-link-title">Quick Links</p>
                <div class="quick-link-btns">
                    <a href="add-post.php" class="btn green-btn">ADD POST</a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include('footer.php') ?>
