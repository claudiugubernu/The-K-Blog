<?php

session_start();

include_once('../includes/connection.php');
include '../admin/widgets/calendar.php';

$date = date('Y-m-d');
$calendar = new Calendar($date);
$calendar->add_event('Holiday', '2022-05-9', 4);
$calendar->add_event('Project Completion', '2022-05-19', 1, 'blue');

if (isset($_SESSION["logged_in"])) { 
    $username = $_SESSION['username'];
} else {
    header('Location: index.php');
}
?>

<?php include('header.php'); ?>

<div class="admin-wrapper flex admin-bg-primary">

    <?php include('templates/admin-nav.php'); ?>

    <div class="admin-dashboard-wrapper flex flex-column">
        <?php include('templates/admin-logout.php'); ?> 
        <div class="admin-dashboard-bottom mh-50 flex flex-wrap">
            
            <div class="calendar-widget mr-50 mb-50">
                <?php echo $calendar ?>
            </div>
            <div class="calendar-widget-controls">
                <h4 class="fs-20 mb-20">Add Event</h4>
                <form action="user-calendar.php" method="post" class="user-calendar-form flex flex-column justify-center">
                    <div class="form-row flex flex-column">
                        <label for="event_type" class="mb-10 fs-16 admin-c-tertiary">Event Type</label>
                        <input type="text" name="event_type" id="event_type"/>
                    </div>
                    <div class="form-row flex flex-column">
                        <label for="event_date" class="mb-10 fs-16 admin-c-tertiary">Event Date</label>
                        <input type="date" value="<?php echo $date ?>" min="<?php echo $date ?>" max="2024-12-31" name="event_date" id="event_date"/>
                    </div>
                    <div class="form-row flex flex-column">
                        <label for="event_duration" class="mb-10 fs-16 admin-c-tertiary">Event Duration (day)</label>
                        <input type="number" name="event_duration" id="event_duration" value="1" min="1" max="14"/>
                    </div>
                    <div class="form-row flex flex-column">
                        <label for="event_color" class="mb-10 fs-16 admin-c-tertiary">Color</label>
                        <select>
                            <option selected>Yellow</option>
                            <option>Green</option>
                            <option>Red</option>
                            <option>Blue</option>
                        </select>
                    </div>
                    <input type="submit" name="update_password" value="UPDATE" class="btn green-btn mv-20"/>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>