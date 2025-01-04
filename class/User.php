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
                    $returnObj->rate_per_km = $result[$r]['per_km_inr'];
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

function user_booking_add($bid,$uid,$aid,$from_date,$to_date,$amount)
{
//--- to do check is there any another booking on from or to date 
    $data=array();
   $insert="insert into user_booking(bid,uid,aid,from_date,to_date,amount,status)Values('$bid','$uid','$aid','$from_date','$to_date','$amount','1')";
    $insert=$this->db_handle->update($insert);
    if($insert)
    {
        $otp=rand(0,999999);
        $returnObj = new stdClass();
        $returnObj->msg = "Booking Confirmed";
        array_push($data, $returnObj);
        
        $result1 = $this->successResponse($data);
        echo json_encode($result1);
    }
    else
    {
        $returnObj = new stdClass();
        $returnObj->msg = "Something Went Wrong !!!";
        array_push($data, $returnObj);

        $result1 = $this->errorResponse($data);
        echo json_encode($result1);

    }
}
           

function booking_cancel($booking_id)
{
    $data=array();
    //-- 1 is active, 2 is canclled, 3 is completed
    $update="update user_booking SET status='2' where id='$booking_id'";
    $update=$this->db_handle->update($update);
    if($update)
    {
        $returnObj = new stdClass();
        $returnObj->msg = "Booking Cancelled";
        array_push($data, $returnObj);
        
        $result1 = $this->successResponse($data);
        echo json_encode($result1);
    }
    else
    {
        $returnObj = new stdClass();
        $returnObj->msg = "Something Went Wrong !!!";
        array_push($data, $returnObj);

        $result1 = $this->errorResponse($data);
        echo json_encode($result1);

    }
}

function update_booking_date($booking_id,$from_date,$to_date)
{
    $data=array();
    //-- to do - check if booking availble on same date 
    $select = "select * from user_booking where id='$booking_id'";
    $select = $this->db_handle->runBaseQuery($select);
    if($select[0]['status'] == '1')
    {
    
        $update="update user_booking SET from_date='$from_date', to_date='$to_date' where id='$booking_id' AND status = '1'";
        $update=$this->db_handle->update($update);

        $returnObj = new stdClass();
        $returnObj->msg = "Booking Date Updated";
        array_push($data, $returnObj);
        
        $result1 = $this->successResponse($data);
        echo json_encode($result1);
    }
    else
    {
        $returnObj = new stdClass();
        $returnObj->msg = "You can not change booking date for now, Contact our team for further help !!!";
        array_push($data, $returnObj);

        $result1 = $this->errorResponse($data);
        echo json_encode($result1);

    }
}

           

           function mybooking($uid){
            $data=array();
            $query = "SELECT * FROM user_booking where uid='$uid' ORDER by id DESC";
            $result = $this->db_handle->runBaseQuery($query);
            if($result)
                {
                    
                    
                    foreach($result as $r=>$v)
                    {
                        //-- get bike info
                    $bike=$this->get_bike($result[$r]['bid']);
                    $returnObj = new stdClass();
                       //-- agent details
                    $agent=$this->get_agent($result[$r]['aid']);   
                    //-- get bike
                    $bike=$this->get_bike($result[$r]['bid']);
                    //--status
                    if($result[$r]['status']=='1'){$status='On Going';}
                    if($result[$r]['status']=='2'){$status='Cancelled';}
                    if($result[$r]['status']=='3'){$status='Completed';}
                    

                    $returnObj->from_date = $result[$r]['from_date'];
                    $returnObj->to_date = $result[$r]['to_date'];
                    $returnObj->bike = $bike[0]['name'];
                    $returnObj->store = $agent[0]['aname'];
                    $returnObj->amount = $result[$r]['amount'];
                    $returnObj->status = $status;
                    $returnObj->booking_date_time = $result[$r]['booking_date_time'];
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

           function addreview(){}

           function viewreview_one(){}

           function viewreview_all(){}

           function feedback_send(){}

           //--- functions from other class
           function get_agent($id)
           {
            $query = "select * from agent where id='$id'";
            $result = $this->db_handle->runBaseQuery($query);
            return $result;
           }
           function get_bike($bid)
           {
            $query = "select * from bikes where id='$bid' ";
            $result = $this->db_handle->runBaseQuery($query);
            return $result;
           }
}