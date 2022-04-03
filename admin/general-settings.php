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
        if (!empty($_POST['site_title'])) {
            $site_title = $_POST['site_title'];

            // Prepare query to get settings from DB
            $query = $pdo->prepare('UPDATE cms_settings SET site_title=?');
            $query->bindValue(1, $site_title);

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

<div class="general-settings-wrapper admin-wrapper flex align-items-center bg-tertiary">
    <?php include('templates/admin-nav.php'); ?>
    <div class="admin-dashboard-wrapper p-30 flex flex-column">
        <?php include('templates/admin-logout.php'); ?> 
        <form method="post" class="cms-update-form flex flex-column justify-center">
            <div class="form-row flex flex-column">
                <label for="favicon" class="tooltip mb-10 fs-16 c-light-grey">Site Icon <span class="info"> &#9432;</span><span class="tooltiptext">Site Icons should be square and at least 512 × 512 pixels.</span></label>
                <input type="file" name="favicon" class="mb-20" accept="image/png, image/jpeg, image/jpg" id="favicon"/>
            </div>
            <div class="form-row flex flex-column">
                <label for="site_title" class="mb-10 fs-16 c-light-grey">Site Title</label>
                <input type="text" name="site_title" class="mb-10 p-10 bg-senary c-light-grey" value="<?php echo $cms_settings[0]['site_title']; ?>"/>
            </div>
            <input type="submit" name="site_info" value="UPDATE" class="btn green-btn mv-20"/>
        </form>

        <form method="post" class="cms-update-form flex flex-column justify-center">
            <label class="mb-10 fs-16 c-light-grey">Select CMS Theme</label>
            <select name="theme-id" id="theme-id">
                <option selected>Default</option>
                <option value="">Corporate</option>
                <option value="">Special 1</option>
                <option value="">Special 2</option>
            </select>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>