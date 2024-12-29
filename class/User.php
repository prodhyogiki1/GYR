<?php
require_once("DBController.php");

class User
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

            function login()
            {}

           function regiter(){}

           function profile(){}

           function profile(){}

           function mybooking(){}

           function addreview(){}

           function viewreview_one(){}

           function viewreview_all(){}

           function feedback_send(){}
}