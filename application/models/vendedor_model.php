<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendedor_model extends CI_Model {

    var $table = 'vendedores';
    var $table_provincias = 'provincias';
    var $table_paises = 'pais';
    var $column_order =  array('id_vendedor','vendedor_nombre','vendedor_telefono','vendedor_movil','vendedor_contacto','vendedor_estado',null); //set column field database for datatable orderable
    var $column_search = array('id_vendedor','vendedor_nombre','vendedor_telefono','vendedor_movil','vendedor_contacto', 'vendedor_provincia','vendedor_localidad', 'vendedor_cuit', 'vendedor_estado'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id_vendedor' => 'asc'); // default order
    

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select('vendedores.*, provincias.nombre as vendedor_provincia, pais.pais as vendedor_pais');
        $this->db->from($this->table);
        $this->db->join($this->table_provincias , "$this->table.vendedor_id_provincia = $this->table_provincias.id_provincia",'left');
        $this->db->join($this->table_paises , "$this->table.vendedor_id_pais = $this->table_paises.id_pais",'left');

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
        $this->db->group_by('id_vendedor');
        $query = $this->db->get();
        //  echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->group_by('id_vendedor');
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
        $this->db->where('id_vendedor',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_provincias()
    {
        $this->db->from('provincias');
        $query = $this->db->get();
        // echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
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
        // echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
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
        $this->db->where('id_vendedor', $id);
        $this->db->delete($this->table);
    }

    public function get_vendedores($id = null)
    {
        $this->db->from($this->table);
        $this->db->where('vendedores.id_empresa', $this->session->userdata('id_empresa'));
        $this->db->where('vendedores.vendedor_estado', 'Activo');
        $query = $this->db->get();
        return $query->result();
    }


}
