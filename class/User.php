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
            $data=array();
            $query = "select * from user where phone='$mobile' AND otp='$otp' ";
            $result = $this->db_handle->runBaseQuery($query);
            if($result)
                {
                    
                    $returnObj = new stdClass();
                    $returnObj->name = $result[0]['name'];
                    $returnObj->email = $result[0]['email'];
                    $returnObj->phone = $result[0]['phone'];
                    $returnObj->address = $result[0]['address'];
                    
                    array_push($data, $returnObj);
                    
                    
                    $result1 = $this->successResponse($data);
                    echo json_encode($result1);
                }
                else
                {
                    $returnObj = new stdClass();
                    $returnObj->msg = "Otp not Found";
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

           function served_location()
           {
            $data=array();
            $query = "select DISTINCT(city) from agent ORDER by city ASC";
            $result = $this->db_handle->runBaseQuery($query);
            if($result)
                {
                    
                    
                    foreach($result as $r=>$v)
                    {
                        $returnObj = new stdClass();
                     $returnObj->city = $result[$r]['city'];
                    array_push($data, $returnObj);
                    }
                    
                    $result1 = $this->successResponse($data);
                    echo json_encode($result1);
                }
                else
                {
                    $returnObj = new stdClass();
                    $returnObj->msg = "No City Found";
                    array_push($data, $returnObj);

                    $result1 = $this->errorResponse($data);
                    echo json_encode($result1);

                }
           }

           function search($city)
           {
            $data=array();
            $query = "SELECT * FROM agent  INNER JOIN agent_bikes ON agent.id=agent_bikes.aid AND  agent.city='$city'";
            $result = $this->db_handle->runBaseQuery($query);
            if($result)
                {
                    
                    
                    foreach($result as $r=>$v)
                    {
                        //-- get bike info
                        $bike=$this->get_bike($result[$r]['bid']);
                    $returnObj = new stdClass();
                    $returnObj->city = $result[$r]['city'];
                    $returnObj->agent = $result[$r]['aid'];
                    $returnObj->bid = $result[$r]['bid'];
                    $returnObj->bimage = $result[$r]['bimage_actual'];
                    //-- bike details
                    $returnObj->bike_name = $bike[0]['name'];
                    $returnObj->bike_brand = $bike[0]['brand'];
                    $returnObj->bike_power = $bike[0]['max power'];

                    $returnObj->kms_run = $result[$r]['bkm'];
                    $returnObj->availble = $result[$r]['bavailable'];
                    array_push($data, $returnObj);
                    }
                    
                    $result1 = $this->successResponse($data);
                    echo json_encode($result1);
                }
                else
                {
                    $returnObj = new stdClass();
                    $returnObj->msg = "No City Found";
                    array_push($data, $returnObj);

                    $result1 = $this->errorResponse($data);
                    echo json_encode($result1);

                }
           }


           function profile(){}

           function get_bike($bid)
           {
            $query = "select * from bikes where id='$bid' ";
            $result = $this->db_handle->runBaseQuery($query);
            return $result;
           }

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