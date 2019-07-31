<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Com_survey extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();
      /*
        if (!$this->session->userdata("admin"))
                    redirect(site_url('user/login'));
        */
        $this->load->model('Com_survey_model', 'crud');
    }

    public function index()
    {
        $data[] = '';
        $data["computertype"] = $this->crud->get_computertype();$data["cbrand"] = $this->crud->get_cbrand();$data["cband_series"] = $this->crud->get_cband_series();$data["ccpu"] = $this->crud->get_ccpu();$data["coperating_system"] = $this->crud->get_coperating_system();$data["coffice"] = $this->crud->get_coffice();$data["employee"] = $this->crud->get_employee();$data["cworkgroup"] = $this->crud->get_cworkgroup();$data["clocation"] = $this->crud->get_clocation();$data["cuse_status"] = $this->crud->get_cuse_status();
        $this->layout->view('com_survey/index', $data);
    }


    function fetch_com_survey()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        $no=1;
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = $row->computertype;
            $sub_array[] = $row->cband_series;
            $sub_array[] = $row->location;
            $sub_array[] = $row->start_year;
            $sub_array[] = $row->owner;
            $sub_array[] = '<div class="btn-group" role="group" ><button class="btn btn-warning" data-btn="btn_edit" data-id="' . $row->id . '">Edit</button><button class="btn btn-danger" data-btn="btn_del" data-id="' . $row->id . '">Delete</button></div>';
            $data[] = $sub_array;
            $no++;
        }

            $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->crud->get_all_data(),
            "recordsFiltered" => $this->crud->get_filtered_data(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function del_com_survey(){
        $id = $this->input->post('id');

        $rs=$this->crud->del_com_survey($id);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_com_survey()
    {
            $data = $this->input->post('items');
            if($data['action']=='insert'){
                $rs=$this->crud->save_com_survey($data);
            }else if($data['action']=='update'){
                $rs=$this->crud->update_com_survey($data);
            }
            if($rs){
                $json = '{"success": true}';
            }else{
                $json = '{"success": false}';
            }

            render_json($json);
        }

    public function  get_com_survey()
    {
                $id = $this->input->post('id');
                $rs = $this->crud->get_com_survey($id);
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": ' . $rows . '}';
                render_json($json);
    }
}