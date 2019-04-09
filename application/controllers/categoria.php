<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class categoria extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('categoria_model','categorias');
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
        $this->data['categorias'] = $this->categorias->get_categorias();
        $this->load->view('categorias/categorias_view', $this->data);
    }

      public function ajax_update()
    {
        $id = $this->input->post('id_categoria');
        $data = array(
            'categoria_nombre' => $this->input->post('categoria_nombre'),
            'categoria_estado' => $this->input->post('categoria_estado'),
        );
        $data = $this->categorias->update(array('id_categoria' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_list()
    {
        $list = $this->categorias->get_datatables();
        //var_dump($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $categoria) {
            $no++;
            $row = array();
            $row[0] = NULL;
            //$row['id_producto'] = $producto->id;
            $row['id_categoria'] = $categoria->id_categoria;
            $row['categoria_nombre'] = $categoria->categoria_nombre;
            $row['categoria_estado'] = $categoria->categoria_estado;
            
            $row['Acciones'] = '
            <div class="btn-group btn-group-sm">
            <a class="btn btn-md btn-warning" href="javascript:void(0)" title="Editar categoria" onclick="editar_categoria('."'".$categoria->id_categoria."'".')"><i class="glyphicon glyphicon-edit"></i> </a>
            <a class="btn btn-md btn-danger" href="javascript:void(0)" title="Eliminar categoria" onclick="eliminar_categoria('."'".$categoria->id_categoria."'".')"><i class="glyphicon glyphicon-trash"></i> </a>
            </div>
            ';
            $data[] = $row;
        }
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->categorias->count_all(),
                        "recordsFiltered" => $this->categorias->count_filtered(),
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
            'categoria_nombre' => $this->input->post('categoria_nombre'),
            'categoria_estado' => $this->input->post('categoria_estado'),
            );
        $insert = $this->categorias->save($data);
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
