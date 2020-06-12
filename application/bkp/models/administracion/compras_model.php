<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras_model extends CI_Model {

    var $table_productos = 'productos';
    var $table_precios = 'precios';
    var $table_precios_query = '(SELECT producto_costo, precios.id_precios, precios.`id_producto`, precios.`producto_precio_venta` FROM `precios`  ORDER BY precios.`id_producto` DESC  ) AS `precios`';
    var $table_estimacion = 'estimacion';
    var $table_marcas = 'marca';
    var $table_tipo = 'tipo';
    var $column_order =  array('productos.id_producto','producto','codigo','tipo', 'marca',null); //set column field database for datatable orderable
    var $column_search = array('producto','codigo','tipo', 'marca'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('producto' => 'asc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select('productos.id_producto as id,productos.*,productos.cantidad_medida, productos.medida, precios.*, estimacion.*');
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
        $this->db->where('productos.id_empresa', $this->session->userdata('id_empresa'));
        $this->db->from($this->table_compras);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table_compras);
        $this->db->where('productos.id_producto',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_stock($id, $tpv = null)
    {
        //$this->db->select('stock_act, stock_min, observacion');
        $this->db->from('stock');
        $this->db->where('id_producto',$id);
        if(isset($tpv)){
             $this->db->where('id_tpv',$tpv);
        }
        $this->db->order_by('id_stock', 'desc');
        $this->db->limit('1');
        $query = $this->db->get();
        if($query->num_rows() > 0){
        //echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $query->result();
        }else{
            return false;
        }
    }

    // public function get_con_by_id($id)
    // {
    //     $this->db->from($this->table_compras);
    //     $this->db->where('id_cliente',$id);
    //     $query = $this->db->get();
    //     return $query->row_array();
    // }

    public function get_proveedores($id = null)
    {
        $this->db->from('proveedores');
        $this->db->where('proveedores.id_empresa', $this->session->userdata('id_empresa'));
        $this->db->where('proveedores.prov_estado', 'Activo');
        $query = $this->db->get();
        return $query->result();
    }

    public function save($id_producto,$data_precio, $data_stock)
    {
        
        $this->db->set('id_producto',$id_producto);
        $this->db->insert($this->table_precios, $data_precio);
//echo $this->db->last_query();
        $this->db->set('id_producto',$id_producto);
        $this->db->set('operacion', 'Ingreso');
        $this->db->insert('stock', $data_stock);
 //echo $this->db->last_query();       
        return $this->db->insert_id();
    }

    public function agrega_stock_tpv($id_producto,$cant, $tpv_o, $tpv_d, $stock_o, $stock_d,$stock_m, $usr)
    {
        $stock_resta = $stock_o - $cant;
        $stock_suma = $stock_d + $cant;
        $this->db->set('id_producto', $id_producto);
        $this->db->set('cantidad', $cant);
        $this->db->set('stock_act', $stock_resta);
        $this->db->set('stock_min', $stock_m);
        $this->db->set('operacion', 'Egreso');
        $this->db->set('created_on', date("Y-m-d", now()));
        $this->db->set('usuario', $usr);
        $this->db->set('id_tpv', $tpv_o);
        $this->db->insert('stock');
//echo $this->db->last_query();

     

        $this->db->set('id_producto', $id_producto);
        $this->db->set('cantidad', $cant);
        $this->db->set('stock_act', $stock_suma);
        $this->db->set('stock_min', $stock_m);
        $this->db->set('operacion', 'Ingreso');
        $this->db->set('created_on', date("Y-m-d", now()));
        $this->db->set('usuario', $usr);
        $this->db->set('id_tpv', $tpv_d);
        $this->db->insert('stock');
 //echo $this->db->last_query();       
        return true;
    }

    // public function update($where, $data, $data_contacto)
    // {
    //     $this->db->update($this->table, $data, $where);
    //     $this->db->update($this->table_contacto, $data_contacto, $where);
    //     //echo $this->db->last_query();
    //     return $this->db->affected_rows();
    // }

    // public function delete_by_id($id)
    // {
    //     $this->db->where('id_cliente', $id);
    //     $this->db->delete($this->table);
    // }

   

     
    


}
