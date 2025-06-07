
<?php 
echo $base_url;
if($_SESSION['utype']=='1')
{ include('admin_menu.php') ; }
if($_SESSION['utype']=='2')
{ include('agent_menu.php') ; }

?>



