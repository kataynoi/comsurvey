<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Switch_survey_model extends CI_Model
{
    var $table = "switch_survey";
    var $order_column = Array('id','switchtype','brand','switch_series','porttype','port','location','start_use','use_status','serial_number','ip',);

    function make_query()
    {
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("switch_series", $_POST["search"]["value"]);$this->db->or_like("location", $_POST["search"]["value"]);
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
    public function del_switch_survey($id)
        {
        $rs = $this->db
            ->where('id', $id)
            ->delete('switch_survey');
        return $rs;
        }

        public function get_cswitchtype(){
                        $rs = $this->db
                        ->get("cswitchtype")
                        ->result();
                        return $rs;}    public function get_switchtype_name($id)
                {
                    $rs = $this->db
                        ->where("id",$id)
                        ->get("cswitchtype")
                        ->row();
                    return $rs?$rs->name:"";
                }public function get_cbrand(){
                        $rs = $this->db
                        ->get("cbrand")
                        ->result();
                        return $rs;}    public function get_brand_name($id)
                {
                    $rs = $this->db
                        ->where("id",$id)
                        ->get("cbrand")
                        ->row();
                    return $rs?$rs->name:"";
                }public function get_clocation(){
                        $rs = $this->db
                        ->get("clocation")
                        ->result();
                        return $rs;}    public function get_location_name($id)
                {
                    $rs = $this->db
                        ->where("id",$id)
                        ->get("clocation")
                        ->row();
                    return $rs?$rs->name:"";
                }public function get_cuse_status(){
                        $rs = $this->db
                        ->get("cuse_status")
                        ->result();
                        return $rs;}    public function get_use_status_name($id)
                {
                    $rs = $this->db
                        ->where("id",$id)
                        ->get("cuse_status")
                        ->row();
                    return $rs?$rs->name:"";
                }

    public function save_switch_survey($data)
            {

                $rs = $this->db
                    ->set("id", $data["id"])->set("switchtype", $data["switchtype"])->set("brand", $data["brand"])->set("switch_series", $data["switch_series"])->set("porttype", $data["porttype"])->set("port", $data["port"])->set("location", $data["location"])->set("start_use", $data["start_use"])->set("use_status", $data["use_status"])->set("serial_number", $data["serial_number"])->set("ip", $data["ip"])
                    ->insert('switch_survey');

                return $rs;

            }
    public function update_switch_survey($data)
            {
                $rs = $this->db
                    ->set("id", $data["id"])->set("switchtype", $data["switchtype"])->set("brand", $data["brand"])->set("switch_series", $data["switch_series"])->set("porttype", $data["porttype"])->set("port", $data["port"])->set("location", $data["location"])->set("start_use", $data["start_use"])->set("use_status", $data["use_status"])->set("serial_number", $data["serial_number"])->set("ip", $data["ip"])->where("id",$data["id"])
                    ->update('switch_survey');

                return $rs;

            }
    public function get_switch_survey($id)
                {
                    $rs = $this->db
                        ->where('id',$id)
                        ->get("switch_survey")
                        ->row();
                    return $rs;
                }
    public function get_switch_series()
                {
                    $rs = $this->db
                        ->select('switch_series as value')
                        ->get("switch_survey")
                        ->result();
                    return $rs;
                }
}