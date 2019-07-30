<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Com_survey_model extends CI_Model
{
    var $table = "com_survey";
    var $order_column = Array('id', 'computertype', 'cband_series', 'operating_system', 'office', 'owner', 'location', 'use_status',);

    function make_query()
    {
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("cpu", $_POST["search"]["value"]);
            $this->db->or_like("ram", $_POST["search"]["value"]);
            $this->db->or_like("cband_series", $_POST["search"]["value"]);
            $this->db->or_like("owner", $_POST["search"]["value"]);
            $this->db->group_end();

        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('', '');
        }
    }

    function make_datatables()
    {
        $this->make_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_filtered_data()
    {
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_all_data()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    /* End Datatable*/
    public function del_com_survey($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->delete('com_survey');
        return $rs;
    }

    public function get_computertype()
    {
        $rs = $this->db
            ->get("computertype")
            ->result();
        return $rs;
    }

    public function get_computertype_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("computertype")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_cband_series()
    {
        $rs = $this->db
            ->get("cband_series")
            ->result();
        return $rs;
    }

    public function get_cband_series_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("cband_series")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_coperating_system()
    {
        $rs = $this->db
            ->get("coperating_system")
            ->result();
        return $rs;
    }

    public function get_operating_system_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("coperating_system")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_coffice()
    {
        $rs = $this->db
            ->get("coffice")
            ->result();
        return $rs;
    }

    public function get_office_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("coffice")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_employee()
    {
        $rs = $this->db
            ->get("employee")
            ->result();
        return $rs;
    }

    public function get_owner_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("employee")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_clocation()
    {
        $rs = $this->db
            ->get("clocation")
            ->result();
        return $rs;
    }

    public function get_location_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("clocation")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_cuse_status()
    {
        $rs = $this->db
            ->get("cuse_status")
            ->result();
        return $rs;
    }

    public function get_use_status_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("cuse_status")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function save_com_survey($data)
    {

        $rs = $this->db
            ->set("id", $data["id"])->set("computertype", $data["computertype"])->set("cbrand", $data["cbrand"])->set("cband_series", $data["cband_series"])->set("ram", $data["ram"])->set("cpu", $data["cpu"])->set("harddisk", $data["harddisk"])->set("operating_system", $data["operating_system"])->set("office", $data["office"])->set("owner", $data["owner"])->set("co_workgroup", $data["co_workgroup"])->set("location", $data["location"])->set("start_year", $data["start_year"])->set("ups", $data["ups"])->set("use_status", $data["use_status"])->set("serial_number", $data["serial_number"])->set("note", $data["note"])
            ->insert('com_survey');

        return $rs;

    }

    public function update_com_survey($data)
    {
        $rs = $this->db
            ->set("id", $data["id"])->set("computertype", $data["computertype"])->set("cbrand", $data["cbrand"])->set("cband_series", $data["cband_series"])->set("ram", $data["ram"])->set("cpu", $data["cpu"])->set("harddisk", $data["harddisk"])->set("operating_system", $data["operating_system"])->set("office", $data["office"])->set("owner", $data["owner"])->set("co_workgroup", $data["co_workgroup"])->set("location", $data["location"])->set("start_year", $data["start_year"])->set("ups", $data["ups"])->set("use_status", $data["use_status"])->set("serial_number", $data["serial_number"])->set("note", $data["note"])->where("id", $data["id"])
            ->update('com_survey');

        return $rs;

    }

    public function get_com_survey($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get("com_survey")
            ->row();
        return $rs;
    }
}