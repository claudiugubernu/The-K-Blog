<?php

session_start();

include_once('../includes/connection.php');

if (isset($_SESSION["logged_in"])) { 
    $username = $_SESSION['username'];

    // Check if fields are completed and posted
    if (isset($_POST["title"])) {
        $title = $_POST['title'];
        $content = nl2br($_POST['content']);
        $img = $_FILES['image']['name'];

        if ($img) {
            // Set img to be stored in uploads folder
            $targetDir = "uploads/";
            $file_name = basename($_FILES['image']['name']);
            $target_file_path = $targetDir . $file_name;
            $file_type = strtolower(pathinfo($target_file_path, PATHINFO_EXTENSION));
            $thumbnail = $_FILES["image"]["tmp_name"];
            //upload file to server
            if (move_uploaded_file($thumbnail, $target_file_path)) {
                $statusMsg = "The file ".$file_name. " has been uploaded to ".$target_file_path;
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }

        if (empty($title)) {
            $error = 'Title field is required';
        } else {
            $query = $pdo->prepare('INSERT INTO posts (post_title, post_content, post_timestamp, post_thumbnail_path) VALUES (?, ?, ?, ?)');
            $query->bindValue(1, $title);
            $query->bindValue(2, $content);
            $query->bindValue(3, time());
            $query->bindValue(4, $target_file_path ? $target_file_path : '');
            $query_execute = $query->execute();

            if ($query_execute) {
                header('Location: posts.php');
            } else {
                $error = 'An error has occured. Please try again.';
            } 
        }
    }
} else {
    header('Location: index.php');
}
?>

<?php include('header.php'); ?>

<div class="admin-wrapper flex admin-bg-primary">

    <?php include('templates/admin-nav.php'); ?>

    <div class="admin-dashboard-wrapper flex flex-column">
        <?php include('templates/admin-logout.php'); ?> 
        <div class="admin-posts-bottom mh-50">
            <p class="add-post-title-label mb-10 fs-24 admin-c-secondary">Title</p>
            <?php if (isset($error)) { ?>
                <div class="error mv-10">
                    <p><?php echo $error ?></p>
                </div>
            <?php } ?>
            <form action="add-post.php" method="post" enctype="multipart/form-data" class="flex flex-column ff-1">
                <input type="text" name="title" class="mb-10 p-10 admin-bg-secondary admin-c-primary"/>
                <?php if (isset($statusMsg)) { ?>
                    <div class="c-green mv-10">
                        <p><?php echo $statusMsg ?></p>
                    </div>
                <?php } ?>
                <!-- MAX_FILE_SIZE must precede the file input field -->
                <!-- <input type="hidden" name="MAX_FILE_SIZE" value="30000" /> -->
                <input type="file" name="image" class="mv-20" accept="image/png, image/jpeg, image/jpg" id="image"/>
                <textarea rows="25" name="content" class="admin-bg-secondary admin-c-primary p-10 ff-1"></textarea>
                <input type="submit" name="submit" value="PUBLISH" class="btn green-btn mv-20"/>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>