<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marca extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('marca_model','marcas');
        $this->load->library(array('form_validation', 'email'));
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
        $this->data['marcas'] = $this->marcas->get_marcas();
        $this->load->view('marcas/marcas_view', $this->data);
    }

      public function ajax_update()
    {
        $id = $this->input->post('id_marca');
        $data = array(
            'marca_nombre' => $this->input->post('marca_nombre'),
            'marca_estado' => $this->input->post('marca_estado'),
        );
        $data = $this->marcas->update(array('id_marca' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_list()
    {
        $list = $this->marcas->get_datatables();
        //var_dump($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $marca) {
            $no++;
            $row = array();
            $row[0] = NULL;
            //$row['id_producto'] = $producto->id;
            $row['id_marca'] = $marca->id_marca;
            $row['marca_nombre'] = $marca->marca_nombre;
            $row['marca_estado'] = $marca->marca_estado;
            
            $row['Acciones'] = '
            <div class="btn-group btn-group-sm">
            <a class="btn btn-md btn-warning" href="javascript:void(0)" title="Editar Marca" onclick="editar_marca('."'".$marca->id_marca."'".')"><i class="glyphicon glyphicon-edit"></i> </a>
            <a class="btn btn-md btn-danger" href="javascript:void(0)" title="Eliminar Marca" onclick="eliminar_marca('."'".$marca->id_marca."'".')"><i class="glyphicon glyphicon-trash"></i> </a>
            </div>
            ';
            $data[] = $row;
        }
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->marcas->count_all(),
                        "recordsFiltered" => $this->marcas->count_filtered(),
                        "data" => $data,
                );
        echo json_encode($output);
    }

    public function ajax_add()
    {  
        //var_dump($this->input->post);
        $insert = 0;
        $data = array(
            'id_empresa' => $this->session->userdata('id_empresa'),
            'marca_nombre' => $this->input->post('marca_nombre'),
            'marca_estado' => $this->input->post('marca_estado'),
            );
        $insert = $this->marcas->save($data);
        if(isset($insert) && $insert > 0 )
        echo json_encode(array("status" => TRUE));
        else
        echo json_encode(array("status" => FALSE));
    }

    public function ajax_edit($id)
    {
        //$data = [];

        $data_datos =  $this->marcas->get_marca_by_id($id);

        //$data =  (object)array_merge((array)$data_datos);

        echo json_encode($data_datos);

    }

    public function ajax_delete($id)
    {
        $this->marcas->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

}
