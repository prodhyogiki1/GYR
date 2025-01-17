<?php

switch ($action) {
				
case "dashboard":

	//-- include here only 
	
 		if($_GET['action']=='dashboard')
 		{
 			
 			//-- no css modal popup
			if(isset($_GET['nocss']))
			{
				if(!file_exists("web/".$_GET['nocss'].".php"))
 						{require_once("web/404.php");}
 					else
 						{require_once("web/".$_GET['nocss'].".php");}
			}
			else if(isset($_GET['page']))
 				{
 					require_once("web/header.php");
					require_once("web/menu.php");
 					//============================================ OPEN ALL PAGES		
 					if(!file_exists("web/".$_GET['page'].".php"))
 						{require_once("web/404.php");}
 					else
 						{require_once("web/".$_GET['page'].".php");}
 					
 					require_once("web/footer2.php");
 				}
 			else
 				{require_once("web/dashboard.php");}
 		}
 		break;

//--- agent
case "agent":
	if($_GET['action']=='agent')
	{
		if($_GET['query']=='signup')
		{
			$signup=$agent->signup($_POST['aname'],$_POST['phone'],$_POST['email'],$_POST['pan'],$_POST['gstin']);
		}
		if($_GET['query']=='add_agent')
		{
			print_r($_POST);
			$signup=$agent->add_agent($_POST['fname'],$_POST['lname'],$_POST['phone'],$_POST['email'],$_POST['designation'],$_POST['phone2'],$_POST['bname'],$_POST['landmark'],$_POST['country'],$_POST['state'],$_POST['city'],$_POST['google_business_link'],$_POST['gstin'],$_POST['pan'],$_POST['business_licence'],$_FILES['gstin_file'],$_FILES['pan_file'],$_POST['business_licence_file']);
		}
		if($_GET['query']=='add_bike')
		{
			$signup=$agent->add_bike($_POST['aid'],$_POST['brand'],$_POST['model'],$_POST['year_manufecturing'],$_POST['color'],$_POST['fuel'],$_POST['insurence'],$_FILES['meter'],$_FILES['puc'],$_FILES['top'],$_FILES['rear'],$_FILES['front'],$_FILES['back'],$_FILES['rc']);
			echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=add_bike_agent&status=1';</script>";
		}
		if($_GET['query']=='bike_rate')
		{
			$rate=$agent->bike_rate($_POST['id'],$_POST['per_day_km'],$_POST['price_per_km'],$_POST['security_deposit'],$_POST['available']);
			if($rate)
			{echo "<div class='alert alert-success'>Bike Data Update Successfully !!!</div>";}
			else
			{echo "<div class='alert alert-danger'>Something Went Wrong !!!</div>";}
		}
	}
	break;

//-- admin 
case "admin":
	if($_GET['action']=='admin')
 		{

			//--------- states and city
			if($_GET['query']=='get_details')
			{
				if($_GET['type']=='state')
				{
					$state=$admin->get_states($_GET['id']);
					foreach($state as $r=>$v)
					{
						echo "<option value='".$state[$r]['id']."'>".$state[$r]['name']."</option>";
					}
				}

				if($_GET['type']=='city')
				{
					$city=$admin->get_cities($_GET['id']);
					foreach($city as $r=>$v)
					{
						echo "<option value='".$city[$r]['id']."'>".$city[$r]['name']."</option>";
					}
				}

				
			}

			//--- get bikes
			if($_GET['query']=='get_bike')
			{
				if($_GET['type']=='brand')
				{
					echo "<option disabled='disabled' selected='selected'>--Select--</option>";
					$brand=$admin->get_bikes($_GET['id']);
					foreach($brand as $r=>$v)
					{
						echo "<option value='".$brand[$r]['id']."'>".$brand[$r]['name']."</option>";
					}
				}

				

				
			}
			
		}	
break;


				
}		