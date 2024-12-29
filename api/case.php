<?php
include_once('class/DBController.php');
include_once('class/Admin.php');
include_once('class/User.php');
include_once('class/Agent.php');
//declare db classes
session_start();


$db_handle=new DBController($db);
$profile = new Profile();
$base_url="https://www.getyouride.in/"
$image = $base_url."images/";


$action = "";
if (!empty($json["action"])) 
	{
    	$action = $json["action"];
	}
	
// -- switch start
switch ($action) {

    case "admin":
    if($json['action']=='admin')
    {
       // -- api config login
       if($json['page']=='app_config')
       {
           $admin->app_config();
       }
    }
    break;
    
    case "user":
        if($json['action']=='user')
        {
           if($json['page']=='login')
           {$user->login();}

           if($json['page']=='register')
           {$user->regiter();}

           if($json['page']=='profile')
           {$user->profile();}

           if($json['page']=='edit_profile')
           {$user->profile();}

           if($json['page']=='mybooking')
           {$user->mybooking();}

           if($json['page']=='addreview')
           {$user->addreview();}

           if($json['page']=='viewreview_one')
           {$user->viewreview_one();}

           if($json['page']=='viewreview_all')
           {$user->viewreview_all();}

           if($json['page']=='feedback_send')
           {$user->feedback_send();}
        }
        break;

        case "agent":
            if($json['action']=='agent')
            {
                if($json['page']=='add_agent')
                {$user->add_agent();}

                if($json['page']=='edit_agent')
                {$user->edit_agent();}

                if($json['page']=='view_agent_all')
                {$user->view_agent_all();}

                if($json['page']=='view_agent_one')
                {$user->view_agent_one();}

                if($json['page']=='delete_agent')
                {$user->delete_agent();}

                if($json['page']=='disable_agent')
                {$user->disable_agent();}

                if($json['page']=='booking_agent')
                {$user->booking_agent();}

                if($json['page']=='add_booking_agent')
                {$user->add_booking_agent();}

                if($json['page']=='edit_booking_agent')
                {$user->edit_booking_agent();}

                if($json['page']=='view_booking_agent')
                {$user->view_booking_agent();}

                if($json['page']=='view_booking_agent_one')
                {$user->view_booking_agent_one();}

                if($json['page']=='view_agent_review')
                {$user->view_agent_review();}

            }
        break;    

}


	
					
