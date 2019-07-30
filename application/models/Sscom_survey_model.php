<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Sscom_survey_model extends CI_Model
{
    var $table = "com_survey";
    var $order_column = Array('cpu','harddisk','operating_system','office','owner','cbrand','cband_series',);

    function make_query()
    {
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("office", $_POST["search"]["value"]);$this->db->or_like("operating_system", $_POST["search"]["value"]);
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
    public function del_sscom_survey($id)
        {
        $rs = $this->db
            ->where('id', $id)
            ->delete('com_survey');
        return $rs;
        }

        public function get_cbrand(){
                        $rs = $this->db
                        ->get("cbrand")
                        ->result();
                        return $rs;}    public function get_cbrand_name($id)
                {
                    $rs = $this->db
                        ->where("id",$id)
                        ->get("cbrand")
                        ->row();
                    return $rs?$rs->name:"";
                }public function get_ccpu(){
                        $rs = $this->db
                        ->get("ccpu")
                        ->result();
                        return $rs;}    public function get_ccpu_name($id)
                {
                    $rs = $this->db
                        ->where("id",$id)
                        ->get("ccpu")
                        ->row();
                    return $rs?$rs->name:"";
                }

    public function save_sscom_survey($data)
            {

                $rs = $this->db
                    ->set("id", $data["id"])->set("computertype", $data["computertype"])->set("cbrand", $data["cbrand"])->set("cband_series", $data["cband_series"])->set("ram", $data["ram"])->set("cpu", $data["cpu"])->set("harddisk", $data["harddisk"])->set("operating_system", $data["operating_system"])->set("office", $data["office"])->set("owner", $data["owner"])->set("co_workgroup", $data["co_workgroup"])->set("location", $data["location"])->set("start_year", $data["start_year"])->set("ups", $data["ups"])->set("use_status", $data["use_status"])->set("serial_number", $data["serial_number"])->set("note", $data["note"])
                    ->insert('com_survey');

                return $rs;

            }
    public function update_sscom_survey($data)
            {
                $rs = $this->db
                    ->set("id", $data["id"])->set("computertype", $data["computertype"])->set("cbrand", $data["cbrand"])->set("cband_series", $data["cband_series"])->set("ram", $data["ram"])->set("cpu", $data["cpu"])->set("harddisk", $data["harddisk"])->set("operating_system", $data["operating_system"])->set("office", $data["office"])->set("owner", $data["owner"])->set("co_workgroup", $data["co_workgroup"])->set("location", $data["location"])->set("start_year", $data["start_year"])->set("ups", $data["ups"])->set("use_status", $data["use_status"])->set("serial_number", $data["serial_number"])->set("note", $data["note"])->where("id",$data["id"])
                    ->update('com_survey');

                return $rs;

            }
    public function get_sscom_survey($id)
                {
                    $rs = $this->db
                        ->where('id',$id)
                        ->get("com_survey")
                        ->row();
                    return $rs;
                }
}