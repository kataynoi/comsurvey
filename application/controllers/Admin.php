<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata("user_type")!=1)
                    redirect(site_url('user/login'));

        $this->layout->setLayout('admin_layout');
        $this->load->model('Admin_model', 'crud');
    }

    public function index()
    {
        $data[] = '';
        $data["cequipment"] = $this->crud->get_cequipment();$data["use_status"] = $this->crud->get_use_status();
        $this->layout->view('admin/index', $data);
    }


    function fetch_admin()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {


            $sub_array = array();
                $sub_array[] = $row->id;$sub_array[] = $row->equipment_id;$sub_array[] = $row->total;$sub_array[] = $row->status1;$sub_array[] = $row->status2;$sub_array[] = $row->status3;$sub_array[] = $row->status4;$sub_array[] = $row->status5;$sub_array[] = $row->status6;
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

    public function del_admin(){
        $id = $this->input->post('id');

        $rs=$this->crud->del_admin($id);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_admin()
    {
            $data = $this->input->post('items');
            if($data['action']=='insert'){
                $rs=$this->crud->save_admin($data);
            }else if($data['action']=='update'){
                $rs=$this->crud->update_admin($data);
            }
            if($rs){
                $json = '{"success": true}';
            }else{
                $json = '{"success": false}';
            }

            render_json($json);
        }

    public function  get_admin()
    {
                $id = $this->input->post('id');
                $rs = $this->crud->get_admin($id);
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": ' . $rows . '}';
                render_json($json);
    }
}