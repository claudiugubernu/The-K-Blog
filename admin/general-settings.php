<?php

session_start();

include_once('../includes/connection.php');

if (isset($_SESSION["logged_in"])) { 
    $username = $_SESSION['username'];

    // Prepare query to get settings from DB
    $query = $pdo->prepare('SELECT * FROM cms_settings');
    $query->execute();

    // Get all CMS settings and assign them
    $cms_settings = $query->fetchAll();

    // Update CMS settings in DB
    if (isset($_POST['site_info'])) {
        // Check for site title
        if (!empty($_POST['site_title'])) {
            $site_title = $_POST['site_title'];
            // Check for new img
            if ($_FILES['image']['size'] != 0) {
                // Set img to be stored in uploads folder
                $targetDir = "./uploads/";
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
                $target_file_path = $cms_settings[0]['site_icon'];
            }

            // Prepare query to get settings from DB
            $query = $pdo->prepare('UPDATE cms_settings SET site_icon=?, site_title=?');
            $query->bindValue(1, $target_file_path ? $target_file_path : '');
            $query->bindValue(2, $site_title);

            $query_execute = $query->execute();

            if ($query_execute) {
                header('Location: general-settings.php');
            } else {
                $error_message =  'Unknown error. Please try again.';
            }  
        }
    }
} else {
    header('Location: index.php');
}

?>

<?php include('header.php'); ?>

<div class="general-settings-wrapper admin-wrapper flex align-items-center admin-bg-primary">
    <?php include('templates/admin-nav.php'); ?>
    <div class="admin-dashboard-wrapper flex flex-column">
        <?php include('templates/admin-logout.php'); ?> 
        <form method="post" enctype="multipart/form-data" class="cms-update-form flex flex-column justify-center mh-50">
            <div class="form-row flex flex-column">
                <label for="image" class="tooltip mb-10 fs-16 admin-c-tertiary">Site Icon <span class="info"> &#9432;</span><span class="tooltiptext">Site Icons should be square and at least 512 × 512 pixels.</span></label>
                <?php if (isset($cms_settings[0]['site_icon']) && $cms_settings[0]['site_icon'] != '') { ?>
                    <div class="thumbnail-img relative mv-20">
                        <img src="<?php echo $cms_settings[0]['site_icon']; ?>" class="edit-single-post-img" />
                        <img src="../assets/img/recycle-bin.png" class="delete-img-icon absolute" alt="delete image icon">
                        <input type="hidden" id="existing-image" name="existing_img" value="<?php echo $cms_settings[0]['site_icon']?>">
                    </div>
                    <input type="file" class="upload-thumbnail mv-20" accept="image/png, image/jpeg, image/jpg" id="image" name="image" />
                <?php } else { ?>
                    <input type="file" class="mv-20" accept="image/png, image/jpeg, image/jpg" id="image" name="image"/>
                <?php } ?>
            </div>
            <div class="form-row flex flex-column">
                <label for="site_title" class="mb-10 fs-16 admin-c-tertiary">Site Title</label>
                <input type="text" name="site_title" class="mb-10 p-10 admin-bg-secondary c-light-grey" value="<?php echo $cms_settings[0]['site_title']; ?>"/>
            </div>
            <input type="submit" name="site_info" value="UPDATE" class="btn green-btn mv-20"/>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>