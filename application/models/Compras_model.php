<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Compras_model extends CI_Model
{

    var $table_compras = 'compras';
    //var $table_precios = 'precios';
    //var $table_compras_query = '(SELECT * FROM `compras`  ORDER BY `fecha_compra` DESC  ) AS `compras`';
    //var $table_estimacion = 'estimacion';
    //var $table_marcas = 'marca';
    var $table_proveedores = 'proveedores';
    var $column_order =  array('id_compra', 'compras.id_proveedor', 'fecha_compra', 'usuario', 'estado', null); //set column field database for datatable orderable
    var $column_search = array('compras.estado', 'compras.usuario', 'compras.fecha_compra'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('fecha_compra' => 'asc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query($tpv = null, $fecha = null, $fecha_fin = null)
    {

        $this->db->select('compras.*, proveedores.prov_nombre');
        $this->db->from($this->table_compras);
        $this->db->join($this->table_proveedores, " $this->table_compras.id_proveedor = $this->table_proveedores.id_proveedor", 'left');

        $i = 0;

        foreach ($this->column_search as $item) // loop column
            {

                //if($_POST['search']['value']) // if datatable send POST for search
                // {

                if ($i === 0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                //}
                $i++;
            }
        $this->db->where('compras.id_empresa', $this->session->userdata('id_empresa'));

        if (isset($tpv) && $tpv != ' ') {
            $this->db->where('compra_id_tpv', $tpv);
        }

        if (isset($fecha) && $fecha != '' && !isset($fecha_fin)) {
            $this->db->where('fecha_compra', $fecha);
        }

        if ((isset($fecha) && $fecha != '') && (isset($fecha_fin) && $fecha_fin != '')) {
            $this->db->where('fecha_compra >=', $fecha);
            $this->db->where('fecha_compra <=', $fecha_fin);
        }

        if (isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else if (isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
    }

    function get_datatables($tpv = null, $fecha = null, $fecha_fin = null)
    {
        $this->_get_datatables_query($tpv,  $fecha, $fecha_fin);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        //$this->db->group_by('stock.id_producto');
        $query = $this->db->get();
        //echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $query->result();
    }

    function count_filtered($tpv, $fecha = null, $fecha_fin = null)
    {
        $this->_get_datatables_query($tpv, $fecha, $fecha_fin);
        $this->db->group_by('compras.id_compra');
        $query = $this->db->get();
        //echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->where('compras.id_empresa', $this->session->userdata('id_empresa'));
        $this->db->from($this->table_compras);
        //echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        // $this->db->from($this->table_compras);
        $this->db->where('compras.id_compra', $id);
        $query = $this->db->get($this->table_compras, 1);
        return $query->row();
    }

    public function get_stock($id, $tpv = null)
    {
        $this->db->select('stock_act, stock_min');
        $this->db->from('stock');
        //$this->db->where('id_compra',$id);
        if (isset($tpv)) {
            $this->db->where('id_tpv', $tpv);
        }
        $this->db->order_by('id_stock', 'desc');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            //echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
            return $query->result();
        } else {
            return false;
        }
    }

    // public function get_compra($id)
    // {
    //     $this->db->from($this->table_compras);
    //     $this->db->where('id_compra',$id);
    //     $query = $this->db->get();
    //     return $query->row_object();
    // }

    public function get_compras_detalles($id){

        $this->db->select('compras_detalle.*, productos.producto, medida, cantidad_medida, codigo');
        $this->db->from('compras_detalle');
        $this->db->join('productos', " compras_detalle.id_producto = productos.id_producto");
        $this->db->where('id_compra',$id);
        $query = $this->db->get();
        //echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $query->result();

    }

    public function get_proveedores($id = null)
    {
        $this->db->from('proveedores');
        $this->db->join('provincias', " proveedores.prov_provincia = provincias.id");
        $this->db->where('proveedores.id_empresa', $this->session->userdata('id_empresa'));
        $this->db->where('proveedores.prov_estado', 'Activo');
        if(isset($id) && $id != ''){
            $this->db->where('proveedores.id_proveedor', $id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    // public function save($id_producto, $data_precio, $data_stock)
    // {

    //     $this->db->set('id_producto', $id_producto);
    //     $this->db->insert($this->table_precios, $data_precio);
    //     //echo $this->db->last_query();
    //     $this->db->set('id_producto', $id_producto);
    //     $this->db->insert('stock', $data_stock);
    //     //echo $this->db->last_query();       
    //     return $this->db->insert_id();
    // }


    public function save_compra($datos_compra , $datos_pago = null , $detalles, $id_compra = null, $estado, $tpv, $numero_compra)
    {
        if(isset($id_compra) && $id_compra != ''){
            $this->db->where('id_compra', $id_compra);
            $this->db->update($this->table_compras, $datos_compra);
        }else{
            $datos_compra['numero_compra'] = $numero_compra; 
            $this->db->insert($this->table_compras, $datos_compra);
            $id_compra = $this->db->insert_id();
        }

        if($datos_pago){
            $this->db->where('id_compra', $id_compra);
            $this->db->update($this->table_compras, $datos_pago);
        }

        $this->db->delete('compras_detalle', array( 'id_compra' => $id_compra));
        
        for ($i=0; $i < count($detalles['id_producto']); $i++){
            $carrito['id_compra']   = $id_compra;
            $carrito['num_detalle'] = $i;
            $carrito['id_producto'] = $detalles['id_producto'][$i];
            $carrito['cantidad']    = $detalles['cantidad'][$i];
            $carrito['precio']      = $detalles['precio'][$i];
            $carrito['sub_total']   = $detalles['importe'][$i];
            $this->db->insert('compras_detalle', $carrito);
            if($estado == 'Aprobada'){
                // echo "entro"; exit();
                $this->update_stock_compra( $detalles['cantidad'][$i] , $tpv , $detalles['id_producto'][$i] );
            }
            
            $where = array('id_producto' => $detalles['id_producto'][$i], 'id_proveedor' => $datos_compra['id_proveedor']);
            $this->db->select('id');
            $this->db->where($where);
            $query = $this->db->get('proveedor-producto');
            // echo $this->db->last_query();
            if ($query->num_rows() > 0) {
                $id = $query->row();
                $this->db->where('id', $id->id );
                $this->db->update(
                    'proveedor-producto', 
                    array(  'id_producto' => $detalles['id_producto'][$i], 'id_proveedor' => $datos_compra['id_proveedor'], 'created_on' => date("Y-m-d H:i", now()) )
                );
            }else{
                $this->db->insert(
                    'proveedor-producto', 
                    array(  'id_producto' => $detalles['id_producto'][$i], 'id_proveedor' => $datos_compra['id_proveedor'], 'created_on' => date("Y-m-d H:i", now()) )
                );
            }
              
// echo $id->id. "dsfdsfasfsaf";
        }
        return $id_compra;
    }


    public function update_stock_compra($cantidad, $id_tpv, $id_producto){//$id_compra, $detalles, $total, $estado){
        // $compra = $this->get_by_id($id_compra);
        // $id_tpv = $compra->compra_id_tpv;
        // $count_detalles =  count($detalles['id_producto']);
        // /* actualica la compra */
        // $this->db->set('estado', $estado);
        // $this->db->set('importe_total', $total);
        // $this->db->where('id_compra', $id_compra);
        // $this->db->update('compras');
        // //echo $this->db->last_query(). "\n";
        // $this->db->delete('compras_detalle', array( 'id_compra' => $id_compra));
        // //var_dump($detalles);
        // for ($i=0;$i<$count_detalles; $i++){
        //     $data['cantidad']    = $detalles['cantidad'][$i];
        //     $data['id_producto'] = $detalles['id_producto'][$i];
        //     $data['precio']      = $detalles['precio'][$i];
        //     $data['importe']     = $detalles['importe'][$i];

        //     $this->db->set('cantidad',  $data['cantidad'], false);
        //     $this->db->set('precio', $data['precio']);
        //     $this->db->set('sub_total' ,$data['importe']);
        //     $this->db->set('id_producto', $data['id_producto']);
        //     $this->db->set('id_compra', $id_compra);
        //     $this->db->insert('compras_detalle');
            //echo $this->db->last_query(). "\n";
           // $lastId = $this->db->insert_id();

            // if($estado == 'Aprobada'){
                    $this->db->set('stock_act', 'stock_act + '. $cantidad, false);
                    $this->db->set('stock.created_on', date("Y-m-d", now()));
                    $this->db->set('id_empresa', $this->session->userdata('id_empresa'));
                    $this->db->where('stock.id_tpv', $id_tpv);
                    $this->db->where('stock.id_producto', $id_producto);                    
                    $this->db->update('stock');
                    $row_cantidad =  $this->db->affected_rows();
                    if($row_cantidad == 0){
                        $this->db->set('stock_act',  $cantidad);
                        $this->db->set('stock_min',  '0' );
                        $this->db->set('stock.created_on', date("Y-m-d", now()));
                        $this->db->set('stock.id_producto', $id_producto);
                        $this->db->set('stock.id_tpv', $id_tpv);
                        $this->db->set('id_empresa', $this->session->userdata('id_empresa'));
                        $this->db->insert('stock');
                    }
                    // $this->db->insert('proveedor-producto', array(  'id_producto'  => $data['id_producto'],
                    //                                                 'id_proveedor' => $compra->id_proveedor,
                    //                                                 'created_on'   => date("Y-m-d", now()) )
                    //                                         );
            // }
        // }   
        return true; 
    }

    // public function delete_by_id($id)
    // {
    //     $this->db->where('id_cliente', $id);
    //     $this->db->delete($this->table);
    // }
    // public function update_compra($where, $data = null)
    public function numero_compra($numero = null )
    {
        if($numero){
            $this->db->where('numero_compra', $numero);
        }
        $this->db->select('numero_compra');
        $this->db->order_by('numero_compra', 'desc');
        $query = $this->db->get('compras', 1);
        if ($query->num_rows() > 0) {
            $numero_compra = $query->row();
            $numeroCompra = $numero_compra->numero_compra;
            $data = ++$numeroCompra;
        }else{
            $data = '1000';
        }
        return $data;
    }

    public function agrega_stock_tpv($id_producto, $cant, $tpv_o, $tpv_d, $stock_o, $stock_d, $stock_m, $usr)
    {
        $stock_resta = $stock_o - $cant;
        $stock_suma = $stock_d + $cant;
        $this->db->select('*');
        //$this->db->from('stock');
        $this->db->where('id_producto', $id_producto);
        $this->db->where('id_tpv', $tpv_o);
        $query_origen = $this->db->get('stock',1);
        if ($query_origen->num_rows() > 0) {
            $data = array(
                'stock_act' => $stock_resta,
            );
            $this->db->where('id_producto', $id_producto);
            $this->db->where('id_tpv', $tpv_o);
            $this->db->update('stock', $data  );
        }else{
            $registro = array(
                'id_producto'   =>  $id_producto,
                'stock_min'     =>  $stock_m,
                'stock_act'     =>  $stock_suma,
                'id_tpv'        =>  $tpv_o,
                'created_on'    =>  date("Y-m-d", now())
            );
            $this->db->insert('stock', $registro);
        }


        $this->db->where('id_producto', $id_producto);
        $this->db->where('id_tpv', $tpv_d);
        $query_destino = $this->db->get('stock',1);
        if ($query_destino->num_rows() > 0) {
            $data = array(
                'stock_act' => $stock_suma,
            );
            $this->db->where('id_producto', $id_producto);
            $this->db->where('id_tpv', $tpv_d);
            $this->db->update('stock', $data  );
        }else{
            $registro = array(
                'id_producto'   =>  $id_producto,
                'stock_min'     =>  $stock_m,
                'stock_act'     =>  $stock_suma,
                'id_tpv'        =>  $tpv_d,
                'created_on'    =>  date("Y-m-d", now())
            );
            $this->db->insert('stock', $registro);
        }



        // $this->db->set('id_producto', $id_producto);
        // $this->db->set('cantidad', $cant);
        // $this->db->set('stock_act', $stock_resta);
        // $this->db->set('stock_min', $stock_m);
        // $this->db->set('operacion', 'egreso');
        // $this->db->set('observacion', 'Egreso por movimiento de mercaderia');
        // $this->db->set('created_on', date("Y-m-d", now()));
        // $this->db->set('usuario', $usr);
        // $this->db->set('id_tpv', $tpv_o);
        // $this->db->insert('stock');
        // //echo $this->db->last_query();

        // $this->db->set('id_producto', $id_producto);
        // $this->db->set('cantidad', $cant);
        // $this->db->set('stock_act', $stock_suma);
        // $this->db->set('stock_min', $stock_m);
        // $this->db->set('operacion', 'Ingreso');
        // $this->db->set('observacion', 'Ingreso por movimiento de mercaderia');
        // $this->db->set('created_on', date("Y-m-d", now()));
        // $this->db->set('usuario', $usr);
        // $this->db->set('id_tpv', $tpv_d);
        // $this->db->insert('stock');

        //echo $this->db->last_query();       
        return true;
    }


    // Add an item to the cart
    // function validate_add_cart_item()
    // {
    //     $id = $this->input->post('product_id'); // Assign posted product_id to $id
    //     $cty = $this->input->post('quantity'); // Assign posted quantity to $cty
    //     $price = $this->input->post('price'); // Assign posted quantity to $cty
    //     $desc = $this->input->post('descuento');
    //     $this->db->where('id_producto', $id); // Select where id matches the posted id
    //     $query = $this->db->get('productos', 1); // Select the products where a match is found and limit the query by 1
    //     // echo $this->db->last_query();

    //     // Check if a row has matched our product id
    //     if ($query->num_rows() > 0) {

    //         // We have a match!
    //         foreach ($query->result() as $row) {
    //                 // Create an array with product information
    //                 $data = array(
    //                     'id'      => $id,
    //                     'qty'     => $cty,
    //                     'price'   => $price,
    //                     'name'    => $row->producto . " " . $row->cantidad_medida . $row->medida ,
    //                     'discount'   => $desc,
    //                 );
    //                 // Add the data to the cart using the insert function that is available because we loaded the cart library
    //                 $this->cart->insert($data);
    //                 return true; // Finally return TRUE
    //             }
    //     } else {
    //         // Nothing found! Return FALSE! 
    //         return false;
    //     }
    // }

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

    public function update_pago_compra($id_compra, $pago){//$id_compra, $detalles, $total, $estado){
        $this->db->where('id_compra', $id_compra);
        $this->db->update($this->table_compras, $pago);
        return $this->db->affected_rows();
    }

    // Updated the shopping cart
    // function validate_update_cart()
    // {

    //     // Get the total number of items in cart
    //     $total = $this->cart->total_items();
    //     // Retrieve the posted information
    //     $item = $this->input->post('rowid');
    //     $qty = $this->input->post('qty');
    //     $price = $this->input->post('precio');
    //     $desc = $this->input->post('descuento');
    //     if ($total > 0) {
    //         // Cycle true all items and update them
    //         for ($i = 0; $i < $total; $i++) {
    //                 // Create an array with the products rowid's and quantities. 
    //                 $data = array(
    //                     'rowid'      => $item[$i],
    //                     'qty'        => $qty[$i],
    //                     'price'      => $price[$i] - $desc[$i],
    //                     'discount'   => $desc[$i],
    //                 );
    //                 // Update the cart with the new information
    //                 $this->cart->update($data);
    //             }
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    

    // function validate_delete_item(){
    //     $item = $this->input->post('id');
    //     $qty = 0;

    //     $data = array (
    //         'rowid' => $item,
    //         'qty'   => $qty
    //     );
    //     //print_r($data);
    //     if($this->cart->remove($item)){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }
}
