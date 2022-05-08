<?php

session_start();

include_once('../includes/connection.php');
include_once('../includes/posts.php');

if (isset($_SESSION["logged_in"])) {
    $username = $_SESSION['username'];

    // Check to see if post_id is set in URL and get data from db
    if (isset($_GET['post_id'])) {
        $current_post_id = $_GET['post_id'];
        $query = $pdo->prepare('SELECT * FROM posts WHERE post_id = ?');
        $query->bindValue(1, $current_post_id);
        $query->execute();

        $post_data = $query->fetch();
    } else {
        $no_id_error = 'ID not found';
    }
    // Update post
    if (isset($_POST["update_post"])) {
        // Check if title exists
        if (!empty($_POST["title"])) {
            // Get all data from post
            $title = $_POST['title'];
            $content = nl2br($_POST['content']);
            $current_post_id = $_POST['current_post_id'];

            // Check for new img
            if ($_FILES['image']['size'] != 0) {
                // Set img to be stored in uploads folder
                $targetDir = "uploads/";
                $file_name = basename($_FILES['image']['name']);
                if ($file_name) {
                    $target_file_path = $targetDir . $file_name;
                    $file_type = strtolower(pathinfo($target_file_path, PATHINFO_EXTENSION));
                    $thumbnail = $_FILES["image"]["tmp_name"];        
                    //upload file to server
                    if (move_uploaded_file($thumbnail, $target_file_path)) {
                        $statusMsg = "The file ". $file_name . " has been uploaded to ". $target_file_path;
                    } else {
                        $statusMsg = "Sorry, there was an error uploading your file.";
                    }
                }
            } else if (empty($_POST['existing_img'])) {
                $target_file_path = '';
            } else {
                $target_file_path = $post_data['post_thumbnail_path'];
            }
           
            // Prepare and Run query
            $query = $pdo->prepare('UPDATE posts SET post_title=?, post_content=?, post_timestamp=?, post_thumbnail_path=? WHERE post_id=?');
            $query->bindValue(1, $title);
            $query->bindValue(2, $content);
            $query->bindValue(3, time());
            $query->bindValue(4, $target_file_path);
            $query->bindValue(5, $current_post_id);
            $query_execute = $query->execute();

            if($query_execute) {
                $success_message =  'Post Successfully updated!';
                header('Location: edit-post.php?post_id=' . $_GET['post_id']);
            } else {
                $error_message =  'Unknown error. Please try again.';
            }
        } else {
            // Ask for title to be added
            $no_title_error = 'Title field is required';
        }
    }
} else {
    header('Location: index.php');
}
?>

<?php include('header.php'); ?>

<div class="admin-wrapper edit-post flex admin-bg-primary">

    <?php include('templates/admin-nav.php'); ?>

    <div class="admin-dashboard-wrapper flex flex-column">

        <?php include('templates/admin-logout.php'); ?> 

        <div class="admin-posts-bottom mh-50 admin-c-secondary">
            <?php if(isset($success_message)) { ?>
                <p class="fs-16 c-add"><?php echo $success_message ?></p>
            <?php } ?> 
            
            <?php if(isset($error_message)) { ?>
                <p class="fs-16 c-error"><?php echo $error_message ?></p>
            <?php } ?> 
            <?php
            if (isset($_GET['post_id'])) { ?>
                <p class="add-post-title-label mb-10 fs-24">Title</p>
                <?php if (isset($no_title_error)) { ?>
                    <div class="error mv-10">
                        <p><?php echo $no_title_error ?></p>
                    </div>
                <?php } ?>
                <form method="post" enctype="multipart/form-data" class="flex flex-column ff-1">
                    <input type="hidden" name="current_post_id" value="<?php echo $post_data['post_id'] ?>"/>
                    <input type="text" name="title" class="mb-10 p-10 admin-bg-secondary admin-c-primary" value="<?php echo $post_data['post_title'] ?>"/>
                    <?php if (isset($statusMsg)) { ?>
                        <div class="c-green mv-10">
                            <p><?php echo $statusMsg ?></p>
                        </div>
                    <?php } ?>
                    <?php if (isset($post_data['post_thumbnail_path']) && $post_data['post_thumbnail_path'] != '') { ?>
                        <div class="thumbnail-img relative mv-20">
                            <img src="<?php echo $post_data['post_thumbnail_path']; ?>" class="edit-single-post-img" />
                            <img src="../assets/img/recycle-bin.png" class="delete-img-icon absolute" alt="delete image icon">
                            <input type="hidden" id="existing-image" name="existing_img" value="<?php echo $post_data['post_thumbnail_path']?>">
                        </div>
                        <input type="file" class="upload-thumbnail mv-20" accept="image/png, image/jpeg, image/jpg" id="image" name="image" />
                    <?php } else { ?>
                        <!-- MAX_FILE_SIZE must precede the file input field -->
                        <!-- <input type="hidden" name="MAX_FILE_SIZE" value="30000" /> -->
                        <input type="file" class="mv-20" accept="image/png, image/jpeg, image/jpg" id="image" name="image" />
                    <?php } ?>
                    <textarea rows="25" name="content" class="admin-bg-secondary admin-c-primary p-10 ff-1"><?php echo strip_tags($post_data['post_content']); ?></textarea>
                    <input type="submit" name="update_post" value="UPDATE" class="btn green-btn mv-20"/>
                </form>
            <?php } else {
                echo $no_id_error;
            }?>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>