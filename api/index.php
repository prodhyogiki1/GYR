<?php 
include_once('../class/DBController.php');
include_once('../class/Admin.php');
include_once('../class/User.php');
include_once('../class/Agent.php');
//declare db classes
session_start();

$base_url="http://localhost/gyr/";
$db_handle=new DBController();
$admin = new Admin();
$agent = new Agent();
$user = new User();
$image = $base_url."theme/assets/images/";

header('Content-Type: application/json; charset=utf-8');

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//login confirmation
$json = json_decode(file_get_contents('php://input'), true);
//--- action variable
$action = "";
if (!empty($json["action"])) 
	{
    	$action = $json["action"];
	}
    
//-- apis    
switch ($action) {
//-- api
case "api":
   
    
            if($json['action']=='api')
            {
                    if($json['page']=='app_config')
                    {
                        $admin->app_config();
                    }
    
                    if($json['page']=='userlogin')
                    {
                        $user->userlogin($json['mobile']);
                    }  
                
            }
    break;
    //-- api closed	
        }
?>