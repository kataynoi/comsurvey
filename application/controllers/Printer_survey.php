<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Printer_survey extends CI_Controller
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();

        //$this->layout->setLeft('layout/left');
        //$this->layout->setLayout('admin_layout');
        $this->load->model('Printer_survey_model', 'crud');
    }

    public function index()
    {
        $data[] = '';
        $data["cprintertype"] = $this->crud->get_cprintertype();
        $data["cbrand"] = $this->crud->get_cbrand();
        $data["clocation"] = $this->crud->get_clocation();
        $data["cuse_status"] = $this->crud->get_cuse_status();
        $this->layout->view('printer_survey/index', $data);
    }


    function fetch_printer_survey()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {


            $sub_array = array();
            $sub_array[] = $row->id;
            $sub_array[] = $row->printertype;
            //$sub_array[] = $row->brand;
            $sub_array[] = $row->printer_series;
            //$sub_array[] = $row->printer_color;
            $sub_array[] = $row->port;
            $sub_array[] = $row->location;
            //$sub_array[] = $row->start_user;
            //$sub_array[] = $row->use_status;
            //$sub_array[] = $row->serial_number;
            $sub_array[] = "<a href='http://".$row->ip."' target='blank'> <i class='fa fa-external-link' aria-hidden='true'></i> ".$row->ip."</a>";
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

    public function del_printer_survey()
    {
        $id = $this->input->post('id');

        $rs = $this->crud->del_printer_survey($id);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_printer_survey()
    {
        $data = $this->input->post('items');
        if ($data['action'] == 'insert') {
            $rs = $this->crud->save_printer_survey($data);
        } else if ($data['action'] == 'update') {
            $rs = $this->crud->update_printer_survey($data);
        }
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  get_printer_survey()
    {
        $id = $this->input->post('id');
        $rs = $this->crud->get_printer_survey($id);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }
}