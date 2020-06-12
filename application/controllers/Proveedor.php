<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('proveedor_model','proveedores');
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
        $this->data['provincias'] = $this->proveedores->get_provincias();
        $this->load->view('proveedores/proveedor_view', $this->data);
    }

    public function ajax_update()
    {
            $data = array(
                
                'prov_nombre' => $this->input->post('prov_nombre'),
                'prov_contacto' => $this->input->post('prov_contacto'),
                'prov_cuit' => $this->input->post('prov_cuit'),
                'prov_direccion' => $this->input->post('prov_direccion'),
                'prov_cp' => $this->input->post('prov_cp'),
                'prov_pais' => $this->input->post('prov_pais'),
                'prov_provincia' => $this->input->post('prov_provincia'),
                'prov_localidad' => $this->input->post('prov_localidad'),
                'prov_telefono' => $this->input->post('prov_telefono'),
                'prov_movil' => $this->input->post('prov_movil'),
                'prov_correo' => $this->input->post('prov_correo'),
                'prov_web' => $this->input->post('prov_web'),
                'prov_estado' => $this->input->post('prov_estado'),
                'prov_observaciones' => $this->input->post('prov_observaciones'),
            );
        $data = $this->proveedores->update(array('id_proveedor' => $this->input->post('id_proveedor')), $data);
        echo json_encode(array("status" => TRUE));
    }


    public function ajax_list()
    {

        $list = $this->proveedores->get_datatables();
        //var_dump($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $proveedor) {
            $no++;
            $row = array();
            $row[0] = NULL;
            $row['id_proveedor'] = $proveedor->id_proveedor;
            $row['prov_nombre'] = $proveedor->prov_nombre;
            $row['prov_telefono'] = $proveedor->prov_telefono;
            $row['prov_movil'] = $proveedor->prov_movil;
            $row['prov_cuit'] = $proveedor->prov_cuit;
            $row['prov_correo'] = $proveedor->prov_correo;
            $row['prov_pais'] = $proveedor->prov_pais;
            $row['prov_cp'] = $proveedor->prov_cp;
            $row['prov_provincia'] = $proveedor->prov_provincia;
            $row['prov_localidad'] = $proveedor->prov_localidad;
            $row['prov_contacto'] = $proveedor->prov_contacto;
            $row['prov_observaciones'] = $proveedor->prov_observaciones;
            $row['prov_correo'] = $proveedor->prov_correo;
            $row['prov_web'] = $proveedor->prov_web;
            $row['balance'] = "balance";
            $row['prov_estado'] = $proveedor->prov_estado;
            $row['prov_created_on'] = date("d-m-Y", strtotime($proveedor->prov_created_on));
            //var_dump($marcas); 
            //add html for action
            $row['Acciones'] = '
            <div class="btn-group btn-group-sm">
            <a class="btn btn-md btn-warning" href="javascript:void(0)" title="Edit" onclick="editar_proveedor('."'".$proveedor->id_proveedor."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
            <a class="btn btn-md btn-danger" href="javascript:void(0)" title="Eliminar" onclick="delete_proveedor('."'".$proveedor->id_proveedor."'".')"><i class="glyphicon glyphicon-trash"></i> </a>
            </div>
            ';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->proveedores->count_all(),
                        "recordsFiltered" => $this->proveedores->count_filtered(),
                        "data" => $data,
                        
                );

        echo json_encode($output);
    }

    public function ajax_add()
    {  
        //var_dump($this->input->post);
        $data = array(
                'id_empresa' => $this->session->userdata('id_empresa'),
                'prov_nombre' => $this->input->post('prov_nombre'),
                'prov_contacto' => $this->input->post('prov_contacto'),
                'prov_cuit' => $this->input->post('prov_cuit'),
                'prov_direccion' => $this->input->post('prov_direccion'),
                'prov_cp' => $this->input->post('prov_cp'),
                'prov_pais' => $this->input->post('prov_pais'),
                'prov_provincia' => $this->input->post('prov_provincia'),
                'prov_localidad' => $this->input->post('prov_localidad'),
                'prov_telefono' => $this->input->post('prov_telefono'),
                'prov_movil' => $this->input->post('prov_movil'),
                'prov_correo' => $this->input->post('prov_correo'),
                'prov_web' => $this->input->post('prov_web'),
                'prov_estado' => $this->input->post('prov_estado'),
                'prov_observaciones' => $this->input->post('prov_observaciones'),
                'prov_created_on' => date("Y-m-d" , now()),
            );

        $insert = $this->proveedores->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id)
    {
        $data_datos =  $this->proveedores->get_by_id($id);
        $provincias = $this->proveedores->get_provincias();
        $data['datos'] =  (object)(array)$data_datos;
        $data['provincias'] = (object)(array)$provincias;
        echo json_encode($data);
    }

    public function get_proveedor($id){
        $proveedor_datos =  $this->proveedores->get_by_id($id);
        return $proveedor_datos;
    }

    public function ajax_delete($id)
    {
        $this->proveedores->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    /**
    * @desc - devuleve un json con las poblaciones filtradas y el código postal de la primera
    */
    public function getDepartamento()
    {     
        $provinciaId = $this->input->post('provinciaId');
        $dep = $this->input->post('dep');
        $localidades = $this->proveedores->getDepartamentos($provinciaId);    
        //obtenemos las poblaciones de esa provincia
        if($provinciaId != ''){
            foreach ($localidades as $value) {
                if (isset($dep) && $dep == $value->nombre){
                    echo "<option value='".$value->nombre."' selected>".$value->nombre."</option> ";
                }else{
                    echo "<option value='".$value->nombre."'>".$value->nombre."</option> ";    
                }    
            }
        }else{
            echo "<option value='0'>Departamentos</option> ";
        }    
    }

}
