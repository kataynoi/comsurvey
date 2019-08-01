<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("login"))
            redirect(site_url('user/login'));
        $this->layout->setLayout('default_layout');
        $this->db = $this->load->database('default', true);
    }

    public function index()
    {

        $data['all_pc'] = $this->db->from('com_survey')->where('computertype',2)->count_all_results();
        $data['all_nb'] = $this->db->from('com_survey')->where('computertype',3)->count_all_results();
        //$data['count_usecar'] = $this->db->from('used_car')->count_all_results();
        //$data['count_approve_car'] = $this->db->from('used_car')->where('approve','1')->count_all_results();
        $data['all_employee'] = $this->db->from('employee')->where('active',1)->count_all_results();
        $data['all_printer'] = '27';
        //$data['outsite_today'] = $this->db->select('id,permit_user,objective,invit_place,permit_start_date,permit_end_date')
         //   ->where("DATE_FORMAT(NOW(),'%Y-%m-%d') = permit_start_date")
         //   ->get('outsite_permit')->result();
        //$data['user'] = $this->db->get('mas_users')->result();
        $this->layout->view('dashboard/index_view', $data);


    }
}
