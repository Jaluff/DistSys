<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model {

    var $table_clientes = 'clientes';
    var $table_contacto = 'contactos';
    //var $table2 = 'mascotas';
    var $column_order =  array('clientes.id_cliente','cli_nombre','cli_telefono','cli_movil',null); //set column field database for datatable orderable
    var $column_search = array('clientes.id_cliente','cli_nombre','telefono1','movil1','cli_direccion', 'cli_doc', 'cli_created_on'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('clientes.id_cliente' => 'desc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select('clientes.*,clientes.id_cliente as idcliente, contactos.id_cliente as idc, contactos.*');
        $this->db->from($this->table_clientes);
        //$this->db->join($this->table2,"$this->table.id_cliente = $this->table2.id_cliente",'left');
        $this->db->join($this->table_contacto,"$this->table_clientes.id_cliente = $this->table_contacto.id_cliente",'left');

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
        $this->db->group_by('clientes.id_cliente');
        $query = $this->db->get();
         //echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->group_by('clientes.id_cliente');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        $this->db->from($this->table_clientes);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table_clientes);
        $this->db->join($this->table_contacto, "$this->table_clientes.id_cliente = $this->table_contacto.id_cliente",'left');
        $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        $this->db->where('clientes.id_cliente',$id);
        $query = $this->db->get();
        //echo $this->db->last_query();exit();
        return $query->row();
    }

    public function get_clientes()
    {
        $this->db->from($this->table_clientes);
        $this->db->join($this->table_contacto, "$this->table_clientes.id_cliente = $this->table_contacto.id_cliente",'left');
        $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        //this->db->where('clientes.id_cliente',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_con_by_id($id)
    {
        $this->db->from($this->table_contacto);
        $this->db->where('id_cliente',$id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function save($data,$data_contacto)
    {
        $this->db->insert($this->table_clientes, $data);
        $id_cliente = $this->db->insert_id();
        $this->db->set('id_cliente',$id_cliente);
        $this->db->insert($this->table_contacto, $data_contacto);
        return $this->db->insert_id();
    }

    public function update($where, $data, $data_contacto)
    {
        $this->db->update($this->table_clientes, $data, $where);
        $this->db->update($this->table_contacto, $data_contacto, $where);
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_cliente', $id);
        $this->db->delete($this->table_clientes);
    }


}
