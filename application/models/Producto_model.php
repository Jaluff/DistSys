<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto_model extends CI_Model {

    var $table_productos = 'productos';
    var $table_proveedores = 'proveedores';
    var $table_precios = 'precios';
    var $table_stock ="stock";
    var $table_imagenes = 'imagenes';
    var $table_precios_query = '(SELECT producto_costo, precios.id_precios, precios.`id_producto`, precios.`producto_precio_venta`, producto_margen FROM `precios`  ORDER BY `id_precios`   ) AS `precios`';
    //var $table_estimacion = 'estimacion';
    var $table_marcas = 'marca';
    var $table_categorias = 'categorias';
    var $column_order =  array( null, 'productos.id_producto','codigo', 'producto','prov_nombre','categoria_nombre', 'marca_nombre','producto_costo', 'precios.producto_precio_venta', 'producto_margen'); //set column field database for datatable orderable
    var $column_search = array('productos.id_producto','codigo', 'producto','prov_nombre', 'categoria_nombre', 'marca_nombre', null, null); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id_precios' => 'asc' ); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select('productos.id_producto as id,productos.*, precios.*, categoria_nombre, marca_nombre, productos.id_proveedor, prov_nombre');
        $this->db->from($this->table_productos);
        $this->db->join($this->table_precios_query,"$this->table_precios.id_producto = $this->table_productos.id_producto",'left');
        $this->db->join($this->table_categorias,"$this->table_categorias.id_categoria = $this->table_productos.id_categoria",'left');
        $this->db->join($this->table_marcas,"$this->table_marcas.id_marca = $this->table_productos.id_marca",'left');
        $this->db->join($this->table_proveedores,"$this->table_proveedores.id_proveedor = $this->table_productos.id_proveedor",'left');

        $i = 0;
        
        foreach ($this->column_search as $item) // loop column
        {
             if($_POST['columns'][$i]['search']['value'] != ''  ) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['columns'][$i]['search']['value']);
                }
                else
                {
                    $this->db->like($item, $_POST['columns'][$i]['search']['value']);
                }

                if(count($this->column_search) == $i) //last loop
                    $this->db->group_end(); //close bracket
           
            }



            $i++;
        }
        $this->db->where('productos.id_empresa', $this->session->userdata('id_empresa'));
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->group_by('productos.id_producto');
       // $this->db->order_by('id_precios', 'asc');
        $query = $this->db->get();
            //  echo "<pre>"; print_r($this->db->last_query()); echo "</pre>";
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->group_by('productos.id_producto');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        $this->db->from($this->table_productos);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table_productos);
        $this->db->where('productos.id_producto',$id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_image_by_id($id)
    {
        $this->db->select('nombre');
        $this->db->from('imagenes');
        $this->db->where('id_producto',$id);
        $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_precio_by_id($id)
    {
        $this->db->from($this->table_precios);
        $this->db->where('id_producto',$id);
        $this->db->order_by('id_precios', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_stock($id, $tpv = null)
    {
        $this->db->select('stock_act, stock_min');
        $this->db->from('stock');
        
        if(isset($id)){
            $this->db->where('id_producto',$id);
        }
        
        if (isset($tpv)){
            $this->db->where('id_tpv',$tpv);
        }

        // $this->db->order_by('id_stock','desc');
        $query = $this->db->get();
        return $query->row();
    }

    

    public function get_marca_by_id($id)
    {
        $this->db->from($this->table_marcas);
        $this->db->where('id_marca',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_imagen_by_id($id)
    {
        //$this->db->from($this->table_imagenes);
        $this->db->where('id_producto',$id);
        $query = $this->db->get($this->table_imagenes);
        return $query->row_array();
    }

    public function get_marcas()
    {
        $this->db->from($this->table_marcas);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_medidas()
    {
        $this->db->from('medida');
        $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    public function get_productos($id=null)
    {
        $this->db->select('productos.id_producto, producto,  cantidad_medida, medida, id_proveedor, stock_act');
        $this->db->from($this->table_productos);
        $this->db->join($this->table_stock,"$this->table_stock.id_producto = $this->table_productos.id_producto",'left');
        if($id){
            $this->db->where('id_proveedor',$id);
        }
        $this->db->where($this->table_productos.'.id_empresa', $this->session->userdata('id_empresa'));
        $this->db->where('productos.estado', 'Activo');
        $this->db->order_by('producto, stock_act desc');
        $query = $this->db->get();
        //  echo $this->db->last_query();
        return $query->result();
    }

    

    public function get_categorias()
    {
        $this->db->from($this->table_categorias);
        $query = $this->db->get();
        return $query->result();
    }

    // public function get_especie()
    // {
    //     $this->db->from('especie');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function get_estimacion_by_id($id)
    // {
    //     $this->db->from($this->table_estimacion);
    //     $this->db->where('id_producto',$id);
    //     $this->db->order_by('id_estimacion', 'desc');
    //     $query = $this->db->get();
    //     return $query->row_array();
    // }

    public function save($data_productos,$data_precio)
    {
        $this->db->insert($this->table_productos, $data_productos);
        $id_producto = $this->db->insert_id();
        //$insertId = $this->db->insert_id();
        $this->db->set('id_producto',$id_producto);
        $this->db->insert($this->table_precios, $data_precio);
        return $id_producto;
    }

    public function guardar_imagen($id_producto, $uploadData){
        $this->db->set('id_producto',$id_producto);
        $this->db->set('nombre', $uploadData['file_name']); 
        $this->db->set('id_empresa', $this->session->userdata('id_empresa'));
        if($this->db->insert('imagenes')){
            return true;    
        }else{
            return true;
        }
        
    }

    public function get_imagenes( $id_producto)
    {
        $this->db->from('imagenes');
        $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        $this->db->where('id_producto', $id_producto);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    public function borrar_imagen($nombre){
        //maecho $nombre;
        $this->db->where('nombre', $nombre);
        $this->db->delete('imagenes');
    }

    public function update($where, $data_producto, $data_precio)
    {
        $this->db->update($this->table_productos, $data_producto, $where);
        $this->db->set($where);
        $this->db->insert($this->table_precios, $data_precio);
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    public function update_precios($where,  $data_precio)
    {
        $this->db->set($where);
        $this->db->insert($this->table_precios, $data_precio);
        return $this->db->affected_rows();
    }
    public function update_stock($id_prod,  $data_stock, $data_compra)
    { 

        $this->db->update($this->table_productos, $data_stock, array('id_producto'=> $id_prod));
        $this->db->insert('compras', $data_compra);
        //return $this->db->affected_rows();
        return $this->db->last_query();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_producto', $id);
        $this->db->delete($this->table_productos);
    }

    public function getRowsProductos($id = ''){
        $this->db->select('id,file_name,created');
        $this->db->from('files');
        if($id){
            $this->db->where('id',$id);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            $this->db->order_by('created','desc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result)?$result:false;
    }
    
    public function insertProductos($data = array()){
        $insert = $this->db->insert_batch('productos',$data);
        return $insert?true:false;
    }


}
