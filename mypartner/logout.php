<?php
//session_save_path('/opt/alt/php74/var/lib/php/session');
  //  ini_set('session.gc_probability', 1);
session_start();

// 2. Unset all the session variables
unset($_SESSION['uid']);	
unset($_SESSION['uname']); 		
unset($_SESSION['ucompany']);

// Unset user login session variables
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
unset($_SESSION['user_email']);
unset($_SESSION['user_phone']);
unset($_SESSION['user_address']);
unset($_SESSION['user_logged_in']);

?>
<script type="text/javascript">
    //alert("Successfully logout!") ;
    window.location = "index.php?logout=0";
</script>
