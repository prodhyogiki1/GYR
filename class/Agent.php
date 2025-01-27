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
        $msg="Thankyou $fname $lname,<br>Your profile has been sent for verification. Our support team will check your details.<br>After a successfull verfication you will be able to login to your account by the password sent to you.<br>Regards,<br>Team Get Your Ride";
        
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
  echo  $query="select * from agent ORDER BY id DESC";
    $result=$this->db_handle->runBaseQuery($query);
    return $result;
}
function view_agent_one($id)
{
    $query="select * from agent where id='$id'";
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
{$query="select * from agent_bikes where aid='$aid'";
    $result=$this->db_handle->runBaseQuery($query);
    return $result;}


function disable_agent(){}
function booking_agent(){}
function add_booking_agent(){}
function edit_booking_agent(){}
function view_booking_agent(){}
function view_booking_agent_one(){}
function view_agent_review(){}


}