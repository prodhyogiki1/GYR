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


			$signup=$agent->verify_agent_profile($_POST['fname'],$_POST['lname'],$_POST['phone'],$_POST['email'],$_POST['designation'],$_POST['phone2'],$_POST['bname'],$_POST['baddress'],$_POST['landmark'],$_POST['country'],$_POST['state'],$_POST['city'],$_POST['google_business_link'],$_POST['gstin'],$_POST['pan'],$_POST['business_licence'],$pan_file,$gstin_file,$business_licence_file,$_POST['secondary_name'],$_POST['secondary_phone'],$_POST['nu_bikes'],$_POST['id']);

				
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

		if($_GET['query']=='save_support_ticket')
		{
			$aid = $_SESSION['aid'];
			$subject = $_POST['subject'];
			$category = $_POST['category'];
			$message = $_POST['message'];
			$bid = isset($_POST['booking_id']) ? (int)$_POST['booking_id'] : 0;
			$support_type = 0; // agent support
			$insertId = $admin->save_support_ticket($aid,$subject,$category,$message,$bid,$support_type);
			if($insertId){
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=agent_support&status=1';</script>";
			} else {
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=agent_support&status=0';</script>";
			}
		}

		if($_GET['query']=='save_support_response')
		{
			$ticket_id = $_POST['ticket_id'];
			$comment = $_POST['response'];
			$admin_id = $_SESSION['uid'];
			$insertId = $admin->save_support_ticket_response($ticket_id, $comment, $admin_id);
			if($insertId){
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=admin_support&status=1';</script>";
			} else {
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=admin_support&status=0';</script>";
			}
		}

		if($_GET['query']=='save_agent_response')
		{
			$ticket_id = $_POST['ticket_id'];
			$comment = $_POST['response'];
			$agent_id = $_SESSION['aid'];
			$insertId = $admin->save_agent_response($ticket_id, $comment, $agent_id);
			if($insertId){
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=agent_my_tickets&status=1';</script>";
			} else {
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=agent_my_tickets&status=0';</script>";
			}
		}

		if($_GET['query']=='update_ticket_status')
		{
			$ticket_id = $_POST['ticket_id'];
			$status = $_POST['status'];
			$result = $admin->update_support_ticket_status($ticket_id, $status);
			if($result){
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=admin_support&status=1';</script>";
			} else {
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=admin_support&status=0';</script>";
			}
		}

		if($_GET['query']=='booking_accept')
		{
			$rate=$agent->booking_accept($_POST['mode_of_payment'],$_POST['amount'],$_POST['status'],$_POST['bookingid'],$_POST['km_covered_start']);
			

			//--get user details from booking id
			$booking_details = $agent->view_booking_agent_one($_POST['bookingid']);
			$user_details = $user->get_one_user($booking_details[0]['uid']);
			$agent_details = $agent->view_agent_one($booking_details[0]['aid']);
			$subject="GYR".$_POST['bookingid']." Booking Status Update";

			
				$status=$_POST['status'];
				if($status=='3'){$reason='Successfully Completed';   }
				if($status=='4'){$reason='Cancelled By Agent';}
				if($status=='5'){$reason='Cancelled By Customer';}
				
				//-- send email to user
				$user_msg="Dear".$user_details[0]['uname'].",<br>Your booking has been ".$reason.".<br><b>Regards,</b><br>Team Get Your Ride<br>For any help, Please drop us an email call us.<br>Team Get Your Ride"; $subject="Booking Status Update";
				$admin->send_email($user_details[0]['uname'],'',$user_details[0]['email'],$user_msg,$subject);

				//-- send email to agent 
				$agent_msg="Dear".$agent_details[0]['fname'].",<br>Your booking has been ".$reason.".<br><b>Regards,</b><br>Team Get Your Ride<br>For any help, Please drop us an email call us.<br>Team Get Your Ride"; $subject="Booking Status Update";
				$admin->send_email($agent_details[0]['fname'],$agent_details[0]['lname'],$user_dagent_detailsetails[0]['email'],$user_msg,$subject);

				//-- change status to 0 for available bikes
				$agent->change_bike_status($booking_details[0]['bid'],'0');


				if($rate)
			{echo "<div class='text-success'>Booking Updated !!!</div>";}
			else
			{echo "<div class='text-danger'>Something Went Wrong !!!</div>";}

		}

		if($_GET['query']=='change_password')
		{
			if($_POST['current_password'] == $_POST['new_password']) {
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=agent_profile&id=".$_POST['id']."&status=7';</script>";
			} elseif($_POST['new_password'] != $_POST['confirm_password']) {
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=agent_profile&id=".$_POST['id']."&status=8';</script>";
			} else {
			  $update_password = $agent->update_password($_SESSION['uid'], $_POST['current_password'], $_POST['new_password']);
			  if($update_password) {
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=agent_profile&id=".$_POST['id']."&status=3';</script>";
			  } else {
				echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=agent_profile&id=".$_POST['id']."&status=2';</script>";
			  }
			}
		}

		if($_GET['query']=='bank_details')
		{
			$bank_details=$agent->bank_details($_POST['acc_name'],$_POST['acc_nu'],$_POST['ifsc'],$_POST['bank_name'],$_SESSION['uid']);
			echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=agent_profile&id=".$_POST['id']."&status=3';</script>";
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

			//--- support ticket response
			if($_GET['query']=='save_support_response')
			{
				$ticket_id = $_POST['ticket_id'];
				$comment = $_POST['response'];
				$admin_id = $_SESSION['uid'];
				$insertId = $admin->save_support_ticket_response($ticket_id, $comment, $admin_id);
				if($insertId){
					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=admin_support&status=1';</script>";
				} else {
					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=admin_support&status=0';</script>";
				}
			}

			//--- update ticket status
			if($_GET['query']=='update_ticket_status')
			{
				$ticket_id = $_POST['ticket_id'];
				$status = $_POST['status'];
				$result = $admin->update_support_ticket_status($ticket_id, $status);
				if($result){
					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=admin_support&status=1';</script>";
				} else {
					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=admin_support&status=0';</script>";
				}
			}

			//--- add policy
			if($_GET['query']=='add_policy')
			{
				$policy_name = $_POST['policy_name'];
				$policy_type = $_POST['policy_type'];
				$calculation_on = $_POST['calculation_on'];
				$value = $_POST['value'];
				$result = $admin->add_policy($policy_name, $policy_type, $calculation_on, $value);
				if($result){
					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=policy&status=1';</script>";
				} else {
					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=policy&status=0';</script>";
				}
			}

			//--- update policy
			if($_GET['query']=='update_policy')
			{
				$policy_id = $_POST['policy_id'];
				$policy_name = $_POST['policy_name'];
				$policy_type = $_POST['policy_type'];
				$calculation_on = $_POST['calculation_on'];
				$value = $_POST['value'];
				$result = $admin->update_policy($policy_id, $policy_name, $policy_type, $calculation_on, $value);
				if($result){
					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=policy&status=1';</script>";
				} else {
					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=policy&status=0';</script>";
				}
			}

			//--- delete policy
			if($_GET['query']=='delete_policy')
			{
				$policy_id = $_POST['policy_id'];
				$result = $admin->delete_policy($policy_id);
				if($result){
					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=policy&status=1';</script>";
				} else {
					echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=policy&status=0';</script>";
				}
			}

			//--- get policy for editing
			if($_GET['query']=='get_policy')
			{
				$policy_id = $_GET['id'];
				$policy = $admin->get_policy_by_id($policy_id);
				if($policy) {
					$response = array('success' => true, 'policy' => $policy[0]);
				} else {
					$response = array('success' => false, 'message' => 'Policy not found');
				}
				header('Content-Type: application/json');
				echo json_encode($response);
				exit;
			}
			
		}	
break;


				
}		