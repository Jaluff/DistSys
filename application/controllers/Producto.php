<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Producto extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('producto_model', 'productos');
        $this->load->model('proveedor_model', 'proveedores');
        $this->load->model('compras_model', 'compras');
        $this->load->model('tpv_model', 'tpvs');
        $this->load->library(array('form_validation', 'email'));
        $this->_init();
    }
    private function _init()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $this->output->set_template('default');
        $this->load->helper('url');
        $this->data['marcas'] = $this->productos->get_marcas();
        $this->data['categorias'] = $this->productos->get_categorias();
        $this->data['medida'] = $this->productos->get_medidas();
        //$this->data['especie'] = $this->productos->get_especie(); 
        $this->data['proveedores'] = $this->proveedores->get_proveedores();
        //$this->data['productos'] = $this->productos->get_productos();
        $this->data['tpv'] = $this->tpvs->get_tpv();
        //$this->output->delete_cache();
        $this->load->view('productos/producto_view', $this->data);
    }

    public function productos_modica_precios()
    {
        $this->output->set_template('default');
        // $this->load->helper('url');
        $this->data['marcas'] = $this->productos->get_marcas();
        $this->data['categorias'] = $this->productos->get_categorias();
        $this->data['medida'] = $this->productos->get_medidas();
        //$this->data['especie'] = $this->productos->get_especie(); 
        $this->data['proveedores'] = $this->proveedores->get_proveedores();
        //$this->data['productos'] = $this->productos->get_productos();
        $this->data['tpv'] = $this->tpvs->get_tpv();
        //$this->output->delete_cache();
        $this->load->view('productos/producto_precio', $this->data);
    }

    public function ajax_list()
    {

        $tpv = $this->input->post('tpv');
        $list = $this->productos->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $producto) {
            $no++;
            $row = array();
            $row[0] = null;
            $row['id'] = $producto->id;
            $row['Codigo'] = $producto->codigo;
            $row['Producto'] = $producto->producto . " - <strong>(" . $producto->cantidad_medida . $producto->medida . ")</strong>";
            $row['Descripcion'] = $producto->descripcion;
            $row['Categoria'] = $producto->categoria_nombre;
            $row['marca'] = $producto->marca_nombre;
            $row['cod_barras'] = $producto->codigo_barras;
            $row['proveedor'] = $producto->prov_nombre;
            if ($stock = $this->productos->get_stock($producto->id, $tpv)) {
                $row['Stock_actual'] = $stock->stock_act;
            } else {
                $row['Stock_actual'] = 0;
            }
            $row['precio_compra'] = $producto->producto_costo;
            if ($precio = $this->productos->get_precio_by_id($producto->id_producto)) {
                $row['precio_venta'] = $precio->producto_precio_venta;
            } else {
                $row['precio_venta'] = " - ";
            }
            $foto = $this->productos->get_imagen_by_id($producto->id);
            if($foto != null) {
                $row['foto_producto'] = array();
                $upload_path = "images/uploads/";
                         $image = base_url() . $upload_path . $foto['nombre'] . '?' . rand(1, 200);
                        $row['foto_producto'] = '<center><a class="showGalleryFromArray" role="button" data-value="'.$producto->id.'" ><img class="img-responsive" src="'.$image.'" width="50px" ></a></center>';
            }else{
                $row['foto_producto'][0] = "<img src='images/no_disponible.png' width='40'>";
            }
            $row['estado'] = $producto->estado;
            $row['medida'] = $producto->medida;
            $row['cantidad_medida'] = $producto->cantidad_medida;
            $row['created_on'] = date("d-m-Y", strtotime($producto->created_on));
            if ($this->ion_auth->is_admin()) {
                $row['Acciones'] = '
                <div class="btn-group btn-group-sm">
                <a class="btn btn-md btn-warning" href="javascript:void(0)" title="Edit" onclick="editar_producto(' . "'" . $producto->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> </a>
                <a class="btn btn-md btn-danger" href="javascript:void(0)" title="Eliminar" onclick="delete_producto(' . "'" . $producto->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> </a>
                <button type="button" class="btn btn-info btn-view-imagen" data-toggle="modal" data-target="#modal-imagen" data-cache="false" value="' . $producto->id . '" >
                    <span class="glyphicon glyphicon-picture"></span>
                </button>
                <button type="button" class="btn btn-default btn-view-barcode" data-toggle="modal" data-target="#modal-default" value="' . $producto->codigo_barras . '" >
                    <span class="glyphicon glyphicon-barcode"></span>
                </button>
                </div>
                ';
            } else {
                $row['Acciones'] = '';
            }
            $data[] = $row;
            // var_dump($data);
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->productos->count_all(),
            "recordsFiltered" => $this->productos->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_precios()
    {
        $list = $this->productos->get_datatables();
        // print_r($list);
        $data = array();
        $no = $_POST['start'];
        
        foreach ($list as $producto) {
            $no++;
            $row = array();
            $row[0] = null;
            $row['sel'] = '<input type="checkbox" class="id_prod" value="'.$producto->id.'"><input type="hidden" name="id_prod[]" value='. $producto->id .'>';
            $row['id'] = $producto->id;
            $row['Codigo'] = $producto->codigo;
            $row['Producto'] = $producto->producto . " - <strong>(" . $producto->cantidad_medida . $producto->medida . ")</strong>";
            $row['Descripcion'] = $producto->descripcion;
            $row['Categoria'] = $producto->categoria_nombre;
            $row['marca'] = $producto->marca_nombre;
            $row['cod_barras'] = $producto->codigo_barras;
            $row['proveedor'] = $producto->prov_nombre;
            if ($producto->producto_costo) {
                $row['precio_compra'] = "<input type='text' name='compra[]' id='compra_". $producto->id ."' onkeyup='cambiar_precios($producto->id)' value='". $producto->producto_costo ."' class='form-control input-sm'>";
         
            }else{
                $row['precio_compra'] = '0';
            }
            if ($precio = $this->productos->get_precio_by_id($producto->id)) {
                $row['precio_venta'] = "<div id='venta_". $producto->id ."'>" . $precio->producto_precio_venta . "</div>";
                $row['precio_porcentaje'] = $precio->producto_margen;
            } else {
                $row['precio_venta'] = "<div id='venta_". $producto->id ."'> - </div>";
                $row['precio_porcentaje'] = '-';
            }
         
            $row['precio_nuevo'] = "<input type='text' name='idPrecio[]' id='idPrecio_" . $producto->id . "' onkeyup='cambiar_precios($producto->id)' class='form-control input-sm' readonly>";
            $row['porcentaje_nuevo'] = "<input type='text' name='idPorcentaje[]'  id='idPorcentaje_" . $producto->id . "' onkeyup='cambiar_precios($producto->id)' class=' form-control input-sm'>";
            $row['estado'] = $producto->estado;
            $row['medida'] = $producto->medida;
            $row['cantidad_medida'] = $producto->cantidad_medida;
            $row['created_on'] = date("d-m-Y", strtotime($producto->created_on));
            $data[] = $row;
            // print_r($data);
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->productos->count_all(),
            "recordsFiltered" => $this->productos->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_edit($id, $tpv = null)
    {
        $data = [];
        $data_producto =  $this->productos->get_by_id($id);
        $data_precio = $this->productos->get_precio_by_id($id);
        $data_stock = $this->productos->get_stock($id, $tpv);
        $data =  (object)array_merge((array)$data_producto, (array)$data_precio,  (array)$data_stock);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        if($this->input->post('codigo_barras')){
            $codigo_barras = $this->input->post('codigo_barras');
        }else{
            $codigo_barras = $this->input->post('id_producto') . $this->input->post('codigo');
        }
        $data_producto = array(
            'id_producto' => '',
            'id_proveedor' => $this->input->post('id_proveedor'),
            'producto' => $this->input->post('producto'),
            'codigo' => $this->input->post('codigo'),
            'codigo_barras' => $codigo_barras,
            'descripcion' => $this->input->post('descripcion'),
            'estado' => $this->input->post('estado'),
            'created_on' => date("Y-m-d", now()),
            'id_categoria' => $this->input->post('categoria'),
            'id_marca' => $this->input->post('marca'),
            'medida' => $this->input->post('medida'),
            'cantidad_medida' => $this->input->post('cantidad'),
            'id_empresa' => $this->session->userdata('id_empresa')
        );
        
        $data_precio =  array(
            'producto_costo' => $this->input->post('costo'),
            'impuestos' => $this->input->post('impuesto'),
            'producto_margen' => $this->input->post('margen_principal'),
            'producto_con_margen' => $this->input->post('pv_principal'),
            'producto_precio_venta' => $this->input->post('pv_iva'),
            'precio_created_on' => date("Y-m-d", now()),
        );

        $config = [
            "upload_path" => "./images/uploads/",
            'allowed_types' => "png|jpg",
            'overwrite' => true
        ];
        
        $insert = $this->productos->save($data_producto, $data_precio);
        if ($insert != false) {
            $this->generateBarCode($codigo_barras);
        }

        if (isset($_FILES['foto_producto']['name']) && $_FILES['foto_producto']['name'] != '') {
            @unlink($config['upload_path'] . $insert);
            $config['file_name'] = $this->input->post('id_producto');
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('foto_producto')) {
                $data = array("upload_data" => $this->upload->data());
                $data_producto['foto_producto'] = $config['upload_path'] . $data['upload_data']['file_name'];

                // REDIMENSIONAMOS
                $img_full_path = $config['upload_path'] . $data['upload_data']['file_name'];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $img_full_path;
                $config['maintain_ratio'] = true;
                $config['width'] = 450;
                //$config['height'] = 250;
                $config['new_image'] = $img_full_path;
                $img_redim1 = $config['new_image'];

                $this->load->library('image_lib', $config);

                if (!$this->image_lib->resize()) {
                    @unlink($img_full_path);
                    echo $this->image_lib->display_errors();
                    exit();
                }

                $this->image_lib->clear();
            } else {
                echo $this->upload->display_errors();
            }
        }
        echo json_encode($insert);
    }



    public function ajax_update()
    {
        $id = $this->input->post('id_producto');
        if($this->input->post('codigo_barras')){
            $codigo_barras = $this->input->post('codigo_barras');
        }else{
            $codigo_barras = $this->input->post('categoria') .$this->input->post('marca').$this->session->userdata('id_empresa').$this->input->post('codigo');
        }
        $data_producto = array(
            'id_producto' => $this->input->post('id_producto'),
            'id_proveedor' => $this->input->post('id_proveedor'),
            'producto' => $this->input->post('producto'),
            'codigo' => $this->input->post('codigo'),
            'codigo_barras' => $codigo_barras,
            'descripcion' => $this->input->post('descripcion'),
            'estado' => $this->input->post('estado'),
            'created_on' => date("Y-m-d", now()),
            'id_categoria' => $this->input->post('categoria'),
            'id_marca' => $this->input->post('marca'),
            'medida' => $this->input->post('medida'),
            'cantidad_medida' => $this->input->post('cantidad'),
            'id_empresa' => $this->session->userdata('id_empresa')
        );
        $data_precio =  array(
            'producto_costo' => $this->input->post('costo'),
            'impuestos' => $this->input->post('impuesto'),
            'producto_margen' => $this->input->post('margen_principal'),
            'producto_con_margen' => $this->input->post('pv_principal'),
            'producto_precio_venta' => $this->input->post('pv_iva'),
            'precio_created_on' => date("Y-m-d", now()),
        );

        $config = [
            "upload_path" => "images/uploads/",
            'allowed_types' => "gif|jpg|jpeg|png",
            'overwrite' => true
        ];

        $data = $this->productos->update(array('id_producto' => $this->input->post('id_producto')), $data_producto, $data_precio);
        if ($data != false) {
            $this->generateBarCode($codigo_barras);
        }
        
        if (isset($_FILES['foto_producto']['name']) && $_FILES['foto_producto']['name'] != '') {
            @unlink($config['upload_path'] . $id);
            $config['file_name'] = $this->input->post('id_producto');

            $this->load->library("upload", $config);
            if ($this->upload->do_upload('foto_producto')) {
                $data = array("upload_data" => $this->upload->data());

                $data_producto['foto_producto'] = $config['upload_path'] . $data['upload_data']['file_name'];

                // REDIMENSIONAMOS
                $img_full_path = $config['upload_path'] . $data['upload_data']['file_name'];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $img_full_path;
                $config['maintain_ratio'] = true;
                $config['width'] = 450;
                //$config['height'] = 250;
                $config['new_image'] = $img_full_path;
                $img_redim1 = $config['new_image'];

                $this->load->library('image_lib', $config);

                if (!$this->image_lib->resize()) {
                    @unlink($img_full_path);
                    echo $this->image_lib->display_errors();
                    exit();
                }
                $this->image_lib->clear();
            } else {
                echo $this->upload->display_errors();
            }
        }
        echo json_encode($data);
    }

    public function ajax_update_precios(){
        $precios = $this->input->post('precios');
        if($precios){
            $row = array();
            parse_str($precios,$arrPrecios);
            // print_r($arrPrecios); //return $precios;
            // echo count($arrPrecios). " <-count <br>"; 
            for($i=0; $i < count($arrPrecios); $i++){
                if(!empty($arrPrecios['compra'][$i]) && !empty($arrPrecios['idPorcentaje'][$i]) && !empty($arrPrecios['idPrecio'][$i]) ){
                    $row['id_producto'] = $arrPrecios['id_prod'][$i];
                    $row['producto_costo'] = $arrPrecios['compra'][$i];
                    $row['producto_margen'] = $arrPrecios['idPorcentaje'][$i];
                    $row['producto_precio_venta'] = $arrPrecios['idPrecio'][$i];
                    $row['precio_created_on'] = date("Y-m-d", now());
                    // print_r($row);
                    $this->productos->update_precios(array('id_producto' => $arrPrecios['id_prod'][$i]) ,  $row);
                }
               
            } echo json_encode( true);
        }else{
            $data_precio =  array(
                'producto_costo' => $this->input->post('costo'),
                'impuestos' => $this->input->post('impuesto'),
                'producto_margen' => $this->input->post('margen_principal'),
                //'producto_margen_tres' => $this->input->post('margen_descuento2'),
                'producto_con_margen' => $this->input->post('pv_principal'),
                'producto_precio_venta' => $this->input->post('pv_iva'),
                //'producto_venta_tres' => $this->input->post('pv_descuento2'),
                'precio_created_on' => date("Y-m-d H:i:s", now()),
            );
            if ($this->productos->update_precios(array('id_producto' => $id),  $data_precio)) {
                echo json_encode(array("status" => true));
            } else {
                echo json_encode(array("status" => false));
            }    
        }
        


        
    }

    public function ajax_update_stock()
    {

        $id_producto = $this->input->post('sel_producto');
        $nuevo_stock = ($this->input->post('stock_act') + $this->input->post('compra_cant'));
        $data_stock =  array(

            'stock_actual' => $nuevo_stock,

        );

        $user = $this->ion_auth->user()->row();
        $data_compra = array(
            'id_proveedor' => $this->input->post('compra_proveedor'),
            'numero_factura' => $this->input->post('factura_numero'),
            'fecha_factura' => date("Y-m-d h:i", strtotime($this->input->post('factura_fecha'))),
            'remito' => $this->input->post('remito'),
            'id_empresa' => $this->session->userdata('id_empresa'),
            'usuario' => $user->first_name . ", " . $user->last_name,
            //'estado' => $this->input->post('estado'),
            'compra_created_on' => date("Y-m-d h:i", now()),

        );

        if ($data = $this->productos->update_stock($id_producto,  $data_stock, $data_compra)) {
            echo json_encode(array("status" => true));
        }
    }

    public function ajax_delete($id)
    {
        $this->productos->delete_by_id($id);
        echo json_encode(array("status" => true));
    }

    public function ajax_get_producto($id)
    {
        //$data = [];
        $data_datos =  $this->productos->get_by_id($id);
        $data =  (object)$data_datos;
        //var_dump($data);
        echo json_encode($data);
    }

    public function ajax_get_imagenes_producto()
    {
        $data = [];
        $id =$this->input->post('id');
        $data_datos =  $this->productos->get_image_by_id($id);
        $data = $data_datos;
        //var_dump($data);
        
        echo json_encode($data);
    }

    protected function generateBarCode($codigo_barras){
		$this->load->library('zend');
	   	$this->zend->load('Zend/Barcode');
	   	$file = Zend_Barcode::draw('code128', 'image', array('text' => $codigo_barras), array());
	   	//$code = time().$code;
	   	$store_image = imagepng($file,"./images/barcodes/{$codigo_barras}.png");
    }
    
    public function fileUpload($id_producto){
// echo $id_producto;
//var_dump($_FILES);
        if(!empty($_FILES['file']['name'])){
     
          // Set preference
        $config = [
            "upload_path" => "images/uploads/",
            'allowed_types' => "gif|jpg|jpeg|png",
            'overwrite' => true
        ];
          $config['upload_path'] = './images/uploads/'; 
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['max_size'] = '4096'; // max_size in kb
          $config['overwrite'] = true;
        //   $config['file_name'] = $_FILES['file']['name'];
          $config['file_name'] = $id_producto . "-" . rand(1, 200) ;
     
          //Load upload library
          $this->load->library('upload',$config); 
     
          // File upload
          if($this->upload->do_upload('file')){
            // Get data about the file
            $uploadData = $this->upload->data();
            //var_dump($uploadData);
            $this->productos->guardar_imagen($id_producto, $uploadData);
          }else{
            echo $this->upload->display_errors();
          }
        }
     
      }

      
      
      
      public function ver_imagenes($id_producto){
        $dir="./images/uploads";
        // $files = scandir($dir);
        
        $ret= array();
        $files = $this->productos->get_imagenes($id_producto);
        foreach($files as $file)
        {
            if($file == "." || $file == "..")
                continue;
            $filePath=$dir."/".$file->nombre;
            $details = array();
            $details['name']=$file->nombre;
            $details['path']=$filePath;
            $details['size']=filesize($filePath);
            $ret[] = $details;
        }
        //print_r($ret);
        echo json_encode($ret);
      }

    public function download()
    {
        if(isset($_GET['filename']))
            {
            $fileName=$_GET['filename'];
            $fileName=str_replace("..",".",$fileName); //required. if somebody is trying parent folder files
            $file = "./images/uploads/".$fileName;
            $file = str_replace("..","",$file);
            echo $file;
            if (file_exists($file)) {
                $fileName =str_replace(" ","",$fileName);
                header('Content-Description: File Transfer');
                header('Content-Disposition: attachment; filename='.$fileName);
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                readfile($file);
                exit;
            }
        }
    }


      public function borrar_imagenes($id_imagen = null)
      {
        $output_dir = "./images/uploads/";
        if(isset($_POST["op"]) && $_POST["op"] == "delete" && isset($_POST['name']))
        {
            $fileName =$_POST['name'];
            $fileName=str_replace("..",".",$fileName); //required. if somebody is trying parent folder files	
            $filePath = $output_dir. $fileName;
            if (file_exists($filePath)) 
            {
                $this->productos->borrar_imagen($fileName);
                unlink($filePath);
            }
            echo "Deleted File ".$fileName."<br>";
        }
        
      }
    // public function upload_file(){
    //     $data = array();
    //     if($this->input->post('fileSubmit') && !empty($_FILES['userFiles']['name'])){
    //         $filesCount = count($_FILES['userFiles']['name']);
    //         $id = $this->input->post('id_prod');
    //         for($i = 0; $i < $filesCount; $i++){
    //             $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
    //             $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
    //             $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
    //             $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
    //             $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

    //             $uploadPath = 'images/';
    //             $config['upload_path'] = $uploadPath;
    //             $config['allowed_types'] = 'gif|jpg|png';

    //             $this->load->library('upload', $config);
    //             $this->upload->initialize($config);
    //             //var_dump($this->upload->data()); exit();
    //             if($this->upload->do_upload('userFile')){
    //                 $fileData = $this->upload->data();
    //                 $uploadData[$i]['file_name'] = $fileData['file_name'];
    //                 $uploadData[$i]['id_empresa'] = 4;
    //                 $uploadData[$i]['estado'] = 'Activo';
    //                 //$uploadData[$i]['created'] = date("Y-m-d H:i:s");
    //                 //$uploadData[$i]['modified'] = date("Y-m-d H:i:s");
    //             }
    //         }

    //         if(!empty($uploadData)){
    //             //Insert file information into the database
    //             $insert = $this->file->insert_productos($uploadData);
    //             $statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
    //             //$this->session->set_flashdata('statusMsg',$statusMsg);
    //         }
    //     }
    //     //Get files data from database
    //     $data_datos = $this->file->getRowsProductos();
    //     //Pass the files data to view
    //     $data =  (object)$data_datos;
    //     echo json_encode($data);
    //     //$this->load->view('upload_files/index', $data);
    // }
}
