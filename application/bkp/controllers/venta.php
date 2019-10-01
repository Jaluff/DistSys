<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venta extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('venta_model','ventas');
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
         $this->load->helper('url');
        $this->load->model('tpv_model','tpvs');
        $this->data['tpv'] = $this->tpvs->get_tpv(); 
        $this->data['ventas'] = $this->ventas->get_ventas(); 
        $this->load->view('tpv/ventas_view',  $this->data);
    }

	public function ajax_list()
    {
        $this->load->model('cliente_model','clientes');
        $tpv = $this->input->post('tpv');
        $fecha = ($this->input->post('fecha') == '') ? date ('Y-m-d' ,now()) : date ('Y-m-d' , strtotime($this->input->post('fecha')));
        $fecha_fin = ($this->input->post('fecha_fin') == '') ? date ('Y-m-d' ,now()) : date ('Y-m-d' , strtotime($this->input->post('fecha_fin')));
        //echo $fecha;
        $list = $this->ventas->get_datatables($tpv , $fecha, $fecha_fin);
       //var_dump($list);
        //exit();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $stk) {
            $no++;
            $row = array();
            //$row[0] = NULL;
            $cli = $this->clientes->get_by_id($stk->cliente);
            $row['id_venta'] = $stk->id_venta;
            $row['metodoPago'] = $stk->metodoPago;
            $row['cliente'] = $cli->cli_nombre;
            $row['tipo'] = ($stk->tipo == 'mostrador' ) ? '<span class="text-success"><strong>' . $stk->tipo . '</strong></span>' : '<span class="text-danger"><strong>' . $stk->tipo . '</strong></span>';
            $row['fecha'] = date("d-m-Y", strtotime($stk->fecha));
            $row['pago_efectivo'] = ($stk->pago_efectivo > 0) ? "$".$stk->pago_efectivo : '';
            
            $row['pago_tarjeta'] = ($stk->pago_tarjeta > 0 ) ? "$".$stk->pago_tarjeta : '';
           
            $row['estado'] = ($stk->estado == 'cobrada') ? '<h4><span class="label label-success">' . $stk->estado . '</span></h4>' : '<h4><span class="label label-danger">' . $stk->estado . '</span></h4>';
            $row['usuario'] = $stk->usuario;
            $row['cobrador'] = $stk->cobrador;
            
            //var_dump($marcas); 
            //add html for action
           //echo $stk->estado;
            $row['Acciones'] = '';
            if ($stk->estado == 'cobrada') {
            $row['Acciones'] .= '

            <div class="btn-group btn-group-md">
                <a class="btn btn-md btn-info" href="'.base_url().'venta/ver_venta/'.$stk->id_venta.'" title="Ver">
                    <i class="glyphicon glyphicon-eye-open"></i> 
                </a>
            </div>
            
            '
            ;
            }
            if ($stk->estado == 'no cobrada') {
              
                $row['Acciones'] .= '
                <div class="btn-group btn-group-md">
                <a class="btn btn-md btn-success" href="'.base_url().'venta/ver_venta/'.$stk->id_venta.'" title="Ver">
                    <i class="glyphicon glyphicon-usd"></i> 
                </a>
            </div>
                
                ';
            }

            $data[] = $row;
        }

        $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->ventas->count_all($tpv  , $fecha, $fecha_fin),
                "recordsFiltered" => $this->ventas->count_filtered($tpv  , $fecha, $fecha_fin),
                "data" => $data,
                        
                );

        echo json_encode($output);
    }

    public function ver_venta($idventa){
        $this->output->set_template('default');

        $this->data['ventas'] = $ventas = $this->ventas->get_venta($idventa);
        $this->data['detalles'] = $this->ventas->get_venta_detalles($idventa);
    
        $this->data['cliente'] = $this->ventas->get_cliente($ventas->cliente);
        $this->load->view('tpv/mostrarVenta_view',  $this->data);

    }
}