<?php 


require('session.php'); 

include_once('class/DBController.php');
include_once('class/Admin.php');
include_once('class/Agent.php');
include_once('class/User.php');

$db_handle = new DBController();

$admin = new Admin();
$agent = new Agent();
$user = new User();


$conn = new DBController();
$con = $conn->connectDB();


//login confirmation
confirm_logged_in();
$action=$_GET['action']; 
// if(!isset($_GET['action']) && empty($_SESSION['uid']))
// {
//     header('Location:index.php?action=dashboard&page=dashboard');
// }
// else
// {
//     echo "<script>window.location.href = 'logout.php';</script>";
// }
//include('class_call.php');
include('case.php');
?>
