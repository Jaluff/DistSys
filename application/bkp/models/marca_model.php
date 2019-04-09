<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marca_model extends CI_Model {

    var $table = 'marca';
    
    

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_marca', $id);
        $this->db->delete($this->table);
    }


}
