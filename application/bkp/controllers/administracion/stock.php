<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('administracion/stock_model','stocks');
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
        $this->load->model('tpv_model','tpvs');
       // $this->data['movimientos'] = $this->stocks->get_movimientos();
        $this->data['tpv'] = $this->tpvs->get_tpv(); 
        $this->load->view('administracion/stock_view',  $this->data);
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
        $tpv = $this->input->post('tpv');
        $fecha = date ('Y-m-d' , strtotime($this->input->post('fecha')));
        $fecha_fin = date ('Y-m-d' , strtotime($this->input->post('fecha_fin')));
        //echo $fecha;
        $list = $this->stocks->get_datatables($tpv, $fecha, $fecha_fin);
        //var_dump($list);
        //exit();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $stk) {
            $no++;
            $row = array();
            $row[0] = NULL;
            $row['id_stock'] = $stk->id_stock;
            $row['producto'] = $stk->producto ." - <strong>(". $stk->cantidad_medida . $stk->medida . ")</strong>";
            $row['operacion'] = $stk->operacion;
            $row['tpv_nombre'] = $stk->tpv_nombre;
            $row['stock_act'] = $stk->stock_act;
            $row['cantidad'] = $stk->cantidad;
            
            $row['usuario'] = $stk->usuario;
           
            $row['created_on'] = date("d-m-Y", strtotime($stk->created_on));
            //var_dump($marcas); 
            //add html for action
            $row['Acciones'] = '';

            // <div class="btn-group btn-group-sm">
            // <a class="btn btn-md btn-warning" href="javascript:void(0)" title="Edit" onclick="editar_proveedor('."'".$stk->id_stock."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
            // <a class="btn btn-md btn-danger" href="javascript:void(0)" title="Eliminar" onclick="delete_proveedor('."'".$stk->id_stock."'".')"><i class="glyphicon glyphicon-trash"></i> </a>
            // </div>
            // ';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->stocks->count_all($tpv, $fecha),
                        "recordsFiltered" => $this->stocks->count_filtered($tpv, $fecha),
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
        //$data = [];

        $data_datos =  $this->proveedores->get_by_id($id);

        

        $data =  (object)(array)$data_datos;

        echo json_encode($data);

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
            //obtenemos las poblaciones de esa provincia
        if($provinciaId && $dep){
            $localidades = $this->proveedores->getDepartamentos($provinciaId);
            echo "<option value='0'>Departamento</option> ";
            //var_dump($localidades);
            foreach ($localidades as $value) {
                if ($dep == $value->nombre){
                    echo "<option value='".$value->nombre."' selected>".$value->nombre."</option> ";
                }else{
                    echo "<option value='".$value->nombre."'>".$value->nombre."</option> ";    
                }
                
            }
        }else{
            echo "<option value='0'>Departamentoss</option> ";
        }    
    }

}
