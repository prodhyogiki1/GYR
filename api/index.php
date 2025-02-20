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
                        $user->get_company();
                    }
    
                    if($json['page']=='userlogin')
                    {
                        $user->userlogin($json['mobile']);
                    }
                    
                    if($json['page']=='otp_varify')
                    {
                        $user->otp_varify($json['mobile'],$json['otp']);
                    }

                    if($json['page']=='register')
                    {
                        $user->register($json['mobile']);
                    }

                    if($json['page']=='served_location')
                    {
                        $user->served_location();
                    }

                    if($json['page']=='search')
                    {
                        $user->search($json['city']);
                    }

                    if($json['page']=='bike_details')
                    {
                        $user->bike_details($json['bid']);
                    }

                    if($json['page']=='calculate_amt')
                    {
                        $user->calculate_amt($json['bid'],$json['to_date'],$json['from_date']);
                    }

                    
                    if($json['page']=='user_booking_add')
                    {                       
                        //0 is cash 1 is at store and 2 is online payement
                        $user->user_booking_add($json['bid'],$json['uid'],$json['aid'],$json['from_date'],$json['to_date'],$json['amount'],$json['payment_mode']);
                    }

                    if($json['page']=='booking_cancel')
                    {
                        $user->booking_cancel($json['id']);
                    }

                    if($json['page']=='update_booking_date')
                    {
                        $user->update_booking_date($json['id'],$json['from_date'],$json['to_date']);
                    }

                    if($json['page']=='mybooking')
                    {
                        $user->mybooking($json['uid']);
                    }

                    if($json['page']=='slider')
                    {
                        $user->slider();
                    }

                    if($json['page']=='user_details_save')
                    {
                        $user->user_details_save($json['uid'],$json['name'],$json['email'],$json['licence'],$json['adhar']);
                    }

                    if($json['page']=='profile')
                    {
                        $user->user_profile($json['mobile']);
                    }

                    

                
            }
    break;
    //-- api closed	
        }
?>