<?php
require_once("DBController.php");

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require './library/vendor/autoload.php';

class Admin
{
    private $db_handle;
    private $mail;
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
function send_email($fname,$lname,$email,$msg,$subject)
{
    //$mail = new PHPMailer(true);
 $comp=$this->get_company();

try {
    $to      = $email;
    $subject = $subject;
    $message = "<p>'".$msg."'</p><hr><img src='../theme/assets/images/".$comp[0]['logo']."'>";
    

    $headers = 'From: noreply@getyourride.in'       . "\r\n" .
                 'Reply-To: noreply@getyourride.in' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

// $headers  = "From: Get Your Ride"."\r\n";
// $headers .= "Reply-To: no-reply@getyourride.in". "\r\n";
$headers .= "CC: info@getyourride.in\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";


    mail($to, $subject, $message, $headers);
    
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
}
} 

//--- notification
function save_alerts($from,$msg,$to)
{
    $query = "insert into notification(from_uid,msg,to_uid)VALUES(?,?,?)";
    $paramType = "isi";
    $paramValue = array($from,$msg,$to);
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
}

function my_alerts($uid)
{
    $query = "select * from notification where to_uid='$uid' ORDER BY id DESC";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function latest_alerts($uid)
{
    $query = "select * from notification where to_uid='$uid' AND status='0' ORDER BY id DESC";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function read_alerts($uid)
{
    $query = "select * from notification where to_uid='$uid' AND status='1' ORDER BY id DESC";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}




//=========users


function create_user($uname,$upass,$utype,$email,$contact,$person_name)
{
    
    $query = "insert into tbluser(uname,upass,utype,uemail,ucontact,person_name)VALUES(?,?,?,?,?,?)";
    $paramType = "ssssss";
    $paramValue = array($uname,$upass,$utype,$email,$contact,$person_name);
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;    
}

function get_maxid()
{
    $query="select MAX(id) as id from tbluser";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function edit_user($uname,$upass,$utype,$email,$contact,$person_name,$id)
{
    
        
     $query = "Update tbluser SET uname='$uname',upass='$upass',utype='$utype',uemail='$email',ucontact='$contact',person_name='$person_name' where id='$id' ";
    $result = $this->db_handle->update($query);
    return $result;	
}

function delete_user($id)
{
    $query="delete from tbluser where id='$id' ";
    $result = $this->db_handle->runSingleQuery($query);
    return $result;	
}

function get_alluser()
{
    $query="select * from tbluser";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function get_alluser_ofc()
{
    $query="select * from tbluser where utype != '3' ";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}


function getone_user($id)
{
    $query="select * from tbluser where id = $id";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function getone_user_rand_bytype($type)
{
    $query="select * from tbluser where utype='$type' ORDER by rand() LIMIT 1";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;
}

function getonetype_user($utype)
{
    $query="select * from tbluser where utype = $utype Order by uname DESC";
    $result = $this->db_handle->runBaseQuery($query);
    return $result;	
}

function update_user_status($uid,$status)
{
    $query="update tbluser SET status = '$status' where id='$uid' ";
    $result = $this->db_handle->update($query);
    return $result;	
}







}


