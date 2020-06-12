<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendedor extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('vendedor_model','vendedores');
        // $this->load->library(array('form_validation'));
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
        $this->data['provincias'] = $this->vendedores->get_provincias();
        $this->load->view('vendedores/vendedor_view', $this->data);
    }

    public function ajax_add()
    {  
        //var_dump($this->input->post);
        $data = array(
            'vendedor_nombre' => $this->input->post('vendedor_nombre'),
            'vendedor_documento' => $this->input->post('vendedor_cuit'),
            'vendedor_domicilio' => $this->input->post('vendedor_direccion'),
            'vendedor_cp' => $this->input->post('vendedor_cp'),
            'vendedor_id_pais' => $this->input->post('vendedor_pais'),
            'vendedor_id_provincia' => $this->input->post('vendedor_provincia'),
            'vendedor_localidad' => $this->input->post('vendedor_localidad'),
            'vendedor_telefono' => $this->input->post('vendedor_telefono'),
            'vendedor_movil' => $this->input->post('vendedor_movil'),
            'vendedor_correo' => $this->input->post('vendedor_correo'),
            'vendedor_estado' => $this->input->post('vendedor_estado'),
            'vendedor_observaciones' => $this->input->post('vendedor_observaciones'),
            'id_empresa' => $this->session->userdata('id_empresa'),
            'vendedor_created_on' => date("d-m-Y", strtotime(now())),
        );

        $this->vendedores->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
            $data = array(
                'vendedor_nombre' => $this->input->post('vendedor_nombre'),
                'vendedor_documento' => $this->input->post('vendedor_cuit'),
                'vendedor_domicilio' => $this->input->post('vendedor_domicilio'),
                'vendedor_cp' => $this->input->post('vendedor_cp'),
                'vendedor_id_pais' => $this->input->post('vendedor_pais'),
                'vendedor_id_provincia' => $this->input->post('vendedor_provincia'),
                'vendedor_localidad' => $this->input->post('vendedor_localidad'),
                'vendedor_telefono' => $this->input->post('vendedor_telefono'),
                'vendedor_movil' => $this->input->post('vendedor_movil'),
                'vendedor_correo' => $this->input->post('vendedor_correo'),
                'vendedor_estado' => $this->input->post('vendedor_estado'),
                'vendedor_observaciones' => $this->input->post('vendedor_observaciones'),
            );
            // var_dump($data); exit();
        $data = $this->vendedores->update(array('id_vendedor' => $this->input->post('id_vendedor')), $data);
        echo json_encode(array("status" => TRUE));
    }


    public function ajax_list()
    {

        $list = $this->vendedores->get_datatables();
        //var_dump($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $vendedor) {
            $no++;
            $row = array();
            $row[0] = NULL;
            $row['id_vendedor'] = $vendedor->id_vendedor;
            $row['vendedor_nombre'] = $vendedor->vendedor_nombre;
            $row['vendedor_documento'] = $vendedor->vendedor_documento;
            $row['vendedor_domicilio'] = $vendedor->vendedor_domicilio;
            $row['vendedor_cp'] = $vendedor->vendedor_cp;
            $row['vendedor_pais'] = $vendedor->vendedor_pais;
            $row['vendedor_provincia'] = $vendedor->vendedor_provincia;
            $row['vendedor_localidad'] = $vendedor->vendedor_localidad;
            $row['vendedor_telefono'] = $vendedor->vendedor_telefono;
            $row['vendedor_movil'] = $vendedor->vendedor_movil;
            $row['vendedor_correo'] = $vendedor->vendedor_correo;
            $row['vendedor_estado'] = $vendedor->vendedor_estado;
            $row['vendedor_observaciones'] = $vendedor->vendedor_observaciones;
            $row['vendedor_created_on'] = date("d-m-Y", strtotime($vendedor->vendedor_created_on));
            //var_dump($marcas); 
            //add html for action
            $row['Acciones'] = '
            <div class="btn-group btn-group-sm">
            <a class="btn btn-md btn-warning" href="javascript:void(0)" title="Edit" onclick="editar_vendedor('."'".$vendedor->id_vendedor."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
            <a class="btn btn-md btn-danger" href="javascript:void(0)" title="Eliminar" onclick="delete_vendedor('."'".$vendedor->id_vendedor."'".')"><i class="glyphicon glyphicon-trash"></i> </a>
            </div>
            ';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->vendedores->count_all(),
                        "recordsFiltered" => $this->vendedores->count_filtered(),
                        "data" => $data,
                        
                );

        echo json_encode($output);
    }

    

    public function ajax_edit($id)
    {
        $data_datos =  $this->vendedores->get_by_id($id);
        $provincias = $this->vendedores->get_provincias();
        $data['datos'] =  (object)(array)$data_datos;
        $data['provincias'] = (object)(array)$provincias;
        echo json_encode($data);
    }

    public function get_provincias()
    {
        $provincias = $this->vendedores->get_provincias();
        
        // var_dump($data);
        echo json_encode($provincias);
    }

    public function get_vendedor($id){
        $vendedor_datos =  $this->vendedores->get_by_id($id);
        return $vendedor_datos;
    }

    public function ajax_delete($id)
    {
        $this->vendedores->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function getDepartamento()
    {     
        $provinciaId = $this->input->post('provinciaId');
        $dep = $this->input->post('dep');
        $localidades = $this->vendedores->getDepartamentos($provinciaId);    
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

    /**
    * @desc - devuleve un json con las poblaciones filtradas y el código postal de la primera
    */
    // public function getDepartamento()
    // {     
    //     $provinciaId = $this->input->post('provinciaId');
    //     $dep = $this->input->post('dep');
    //         //obtenemos las poblaciones de esa provincia
    //     if($provinciaId && $dep){
    //         $localidades = $this->vendedores->getDepartamentos($provinciaId);
    //         echo "<option value='0'>Departamento</option> ";
    //         //var_dump($localidades);
    //         foreach ($localidades as $value) {
    //             if ($dep == $value->nombre){
    //                 echo "<option value='".$value->nombre."' selected>".$value->nombre."</option> ";
    //             }else{
    //                 echo "<option value='".$value->nombre."'>".$value->nombre."</option> ";    
    //             }
                
    //         }
    //     }else{
    //         echo "<option value='0'>Departamentoss</option> ";
    //     }    
    // }

}
