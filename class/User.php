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
                $data = array();
                $query = "select * from user where phone='$mobile'";
                $result = $this->db_handle->runBaseQuery($query);
                if($result)
                {
                    $otp=rand(0,999999);
                    $returnObj = new stdClass();
                    $returnObj->otp = $otp;
                    $returnObj->msg = "Otp has been sent to your mobile number";
                    array_push($data, $returnObj);
                    
                    $this->update_otp($mobile,$otp);
                    $result1 = $this->successResponse($data);
                    echo json_encode($result1);
                }
                else
                {
                    $returnObj = new stdClass();
                    $returnObj->msg = "No User Found";
                    array_push($data, $returnObj);

                    $result1 = $this->errorResponse($data);
                    echo json_encode($result1);

                }
            }

           function otp_varify($mobile,$otp)
           {
            $query = "select * from user where phone='$mobile' AND otp='$otp' ";
            $result = $this->db_handle->runBaseQuery($query);
            if($result)
                {
                    
                    $returnObj = new stdClass();
                    $returnObj->name = $result[0]['name'];
                    $returnObj->name = $result[0]['email'];
                    $returnObj->name = $result[0]['phone'];
                    $returnObj->name = $result[0]['address'];
                    
                    array_push($data, $returnObj);
                    
                    
                    $result1 = $this->successResponse($data);
                    echo json_encode($result1);
                }
                else
                {
                    $returnObj = new stdClass();
                    $returnObj->msg = "No User Found";
                    array_push($data, $returnObj);

                    $result1 = $this->errorResponse($data);
                    echo json_encode($result1);

                }
           }
           
           function update_otp($mobile,$otp)
           {
            $update="update user SET otp='$otp' where phone='$mobile'";
            $update=$this->db_handle->update($update);
            return $update;
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