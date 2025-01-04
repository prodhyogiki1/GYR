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

            function userlogin($mobile)
            {
                echo $query = "select * from users where phone='$mobile'";
                $result = $this->db_handle->runBaseQuery($query);
                if(mysqli_num_rows($result)>0)
                {
                    echo $otp=rand(0,999999);
                }
            }

           function regiter(){}

           function profile(){}

           

           function mybooking(){}

           function addreview(){}

           function viewreview_one(){}

           function viewreview_all(){}

           function feedback_send(){}

           function get_all_booking()
           {
            $query = "select * from user_booking";
            $result = $this->db_handle->runBaseQuery($query);
            return $result;
           }
}