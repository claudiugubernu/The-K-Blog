<?php

session_start();

include_once('../includes/connection.php');

if (isset($_SESSION["logged_in"])) { 
    $username = $_SESSION['username'];
    // Check if fields are completed and posted
    if (isset($_POST['title'],$_POST['content'])) {
        $title = $_POST['title'];
        $content = nl2br($_POST['content']);
        $thumbnail = $_POST['thumbnail'];

        if (empty($title)) {
            $error = 'Title field is required';
        } else {
            $query = $pdo->prepare('INSERT INTO posts (post_title, post_content, post_timestamp, post_thumbnail) VALUES (?, ?, ?, ?)');
            $query->bindValue(1, $title);
            $query->bindValue(2, $content);
            $query->bindValue(3, time());
            $query->bindValue(4, $thumbnail);
            $query->execute();
            header('Location: index.php');
        }
    }

} else {
    header('Location: index.php');
}
?>

<?php include('header.php'); ?>

<div class="admin-wrapper">

    <?php include('templates/admin-nav.php'); ?>

    <div class="admin-dashboard-wrapper">
        <div class="admin-dashboard-top">
            <p class="admin-sign-out">Hello, <?php echo $username ?></p><a href="logout.php">(logout)</a>
        </div>
        <div class="admin-posts-bottom">
            <p class="add-post-title-label">Title</p>
            <form action="add-post.php" method="post">
                <input type="text" name="title"/>
                <input type="file" accept="image/*" name="thumbnail"/>
                <textarea rows="25" name="content"></textarea>
                <input type="submit" value="PUBLISH" class="btn green-btn"/>
            </form>
        </div>
        <?php if (isset($error)) { ?>
            <div class="login-error">
                <p><?php echo $error ?></p>
            </div>
        <?php } ?>
    </div>
</div>

<?php include('footer.php'); ?>