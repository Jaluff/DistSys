<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import_model extends CI_Model {

	 public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function import_productos(){

    	ini_set('auto_detect_line_endings',TRUE);
    	date_default_timezone_set('America/Argentina/Buenos_Aires');
		
		$fecha_hoy  = date("Y-m-d H:i", now());  
		
		$datos[] = '';
	    
	    $test = base_url().'assets/uploads_productos/PURINA8.csv';
		
		if (($gestor = fopen($test , "r")) !== FALSE) {
		
		    while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
		       	$data_prod = array(
		       		'codigo' => trim($datos[0]),
		       		'codigo_barras' => '',
		       		'producto' => trim($datos[1]),
		       		'tipo' => trim($datos[6]),
		       		'marca' => trim($datos[5]),
		       		'especie' => trim($datos[7]),
		       		'medida' => 'Kg',
		       		'cantidad_medida' => trim($datos[2]),
		       		'estado' => 'Activo',
		       		'created_on' => $fecha_hoy,
		       		'id_empresa' => '4'
		       		);
		       	$this->db->insert('productos', $data_prod);
		       	$id_producto = $this->db->insert_id();

		        // $ins_prod = "insert into productos_copy  (codigo , codigo_barras, producto, tipo, marca, especie, medida, cantidad_medida, estado, created_on, id_empresa) values ('', '', '".trim($datos[0]). "', '".trim($datos[6]). "', '".trim($datos[5]). "', '".trim($datos[7]). "', 'Kg', '".trim($datos[1]). "', 'Activo', '". $fecha_hoy. "', '4' ); <br/>";
		        // echo $ins_prod;
		
		        $margen = number_format((trim($datos[4]) - trim($datos[3])) / trim($datos[4]) * 100, 2, '.', ' ');
		
		        $data_precios = array(
		        	'id_producto' => $id_producto,
		        	'producto_costo' => trim($datos[3]),
		        	'producto_margen' => $margen,
		        	'producto_precio_venta' => trim($datos[4]),
		        	'precio_created_on' => $fecha_hoy
		        	);
		        $this->db->insert('precios' , $data_precios);

		        // $ins_precio = "insert into precios_copy (id_producto, producto_costo, producto_margen, producto_precio_venta, precio_created_on) values ( '5555' , '".trim($datos[2]). "', '" . $margen . "' , '".trim($datos[3]). "', '". $fecha_hoy. "')  <br/>";
		        // echo $ins_precio;
		    
		    }
		    
		    fclose($gestor);
		}
		
		ini_set('auto_detect_line_endings',FALSE);
	}

}