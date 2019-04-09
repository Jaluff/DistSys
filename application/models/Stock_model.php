<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {

    var $table_productos = 'productos';
    var $table_tpv = 'tpv';
    var $table_precios_query = '(SELECT producto_costo, precios.id_precios, precios.`id_producto`, precios.`producto_precio_venta` FROM `precios`  ORDER BY `id_precios` DESC  ) AS `precios`';
    var $table_stock = 'stock';
    //var $table_marcas = 'marca';
    //var $table_tipo = 'tipo';
    var $column_order =  array('productos.codigo','productos.producto', 'productos.tipo','productos.marca','cast(stock_min as unsigned) ', 'cast(stock_act as unsigned) ',null); //set column field database for datatable orderable
    var $column_search = array('stock.id_stock','producto','tpv.tpv_nombre', 'stock.created_on'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('productos.producto' => 'asc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query( $tpv = null, $fecha = null, $fecha_fin = null)
    {

        $this->db->select('productos.*');
        $this->db->from($this->table_productos);
        //$this->db->join($this->table_precios_query,"$this->table_precios.id_producto = $this->table_productos.id_producto",'left');
        $this->db->join($this->table_stock, " $this->table_stock.id_producto = $this->table_productos.id_producto", 'left');
        //$this->db->join($this->table_tpv, " $this->table_productos.id_tpv = $this->table_tpv.id_tpv");

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
        $this->db->where('productos.id_empresa', $this->session->userdata('id_empresa'));
        
        if(isset($tpv) && $tpv != ''){
        	$this->db->where('tpv.id_tpv', $tpv);
        }
//echo $fecha_fin. " - ". $fecha;
        // if(isset($fecha) && $fecha != '' && !isset($fecha_fin)){
        // 	$this->db->where('stock.created_on', $fecha);
        // }

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

    function get_datatables($tpv = null, $fecha = null, $fecha_fin = null)
    {
        $this->_get_datatables_query($tpv,  $fecha, $fecha_fin);
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

    public function get_stock($id, $tpv = null)
    {
        //$this->db->select('stock_act, stock_min, observacion');
    
        $this->db->where('id_producto',$id);
        if(isset($tpv)){
             $this->db->where('id_tpv',$tpv);
        }
        $this->db->order_by('id_stock', 'desc');
        $this->db->limit('1');
        $query = $this->db->get('stock');
        if($query->num_rows() > 0){
        //echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $query->row_array();
        }else{
            return false;
        }
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

    public function modifica_stock_tpv($stock)
    {
        //print_r($stock);exit(0);
        $stock_m = $stock['stock_minimo'];
        if ( $stock_m != ''){
            $stock_m = $stock_m;
        }else{
            $stock_m = 0;    
        }
        
        $this->db->set('stock_act', $stock['cantidad']);
        $this->db->set('stock_min',$stock_m);
        $this->db->set('created_on', date("Y-m-d", now()));
        $this->db->where('id_producto', $stock['id_producto']);
        $this->db->where('id_tpv', $stock['tpv']);
        $this->db->where('id_empresa',$this->session->userdata('id_empresa'));
        $this->db->update('stock');
        //echo $this->db->last_query();
        $row_cantidad_origen =  $this->db->affected_rows();
        
        if($row_cantidad_origen == 0){
            $this->db->set('id_producto', $stock['id_producto']);
            $this->db->set('stock_act',  $stock['cantidad']);
            $this->db->set('stock_min', $stock_m);
            $this->db->set('created_on', date("Y-m-d", now()));
            $this->db->set('id_empresa',$this->session->userdata('id_empresa'));
            $this->db->set('id_tpv', $stock['tpv']);
            $this->db->insert('stock');
            //echo $this->db->last_query();       
        }
        //insert en stock_detalles origen
        $this->db->set('id_producto', $stock['id_producto']);
        $this->db->set('cantidad', $stock['cantidad']);
        $this->db->set('operacion' , 'Modificacion de stock');
        $this->db->set('created_on', date("Y-m-d", now()));
        $this->db->set('id_tpv', $stock['tpv']);
        $this->db->set('id_empresa',$this->session->userdata('id_empresa'));
        $this->db->set('usuario', $stock['usuario']);
        $this->db->insert('stock_detalles');
        return true;
    }

    public function agrega_stock_tpv($id_producto,$cant, $tpv_o, $tpv_d, $stock_o, $stock_d,$stock_m, $usr)
    {
        //$stock_resta = $stock_o - $cant;
        //$stock_suma = $stock_d + $cant;
        if (isset($stosk_m) && $stock_m != ''){
            $stosk_m = $stosk_m;
        }else{
            $stock_m = 0;    
        }
        $stock_m = 0;
        $this->db->set('stock_act', 'stock_act -' . $cant, false);
        $this->db->set('stock_min', $stock_m);
        $this->db->set('created_on', date("Y-m-d", now()));
        $this->db->where('id_producto', $id_producto);
        $this->db->where('id_tpv', $tpv_o);
        $this->db->where('id_empresa',$this->session->userdata('id_empresa'));
        $this->db->update('stock');
        //echo $this->db->last_query();
        
        $row_cantidad_origen =  $this->db->affected_rows();
        if($row_cantidad_origen == 0){
            $this->db->set('id_producto', $id_producto);
            $this->db->set('stock_act',  $cant, false);
            $this->db->set('stock_min', $stock_m);
            $this->db->set('created_on', date("Y-m-d", now()));
            $this->db->set('id_tpv', $tpv_o);
            $this->db->insert('stock');
            //echo $this->db->last_query();       
        }
        //insert en stock_detalles origen
        $this->db->set('id_producto', $id_producto);
        $this->db->set('cantidad', $cant);
        $this->db->set('operacion' , 'Egreso');
        $this->db->set('created_on', date("Y-m-d", now()));
        $this->db->set('id_tpv', $tpv_o);
        $this->db->set('id_empresa',$this->session->userdata('id_empresa'));
        $this->db->set('usuario', $usr);
        $this->db->insert('stock_detalles');
        




        // datos para ingreso de productos
        $this->db->set('stock_act', 'stock_act +' . $cant, false);
        $this->db->set('stock_min', $stock_m);
        $this->db->set('created_on', date("Y-m-d", now()));
        $this->db->where('id_producto', $id_producto);
        $this->db->where('id_tpv', $tpv_d);
        $this->db->where('id_empresa',$this->session->userdata('id_empresa'));
        $this->db->update('stock');
        //echo $this->db->last_query();
        
        $row_cantidad_destino =  $this->db->affected_rows();
        if($row_cantidad_destino == 0){
            $this->db->set('id_producto', $id_producto);
            $this->db->set('stock_act',  $cant, false);
            $this->db->set('stock_min', $stock_m);
            $this->db->set('created_on', date("Y-m-d", now()));
            $this->db->set('id_tpv', $tpv_d);
            $this->db->set('id_empresa',$this->session->userdata('id_empresa'));
            $this->db->insert('stock');
            //echo $this->db->last_query();       
        }
        $this->db->set('id_producto', $id_producto);
        $this->db->set('cantidad', $cant);
        $this->db->set('operacion' , 'Ingreso');
        $this->db->set('created_on', date("Y-m-d", now()));
        $this->db->set('id_tpv', $tpv_d);
        $this->db->set('id_empresa',$this->session->userdata('id_empresa'));
        $this->db->set('usuario', $usr);
        $this->db->insert('stock_detalles');
        //insert en stock_detalles destino
        return true;
    }


}
