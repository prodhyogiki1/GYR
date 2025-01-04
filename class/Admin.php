<?php
require_once("DBController.php");

class Admin
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

    function app_config()
    {
        $html="<div style='padding:5px; margin:10px; text-align:center; border:1px solid #000; border-radius:2px;color:#000;'><img src='../theme/assets/images/logo.png' width='100px'><h6>Welcome to Get Your Ride</h5></div>";
        $config = array("msg"=>'success',"active"=>"1","version"=>"1","color_code"=>"#483f98","logo"=>"https://getyourride.in/theme/assets/images/logo.png","new_alert_popup_msg"=>"$html","table_row_odd"=>"#5F9EA0","table_row_even"=>"#A7C7E7","table_header"=>"#6F8FAF");
        $result1 = $this->successResponse($config);
        echo json_encode($result1);
    }

                //========== company
        function get_company()
        {
            $query = "select * from company_details where id='1'";
            $result = $this->db_handle->runBaseQuery($query);
            return $result;
        }


function get_country()
{
    $query = "select * from countries Order by name ASC";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}
function get_states($country_id)
{
  echo  $query = "select * from states where country_id='$country_id' Order by name ASC";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}
function get_cities($state_id)
{
    $query = "select * from cities where state_id='$state_id' Order by name ASC";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}


//---------- bikes
function get_all_bikes()
{
    $query = "select * from bikes";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}


//---------- support
function get_all_support_tickets()
{
    $query = "select * from support_tickets";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function get_all_feedback()
{
    $query = "select * from feedback";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}
}