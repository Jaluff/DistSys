<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentas_clientes_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    var $table_ventas = 'ventas';
    var $table_clientes = 'clientes';
    var $column_order =  array('id_venta', 'ventas.cliente', 'fecha_venta', 'usuario', 'estado', null); //set column field database for datatable orderable
    var $column_search = array('ventas.tipo', 'ventas.usuario', 'ventas.fecha'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('ventas.fecha' => 'asc'); // default order

    private function _get_datatables_query($entidad = null, $fecha = null, $fecha_fin = null)
    {
        // $this->db->select('compras.*, proveedores.prov_nombre');
        // $this->db->from($this->table_compras);
        // $this->db->join($this->table_proveedores, " $this->table_compras.id_proveedor = $this->table_proveedores.id_proveedor", 'left');

        $this->db->set('@T:','0');
        $this->db->select('ventas.*, clientes.cli_nombre as entidad_nombre');
        $this->db->from($this->table_ventas);
        $this->db->join($this->table_clientes, " $this->table_ventas.cliente = $this->table_clientes.id_cliente", 'left');
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
        $this->db->where($this->table_ventas . '.id_empresa', $this->session->userdata('id_empresa'));

        if (isset($entidad) && $entidad != ' ') {
            $this->db->where($this->table_ventas. '.cliente', $entidad);
        }

        if (isset($fecha) && $fecha != '' && !isset($fecha_fin)) {
            $this->db->where('fecha', $fecha);
        }

        if ((isset($fecha) && $fecha != '') && (isset($fecha_fin) && $fecha_fin != '')) {
            $this->db->where('fecha >=', $fecha);
            $this->db->where('fecha <=', $fecha_fin);
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($entidad = null, $fecha = null, $fecha_fin = null)
    {
        // echo "fecha " .$fecha . " fecha fin ". $fecha_fin;
        $this->_get_datatables_query($entidad,  $fecha, $fecha_fin);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        //$this->db->group_by('clientes.id_cliente');
        $query = $this->db->get();
        //   echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        //$this->db->group_by('clientes.id_cliente');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        $this->db->from($this->table_ventas);
        return $this->db->count_all_results();
    }

    
}
