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
        $html="<div style='padding:5px; margin:10px; text-align:center; border:1px solid #000; border-radius:2px;color:#000;'><img src='https://erp.luckyinstitute.org/img/document_android.jpg'><h6>Dear Student, Document verification and correction is in proceess from college administration. In case of any correction or help please whatsapp or call at 73402-50941.<br>Order By Principal.</h5></div>";
        $config = array("msg"=>'success',"active"=>"1","version"=>"1.5","college"=>"Lucky Institute Of Professional Studies","color_code"=>"#483f98","logo"=>"https://erp.luckyinstitute.org/img/logo-android-s.png","new_alert_popup_msg"=>"$html","table_row_odd"=>"#5F9EA0","table_row_even"=>"#A7C7E7","table_header"=>"#6F8FAF");
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
}