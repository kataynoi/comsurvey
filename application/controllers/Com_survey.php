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
        $data["computertype"] = $this->crud->get_computertype();
        $data["cband_series"] = $this->crud->get_cband_series();
        $data["coperating_system"] = $this->crud->get_coperating_system();
        $data["coffice"] = $this->crud->get_coffice();
        $data["employee"] = $this->crud->get_employee();
        $data["clocation"] = $this->crud->get_clocation();
        $data["cuse_status"] = $this->crud->get_cuse_status();
        $this->layout->view('com_survey/index', $data);
    }


    function fetch_com_survey()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {
            $computertype_name = $this->crud->get_computertype_name($row->computertype);
            $cband_series_name = $this->crud->get_cband_series_name($row->cband_series);
            //$operating_system_name = $this->crud->get_operating_system_name($row->operating_system);
            //$office_name = $this->crud->get_office_name($row->office);
            $owner_name = $this->crud->get_owner_name($row->owner);
            $location_name = $this->crud->get_location_name($row->location);
            $use_status_name = $this->crud->get_use_status_name($row->use_status);

            $sub_array = array();
            $sub_array[] = $row->id;
            $sub_array[] = $computertype_name;
            $sub_array[] = $cband_series_name;
            //$sub_array[] = $operating_system_name;
            //$sub_array[] = $office_name;
            $sub_array[] = $owner_name;
            $sub_array[] = $location_name;
            $sub_array[] = $use_status_name;
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

    public function del_com_survey()
    {
        $id = $this->input->post('id');

        $rs = $this->crud->del_com_survey($id);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_com_survey()
    {
        $data = $this->input->post('items');
        if ($data['action'] == 'insert') {
            $rs = $this->crud->save_com_survey($data);
        } else if ($data['action'] == 'update') {
            $rs = $this->crud->update_com_survey($data);
        }
        if ($rs) {
            $json = '{"success": true}';
        } else {
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