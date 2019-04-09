<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('stock_model','stock');
        $this->load->model('tpv_model','tpvs');
        $this->load->helper('url');
        $this->load->library(array('form_validation'));
        $this->_init();
    }
    private function _init()
  	{
          if (!$this->ion_auth->logged_in())
  		{
  			redirect('auth/login', 'refresh');
  		}
        
        
  	}

    public function index()
    {
        $this->output->set_template('default');
       // $this->data['movimientos'] = $this->stocks->get_movimientos();
        $this->data['tpv'] = $this->tpvs->get_tpv(); 
        $this->load->view('stock/stock_view',  $this->data);
    }

    public function movimientos_stock(){
        $this->output->set_template('default');
        $this->data['tpv'] = $this->tpvs->get_tpv();
        $this->load->view('stock/movimientos_stock', $this->data);

    }

    // public function ajax_update_stock()
    // {
    //     $id_producto = $this->input->post('id_producto');
    //     $tpv = $this->input->post('tpv');
    //     $operacion = $this->input->post('operacion');
    //     $cant = $this->input->post('cant');
    //     if ($operacion == 'Egreso') {
    //         $cant = $cant * (-1);
    //     }

    //     $nuevo_stock = ($this->input->post('stock_act') + $cant);
    //     $stock_minimo = $this->input->post('stock_min');
    //     $stock_obs = ($this->input->post('stock_obs') == '') ? 'Ingreso por compra de producto' : $this->input->post('stock_obs');

    //     $user = $this->ion_auth->user()->row();
    //     $data_stock =  array(
    //         'stock_act' => $nuevo_stock,
    //         'stock_min' => $stock_minimo,
    //         'cantidad' => $cant,
    //         'id_tpv' => $tpv,
    //         'operacion' => $operacion,
    //         'observacion' => $stock_obs,
    //         'created_on' => date("Y-m-d", now()),
    //         'usuario' => $user->first_name . ", " . $user->last_name,
    //     );

    //     $data_precio =  array(
    //         'producto_costo' => $this->input->post('costo'),
    //         'impuestos' => $this->input->post('impuesto'),
    //         'producto_margen' => $this->input->post('margen_principal'),
    //         //'producto_margen_tres' => $this->input->post('margen_descuento2'),
    //         'producto_con_margen' => $this->input->post('pv_principal'),
    //         'producto_precio_venta' => $this->input->post('pv_iva'),
    //         //'producto_venta_tres' => $this->input->post('pv_descuento2'),
    //         'precio_created_on' => date("Y-m-d", now()),
    //     );
    //     //$detalles = $this->cart->contents();
    //     if ($data = $this->compras->save($id_producto,  $data_precio, $data_stock)) {
    //             echo json_encode(array("status" => true));
    //         }
    // }


    public function ajax_send_stock()
    {
        //$data_precio =  array(
        $id_producto =  $this->input->post('idp');
        $cantidad = $this->input->post('cantidad');
        $tpv_origen = $this->input->post('tpv_origen');
        $tpv_destino = $this->input->post('tpv_destino');
        $stock_origen = $this->input->post('stock_origen');
        $stock_destino = $this->input->post('stock_destino');
        $stock_minimo = $this->input->post('stock_minimo');

        $user = $this->ion_auth->user()->row();
        $usuario = $user->first_name . ", " . $user->last_name;
        //$stock_creted_on = date("Y-m-d", now());
        //    );
        if ($this->stock->agrega_stock_tpv($id_producto, $cantidad, $tpv_origen, $tpv_destino, $stock_origen, $stock_destino, $stock_minimo, $usuario)) {
                echo json_encode(array("status" => true));
            } else {
            echo json_encode(array("status" => false));
        }
    }

    public function ajax_modifica_stock()
    {
        $user = $this->ion_auth->user()->row();

        $data_stock =  array(
        'id_producto'   =>  $this->input->post('idp'),
        'cantidad'      => $this->input->post('cantidad'),
        'tpv'           => $this->input->post('tpv'),
        'stock'         => $this->input->post('stock'),
        'stock_minimo'  => $this->input->post('stock_minimo'),
        'usuario'       => $user->first_name . ", " . $user->last_name
        );
        //var_dump($data_stock); exit(0);
        if ($this->stock->modifica_stock_tpv( $data_stock)) {
                echo json_encode(array("status" => true));
            } else {
            echo json_encode(array("status" => false));
        }
    }


    // public function ajax_update()
    // {
    //         $data = array(
                
    //             'prov_nombre' => $this->input->post('prov_nombre'),
    //             'prov_contacto' => $this->input->post('prov_contacto'),
    //             'prov_cuit' => $this->input->post('prov_cuit'),
    //             'prov_direccion' => $this->input->post('prov_direccion'),
    //             'prov_cp' => $this->input->post('prov_cp'),
    //             'prov_pais' => $this->input->post('prov_pais'),
    //             'prov_provincia' => $this->input->post('prov_provincia'),
    //             'prov_localidad' => $this->input->post('prov_localidad'),
    //             'prov_telefono' => $this->input->post('prov_telefono'),
    //             'prov_movil' => $this->input->post('prov_movil'),
    //             'prov_correo' => $this->input->post('prov_correo'),
    //             'prov_web' => $this->input->post('prov_web'),
    //             'prov_estado' => $this->input->post('prov_estado'),
    //             'prov_observaciones' => $this->input->post('prov_observaciones'),
    //         );
    //     $data = $this->proveedores->update(array('id_proveedor' => $this->input->post('id_proveedor')), $data);
    //     echo json_encode(array("status" => TRUE));
    // }


    public function ajax_list()
    {
        $tpv = $this->input->post('tpv');
        $list = $this->stock->get_datatables();
        //var_dump($list);
        //var_dump($stock);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $producto) {
            $no++;
            $row = array();
            $row[0] = NULL;
            //$row['id_producto'] = $producto->id;
            $row['Codigo'] = $producto->codigo;
            $row['Producto'] = $producto->producto ." - <strong>(". $producto->cantidad_medida . $producto->medida . ")</strong>";
            $row['Operacion'] = '';
            $row['categorias'] = $producto->categorias;
            $row['marca'] = $producto->marca;
            //$row['cod_barras'] = $producto->codigo_barras;
            //$row['especie'] = $producto->especie;
            if ($stock = $this->stock->get_stock($producto->id_producto,$tpv)){
                //var_dump($stock);
                $row['Stock_minimo'] = $stock['stock_min'];
                $row['Stock_actual'] = $stock['stock_act'];
            }else{
                $row['Stock_minimo'] = 0;
                $row['Stock_actual'] = 0;
            }
            $row['cantidad'] = $producto->marca;
            $row['usuario'] = '';
            //echo $stock;
//$row['id_precio'] = $producto->producto_precio_venta;
            //$row['estado'] = $producto->estado;
            //$row['id_estimacion'] = $producto->id_estimacion;
            $row['created_on'] = date("d-m-Y", strtotime($producto->created_on));
            
            //var_dump($marcas); 
            //add html for action
            $row['Acciones'] = '
            <div class="btn-group btn-group-sm">
            <a class="btn btn-md btn-info" href="javascript:void(0)" title="Modificar stock" 
            onclick="modifica_stock('.$producto->id_producto.','.$tpv.')"><i class="glyphicon glyphicon-edit"></i> </a>
            
            <a class="btn btn-md btn-warning" href="javascript:void(0)" title="Movimiento de stock" 
            onclick="movimiento_stock('.$producto->id_producto.','.$tpv.' )"><i class="glyphicon glyphicon-share"></i> </a>
            </div>
            ';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->stock->count_all($tpv),
                        "recordsFiltered" => $this->stock->count_filtered($tpv),
                        "data" => $data,
                        
                );

        echo json_encode($output);
    }

    // public function ajax_add()
    // {  
    //     //var_dump($this->input->post);
    //     $data = array(
    //             'id_empresa' => $this->session->userdata('id_empresa'),
    //             'prov_nombre' => $this->input->post('prov_nombre'),
    //             'prov_contacto' => $this->input->post('prov_contacto'),
    //             'prov_cuit' => $this->input->post('prov_cuit'),
    //             'prov_direccion' => $this->input->post('prov_direccion'),
    //             'prov_cp' => $this->input->post('prov_cp'),
    //             'prov_pais' => $this->input->post('prov_pais'),
    //             'prov_provincia' => $this->input->post('prov_provincia'),
    //             'prov_localidad' => $this->input->post('prov_localidad'),
    //             'prov_telefono' => $this->input->post('prov_telefono'),
    //             'prov_movil' => $this->input->post('prov_movil'),
    //             'prov_correo' => $this->input->post('prov_correo'),
    //             'prov_web' => $this->input->post('prov_web'),
    //             'prov_estado' => $this->input->post('prov_estado'),
    //             'prov_observaciones' => $this->input->post('prov_observaciones'),
    //             'prov_created_on' => date("Y-m-d" , now()),
    //         );

    //     $insert = $this->proveedores->save($data);
    //     echo json_encode(array("status" => TRUE));
    // }

    // public function ajax_edit($id)
    // {
    //     //$data = [];

    //     $data_datos =  $this->proveedores->get_by_id($id);

        

    //     $data =  (object)(array)$data_datos;

    //     echo json_encode($data);

    // }

    // public function ajax_delete($id)
    // {
    //     $this->proveedores->delete_by_id($id);
    //     echo json_encode(array("status" => TRUE));
    // }

    /**
    * @desc - devuleve un json con las poblaciones filtradas y el código postal de la primera
    */
    
    public function get_producto_stock(){
        $id = $this->input->post('id');
        $tpv = $this->input->post('tpv');
        $stock = $this->stock->get_stock($id, $tpv);

        echo json_encode($stock);
    }
    
    public function ajax_enviar_producto()
    {
        $id = $this->input->post('id');
        $tpv = $this->input->post('tpv');
        $this->load->model('producto_model', 'productos');
        $data_producto =  $this->productos->get_by_id($id);
        $data_tpv = $this->tpvs->get_tpv($tpv);
        
        $data_stock = $this->stock->get_stock($id, $tpv);
        $data =  array_merge(array($data_producto), $data_tpv, array($data_stock));
        echo json_encode($data);
    }
    
    public function getDepartamento()
    {     
        $provinciaId = $this->input->post('provinciaId');
        $dep = $this->input->post('dep');
            //obtenemos las poblaciones de esa provincia
        if($provinciaId && $dep){
            $localidades = $this->proveedores->getDepartamentos($provinciaId);
            echo "<option value='0'>Departamento</option> ";
            //var_dump($localidades);
            foreach ($localidades as $value) {
                if ($dep == $value->nombre){
                    echo "<option value='".$value->nombre."' selected>".$value->nombre."</option> ";
                }else{
                    echo "<option value='".$value->nombre."'>".$value->nombre."</option> ";    
                }
                
            }
        }else{
            echo "<option value='0'>Departamentoss</option> ";
        }    
    }

}
