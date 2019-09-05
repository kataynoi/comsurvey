<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Carc_model extends CI_Model
{
    var $table = "car";
    var $order_column = Array('id','name','licente_plate','seat','default_driver','img',);

    function make_query()
    {
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("name", $_POST["search"]["value"]);
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
    public function del_carc($id)
        {
        $rs = $this->db
            ->where('id', $id)
            ->delete('car');
        return $rs;
        }

        

    public function save_carc($data)
            {

                $rs = $this->db
                    ->set("id", $data["id"])->set("name", $data["name"])->set("licente_plate", $data["licente_plate"])->set("seat", $data["seat"])->set("default_driver", $data["default_driver"])->set("img", $data["img"])
                    ->insert('car');

                return $this->db->insert_id();

            }
    public function update_carc($data)
            {
                $rs = $this->db
                    ->set("id", $data["id"])->set("name", $data["name"])->set("licente_plate", $data["licente_plate"])->set("seat", $data["seat"])->set("default_driver", $data["default_driver"])->set("img", $data["img"])->where("id",$data["id"])
                    ->update('car');

                return $rs;

            }
    public function get_carc($id)
                {
                    $rs = $this->db
                        ->where('id',$id)
                        ->get("car")
                        ->row();
                    return $rs;
                }
}