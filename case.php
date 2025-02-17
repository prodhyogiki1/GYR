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
		
		if($_GET['query']=='add_agent')
		{
			//print_r($_POST);
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
		if($_GET['query']=='verify_agent')
		{
			//print_r($_POST);
			$signup=$agent->verify_agent($_POST['fname'],$_POST['lname'],$_POST['phone'],$_POST['email'],$_POST['designation'],$_POST['phone2'],$_POST['bname'],$_POST['baddress'],$_POST['landmark'],$_POST['country'],$_POST['state'],$_POST['city'],$_POST['google_business_link'],$_POST['gstin'],$_POST['pan'],$_POST['business_licence'],$_POST['id']);

			// -- update the status and send email to agent
			$status = $admin->update_user_status($_POST['uid'],$_POST['status']);
			//-- send email
			if($_POST['status']=='1')
			{
				//--get upassword from table user
				$user_details = $admin->getone_user($_POST['uid']);
				$msg="Dear ".$_POST['fname'].",<br>Your application as an agent has been approved by our support team. Please login through these credentials and complete your profile;<br><b>User Name:</b>".$user_details[0]['uname']."<br><b>Password :</b>".$user_details[0]['upass']."<br><b>Regards,</b><br>Team Get Your Ride"; $subject="Application Approved for Agent";}

			else{$msg="Dear ".$_POST['fname'].",<br>We regret to inform you that your profile has been dis approved by our support team. For information please call or drop us an email at support@getyouride.in.<br><b>Regards,</b><br>Team Get Your Ride"; $subject="Application Declined for Agent";}
			
			$admin->send_email($_POST['fname'],$_POST['lname'],$_POST['email'],$msg,$subject);

			echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=verify_agent&id=".$_POST['id']."&status=3';</script>";
		}

		if($_GET['query']=='verify_agent_profile')
		{
			//--gstin upload
			if(isset($_FILES['pan_file']))
			{$pan_file=$admin->upload_files($_FILES['pan_file']);}
			else{$pan_file=$_POST['pan_file_default'];}

			if(isset($_FILES['gstin_file']))
			{$gstin_file=$admin->upload_files($_FILES['gstin_file']);}
			else{$gstin_file=$_POST['gstin_file_default'];}

			if(isset($_FILES['business_licence_file']))
			{$business_licence_file=$admin->upload_files($_FILES['business_licence_file']);}
			else{$business_licence_file=$_POST['business_licence_default'];}


			$signup=$agent->verify_agent_profile($_POST['fname'],$_POST['lname'],$_POST['phone'],$_POST['email'],$_POST['designation'],$_POST['phone2'],$_POST['bname'],$_POST['baddress'],$_POST['landmark'],$_POST['country'],$_POST['state'],$_POST['city'],$_POST['google_business_link'],$_POST['gstin'],$_POST['pan'],$_POST['business_licence'],$pan_file,$gstin_file,$business_licence_file,$_POST['id']);

				
			echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=agent_profile&id=".$_POST['id']."&status=3';</script>";
		}

		if($_GET['query']=='rates_update')
		{
			$rate=$agent->rate_update($_POST['available'],$_POST['from_date'],$_POST['to_date'],$_POST['price_per_km'],$_POST['per_day_km'],$_POST['id']);
			if($rate)
			{echo "<div class='text-success'>Updated !!!</div>";}
			else
			{echo "<div class='text-danger'>Something Went Wrong !!!</div>";}
		}

		if($_GET['query']=='booking_accept')
		{
			$rate=$agent->booking_accept($_POST['mode_of_payment'],$_POST['amount'],$_POST['status'],$_POST['bookingid'],$_POST['km_covered_start']);
			if($rate)
			{echo "<div class='text-success'>Booking Confirmed !!!</div>";}
			else
			{echo "<div class='text-danger'>Something Went Wrong !!!</div>";}
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