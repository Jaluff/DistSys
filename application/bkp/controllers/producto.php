<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('producto_model','productos');
        $this->load->model('proveedor_model','proveedores');
        $this->load->model('administracion/compras_model','compras');
        $this->load->model('tpv_model','tpvs');
        $this->load->library(array('form_validation', 'email'));
        $this->_init();
    }
    private function _init()
  	{
          if (!$this->ion_auth->logged_in())
  		{
  			// redirect them to the login page
  			redirect('auth/login', 'refresh');
  		}



  	}

    public function index()
    {
        $this->output->set_template('default');
        $this->load->helper('url');
        $this->data['marcas'] = $this->productos->get_marcas();
        $this->data['tipo'] = $this->productos->get_tipo();
        $this->data['medida'] = $this->productos->get_medidas();
        $this->data['especie'] = $this->productos->get_especie(); 
        $this->data['proveedores'] = $this->proveedores->get_proveedores();
        $this->data['productos'] = $this->productos->get_productos();
        $this->data['tpv'] = $this->tpvs->get_tpv(); 
        $this->load->view('productos/producto_view', $this->data);
    }

    public function ajax_list()
    {
         $tpv = $this->input->post('tpv');
        $list = $this->productos->get_datatables();
        //var_dump($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $producto) {
            $no++;
            $row = array();
            $row[0] = NULL;
            //$row['id_producto'] = $producto->id;
            $row['Codigo'] = $producto->codigo;
            $row['Producto'] = $producto->producto ." - <strong>(". $producto->cantidad_medida . $producto->medida . ")</strong>";
            $row['Descripcion'] = $producto->descripcion;
            $row['tipo'] = $producto->tipo;
            $row['marca'] = $producto->marca;
            $row['cod_barras'] = $producto->codigo_barras;
            $row['especie'] = $producto->especie;
            if ($stock = $this->compras->get_stock($producto->id,$tpv)){
                $row['Stock_minimo'] = $stock[0]->stock_min;
                $row['Stock_actual'] = $stock[0]->stock_act;
            }else{
                $row['Stock_minimo'] = 0;
                $row['Stock_actual'] = 0;
            }
            if ($precio = $this->productos->get_precio_by_id($producto->id)){
                $row['precio_venta'] = $precio->producto_precio_venta ;
            }
            $row['estado'] = $producto->estado;
            $row['medida'] = $producto->medida;
            $row['cantidad_medida'] = $producto->cantidad_medida;
            //$row['id_estimacion'] = $producto->id_estimacion;
            $row['created_on'] = date("d-m-Y", strtotime($producto->created_on));
            
            //var_dump($marcas); 
            //add html for action
            if ($this->ion_auth->is_admin()){
                $row['Acciones'] = '
                <div class="btn-group btn-group-sm">
                <a class="btn btn-md btn-warning" href="javascript:void(0)" title="Edit" onclick="editar_producto('."'".$producto->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
                <a class="btn btn-md btn-danger" href="javascript:void(0)" title="Eliminar" onclick="delete_producto('."'".$producto->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>
                </div>
                ';
            }else{
                $row['Acciones'] = '';
            }

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->productos->count_all(),
                        "recordsFiltered" => $this->productos->count_filtered(),
                        "data" => $data,
                        
                );

        echo json_encode($output);
    }

    public function ajax_edit($id, $tpv = null)
    {
        //$data = [];

        $data_producto =  $this->productos->get_by_id($id);

        $data_precio = $this->productos->get_precio_by_id($id);

        $data_estimacion = $this->productos->get_estimacion_by_id($id);

        $data_stock = $this->productos->get_stock($id, $tpv);

        $data =  (object)array_merge((array)$data_producto, (array)$data_precio, (array)$data_estimacion, (array)$data_stock);

        echo json_encode($data);

    }

    public function ajax_add()
    {  
        $data_producto = array(
            'id_producto' => '',
            'producto' => $this->input->post('producto'),
            'codigo' => $this->input->post('codigo'),
            'codigo_barras' => $this->input->post('codigo_barras'),
            'descripcion' => $this->input->post('descripcion'),
            'stock_minimo' => $this->input->post('stock_minimo'),
            'stock_actual' => $this->input->post('stock_actual'),
            'estado' => $this->input->post('estado'),
            'created_on' => date("Y-m-d", now()),
            'tipo' => $this->input->post('tipo'),
            'especie' => $this->input->post('especie'),
            'marca' => $this->input->post('marca'),
            'medida' => $this->input->post('medida'),
            'cantidad_medida' => $this->input->post('cantidad'),
            'id_empresa' =>$this->session->userdata('id_empresa')
            );

        $data_precio =  array(
            'producto_costo' => $this->input->post('costo'),
            'impuestos' => $this->input->post('impuesto'),
            'producto_margen' => $this->input->post('margen_principal'),
            //'producto_margen_tres' => $this->input->post('margen_descuento2'),
            'producto_con_margen' => $this->input->post('pv_principal'),
            'producto_precio_venta' => $this->input->post('pv_iva'),
            //'producto_venta_tres' => $this->input->post('pv_descuento2'),
            'precio_created_on' => date("Y-m-d", now()),
            );


        $data_estimacion = array(            
            'estimacion_small' => $this->input->post('estimacion_small'),
            'estimacion_medium' => $this->input->post('estimacion_medium'),
            'estimacion_large' => $this->input->post('estimacion_large'),
            'estimacion_dias' => $this->input->post('cantidad_dias'),
            'estimacion_created_on' => date("Y-m-d", now()),
        );
        // var_dump($data_producto);
        // var_dump($data_precio);
        // var_dump($data_estimacion);

        $insert = $this->productos->save($data_producto, $data_precio, $data_estimacion );
        echo json_encode(array("status" => TRUE));
    }
    
    
    
    public function ajax_update()
    {
        
            $data_producto = array(
            'id_producto' => $this->input->post('id_producto'),
            'producto' => $this->input->post('producto'),
            'codigo' => $this->input->post('codigo'),
            'codigo_barras' => $this->input->post('codigo_barras'),
            'descripcion' => $this->input->post('descripcion'),
            'stock_minimo' => $this->input->post('stock_minimo'),
            'stock_actual' => $this->input->post('stock_actual'),
            'estado' => $this->input->post('estado'),
            'created_on' => date("Y-m-d", now()),
            'tipo' => $this->input->post('tipo'),
            'especie' => $this->input->post('especie'),
            'marca' => $this->input->post('marca'),
             'medida' => $this->input->post('medida'),
            'cantidad_medida' => $this->input->post('cantidad'),
            'id_empresa' =>$this->session->userdata('id_empresa')
            );
            //var_dump($data_producto);
        $data_precio =  array(
            'producto_costo' => $this->input->post('costo'),
            'impuestos' => $this->input->post('impuesto'),
            'producto_margen' => $this->input->post('margen_principal'),
            //'producto_margen_tres' => $this->input->post('margen_descuento2'),
            'producto_con_margen' => $this->input->post('pv_principal'),
            'producto_precio_venta' => $this->input->post('pv_iva'),
            //'producto_venta_tres' => $this->input->post('pv_descuento2'),
            'precio_created_on' => date("Y-m-d", now()),
            );


        $data_estimacion = array(            
            'estimacion_small' => $this->input->post('estimacion_small'),
            'estimacion_medium' => $this->input->post('estimacion_medium'),
            'estimacion_large' => $this->input->post('estimacion_large'),
            'estimacion_dias' => $this->input->post('cantidad_dias'),
            'estimacion_created_on' => date("Y-m-d h:i", now()),
        );

        $data = $this->productos->update(array('id_producto' => $this->input->post('id_producto')), $data_producto, $data_precio, $data_estimacion);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update_precios()
    {
        
           
        $data_precio =  array(
            'producto_costo' => $this->input->post('costo'),
            'impuestos' => $this->input->post('impuesto'),
            'producto_margen' => $this->input->post('margen_principal'),
            //'producto_margen_tres' => $this->input->post('margen_descuento2'),
            'producto_con_margen' => $this->input->post('pv_principal'),
            'producto_precio_venta' => $this->input->post('pv_iva'),
            //'producto_venta_tres' => $this->input->post('pv_descuento2'),
            'precio_created_on' => date("Y-m-d", now()),
            );


        if( $data = $this->productos->update_precios(array('id_producto' => $this->input->post('id_producto')),  $data_precio))
        {
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }

    public function ajax_update_stock()
    {
        
        $id_producto = $this->input->post('sel_producto');
        $nuevo_stock = ($this->input->post('stock_act') + $this->input->post('compra_cant'));
        $data_stock =  array(
         
            'stock_actual' => $nuevo_stock,
            
            );

        $user = $this->ion_auth->user()->row();
        $data_compra = array(
            'id_proveedor' => $this->input->post('compra_proveedor'),
            'numero_factura' => $this->input->post('factura_numero'),
            'fecha_factura' => date("Y-m-d h:i", strtotime($this->input->post('factura_fecha'))),
            'remito' => $this->input->post('remito'),
            'id_empresa' =>$this->session->userdata('id_empresa'),
            'usuario' =>$user->first_name. ", ".$user->last_name,
            //'estado' => $this->input->post('estado'),
            'compra_created_on' => date("Y-m-d h:i", now()),

            );

        if( $data = $this->productos->update_stock($id_producto,  $data_stock, $data_compra))
        {
            echo json_encode(array("status" => TRUE));
        }

    }

    public function ajax_delete($id)
    {
        $this->clientes->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_get_producto($id)
    {
        //$data = [];

        $data_datos =  $this->productos->get_by_id($id);

        

        $data =  (object)$data_datos;
//var_dump($data);
        echo json_encode($data);

    }

}
