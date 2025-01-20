<?php
require_once("DBController.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../library/vendor/autoload.php';

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

function get_bikes_brand()
{
    $query = "select DISTINCT(brand) from bikes";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function get_bikes($brand)
{
    $query = "select * from bikes where brand='$brand'";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function get_bike_one($id)
{
    $query = "select * from bikes where id='$id'";
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


//------------ file upload
function upload_files($pic)
	{
       $a=$pic;
		$filename = $a['name'];
		$tempname = $a["tmp_name"];
		

        //-- rename file
        $temp = explode(".", $filename);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $folder = "./theme/assets/images/". $newfilename;
    
		if (move_uploaded_file($tempname, $folder)) {
			return $newfilename;
		} else {
			return 0;
		}
	}



//--- send email by php mailer
function send_email()
{
    $mail = new PHPMailer(true);
 
try {
    $mail->SMTPDebug = 2;                                       
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.hostinger.com;';                    
    $mail->SMTPAuth   = true;                             
    $mail->Username   = 'info@getyourride.in';                 
    $mail->Password   = 'Info@#021';                        
    $mail->SMTPSecure = 'tls';                              
    $mail->Port       = 587;  
 
    $mail->setFrom('info@getyourride.in', 'Name');           
    $mail->addAddress('sid.vyas786@gmail.com');
    $mail->addAddress('sid.vyas786@gmail.com', 'Name');
      
    $mail->isHTML(true);                                  
    $mail->Subject = 'Subject';
    $mail->Body    = 'HTML message body in <b>bold</b> ';
    $mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();
    echo "Mail has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}    
}
