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


function signup($aname,$phone,$email,$pan,$gstin)
{
    //--check with same gstin
    $query="select * from agent where gstin='$gstin'";
    $result=$this->db_handle->runBaseQuery($query);
    
    if($query)
    {echo "<div class='alert alert-danger'>GST already exist</div>";}
    else
    {
        $query = "insert into agent(aname,phone,email,pan,gstin)VALUES(?,?,?,?,?)";
        $paramType = "sssss";
        $paramValue = array($aname,$phone,$email,$pan,$gstin);
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        
        echo "<script>window.location.href='".$base_url."index.php?action=dashboard&page=signup&success=1';</script>";
    }     
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