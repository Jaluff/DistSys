<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor_model extends CI_Model {

    var $table = 'proveedores';
    var $column_order =  array('id_proveedor','prov_nombre','prov_telefono','prov_movil','prov_contacto','prov_estado',null); //set column field database for datatable orderable
    var $column_search = array('id_proveedor','prov_nombre','prov_telefono','prov_movil','prov_contacto', 'prov_provincia','prov_localidad', 'prov_cuit', 'prov_estado'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id_proveedor' => 'asc'); // default order
    

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        
        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;

        }

        $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->group_by('id_proveedor');
        $query = $this->db->get();
        // echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->group_by('id_proveedor');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id_proveedor',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_provincias()
    {
        $this->db->from('provincias');
        $query = $this->db->get();
        return $query->result();
    }

    /**
    * @desc - obtenemos todas las poblaciones que pertenecen a esa provincia
    * @return object
    */
    public function getDepartamentos($provinciaId)
    {
        $this->db->select("nombre");
        $this->db->where("provincia_id", $provinciaId);
        $result = $this->db->get("departamentos")->result();
        //echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $result;
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
        $this->db->where('id_proveedor', $id);
        $this->db->delete($this->table);
    }

    public function get_proveedores($id = null)
    {
        $this->db->from($this->table);
        $this->db->where('proveedores.id_empresa', $this->session->userdata('id_empresa'));
        $this->db->where('proveedores.prov_estado', 'Activo');
        $query = $this->db->get();
        return $query->result();
    }


}
