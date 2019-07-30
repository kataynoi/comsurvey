<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sscom_survey extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();
      /*
        if (!$this->session->userdata("admin"))
                    redirect(site_url('user/login'));
        */
        $this->load->model('Sscom_survey_model', 'crud');
    }

    public function index()
    {
        $data[] = '';
        $data["cbrand"] = $this->crud->get_cbrand();$data["ccpu"] = $this->crud->get_ccpu();
        $this->layout->view('sscom_survey/index', $data);
    }


    function fetch_sscom_survey()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {
            $cbrand_name = $this->crud->get_cbrand_name($row->cbrand);

            $sub_array = array();
                $sub_array[] = $cbrand_name;$sub_array[] = $row->cband_series;$sub_array[] = $row->harddisk;$sub_array[] = $row->operating_system;$sub_array[] = $row->office;$sub_array[] = $row->owner;
                $sub_array[] = '<div class="btn-group" role="group" ><button class="btn btn-warning" data-btn="btn_edit" data-id="' . $row->id . '">Edit</button><button class="btn btn-danger" data-btn="btn_del" data-id="' . $row->id . '">Delete</button></div>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->crud->get_all_data(),
            "recordsFiltered" => $this->crud->get_filtered_data(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function del_sscom_survey(){
        $id = $this->input->post('id');

        $rs=$this->crud->del_sscom_survey($id);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_sscom_survey()
    {
            $data = $this->input->post('items');
            if($data['action']=='insert'){
                $rs=$this->crud->save_sscom_survey($data);
            }else if($data['action']=='update'){
                $rs=$this->crud->update_sscom_survey($data);
            }
            if($rs){
                $json = '{"success": true}';
            }else{
                $json = '{"success": false}';
            }

            render_json($json);
        }

    public function  get_sscom_survey()
    {
                $id = $this->input->post('id');
                $rs = $this->crud->get_sscom_survey($id);
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": ' . $rows . '}';
                render_json($json);
    }
}