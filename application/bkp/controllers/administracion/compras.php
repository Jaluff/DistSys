<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('administracion/compras_model','compras');
        $this->load->model('proveedor_model','proveedores');
        $this->load->model('producto_model','productos');
        $this->load->model('tpv_model','tpvs');
        $this->load->library('form_validation');
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
        $this->data['proveedores'] = $this->compras->get_proveedores();
        $this->data['tpv'] = $this->tpvs->get_tpv();
        
        //var_dump($this->data);
        $this->load->view('administracion/compras_view', $this->data);
    }

    

    public function nueva_compra()
    {
        $this->output->set_template('default');
        $this->load->helper('url');
        $this->data['proveedores'] = $this->compras->get_proveedores();
        $this->data['productos'] = $this->productos->get_productos();
        //var_dump($this->data);
        $this->load->view('administracion/form_compras', $this->data);
    }

    public function get_producto_precio(){
        $id = $this->input->post('id');
        $precio = $this->productos->get_precio_by_id($id);
        echo json_encode($precio);
    }

    public function get_producto_stock(){
        $id = $this->input->post('id');
        $tpv = $this->input->post('tpv');
        $stock = $this->productos->get_stock($id, $tpv);

        echo json_encode($stock);
    }
    public function ajax_list()
    {
        $tpv = $this->input->post('tpv');
        $list = $this->compras->get_datatables();
        //echo $list['id_producto'];
        
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
            //echo $stock;
            $row['id_precio'] = $producto->producto_precio_venta;
            $row['estado'] = $producto->estado;
            //$row['id_estimacion'] = $producto->id_estimacion;
            $row['created_on'] = date("d-m-Y", strtotime($producto->created_on));
            
            //var_dump($marcas); 
            //add html for action
            $row['Acciones'] = '
            <div class="btn-group btn-group-sm">
            <a class="btn btn-md btn-info" href="javascript:void(0)" title="Agregar stock" onclick="editar_compra('.$producto->id.','.$tpv.' )"><i class="glyphicon glyphicon-plus"></i> </a>
            
            <a class="btn btn-md btn-warning" href="javascript:void(0)" title="Movimiento de stock" 
            onclick="movimiento_stock('.$producto->id.','.$tpv.' )"><i class="glyphicon glyphicon-share"></i> </a>
            </div>
            ';

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
            $usuario = $user->first_name. ", ".$user->last_name;
            //$stock_creted_on = date("Y-m-d", now());
        //    );





        if( $this->compras->agrega_stock_tpv($id_producto, $cantidad, $tpv_origen, $tpv_destino,$stock_origen,$stock_destino, $stock_minimo,$usuario))
        {
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }

    public function ajax_update_stock()
    {
        
        $id_producto = $this->input->post('id_producto');
        $tpv = $this->input->post('tpv');
        $nuevo_stock = ($this->input->post('stock_act') + $this->input->post('cant'));
        $stock_minimo = $this->input->post('stock_min');
        $stock_obs = ($this->input->post('stock_obs') == '') ? 'Ingreso por compra de producto' : $this->input->post('stock_obs');
        $cant = $this->input->post('cant');
        $user = $this->ion_auth->user()->row();
        $data_stock =  array(
            'stock_act' => $nuevo_stock,
            'stock_min' => $stock_minimo,
            'cantidad' => $cant,
            'id_tpv' => $tpv,
            'observacion' => $stock_obs,
            'created_on' => date("Y-m-d", now()),
            'usuario' => $user->first_name. ", ".$user->last_name,
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

        if( $data = $this->compras->save($id_producto,  $data_precio,$data_stock))
        {
            echo json_encode(array("status" => TRUE));
        }

    }

    public function ajax_edit($id, $tpv)
    {
        //$data = [];

        $data_producto =  $this->productos->get_by_id($id);

        $data_precio = $this->productos->get_precio_by_id($id);

        $data_stock = $this->compras->get_stock($id, $tpv);

        $data =  (object)array_merge((array)$data_producto, (array)$data_precio, (array)$data_stock);

        echo json_encode($data);

    }

    public function ajax_enviar_producto($id, $tpv)
    {

        $data_producto =  $this->productos->get_by_id($id);

        $data_tpv = $this->tpvs->get_tpv($tpv);

        $data_stock = $this->compras->get_stock($id, $tpv);

        $data =  (object)array_merge((array)$data_producto, (array)$data_tpv, (array)$data_stock);

        echo json_encode($data);

    }



}
