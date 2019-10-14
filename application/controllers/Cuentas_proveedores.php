<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentas_proveedores extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cuentas_proveedor_model','cuentas_proveedor');
        $this->load->model('proveedor_model','proveedores');
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
        $this->data['proveedores'] = $this->proveedores->get_proveedores();
        $this->load->view('cuentas/cuentas_proveedor_view', $this->data);
    }

    //  public function ajax_update()
    // {
    //     $id = $this->input->post('id_categoria');
    //     $data = array(
    //         'categoria_nombre' => $this->input->post('categoria_nombre'),
    //         'categoria_estado' => $this->input->post('categoria_estado'),
    //     );
    //     $data = $this->categorias->update(array('id_categoria' => $id), $data);
    //     echo json_encode(array("status" => TRUE));
    // }

    public function ajax_list()
    {
        $entidad = $this->input->post('proveedor');
        $fecha = $this->input->post('fecha') ;//== '') ? $this->_data_first_month_day() : date('Y-m-d', strtotime($this->input->post('fecha')));
        $fecha_fin = $this->input->post('fecha_fin'); // == '') ? $this->_data_last_month_day() : date('Y-m-d', strtotime($this->input->post('fecha_fin')));
        $list = $this->cuentas_proveedor->get_datatables($entidad, $fecha, $fecha_fin);
        
        // var_dump($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cuenta) {
            $no++;
            $row = array();
            $row[0] = NULL;
            //$row['id_producto'] = $producto->id;
            $row['id'] = $cuenta->id_compra;
            $row['documento_asociado'] = $cuenta->factura_numero;
            $row['entidad'] = $cuenta->entidad_nombre;
            $row['importe'] = $cuenta->importe_total;
            $row['importe_recibido'] = $cuenta->importe_recibido;
            $row['saldo'] = $cuenta->importe_saldo;
            $row['created_on'] = $cuenta->compra_created_on;
            $row['Acciones'] = '
            <div class="btn-group btn-group-sm">
            <a class="btn  btn-info" href="'.base_url().'compras/ver_compra/'. $cuenta->id_compra .'" title="Ver compras" >
                <i class="glyphicon glyphicon-eye-open"></i> 
            </a>
            
            </div>
            ';
            $data[] = $row;
        }
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->cuentas_proveedor->count_all(),
                        "recordsFiltered" => $this->cuentas_proveedor->count_filtered(),
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

    public function ajax_edit($id)
    {
        //$data = [];

        $data_datos =  $this->categorias->get_categoria_by_id($id);

        //$data =  (object)array_merge((array)$data_datos);

        echo json_encode($data_datos);

    }

    public function ajax_delete($id)
    {
        $this->categorias->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _data_last_month_day() { 
        $month = date('m');
        $year = date('Y');
        $day = date("d", mktime(0,0,0, $month+1, 0, $year));
        return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
    }

    /** Actual month first day **/
    private function _data_first_month_day() {
        $month = date('m');
        $year = date('Y');
        return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
    }

}
