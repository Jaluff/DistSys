<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cliente_model','clientes');
        $this->load->model('mascotas_model','mascota');
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
        $this->load->view('usuarios/cliente_view');
    }

    public function ajax_list()
    {

        $list = $this->clientes->get_datatables();
        //var_dump($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cliente) {
            $no++;
            $row = array();
            $row[0] = NULL;
            $row['Codigo']      = $cliente->idcliente;
            $row['Nombre']      = $cliente->cli_nombre;
            $row['Telefono']    = $cliente->telefono1;
            $row['Movil']       = $cliente->movil1;
            $row['Documento']   = $cliente->cli_doc;
            $row['Correo']      = $cliente->correo1;
            $row['Tipo']        = $cliente->cli_tipo;
            $row['Direccion']   = $cliente->domicilio1;
            $row['Localidad']   = $cliente->localidad1;
            $row['Provincia']   = $cliente->provincia1;
            $row['Desde']       = date("d-m-Y", strtotime($cliente->cli_created_on));


            //add html for action
            if ($this->ion_auth->is_admin()){
                $row['Acciones'] = '
                    <div class="btn-group btn-group-sm">
                    <a class="btn btn-md btn-warning" href="javascript:void(0)" title="Edit" onclick="editar_cliente('."'".$cliente->idcliente."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
                    <a class="btn btn-md btn-danger" href="javascript:void(0)" title="Eliminar" onclick="delete_cliente('."'".$cliente->idcliente."'".')"><i class="glyphicon glyphicon-trash"></i> </a>
                    </div>
                    ';
                    // <a class="btn btn-md btn-info" title="Agregar mascota" onclick="add_mascota('.$cliente->idcliente.')"><i class="glyphicon glyphicon-plus"></i> </a>
                    // </div>
                    // ';
            }else{
                $row['Acciones'] = '
                    
                    
                    <a class="btn btn-sm btn-info" title="Agregar mascota" onclick="add_mascota('.$cliente->idcliente.')"><i class="glyphicon glyphicon-plus"></i> </a>
                    
                    ';
            }

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->clientes->count_all(),
                        "recordsFiltered" => $this->clientes->count_filtered(),
                        "data" => $data,
                );

        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        //$data = [];

        $data_datos =  $this->clientes->get_by_id($id);

        $data_contactos = $this->clientes->get_con_by_id($id);

        $data =  (object)array_merge((array)$data_datos, (array)$data_contactos);

        echo json_encode($data);

    }

    public function ajax_get_cliente($id =null)
    {
        //$data = [];
        $data_datos =  $this->clientes->get_by_id($id);
        $data =  (object)$data_datos;
        echo json_encode($data);
    }

    public function ajax_add()
    {  
        $data = array(
            'id_cliente' => '',
            'id_empresa' => $this->session->userdata('id_empresa'),
            'cli_sexo' => $this->input->post('sexo'),
            'cli_fecha_nac' => date("Y-m-d", strtotime($this->input->post('cli_fecha_nacimiento'))) ,
            'cli_lista_precios' => $this->input->post('cli_lista_precios'),
            'cli_doc' => $this->input->post('cli_documento'),
            'cli_nombre' => $this->input->post('cli_nombre'),
            'cli_tipo' => $this->input->post('cli_tipo'),
            'cli_estado' => $this->input->post('Activo'),
            'cli_created_on' => date("Y-m-d", now()),

            );

        $data_contacto = array(
            'telefono1' => $this->input->post('telefono1'),
            'telefono2' => $this->input->post('telefono2'),

            'domicilio1' => $this->input->post('direccion1'),
            'domicilio2' => $this->input->post('direccion2'),

            'localidad1' => $this->input->post('localidad1'),
            'localidad2' => $this->input->post('localidad2'),

            'pais1' => $this->input->post('pais1'),
            'pais2' => $this->input->post('pais2'),

            'provincia1' => $this->input->post('provincia1'),
            'provincia2' => $this->input->post('provincia2'),

            'cp1' => $this->input->post('cp1'),
            'cp2' => $this->input->post('cp2'),


            'movil1' => $this->input->post('telefono_movil1'),
            'movil2' => $this->input->post('telefono_movil2'),

            'correo1' => $this->input->post('correo1'),
            'correo2' => $this->input->post('correo2'),

            'infomail1' => $this->input->post('infomail1'),
            'infomail2' => $this->input->post('infomail2'),
        );
        //var_dump($data_contacto);

        $insert = $this->clientes->save($data,$data_contacto);
        echo json_encode(array("status" => TRUE));
    }
    
    
    
    public function ajax_update()
    {
        
            $data = array(
                'cli_telefono' => $this->input->post('cli_telefono'),
                'cli_movil' => $this->input->post('cli_movil'),
                'cli_correo' => $this->input->post('cli_correo'),
                'cli_sexo' => $this->input->post('sexo'),
                'cli_fecha_nac' => date("Y-m-d", strtotime($this->input->post('cli_fecha_nacimiento'))) ,
                'cli_lista_precios' => $this->input->post('cli_lista_precios'),
                'cli_doc' => $this->input->post('cli_documento'),
                'cli_nombre' => $this->input->post('cli_nombre'),
                'cli_tipo' => $this->input->post('cli_tipo'),
                'cli_estado' => $this->input->post('Activo'),
            );
        
            $data_contacto = array(
                'telefono1' => $this->input->post('telefono1'),
                'telefono2' => $this->input->post('telefono2'),

                'domicilio1' => $this->input->post('direccion1'),
                'domicilio2' => $this->input->post('direccion2'),

                'localidad1' => $this->input->post('localidad1'),
                'localidad2' => $this->input->post('localidad2'),

                'pais1' => $this->input->post('pais1'),
                'pais2' => $this->input->post('pais2'),

                'provincia1' => $this->input->post('provincia1'),
                'provincia2' => $this->input->post('provincia2'),

                'cp1' => $this->input->post('cp1'),
                'cp2' => $this->input->post('cp2'),


                'movil1' => $this->input->post('telefono_movil1'),
                'movil2' => $this->input->post('telefono_movil2'),

                'correo1' => $this->input->post('correo1'),
                'correo2' => $this->input->post('correo2'),

                'infomail1' => $this->input->post('infomail1'),
                'infomail2' => $this->input->post('infomail2'),
            );

        $data = $this->clientes->update(array('id_cliente' => $this->input->post('id_cliente')), $data, $data_contacto);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->clientes->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

}
