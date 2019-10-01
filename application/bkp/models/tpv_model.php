<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tpv_model extends CI_Model {

    var $table = 'tpv';
    var $table_venta = 'ventas';
    

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_tpv($id = null){
    	$this->db->from('tpv');
        if(isset($id)){
            $this->db->where('id_tpv', $id);
        }
    	$query = $this->db->get();
    	return $query->result();
    }   

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function save_compra($cliente , $pago , $detalles, $tpv)
    {
       // var_dump($pago);
        $this->db->insert($this->table_venta, array_merge($cliente, $pago));
        $id_venta = $this->db->insert_id();
        
       //$this->db->where('id_venta', $id_venta);
        foreach ($detalles as $detalle) {
            $carrito['id_venta'] = $id_venta;
            $carrito['id_producto'] = $detalle['id'];
            $carrito['cant_producto'] = $detalle['qty'];
            $carrito['descripcion'] = $detalle['name'];
            $carrito['precio'] = $detalle['price'];
            $carrito['importe'] = $detalle['subtotal'];
            //var_dump($carrito);
            $this->db->insert('ventas_detalle', $carrito);

            $stock = $this->_get_stock($detalle['id'], $tpv);
            $nueva_cantidad = ($stock->stock_act - $detalle['qty']);

            $user = $this->ion_auth->user()->row();
            $stock_data = array(
                'id_producto' => $detalle['id'],
                'stock_act'   => $nueva_cantidad,
                'stock_min'   => $stock->stock_min,
                'cantidad'    => $detalle['qty'],
                'id_tpv'      => $tpv,
                'operacion'   => 'egreso',
                'observacion' => 'Egreso por venta',
                'created_on'  => date("Y-m-d", now()),
                'usuario'     => $user->first_name. ", ".$user->last_name,
                );

            $this->db->insert('stock', $stock_data);
            /*****
            consulta donde actualiza o descuenta la cantidad de productos en stock
            
            ******/


        }
        return $id_venta;
        //$this->db->insert('ventas_detalles', $detalle['']);

    }

    public function update_compra($pago , $id_venta)
    {
       // var_dump($pago);
        $this->db->where('id_venta', $id_venta);
        $this->db->update($this->table_venta,  $pago);
        //$id_venta = $this->db->insert_id();
        return TRUE;
        //$this->db->insert('ventas_detalles', $detalle['']);

    }

    public function _get_stock($id, $tpv = null)
    {
        $this->db->select('stock_act, stock_min');
        $this->db->from('stock');
        $this->db->where('id_producto',$id);
        if ($tpv ){
            $this->db->where('id_tpv',$tpv);
        }
        $this->db->order_by('id_stock','desc');
        $query = $this->db->get();
        return $query->row();
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


    // Add an item to the cart
    function validate_add_cart_item(){
         
        $id = $this->input->post('product_id'); // Assign posted product_id to $id
        $cty = $this->input->post('quantity'); // Assign posted quantity to $cty
        $price = $this->input->post('price'); // Assign posted quantity to $cty
         
        $this->db->where('id_producto', $id); // Select where id matches the posted id
        $query = $this->db->get('productos', 1); // Select the products where a match is found and limit the query by 1
        // echo $this->db->last_query();
        //echo $price;
        // Check if a row has matched our product id
        if($query->num_rows() > 0){
         
        // We have a match!
            foreach ($query->result() as $row)
            {
                // Create an array with product information
                $data = array(
                    'id'      => $id,
                    'qty'     => $cty,
                    'price'   => $price,
                    'name'    => $row->producto . " " . $row->cantidad_medida . $row->medida . " - " . $row->especie
                );
         //var_dump($data);
        // exit();
                // Add the data to the cart using the insert function that is available because we loaded the cart library
                $this->cart->insert($data); 
                 
                return TRUE; // Finally return TRUE
            }
         
        }else{
            //echo "no entreo";
            // Nothing found! Return FALSE! 
            return FALSE;
        }
    }


    // Updated the shopping cart
    function validate_update_cart(){
         
        // Get the total number of items in cart
       $total = $this->cart->total_items();
        //echo count($total); 
        // Retrieve the posted information
        $item = $this->input->post('rowid');
        $qty = $this->input->post('qty');
        
        if ($total > 0 ){
            // Cycle true all items and update them
            for($i=0;$i < $total;$i++)
            {
                // Create an array with the products rowid's and quantities. 
                $data = array(
                   'rowid' => $item[$i],
                   'qty'   => $qty[$i]
                );
                 
                // Update the cart with the new information
                $this->cart->update($data);
               
            }
            return TRUE;
        }else{
            return FALSE;
        }
     
    }




}
