<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_model extends CI_Model {

    var $table_ventas = 'ventas';
    var $table_cliente = 'clientes';
    var $table_contactos = 'contactos';
    //var $table_precios_query = '(SELECT producto_costo, precios.id_precios, precios.`id_producto`, precios.`producto_precio_venta` FROM `precios`  ORDER BY `id_precios` DESC  ) AS `precios`';
    //var $table_stock = 'stock';
    //var $table_marcas = 'marca';
    //var $table_tipo = 'tipo';
    var $column_order =  array('id_venta','clientes.cli_nombre','metodoPago', 'fecha','pago_efectivo','pago_tarjeta','pago_cheque','ventas.importe_total','importe_recibido', 'importe_saldo','ventas.usuario' , null); //set column field database for datatable orderable
    var $column_search = array('id_venta','cliente','clientes.cli_nombre','metodoPago', 'fecha','pago_efectivo','pago_tarjeta', 'ventas.importe_total','ventas.cobrador','ventas.usuario'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array(   'fecha' => 'asc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query( $tpv = null, $fecha = null, $fecha_fin = null)
    {
        $this->db->select('*, (importe_recibido - importe_total) as saldo');
        $this->db->from($this->table_ventas);
        $this->db->join($this->table_cliente, " $this->table_cliente.id_cliente = $this->table_ventas.cliente ", "left");
        $this->db->join($this->table_contactos, " $this->table_contactos.id_cliente = $this->table_cliente.id_cliente",'left');
        // $this->db->join($this->table_tpv, " $this->table_stock.id_tpv = $this->table_tpv.id_tpv",'left');
        $i = 0;
        foreach ($this->column_search as $item) // loop column
        {
            //if($_POST['search']['value']) // if datatable send POST for search
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
        $this->db->where('ventas.id_empresa', $this->session->userdata('id_empresa'));
        if(isset($tpv) && $tpv != ''){
        	$this->db->where('id_tpv', $tpv);
        }

        if((isset($fecha) && $fecha != '') && (isset($fecha_fin) && $fecha_fin != '')){
        	$this->db->where('fecha >=', $fecha);
        	$this->db->where('fecha <=', $fecha_fin);
        }

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
        $this->_get_datatables_query($tpv ,  $fecha, $fecha_fin);
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            //$this->db->group_by('stock.id_producto');
            $query = $this->db->get();
        //echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $query->result();
    }

    function count_filtered($tpv, $fecha = null, $fecha_fin = null)
    {
        $this->_get_datatables_query($tpv , $fecha, $fecha_fin);
        $this->db->group_by('id_venta');
        $query = $this->db->get();
        //echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $query->num_rows();
    }

    public function count_all($tpv = null, $fecha=null, $fecha_fin = null)
    {
        $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        $this->db->from($this->table_ventas);
        return $this->db->count_all_results();
    }

    public function get_ventas( $tpv = null)
    {
        $this->db->select('*');
        $this->db->from('ventas');
        //$this->db->where('id_producto',$id);
        if(isset($tpv)){
             $this->db->where('id_tpv',$tpv);
        }
         
        $this->db->order_by('id_venta', 'desc');
        //$this->db->limit('1');
        $query = $this->db->get();
        if($query->num_rows() > 0){
        //echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $query->result();
        }else{
            return false;
        }
    }

    public function get_venta($id){

        $this->db->select('*');
        $this->db->from('ventas');
        $this->db->where('id_venta',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_ventas_detalles($id){
        $this->db->select('ventas_detalle.*, productos.producto, medida, cantidad_medida, codigo');
        $this->db->from('ventas_detalle');
        $this->db->join('productos', " ventas_detalle.id_producto = productos.id_producto");
        $this->db->where('id_venta',$id);
        $query = $this->db->get();
        //echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $query->result();
    }

    function agregar_producto($producto){
        //

        //$id_compra = '1006'; 
        $this->db->where('id_producto', $producto['id_producto']); // Select where id matches the posted id
        $query = $this->db->get('productos', 1);
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                    $data = array(
                        'id_producto'   => $producto['id_producto'],
                        'codigo'        => $row->codigo,
                        'cantidad'      => $producto['cantidad'],
                        'precio'        => $producto['precio'],
                        'nombre'        => $row->producto . " " . $row->cantidad_medida . $row->medida ,
                        'sub_total'     => $producto['cantidad'] * $producto['precio'] ,//$desc,
                        //  'id_compra'     => $id_compra
                    );
                    // Add the data to the cart using the insert function that is available because we loaded the cart library
                    //if($this->db->insert('compras_detalle', $data )){
                        //return $data; // Finally return TRUE
                    //}else{
                      //  return false;
                   // }
                }
                return $data;
        } else { 
            return false;
        }
    }

    public function save_venta($datos_venta,  $detalles, $id_venta = null,  $tpv, $tipo)
    {
        if(isset($id_venta) && $id_venta != ''){
            $this->db->where('id_venta', $id_venta);
            $this->db->update($this->table_ventas, $datos_venta);
        }
        else{
            $this->db->insert($this->table_ventas, $datos_venta);
            $id_venta = $this->db->insert_id();
        }

        $this->db->delete('ventas_detalle', array( 'id_venta' => $id_venta));
        
        for ($i=0; $i < count($detalles['id_producto']); $i++){
            $carrito['id_venta']   = $id_venta;
            //$carrito['num_detalle'] = $i;
            $carrito['id_producto'] = $detalles['id_producto'][$i];
            $carrito['cant_producto ']    = $detalles['cantidad'][$i];
            $carrito['precio']      = $detalles['precio'][$i];
            $carrito['importe']   = $detalles['importe'][$i];
            $this->db->insert('ventas_detalle', $carrito);

            if ($tipo == 'Venta'){
                $this->update_stock_venta( $detalles['cantidad'][$i] , $tpv , $detalles['id_producto'][$i], $tipo );
            }
                
        }
        return $id_venta;
    }

    private function update_stock_venta($cantidad, $id_tpv, $id_producto, $tipo){//$id_compra, $detalles, $total, $estado){
                    $this->db->set('stock_act', 'stock_act - '. $cantidad, false);
                    $this->db->set('stock.created_on', date("Y-m-d", now()));
                    $this->db->set('id_empresa', $this->session->userdata('id_empresa'));
                    $this->db->where('stock.id_tpv', $id_tpv);
                    $this->db->where('stock.id_producto', $id_producto);                    
                    $this->db->update('stock');
                    $row_cantidad =  $this->db->affected_rows();
                    if($row_cantidad == 0){
                        $cantidad = 0 - $cantidad;
                        $this->db->set('stock_act',  $cantidad);
                        // $this->db->set('stock_min',  '0' );
                        $this->db->set('stock.created_on', date("Y-m-d", now()));
                        $this->db->set('stock.id_producto', $id_producto);
                        $this->db->set('stock.id_tpv', $id_tpv);
                        $this->db->set('id_empresa', $this->session->userdata('id_empresa'));
                        $this->db->insert('stock');
                    }   
                    //echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return true; 
    }

    public function get_clientes($id = null)
    {
        $this->db->from('clientes');
        // $this->db->join('contactos', 'contactos.id_cliente = clientes.id_cliente');
        if($id){
            $this->db->where('clientes.id_cliente',$id);
        }
        $query = $this->db->get();
        return $query->result();
    }


    public function update_pago_venta($id_venta, $pago){//$id_compra, $detalles, $total, $estado){
        $this->db->where('id_venta', $id_venta);
        $this->db->update($this->table_ventas, $pago);
        return $this->db->affected_rows();
    }
}