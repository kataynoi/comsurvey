<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_line extends CI_Controller
{
// define('LINE_API',"https://notify-api.line.me/api/notify");
    public $user_id;
    public  $token = "SqTlGz2Hl6kNa45hsespDXvgw899jVnT2155p3qL7wl";
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata("user_type")!=1)
            redirect(site_url('user/login'));
        $this->layout->setLeft('layout/left_admin');
        $this->layout->setLayout('admin_layout');
        $this->load->model('Admin_line_model', 'create_crud');
    }

    public function index()
    {

        $data[] = '';
        $str = 'ทดสอบ Line Notyfy By<br> Test จำนวนเครื่อง  computer';
        $res = $this->notify_message($str,$this->token);
        $this->layout->view('admin_line/index', $data);
    }

    public  function notify_message($message,$token){
        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData,'','&');
        $headerOptions = array(
            'http'=>array(
                'method'=>'POST',
                'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                    ."Authorization: Bearer ".$token."\r\n"
                    ."Content-Length: ".strlen($queryData)."\r\n",
                'content' => $queryData
            ),
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents(LINE_API,FALSE,$context);
        $res = json_decode($result);
        return $res;
    }
}