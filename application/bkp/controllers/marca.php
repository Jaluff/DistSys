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

    public function ajax_update()
    {
            $data = array(
                'marca' => $this->input->post('marca'),
            );
        $data = $this->marcas->update(array('marca' => $this->input->post('marca')), $data);
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
            $row['Codigo'] = $producto->codigo;
            
            
            //var_dump($marcas); 
            //add html for action
            $row['Acciones'] = '
            <div class="btn-group btn-group-sm">
            <a class="btn btn-md btn-danger" href="javascript:void(0)" title="Eliminar" onclick="delete_producto('."'".$producto->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>
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

    public function ajax_add()
    {  
        //var_dump($this->input->post);
        $data = array(
            'id_empresa' => $this->session->userdata('id_empresa'),
            'marca' => $this->input->post('nueva_marca'),
            );

        $insert = $this->marcas->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->marcas->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

}
