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
	}
	break;

//-- admin 
case "admin":
	if($_GET['action']=='admin')
 		{
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

			
		}	
break;


				
}		