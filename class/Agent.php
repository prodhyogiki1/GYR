<?php
require_once("DBController.php");

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


function add_agent(){}
function edit_agent(){}
function view_agent_all(){}
function view_agent_one($id)
{
    $query="select * from agent where uid='$id'";
    $result=$this->db_handle->runBaseQuery($query);
    return $result;
}
function delete_agent(){}
function disable_agent(){}
function booking_agent(){}
function add_booking_agent(){}
function edit_booking_agent(){}
function view_booking_agent(){}
function view_booking_agent_one(){}
function view_agent_review(){}


}