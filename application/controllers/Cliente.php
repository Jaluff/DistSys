<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cliente_model','clientes');
        // $this->load->model('mascotas_model','mascota');
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
            $row['Codigo']      = $cliente->id_cliente;
            $row['Nombre']      = $cliente->cli_nombre;
            $row['Telefono']    = $cliente->cli_telefono;
            $row['Movil']       = $cliente->cli_movil;
            $row['Cuit']        = $cliente->cli_cuit;
            $row['Correo']      = $cliente->cli_correo;
            $row['Tipo']        = $cliente->cli_tipo;
            $row['Direccion']   = $cliente->cli_direccion;
            $row['Localidad']   = $cliente->cli_localidad;
            $row['Provincia']   = $cliente->cli_provincia;
            $row['Desde']       = date("d-m-Y", strtotime($cliente->cli_created_on));


            //add html for action
            if ($this->ion_auth->is_admin()){
                $row['Acciones'] = '
                    <div class="btn-group btn-group-sm">
                    <a class="btn btn-md btn-warning" href="javascript:void(0)" title="Edit" onclick="editar_cliente('."'".$cliente->id_cliente."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
                    <a class="btn btn-md btn-danger" href="javascript:void(0)" title="Eliminar" onclick="delete_cliente('."'".$cliente->id_cliente."'".')"><i class="glyphicon glyphicon-trash"></i> </a>
                    </div>
                    ';
                    // <a class="btn btn-md btn-info" title="Agregar mascota" onclick="add_mascota('.$cliente->idcliente.')"><i class="glyphicon glyphicon-plus"></i> </a>
                    // </div>
                    // ';
            }else{
                $row['Acciones'] = '';
                    
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
        $data_datos =  $this->clientes->get_by_id($id);
        $provincias = $this->clientes->get_provincias();
        $data =  (object)array_merge((array)$data_datos, (array)$provincias);
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
            // 'cli_created_on' => date("Y-m-d", strtotime($this->input->post('cli_created_on'))) ,
            // 'cli_lista_precios' => $this->input->post('cli_lista_precios'),
            'cli_cuit' => $this->input->post('cli_cuit'),
            'cli_nombre' => $this->input->post('cli_nombre'),
            'cli_tipo' => $this->input->post('cli_tipo'),
            'cli_estado' => $this->input->post('cli_estado'),
            'cli_created_on' => date("Y-m-d", now()),

            );

            $data_contacto = array(
                'cli_telefono' => $this->input->post('cli_telefono'),
                // 'telefono2' => $this->input->post('telefono2'),

                'cli_direccion' => $this->input->post('cli_direccion'),
                // 'domicilio2' => $this->input->post('direccion2'),

                'cli_localidad' => $this->input->post('cli_localidad'),
                // 'localidad2' => $this->input->post('localidad2'),

                'cli_pais' => $this->input->post('cli_pais'),
                // 'pais2' => $this->input->post('pais2'),

                'cli_provincia' => $this->input->post('cli_provincia'),
                // 'provincia2' => $this->input->post('provincia2'),

                'cli_cp' => $this->input->post('cli_cp'),
                // 'cp2' => $this->input->post('cp2'),


                'cli_movil' => $this->input->post('cli_movil'),
                // 'movil2' => $this->input->post('telefono_movil2'),

                'cli_correo' => $this->input->post('cli_correo'),
                // 'correo2' => $this->input->post('correo2'),

                // 'infomail1' => $this->input->post('infomail1'),
                // 'infomail2' => $this->input->post('infomail2'),
            );
        // var_dump($data_contacto); exit();

        if($this->clientes->save($data,$data_contacto)){
            echo json_encode(array("status" => true));
        }else{
            echo json_encode(array("status" => false));
        }
    }
    
    
    
    public function ajax_update()
    {
        
            $data = array(
                'cli_telefono' => $this->input->post('cli_telefono'),
                'cli_movil' => $this->input->post('cli_movil'),
                'cli_correo' => $this->input->post('cli_correo'),
                'cli_sexo' => $this->input->post('sexo'),
                // 'cli_fecha_nac' => date("Y-m-d", strtotime($this->input->post('cli_fecha_nacimiento'))) ,
                // 'cli_lista_precios' => $this->input->post('cli_lista_precios'),
                'cli_cuit' => $this->input->post('cli_cuit'),
                'cli_nombre' => $this->input->post('cli_nombre'),
                'cli_tipo' => $this->input->post('cli_tipo'),
                'cli_estado' => $this->input->post('Activo'),
            );
        
            $data_contacto = array(
                'cli_telefono' => $this->input->post('cli_telefono'),
                // 'telefono2' => $this->input->post('telefono2'),

                'cli_direccion' => $this->input->post('cli_direccion'),
                // 'domicilio2' => $this->input->post('direccion2'),

                'cli_localidad' => $this->input->post('cli_localidad'),
                // 'localidad2' => $this->input->post('localidad2'),

                'cli_pais' => $this->input->post('cli_pais'),
                // 'pais2' => $this->input->post('pais2'),

                'cli_provincia' => $this->input->post('cli_provincia'),
                // 'provincia2' => $this->input->post('provincia2'),

                'cli_cp' => $this->input->post('cli_cp'),
                // 'cp2' => $this->input->post('cp2'),


                'cli_movil' => $this->input->post('cli_movil'),
                // 'movil2' => $this->input->post('telefono_movil2'),

                'cli_correo' => $this->input->post('cli_correo'),
                // 'correo2' => $this->input->post('correo2'),

                // 'infomail1' => $this->input->post('infomail1'),
                // 'infomail2' => $this->input->post('infomail2'),
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
