<?php

session_start();

include_once('../includes/connection.php');

if (isset($_SESSION["logged_in"])) { 
    $username = $_SESSION['username'];

    // Check if fields are completed and posted
    if (isset($_POST["title"])) {
        $title = $_POST['title'];
        $content = nl2br($_POST['content']);

        // Set img to be stored in uploads folder
        $targetDir = "uploads/";
        $file_name = $_FILES['image']['name'];
        $targetFilePath = $targetDir . $file_name;
        $file_type = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $thumbnail = $_FILES["image"]["tmp_name"];
        $img_to_db = file_get_contents($thumbnail);

        //upload file to server
        if (move_uploaded_file($thumbnail, $targetFilePath)) {
            $statusMsg = "The file ".$file_name. " has been uploaded to ".$targetFilePath;
        } else {
            $statusMsg = "Sorry, there was an error uploading your file.";
        }

        if (empty($title)) {
            $error = 'Title field is required';
        } else {
            
            $query = $pdo->prepare('INSERT INTO posts (post_title, post_content, post_timestamp, post_thumbnail) VALUES (?, ?, ?, ?)');
            $query->bindValue(1, $title);
            $query->bindValue(2, $content);
            $query->bindValue(3, time());
            $query->bindValue(4, $img_to_db);
            $query->execute();
            header('Location: posts.php');
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
            <?php if (isset($error)) { ?>
                <div class="error mv-10">
                    <p><?php echo $error ?></p>
                </div>
            <?php } ?>
            <form action="add-post.php" method="post" enctype="multipart/form-data" class="flex flex-column ff-1">
                <input type="text" name="title" class="mb-10 p-10 bg-senary c-light-grey"/>
                <label for="image" class="btn mv-10">Thumbnail Image</label>
                <!-- MAX_FILE_SIZE must precede the file input field -->
                <!-- <input type="hidden" name="MAX_FILE_SIZE" value="30000" /> -->
                <?php if (isset($statusMsg)) { ?>
                    <div class="c-green mv-10">
                        <p><?php echo $statusMsg ?></p>
                    </div>
                <?php } ?>
                <input type="file" accept="image/png, image/jpeg, image/jpg" style="display:none;" id="image" name="image" />
                <textarea rows="25" name="content" class="bg-senary c-light-grey p-10 ff-1"></textarea>
                <input type="submit" name="submit" value="PUBLISH" class="btn green-btn mv-20"/>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>