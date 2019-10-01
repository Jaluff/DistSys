<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mascotas extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('mascotas_model','mascotas');
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

    }

    public function ajax_add()
    {
        $data = array(
            'id_cliente' => $this->input->post('id_cli'),
            'mas_nombre' => $this->input->post('nombre_mascota'),
            'mas_especie' => $this->input->post('especie'),
            'mas_raza' => $this->input->post('raza'),
            'mas_sexo' => $this->input->post('sexo'),
            'mas_fecha_nac' => date("Y-m-d", strtotime($this->input->post('fecha_nacimiento'))) ,
            'mas_created_on' => date("Y-m-d", now()),
            'mas_peso' => $this->input->post('peso'),
            'mas_chip' => $this->input->post('chip'),
            'mas_observaciones' => $this->input->post('observaciones'),
            'mas_castrada' => $this->input->post('castrada'),
            );

        $insert = $this->mascotas->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id)
    {
        $data = $this->mascotas->get_by_id($id);

        echo json_encode($data);

    }

    public function ajax_update_mascota()
    {
        
        $data = array(
            'mas_nombre' => $this->input->post('nombre_mascota'),
            'mas_especie' => $this->input->post('especie'),
            'mas_raza' => $this->input->post('raza'),
            'mas_sexo' => $this->input->post('sexo'),
            'mas_fecha_nac' => date("Y-m-d", strtotime($this->input->post('fecha_nacimiento'))) ,
            'mas_created_on' => date("Y-m-d", now()),
            'mas_peso' => $this->input->post('peso'),
            'mas_chip' => $this->input->post('chip'),
            'mas_observaciones' => $this->input->post('observaciones'),
            'mas_castrada' => $this->input->post('castrada'),
        );
        //var_dump($this->input->post());
        //var_dump($data);

        $data = $this->mascotas->update(array('id' => $this->input->post('id_cli')), $data);
        
        echo json_encode(array("status" =>  $data));

    }

    public function ajax_delete($id)
    {
        $data = $this->mascotas->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

//    public function listar()
//  	{
//    if ($this->input->post('idCliente')){
//        $id = $this->input->post('idCliente');
//        $list = $this->mascotas->get_by_cliente_id($id);
//    }else{
//        $list = $this->mascotas->get_datatables();
//    }
//
//    //$list = $this->mascotas->get_datatables();
//        $data = array();
//        $no = $_POST['start'];
//        foreach ($list as $mascota) {
//            $no++;
//            $row = array();
//            $row['codigo'] = $mascota->id;
//            $row['nombre'] = $mascota->mas_nombre;
//            $row['especie'] = $mascota->mas_especie;
//            $row['raza'] = $mascota->mas_raza;
//            $row['sexo'] = $mascota->mas_sexo;
//            $row['peso'] = $mascota->mas_peso;
//            $row['desde'] = date("d-m-Y", strtotime($mascota->mas_created_on));
//
//
//            //add html for action
//            $row['Acciones'] = '
//            <div class="btn-group btn-group-sm">
//            <a class="btn btn-md btn-warning" href="javascript:void(0)" title="Edit" onclick="editar_cliente('."'".$mascota->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
//            <a class="btn btn-md btn-danger" href="javascript:void(0)" title="Eliminar" onclick="delete_cliente('."'".$mascota->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>
//            </div>
//            ';
//
//            $data[] = $row;
//        }
//
//        $output = array(
//                        "draw" => $_POST['draw'],
//                        "recordsTotal" => $this->mascotas->count_all(),
//                        "recordsFiltered" => $this->mascotas->count_filtered(),
//                        "data" => $data,
//                );
//        //output to json format
//        echo json_encode($output);
//
//  	}

    

}
/* End of file ControllerName.php */
/* Location: ./application/controllers/ControllerName.php */
  ?>
