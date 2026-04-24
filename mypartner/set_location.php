<?php
session_start();
include_once('class/DBController.php');
$db_handle = new DBController();
if (isset($_POST['id'])) {
    $location_id = intval($_POST['id']);
    $_SESSION['location_id'] = $location_id;
    $query = "SELECT name FROM cities WHERE id='$location_id'";
    $result = $db_handle->runBaseQuery($query);
    if (!empty($result) && !empty($result[0]['name'])) {
        $_SESSION['location_name'] = $result[0]['name'];
    }
    echo 'ok';
}
?>