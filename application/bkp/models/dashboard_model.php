<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    var $t_ventas = 'ventas';
    var $stock = 'stock';
    var $_vdetalles = 'ventas_detalle';
    

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_total_operacion($operacion , $tpv = null){
    	$this->db->select('SUM(cantidad) as tventa');
        $this->db->from('stock');
        if(isset($tpv)){
            $this->db->where('id_tpv', $tpv);
        }
         $this->db->where('operacion', $operacion);
    	$query = $this->db->get();
    	return $query->row();
    }

    public function get_ventasTipo($tipo, $tpv = null){
        $this->db->select('COUNT(id_venta) AS cantidad');
        $this->db->from('ventas');
        if(isset($tpv)){
            $this->db->where('id_tpv', $tpv);
        }
         $this->db->where('tipo', $tipo);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_ventasTPV(){
        $this->db->select('tpv_nombre,SUM(pago_efectivo + pago_tarjeta) AS tVentas');
        $this->db->from('ventas');
        $this->db->join('tpv','ventas.id_tpv = tpv.id_tpv');
        $this->db->where('ventas.id_empresa', $this->session->userdata('id_empresa'));
        $this->db->group_by('ventas.id_tpv');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_masVendidos($operacion){
        $mesactual = date("m");
        $this->db->select("P.id_producto,P.codigo,CONCAT(P.producto, ' ',  P.cantidad_medida, P.medida)AS nombre, P.marca, P.tipo,  SUM(cantidad) AS cantidad");
        $this->db->from('stock');
        $this->db->join('productos AS P','stock.id_producto = P.id_producto', 'left');
        $this->db->where('P.id_empresa', $this->session->userdata('id_empresa'));
        $this->db->where('operacion LIKE', $operacion);
        $this->db->where('MONTH(stock.created_on)', $mesactual);
        $this->db->group_by('id_producto');
        $this->db->order_by('cantidad', 'desc');
        $this->db->limit('5');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_mayorMargen(){
        $mesactual = date("m");
        $this->db->select("Pro.id_producto,CONCAT(Pro.producto, ' ',  Pro.cantidad_medida, Pro.medida)AS nombre, Pro.marca, Pro.tipo,  Pre.producto_costo AS pc, 
Pre.`producto_precio_venta` AS pv, Pre.`producto_margen` AS pm");
        $this->db->from('productos AS Pro');
        $this->db->join('precios AS Pre','Pre.id_producto = Pro.id_producto', 'left');
        $this->db->where('Pro.id_empresa', $this->session->userdata('id_empresa'));
        //$this->db->where('operacion LIKE', $operacion);
        //$this->db->where('MONTH(Pre.precio_created_on)', $mesactual);
        $this->db->group_by('id_producto');
        $this->db->order_by('pm', 'desc');
        $this->db->limit('5');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    public function get_ventasMetodo(){
        $this->db->select('metodoPago, COUNT(metodoPago) AS metodo');
        $this->db->from('ventas');
        
        $this->db->where('ventas.id_empresa', $this->session->userdata('id_empresa'));
        $this->db->group_by('ventas.metodoPago');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_total($tpv = null){
        $this->db->select(' SUM(pago_efectivo + pago_tarjeta) AS tVentas , SUM(pago_efectivo) AS tventas_efectivo, SUM(pago_tarjeta) AS tventas_tarjeta');
        
        $this->db->from('ventas');
        
        if(isset($tipo)){
            $this->db->where('id_tpv', $tpv);
        }
        
        $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        $query = $this->db->get();
        return $query->row();
    }   

    

    public function get_proyeccion($operacion){
        $mesactual = date("m");
        $this->db->select('SUM(cantidad) as cantidad, CAST(created_on AS DATE) as fecha');
        $this->db->from('stock');
        $this->db->where('MONTH(created_on)=', $mesactual);
        $this->db->where('operacion',$operacion);
        
        $this->db->group_by('created_on');
        //$this->db->order_by(' created_on','asc');
        $query = $this->db->get();
        return $query->result();

    }

    public function get_stockBajo(){
        $mesactual = date("m");
        $this->db->select('stock.id_producto,  stock.stock_min, stock.stock_act , CAST(stock.`created_on` AS DATE)');
        $this->db->from('stock');
        $this->db->where('stock.stock_min > ', 'stock.stock_act' );
        //$this->db->where('operacion',$operacion);
        
        $this->db->group_by('stock.id_producto');
        //$this->db->order_by(' created_on','asc');
        $query = $this->db->get();
        return $query->result();

    }

    // public function update($where, $data)
    // {
    //     $this->db->update($this->table, $data, $where);
    //     //echo $this->db->last_query();
    //     return $this->db->affected_rows();
    // }

    // public function delete_by_id($id)
    // {
    //     $this->db->where('id_marca', $id);
    //     $this->db->delete($this->table);
    // }


    // // Add an item to the cart
    // function validate_add_cart_item(){
         
    //     $id = $this->input->post('product_id'); // Assign posted product_id to $id
    //     $cty = $this->input->post('quantity'); // Assign posted quantity to $cty
    //     $price = $this->input->post('price'); // Assign posted quantity to $cty
         
    //     $this->db->where('id_producto', $id); // Select where id matches the posted id
    //     $query = $this->db->get('productos', 1); // Select the products where a match is found and limit the query by 1
    //     // echo $this->db->last_query();
    //     //echo $price;
    //     // Check if a row has matched our product id
    //     if($query->num_rows() > 0){
         
    //     // We have a match!
    //         foreach ($query->result() as $row)
    //         {
    //             // Create an array with product information
    //             $data = array(
    //                 'id'      => $id,
    //                 'qty'     => $cty,
    //                 'price'   => $price,
    //                 'name'    => $row->producto . " " . $row->cantidad_medida . $row->medida . " - " . $row->especie
    //             );
    //      //var_dump($data);
    //     // exit();
    //             // Add the data to the cart using the insert function that is available because we loaded the cart library
    //             $this->cart->insert($data); 
                 
    //             return TRUE; // Finally return TRUE
    //         }
         
    //     }else{
    //         //echo "no entreo";
    //         // Nothing found! Return FALSE! 
    //         return FALSE;
    //     }
    // }


    // // Updated the shopping cart
    // function validate_update_cart(){
         
    //     // Get the total number of items in cart
    //    $total = $this->cart->total_items();
    //     //echo count($total); 
    //     // Retrieve the posted information
    //     $item = $this->input->post('rowid');
    //     $qty = $this->input->post('qty');
        
    //     if ($total > 0 ){
    //         // Cycle true all items and update them
    //         for($i=0;$i < $total;$i++)
    //         {
    //             // Create an array with the products rowid's and quantities. 
    //             $data = array(
    //                'rowid' => $item[$i],
    //                'qty'   => $qty[$i]
    //             );
                 
    //             // Update the cart with the new information
    //             $this->cart->update($data);
               
    //         }
    //         return TRUE;
    //     }else{
    //         return FALSE;
    //     }
     
    // }




}
