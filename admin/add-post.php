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

<div class="admin-wrapper flex bg-tertiary">

    <?php include('templates/admin-nav.php'); ?>

    <div class="admin-dashboard-wrapper p-30 flex flex-column">
        <?php include('templates/admin-logout.php'); ?> 
        <div class="admin-posts-bottom mv-auto c-light-grey">
            <p class="add-post-title-label mb-10 fs-24">Title</p>
            <form action="add-post.php" method="post" class="flex flex-column ff-1">
                <input type="text" name="title" class="mb-10 p-10 bg-senary c-light-grey"/>
                <input type="file" accept="image/*" name="thumbnail" class="mv-10"/>
                <textarea rows="25" name="content" class="bg-senary c-light-grey p-10 ff-1"></textarea>
                <input type="submit" value="PUBLISH" class="btn green-btn mv-20"/>
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