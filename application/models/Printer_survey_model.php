<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Printer_survey_model extends CI_Model
{
    var $table = "printer_survey as a";
    var $order_column = Array('id', 'printertype', 'brand', 'printer_series', 'printer_color', 'port', 'location', 'start_user', 'use_status', 'serial_number', 'ip',);

    function make_query()
    {

        $this->db->select('a.id, c.name as printertype, a.printer_series, a.port,b.name as location, ip')
            ->join('clocation as b','a.location = b.id')
            ->join('cprintertype as c','a.printertype = c.id')
            ->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("b.name", $_POST["search"]["value"]);
            $this->db->or_like("a.ip", $_POST["search"]["value"]);
            $this->db->or_like("a.printer_series", $_POST["search"]["value"]);
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
    public function del_printer_survey($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->delete('printer_survey');
        return $rs;
    }

    public function get_cprintertype()
    {
        $rs = $this->db
            ->get("cprintertype")
            ->result();
        return $rs;
    }

    public function get_printertype_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("cprintertype")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_cbrand()
    {
        $rs = $this->db
            ->get("cbrand")
            ->result();
        return $rs;
    }

    public function get_brand_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("cbrand")
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

    public function save_printer_survey($data)
    {

        $rs = $this->db
            ->set("id", $data["id"])->set("printertype", $data["printertype"])->set("brand", $data["brand"])->set("printer_series", $data["printer_series"])->set("printer_color", $data["printer_color"])->set("port", $data["port"])->set("location", $data["location"])->set("start_user", $data["start_user"])->set("use_status", $data["use_status"])->set("serial_number", $data["serial_number"])->set("ip", $data["ip"])
            ->insert('printer_survey');

        return $rs;

    }

    public function update_printer_survey($data)
    {
        $rs = $this->db
            ->set("id", $data["id"])->set("printertype", $data["printertype"])->set("brand", $data["brand"])->set("printer_series", $data["printer_series"])->set("printer_color", $data["printer_color"])->set("port", $data["port"])->set("location", $data["location"])->set("start_user", $data["start_user"])->set("use_status", $data["use_status"])->set("serial_number", $data["serial_number"])->set("ip", $data["ip"])->where("id", $data["id"])
            ->update('printer_survey');

        return $rs;

    }

    public function get_printer_survey($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get("printer_survey")
            ->row();
        return $rs;
    }
}