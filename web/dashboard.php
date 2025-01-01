
<?php 
if($_SESSION['utype']=='1')
{ include('admin_dashboard.php') ; }
if($_SESSION['utype']=='2')
{ include('agent_dashboard.php') ; }

?>



