<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentas_clientes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cuentas_clientes_model','cuentas_clientes');
        $this->load->model('cliente_model','clientes');
        //$this->load->library(array('form_validation', 'email'));
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
        $this->data['clientes'] = $this->clientes->get_clientes();
        $this->load->view('cuentas/cuentas_cliente_view', $this->data);
    }

    public function ajax_list()
    {
        $entidad = $this->input->post('cliente');
        $fecha = $this->input->post('fecha') ;//== '') ? $this->_data_first_month_day() : date('Y-m-d', strtotime($this->input->post('fecha')));
        $fecha_fin = $this->input->post('fecha_fin'); // == '') ? $this->_data_last_month_day() : date('Y-m-d', strtotime($this->input->post('fecha_fin')));
        $list = $this->cuentas_clientes->get_datatables($entidad, $fecha, $fecha_fin);
        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cuenta) {
            $no++;
            $row = array();
            $row[0] = NULL;
            $row['id'] = $cuenta->id_venta;
            $row['documento_asociado'] = $cuenta->metodoPago;
            $row['entidad'] = $cuenta->entidad_nombre;
            $row['importe'] = $cuenta->importe_total;
            $row['importe_recibido'] = $cuenta->importe_recibido;
            $row['saldo'] = $cuenta->importe_saldo;
            $row['tipo'] = $cuenta->tipo;
            $row['created_on'] = $cuenta->fecha;
            $row['Acciones'] = '
            <div class="btn-group btn-group-sm"><a class="btn  btn-info" href="'.base_url().'ventas/ver_venta/'. $cuenta->id_venta .'" title="Ver venta" ><i class="glyphicon glyphicon-eye-open"></i></a></div>';
            $data[] = $row;
        }
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->cuentas_clientes->count_all(),
                        "recordsFiltered" => $this->cuentas_clientes->count_filtered(),
                        "data" => $data,
                );
        echo json_encode($output);
    }

    public function ajax_add()
    {  
        //var_dump($this->input->post);
        $insert = 0;
        $data = array(
            'cuenta_fecha' => $this->session->userdata('id_empresa'),
            'id_entidad' => $this->input->post('id_entidad'),
            'documento_asociado' => $this->input->post('documento_asociado'),
            'importe'  => $this->input->post('importe'),
            'saldo'  => $this->input->post('saldo'),
            'entidad'  => $this->input->post('entidad'),
            'created_on'  => date("Y-m-d", now()),
            );
        $insert = $this->cuentas->save($data);
        
        if(isset($insert) && $insert > 0 )
        echo json_encode(array("status" => TRUE));
        else
        echo json_encode(array("status" => FALSE));
    }

}