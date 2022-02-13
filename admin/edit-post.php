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
        if (isset($_POST["title"])) {
            //Get all data from post
            $title = $_POST['title'];
            $content = nl2br($_POST['content']);
            $img_to_db = "/";
            $current_post_id = $_POST['current_post_id'];
            // IMAGE UPDATE FUNCTIONALITY //


            // END IMAGE UPDATE FUNCTIONALITY //
            
            // Prepare and Run query
            try {
                $query = $pdo->prepare('UPDATE posts SET post_title=?, post_content=?, post_timestamp=?, post_thumbnail=? WHERE post_id=?');
                $query->bindValue(1, $title);
                $query->bindValue(2, $content);
                $query->bindValue(3, time());
                $query->bindValue(4, $img_to_db);
                $query->bindValue(5, $current_post_id);

                $query_execute = $query->execute();

                if($query_execute = $query->execute()) {
                    $success_message =  'Post Successfully updated!';
                    header('Location: edit-post.php?post_id=' . $curent_post_id);
                } else {
                    $error_message =  'Unknown error. Please try again.';
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
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

<div class="admin-wrapper edit-post flex bg-tertiary">

    <?php include('templates/admin-nav.php'); ?>

    <div class="admin-dashboard-wrapper p-30 flex flex-column">

        <?php include('templates/admin-logout.php'); ?> 

        <div class="admin-posts-bottom mv-auto c-light-grey">
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
                    <input type="text" name="title" class="mb-10 p-10 bg-senary c-light-grey" value="<?php echo $post_data['post_title'] ?>"/>
                    <?php if (isset($statusMsg)) { ?>
                        <div class="c-green mv-10">
                            <p><?php echo $statusMsg ?></p>
                        </div>
                    <?php } ?>
                    <?php if (isset($post_data['post_thumbnail'])) { ?>
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($post_data['post_thumbnail']); ?>" class="edit-single-post-img mv-20" />
                    <?php } else { ?>
                        <label for="image" class="btn mv-10">Thumbnail Image</label>
                        <!-- MAX_FILE_SIZE must precede the file input field -->
                        <!-- <input type="hidden" name="MAX_FILE_SIZE" value="30000" /> -->
                        <input type="file" accept="image/png, image/jpeg, image/jpg" style="display:none;" id="image" name="image" />
                    <?php } ?>
                    <textarea rows="25" name="content" class="bg-senary c-light-grey p-10 ff-1"><?php echo strip_tags($post_data['post_content']); ?></textarea>
                    <input type="submit" name="update_post" value="UPDATE" class="btn green-btn mv-20"/>
                </form>
            <?php } else {
                echo $no_id_error;
            }?>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>