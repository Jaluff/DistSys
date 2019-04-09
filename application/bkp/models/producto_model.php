<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto_model extends CI_Model {

    var $table_productos = 'productos';
    var $table_precios = 'precios';
    var $table_precios_query = '(SELECT producto_costo, precios.id_precios, precios.`id_producto`, precios.`producto_precio_venta` FROM `precios`  ORDER BY `id_precios`   ) AS `precios`';
    var $table_estimacion = 'estimacion';
    var $table_marcas = 'marca';
    var $table_tipo = 'tipo';
    var $column_order =  array( 'codigo', 'producto','tipo', 'marca','precios.producto_precio_venta', null); //set column field database for datatable orderable
    var $column_search = array('producto','codigo','tipo', 'marca','cantidad_medida'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('producto, cantidad_medida' => 'asc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select('productos.id_producto as id,productos.*, precios.*, estimacion.*');
        $this->db->from($this->table_productos);
        $this->db->join($this->table_precios_query,"$this->table_precios.id_producto = $this->table_productos.id_producto",'left');
        $this->db->join($this->table_estimacion,"$this->table_estimacion.id_producto = $this->table_productos.id_producto",'left');

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
        $this->db->group_by('productos.id_producto');
       // $this->db->order_by('id_precios', 'asc');
        $query = $this->db->get();
        //echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->group_by('productos.id_producto');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        $this->db->from($this->table_productos);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table_productos);
        $this->db->where('productos.id_producto',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_precio_by_id($id)
    {
        $this->db->from($this->table_precios);
        $this->db->where('id_producto',$id);
        $this->db->order_by('id_precios', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_stock($id, $tpv = null)
    {
        $this->db->select('stock_act');
        $this->db->from('stock');
        $this->db->where('id_producto',$id);
        if ($tpv ){
            $this->db->where('id_tpv',$tpv);
        }
        $this->db->order_by('id_stock','desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_marca_by_id($id)
    {
        $this->db->from($this->table_marcas);
        $this->db->where('id_marca',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_marcas()
    {
        $this->db->from($this->table_marcas);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_medidas()
    {
        $this->db->from('medida');
        $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    public function get_productos()
    {
        $this->db->select('id_producto, producto, stock_actual, cantidad_medida, especie');
        $this->db->from($this->table_productos);
        $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        $this->db->where('productos.estado', 'Activo');
        $this->db->order_by('producto, cantidad_medida');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_tipo()
    {
        $this->db->from($this->table_tipo);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_especie()
    {
        $this->db->from('especie');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_estimacion_by_id($id)
    {
        $this->db->from($this->table_estimacion);
        $this->db->where('id_producto',$id);
        $this->db->order_by('id_estimacion', 'desc');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function save($data_productos,$data_precio, $data_estimacion)
    {
        $this->db->insert($this->table_productos, $data_productos);
        $id_producto = $this->db->insert_id();
        
        $this->db->set('id_producto',$id_producto);
        $this->db->insert($this->table_precios, $data_precio);

        $this->db->set('id_producto',$id_producto);
        $this->db->insert($this->table_estimacion, $data_estimacion);
        
        return $this->db->insert_id();
    }

    public function update($where, $data_producto, $data_precio, $data_estimacion)
    {
        $this->db->update($this->table_productos, $data_producto, $where);
        //var_dump($where);
        $this->db->set($where);
        $this->db->insert($this->table_precios, $data_precio);
        //echo $this->db->last_query();
        $this->db->set($where);
        $this->db->insert($this->table_estimacion, $data_estimacion);
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    public function update_precios($where,  $data_precio)
    {
        
        //var_dump($where);
        $this->db->set($where);
        $this->db->insert($this->table_precios, $data_precio);
        //echo $this->db->last_query();
        
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }
    public function update_stock($id_prod,  $data_stock, $data_compra)
    { 

        $this->db->update($this->table_productos, $data_stock, array('id_producto'=> $id_prod));
        $this->db->insert('compras', $data_compra);
        //return $this->db->affected_rows();
        return $this->db->last_query();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_producto', $id);
        $this->db->delete($this->table_productos);
    }


}
