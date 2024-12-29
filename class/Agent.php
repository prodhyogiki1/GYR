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



    function add_agent(){}
function edit_agent(){}
function view_agent_all(){}
function view_agent_one(){}
function delete_agent(){}
function disable_agent(){}
function booking_agent(){}
function add_booking_agent(){}
function edit_booking_agent(){}
function view_booking_agent(){}
function view_booking_agent_one(){}
function view_agent_review(){}


}