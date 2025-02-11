<?php
require_once("DBController.php");
require_once("Admin.php");
class Agent
{
    private $db_handle;

    function successResponse($res)
    {
        $succResp = new stdClass();
        $succResp->success = true;
        $succResp->error = false;
        $succResp->response = $res;
        return $succResp;
    }

    function errorResponse($res)
    {
        $errorResp = new stdClass();
        $errorResp->success = false;
        $errorResp->error = true;
        $errorResp->response = $res;
        return $errorResp;
    }

    function __construct()
    {
        $this->db_handle = new DBController();
        $this->admin = new Admin();
        
    }


function signup($fname,$lname,$phone,$email,$pan,$gstin)
{
    //--check with same gstin
    $query="select * from agent where gstin='$gstin' OR phone='$phone' OR email='$email' OR pan='$pan'";
    $result=$this->db_handle->runBaseQuery($query);
    
    if(!$query)
    {echo "<div class='alert alert-danger'>Detail(s) already exist</div>";}
    else
    {
        //-- register and disbale to tbluser
        $uname=$fname.'_'.$lname;
        $person_name=$fname.' '.$lname;
        $password = rand(1,999999);
        $create_user = $this->admin->create_user($uname,$password,'2',$email,$phone,$person_name);

        //-- get max uid from tbluser
        $query="select MAX(id) as id from tbluser";
        $result=$this->db_handle->runBaseQuery($query);
        $uid=$result[0]['id'];

        //-- create agent details in agent table
        $query = "insert into agent(fname,lname,phone,email,pan,gstin,uid)VALUES(?,?,?,?,?,?,?)";
        $paramType = "ssssssi";
        $paramValue = array($fname,$lname,$phone,$email,$pan,$gstin,$uid);
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        
        //-- send email to agent 
        $msg="Thankyou<br> $fname $lname,<br>Please find your login crendentials below.<br><b>User Name:</b>$uname<br><b>Password:</b>$password<br><span style='color:red;'>Complete your profile and add all your documents. <br> After a final approval by our team, you will be able to use all our services.</span><b><br>Regards</br>,<br>Team Get Your Ride";
        
        $subject="Registered Successfully !!!";
        $reg_email = $this->admin->send_email($fname,$lname,$email,$msg,$subject);
        if($reg_email){echo "<div class='alert alert-danger'>Email Has Not Sent, Please Try Again Or Call To Our Support Team !!!</div>";}
        else{echo "<div class='alert alert-danger'>Thank you showing interest in us. You profile has been sent for verification. !!!</div>"; echo "<a href='login.php' class='btn btn-success'>Back To Login</a>";}

        

        //--- send notification to admin about new user
        $reg_email = $this->admin->save_alerts($uid,"New Agent Rquest Received",'1');

        exit();
    }
}

function verify_agent($fname,$lname,$phone,$email,$designation,$phone2,$bname,$baddress,$landmark,$country,$state,$city,$google_business_link,$gstin,$pan,$business_licence,$id)
{
    $query = "update agent set fname='$fname',lname='$lname',phone='$phone',email='$email',designation='$designation',phone2='$phone2',bname='$bname',baddress='$baddress',landmark='$landmark',country='$country',state='$state',city='$city',google_business_link='$google_business_link',gstin='$gstin',pan='$pan',business_licence='$business_licence' where id='$id' ";
    $result=$this->db_handle->update($query);
    return $result;
}

function verify_agent_profile($fname,$lname,$phone,$email,$designation,$phone2,$bname,$baddress,$landmark,$country,$state,$city,$google_business_link,$gstin,$pan,$business_licence,$pan_file,$gstin_file,$business_licence_file,$id)
{
    //-- change status from 2 to 3 if it is 2
    if($_SESSION['status']=='2' && $gstin != '' && $pan != '' && $business_licence != '')
    {$status='3';
        $query0 = "update tbluser set status='$status' where id='$_SESSION[id]' ";
        $result=$this->db_handle->update($query);
    }
    

    $query = "update agent set fname='$fname',lname='$lname',phone='$phone',email='$email',designation='$designation',phone2='$phone2',bname='$bname',baddress='$baddress',landmark='$landmark',country='$country',state='$state',city='$city',google_business_link='$google_business_link',gstin='$gstin',pan='$pan',business_licence='$business_licence',pan_file='$pan_file',gstin_file='$gstin_file',business_licence_file='$business_licence_file', where id='$id' ";
    $result=$this->db_handle->update($query);
    return $result;
}

function add_agent($fname,$lname,$phone,$email,$designation,$phone2,$bname,$landmark,$country,$state,$city,$google_business_link,$gstin,$pan,$business_licence,$_gstin_file,$_pan_file,$business_licence_file)
{
    $query="select * from agent where gstin='$gstin'";
    $result=$this->db_handle->runBaseQuery($query);
    
    if($result)
    {echo "<div class='alert alert-danger'>GST already exist</div>";}
    else
    {
        $gstinfile = $admin->upload_files($_FILES['gstin_file']);
        $panfile = $admin->upload_files($_FILES['pan_file']);     
        $businesslicencefile = $admin->upload_files($_FILES['business_licence_file']);

        $query = "insert into agent(fname,lname,phone,email,designation,phone2,bname,landmark,country,state,city,google_business_link,gstin,pan,business_licence,_gstin_file,_pan_file,business_licence_file)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $paramType = "ssssssssssssssssss";
        $paramValue = array($fname,$lname,$phone,$email,$designation,$phone2,$bname,$landmark,$country,$state,$city,$google_business_link,$gstin,$pan,$business_licence,$gstinfile,$panfile,$businesslicencefile);
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        
        echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=add_agent&success=1';</script>";
    } 
}

function edit_agent(){}
function viewall()
{
    $query="select * from agent ORDER BY id DESC";
    $result=$this->db_handle->runBaseQuery($query);
    return $result;
}
function view_agent_one($id)
{
    $query="select * from agent where id='$id'";
    $result=$this->db_handle->runBaseQuery($query);
    return $result;
}

function view_agent_one_byuid($uid)
{
    $query="select * from agent where uid='$uid'";
    $result=$this->db_handle->runBaseQuery($query);
    return $result;
}

function get_bike_one($id)
{
    $query="select * from agent_bikes where id='$id'";
    $result=$this->db_handle->runBaseQuery($query);
    return $result;
}

function bike_rate($id,$per_day_km,$price_per_km,$security_deposit,$available)
{
    $query="update agent_bikes SET per_day_km='$per_day_km',price_per_km='$price_per_km',security_deposit='$security_deposit',available='$available' where id='$id'";
    $result=$this->db_handle->update($query);
    return $result;
}

//-- bikes
function add_bike($aid,$brand,$model,$year_manufecturing,$color,$fuel,$insurence,$meter,$puc,$top,$rear,$front,$back,$rc)
{
    $meter = $this->admin->upload_files($meter);
    $puc = $this->admin->upload_files($puc);     
    $top = $this->admin->upload_files($top);
    $rear = $this->admin->upload_files($rear);
    $front = $this->admin->upload_files($front);
    $back = $this->admin->upload_files($back);
    $rc = $this->admin->upload_files($rc);

    $query = "insert into agent_bikes(aid,brand,bid,year_manufecturing,color,fuel,insurence,meter,puc,top,rear,front,back,rc)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $paramType = "ssssssssssssss";
    $paramValue = array($aid,$brand,$model,$year_manufecturing,$color,$fuel,$insurence,$meter,$puc,$top,$rear,$front,$back,$rc);

    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
}


function viewall_agent_bike($aid)
{
    $query="select * from agent_bikes where aid='$aid'";
    $result=$this->db_handle->runBaseQuery($query);
    return $result;
}

function viewall_agent_bike_limit($aid)
{
    $query="select * from agent_bikes where aid='$aid' ORDER by id DESC LIMIT 5";
    $result=$this->db_handle->runBaseQuery($query);
    return $result;
}


//--- booking
function new_booking($aid){
    $query="select * from user_booking where aid='$aid'";
    $result=$this->db_handle->runBaseQuery($query);
    return $result; 
}

function table_columns($table)
{
    $select="SHOW COLUMNS FROM $table";
    $result=$this->db_handle->runBaseQuery($select);
    return $result;
}

function rate_update($available,$from_date,$to_date,$price_per_km,$per_day_km,$id)
{
   $query="update agent_bikes SET available='$available',from_date='$from_date',to_date='$to_date',price_per_km='$price_per_km',per_day_km='$per_day_km' where id='$id'";
   $result=$this->db_handle->update($query);
   return $result;
}

function disable_agent(){}
function mybooking($aid)
{
    $query="select * from user_booking where aid='$aid'";
    $result=$this->db_handle->runBaseQuery($query);
    return $result; 
}

function customer_details($id)
{
    $query="select * from user where id='$id'";
    $result=$this->db_handle->runBaseQuery($query);
    return $result; 
}

function view_booking_agent_one($id)
{
    $query="select * from user_booking where id='$id'";
    $result=$this->db_handle->runBaseQuery($query);
    return $result; 
}

function booking_accept($mode_of_payment,$amount,$status,$bookingid,$km_covered_start)
{
    $update="update user_booking SET status='$status',km_covered_start='$km_covered_start' where id='$bookingid'";
    $result=$this->db_handle->update($update);  
    

    //-- update transaction in user_tarnsaction
    $insert="insert into user_booking_transaction (bookingid,amount,payment_mode)Values('$bookingid','$amount','$mode_of_payment')";
    $insert=$this->db_handle->update($insert); 

    return $result;
}

             
function get_transaction($aid)
{
     $query = "SELECT * FROM user_booking INNER JOIN user_booking_transaction ON user_booking.id=user_booking_transaction.bookingid AND user_booking.aid='$aid' ";
    $result=$this->db_handle->runBaseQuery($query);  
    return $result;
}

function add_booking_agent(){}
function edit_booking_agent(){}
function view_booking_agent(){}

function view_agent_review(){}


}