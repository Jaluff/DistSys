<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cuentas_model','cuentas');
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
        // $this->data['cuentas'] = $this->cuentas->get_cuentas();
        $this->load->view('cuentas/cuentas_view');//, $this->data);
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
        $list = $this->cuentas->get_datatables();
        var_dump($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cuenta) {
            $no++;
            $row = array();
            $row[0] = NULL;
            //$row['id_producto'] = $producto->id;
            $row['id'] = $cuenta->id;
            $row['documento_asociado'] = $cuenta->documento_asociado;
            $row['entidad'] = $cuenta->entidad_nombre;
            $row['importe'] = $cuenta->importe;
            $row['saldo'] = $cuenta->saldo_total;
            $row['created_on'] = $cuenta->created_on;
            $row['Acciones'] = '
            <div class="btn-group btn-group-sm">
            <a class="btn btn-md btn-info" href="javascript:void(0)" title="Editar categoria" onclick="editar_categoria('."'".$cuenta->id."'".')"><i class="glyphicon glyphicon-eye-open"></i> </a>
            
            </div>
            ';
            $data[] = $row;
        }
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->cuentas->count_all(),
                        "recordsFiltered" => $this->cuentas->count_filtered(),
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

}
