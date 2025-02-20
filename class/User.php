<?php
require_once("DBController.php");
require_once("Admin.php");
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
        $this->admin = new Admin();
    }

    function get_company()
    {
        $data = array();
        $query = "select * from company_details where id='1'";
        $result = $this->db_handle->runBaseQuery($query);
        if($result)
                {
                    
                    $returnObj = new stdClass();
                    $returnObj->cname = $result[0]['cname'];
                    $returnObj->email = $result[0]['email'];
                    $returnObj->phone = $result[0]['phone'];
                    $returnObj->reg_type = $result[0]['reg_type'];
                    $returnObj->regnu = $result[0]['regnu'];
                    $returnObj->website = $result[0]['website'];
                    $returnObj->pan = $result[0]['pan'];
                    $returnObj->acnu = $result[0]['acnu'];
                    $returnObj->acbank = $result[0]['acbank'];
                    $returnObj->ifsc = $result[0]['ifsc'];
                    $returnObj->state = $result[0]['state'];
                    $returnObj->country = $result[0]['country'];
                    array_push($data, $returnObj);                    
                    
                    $result1 = $this->successResponse($data);
                    echo json_encode($result1);
                }
                else
                {
                    $returnObj = new stdClass();
                    $returnObj->msg = "No data Found";
                    array_push($data, $returnObj);

                    $result1 = $this->errorResponse($data);
                    echo json_encode($result1);

                }
    }

    function get_one_user($id)
    {
        $query = "select * from user where id='$id'";
        $result = $this->db_handle->runBaseQuery($query);
        return $result; 
    }
    function register($mobile)
    {$data=array();

        if(strlen($mobile) != 10)
        {
                     $returnObj = new stdClass();
                    $returnObj->msg = "Mobile number should be 10 digit long !!!";
                    array_push($data, $returnObj);
                    $result1 = $this->errorResponse($data);
                    echo json_encode($result1);
                    exit();
        }


                $query = "select * from user where phone='$mobile'";
                $result = $this->db_handle->runBaseQuery($query);
                if($result)
                {
                    $returnObj = new stdClass();
                    $returnObj->msg = "Mobile number is alaready resgistered !!!";
                    array_push($data, $returnObj);
                    $result1 = $this->errorResponse($data);
                    echo json_encode($result1);
                }
                else
                {
                    $query = "insert into user (phone) Values ('$mobile') ";
                    $result = $this->db_handle->update($query);
                    
                    $otp=rand(0,999999);
                    $this->update_otp($mobile,$otp);
                    
                    $returnObj = new stdClass();
                    $returnObj->otp = $otp;
                    $returnObj->msg = "Mobile number Successfully Resgistered !!!";
                    array_push($data, $returnObj);
                    $result1 = $this->successResponse($data);
                    echo json_encode($result1);
                }
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
                    $returnObj->name = $result[0]['uname'];
                    $returnObj->email = $result[0]['email'];
                    $returnObj->phone = $result[0]['phone'];
                    $returnObj->address = $result[0]['address'];
                    $returnObj->uid = $result[0]['id'];
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
                        //-- get city name 
                        $city = $this->admin->get_city($result[$r]['city']);

                        $returnObj = new stdClass();
                     $returnObj->city = $city[0]['name'];
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
            //-- get city id
             $city0 = "select * from cities where name='$city'";
            $cresult = $this->db_handle->runBaseQuery($city0);

            
            //$query = "SELECT * FROM agent  INNER JOIN agent_bikes ON agent.id=agent_bikes.aid AND  agent.city='".$cresult[0]['id']."'  AND agent_bikes.available='0' ";
            $query = "SELECT * FROM agent  INNER JOIN agent_bikes ON agent.city='".$cresult[0]['id']."'  AND agent_bikes.available='0' ";
            $result = $this->db_handle->runBaseQuery($query);

            if($result)
                {
                    
                    
                    foreach($result as $r=>$v)
                    {
                        //-- get bike info
                    $bike=$this->get_bike($result[$r]['bid']);
                    $returnObj = new stdClass();
                    $returnObj->city = $city;
                    $returnObj->agent = $result[$r]['aid'];
                    //-- to do change solution for agent.bikes.id
                    $returnObj->bid = $result[$r]['id'];
                    $returnObj->bimage = 'assets/images/'.$result[$r]['front'];
                    //-- bike details
                    $returnObj->bike_name = $bike[0]['name'];
                    $returnObj->bike_brand = $bike[0]['brand'];
                    $returnObj->bike_power = $bike[0]['max power'];
                    $returnObj->color = $result[$r]['color'];  
                    $returnObj->kms_run = '';
                    $returnObj->rate_per_km = $result[$r]['price_per_km'];
                    $returnObj->km_per_day = $result[$r]['per_day_km'];
                    $returnObj->availble = $result[$r]['available'];
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

function user_booking_add($bid,$uid,$aid,$from_date,$to_date,$amount,$payment_mode)
{
//--- to do check is there any another booking on from or to date 
    $data=array();
  
    
        $insert="insert into user_booking(bid,uid,aid,booking_from,booking_to,amount,status,payment_mode)Values('$bid','$uid','$aid','$from_date','$to_date','$amount','1','$payment_mode')";
        $insert=$this->db_handle->update($insert);
        if($insert)
        {
            $returnObj = new stdClass();
            $returnObj->msg = "Booking Confirmed";
            array_push($data, $returnObj);
            
            $result1 = $this->successResponse($data);
            echo json_encode($result1);

            //-- change status of bike in agent_bikes table
            $update="update agent_bikes SET available='1' where id='$bid'";
            $update=$this->db_handle->update($update);
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
           
function calculate_amt($bid,$to_date,$from_date)
{
    $data=array();
    
    $amt = "select * from agent_bikes where id='$bid'";
    $amt = $this->db_handle->runBaseQuery($amt);
     $amt_oneday = $amt[0]['price_per_km']*$amt[0]['per_day_km'];
     $days = strtotime($to_date) - strtotime($from_date);
     $days =round($days / (60 * 60 * 24));
     $final_amt = $days*$amt_oneday;
     
     
     $returnObj = new stdClass();
     $returnObj->amount = $final_amt;
     
     $result1 = $this->successResponse($returnObj);
     echo json_encode($result1); 
}
function booking_cancel($booking_id,$reason)
{
    $data=array();
    

    //-- 5 = cancelled by customer
    $update="update user_booking SET status='5', cancel_reason='$reason' where id='$booking_id'";
    $update=$this->db_handle->update($update);
    if($update)
    {
        $returnObj = new stdClass();
        $returnObj->msg = "Booking Cancelled";
        array_push($data, $returnObj);
        
        $result1 = $this->successResponse($data);
        echo json_encode($result1);

        //--- set bike available now for booking
        $update="update agent_bikes SET available='0' where id=(select bid from user_booking where id='$booking_id')";
        $update=$this->db_handle->update($update);
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
                        //-- get agent bike info
                    $agent_bike=$this->agent_get_bike($result[$r]['bid']);
                        //-- get bike details
                    $bike=$this->get_bike($agent_bike[0]['bid']);

                    $returnObj = new stdClass();
                       //-- agent details
                    $agent=$this->get_agent($result[$r]['aid']);   
                    
                    //--status
                    if($result[$r]['status']=='1'){$status='On Going';}
                    if($result[$r]['status']=='2'){$status='Cancelled';}
                    if($result[$r]['status']=='3'){$status='Completed';}
                    

                    $returnObj->from_date = $result[$r]['from_date'];
                    $returnObj->to_date = $result[$r]['to_date'];
                    $returnObj->store = $agent[0]['aname'];
                    $returnObj->amount = $result[$r]['amount'];
                    $returnObj->status = $status;
                    //=== bike details
                    $returnObj->bike = $bike[0]['name'];
                    $returnObj->bimage = 'theme/assets/images/'.$agent_bike[0]['front'];
                    $returnObj->price_per_km = $agent_bike[0]['price_per_km'];
                    
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

           function agent_get_bike($bid)
           {
            $query = "select * from agent_bikes where id='$bid' ";
            $result = $this->db_handle->runBaseQuery($query);
            return $result;
           }

           function slider()
           {
            $data=array();
             $query = "select * from website_config where ctype='slider'";
            $result = $this->db_handle->runBaseQuery($query);
            if($result)
                        {
                            
                            foreach($result as $r=>$v)
                            {
                                $returnObj = new stdClass();
                                $returnObj->image_url = 'theme/assets/images/'.$result[$r]['value1'];
                                $returnObj->content = $result[$r]['value2'];
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

           function user_details_save($uid,$name,$email,$licence,$adhar)
           {
            $data=array();
            $update="update user SET uname='$name', email='$email', licence='$licence', adhar='$adhar' where id='$uid'";
            $result = $this->db_handle->update($update);
            if($result) 
                        {
                                $returnObj = new stdClass();
                                $returnObj->msg = 'Saved Successfully';
                                $result1 = $this->successResponse($returnObj);
                                echo json_encode($result1);
                        }  
                        else
                        {
                            $returnObj = new stdClass();
                            $returnObj->msg = "Something went wrong";
                            $result1 = $this->errorResponse($returnObj);
                            echo json_encode($result1);
        
                        }      
           }

           function user_profile($mobile)
           {
                $profile="select * from user where phone='$mobile'";
                $result = $this->db_handle->runBaseQuery($profile);
                if($result)
                        {
                                $returnObj = new stdClass();
                                $returnObj->name = $result[0]['uname'];
                                $returnObj->mobile = $result[0]['phone'];
                                $returnObj->email = $result[0]['email'];
                                $returnObj->licence = $result[0]['licence'];
                                $returnObj->adhar = $result[0]['adhar'];

                                $result1 = $this->successResponse($returnObj);
                                echo json_encode($result1);
                        }  
                        else
                        {
                            $returnObj = new stdClass();
                            $returnObj->msg = "Something went wrong";
                            $result1 = $this->errorResponse($returnObj);
                            echo json_encode($result1);
        
                        }
           }

           function bike_details($bid)
           {
                $bike="select * from agent_bikes where id='$bid'";
                $result = $this->db_handle->runBaseQuery($bike);
                if($result)
                        {
                                $returnObj = new stdClass();
                                
                                $returnObj->year_manufecturing = $result[0]['year_manufecturing'];
                                $returnObj->color = $result[0]['color'];
                                $returnObj->fuel = $result[0]['fuel'];
                                $returnObj->insurence_till = date("d-m-Y", strtotime($result[0]['insurence']));
                                $result[0]['insurence'];
                                $returnObj->top = 'theme/assets/images/'.$result[0]['top'];
                                $returnObj->front = 'theme/assets/images/'.$result[0]['front'];
                                $returnObj->rear = 'theme/assets/images/'.$result[0]['rear'];
                                $returnObj->back = 'theme/assets/images/'.$result[0]['back'];
                                $returnObj->price_per_km = $result[0]['price_per_km'];
                                $returnObj->per_day_km_limit = $result[0]['per_day_km'];
                                //-- bike details from bikes table
                                $bike_details="select * from bikes where id='".$result[0]['bid']."' ";
                                $result1 = $this->db_handle->runBaseQuery($bike_details);
                                $returnObj->brand = $result1[0]['brand'];
                                $returnObj->brand = $result1[0]['brand'];
                                $returnObj->name = $result1[0]['name'];
                                $returnObj->transmission = $result1[0]['transmission'];
                                $returnObj->maxpower = $result1[0]['max power'];
                                $returnObj->mileage = $result1[0]['mileage - arai'];
                                $returnObj->braking = $result1[0]['braking system'];
                                $returnObj->wheeltype = $result1[0]['wheel type'];


                                $result1 = $this->successResponse($returnObj);
                                echo json_encode($result1);
                        }
                        else
                        {
                            $returnObj = new stdClass();
                            $returnObj->msg = "No Details Found";
                            $result1 = $this->errorResponse($returnObj);
                            echo json_encode($result1);
        
                        }
                    }   
                    
}