<?php 


require('session.php'); 
//require('composer/vendor/autoload.php'); 
//login confirmation
confirm_logged_in();
$action=$_GET['action']; 
if(!isset($_GET['action']) && !empty($_SESSION['uid']))
{
    header('Location:index.php?action=dashboard&page=dashboard');
}
//include('class_call.php');
include('case.php');
?>
