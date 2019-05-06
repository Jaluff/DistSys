<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ventas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ventas_model', 'ventas');
        $this->load->model('cliente_model', 'clientes');
        $this->load->model('producto_model', 'productos');
        $this->load->model('tpv_model', 'tpvs');
        $this->load->library('form_validation');
        $this->_init();
    }

    private function _init()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $this->output->set_template('default');
        $this->data['clientes'] = $this->clientes->get_clientes();
        $this->data['productos'] = $this->productos->get_productos();
        $this->data['tpv'] = $this->tpvs->get_tpv();
        //var_dump($this->data);
        $this->load->view('ventas/ventas_view', $this->data);
    }

    public function nueva()
    {
        $this->output->set_template('default');
        $this->data['clientes'] = $this->ventas->get_clientes();
        $this->data['productos'] = $this->productos->get_productos();
        $this->data['tpv'] = $this->tpvs->get_tpv();
        //var_dump($this->data);
        $this->load->view('ventas/nueva_venta', $this->data);
    }
    
    public function ajax_list()
    {
        $this->load->model('cliente_model','clientes');
        $tpv = $this->input->post('tpv');
        $fecha = ($this->input->post('fecha') == '') ? $this->_data_first_month_day() : date('Y-m-d', strtotime($this->input->post('fecha')));
        $fecha_fin = ($this->input->post('fecha_fin') == '') ? $this->_data_last_month_day() : date('Y-m-d', strtotime($this->input->post('fecha_fin')));
        // -echo $fecha;
        //echo $date = date('Y-m-d H:i', now());
        $list = $this->ventas->get_datatables($tpv , $fecha, $fecha_fin);
        //  var_dump($list);
        // exit();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $stk) {
            // print_r($stk);
            $no++;
            $row = array();
            //$row[0] = NULL;
            $cli = $this->clientes->get_by_id($stk->cliente);
            
            $row['id_venta'] = $stk->id_venta;
            $row['metodoPago'] = $stk->metodoPago;
            if(isset($stk->cli_nombre) && $stk->cli_nombre == 0){
                $row['cliente'] = $stk->cli_nombre;
            } else {
                $row['cliente'] = 'Cons. final';
            }
            // $row['tipo'] = ($stk->tipo == 'factura' ) ? '<span class="text-success"><strong>' . $stk->tipo . '</strong></span>' : '<span class="text-danger"><strong>' . $stk->tipo . '</strong></span>';
            $row['fecha'] = date("d-m-Y", strtotime($stk->fecha));
            $row['pago_efectivo'] = ($stk->pago_efectivo > 0) ? "$".$stk->pago_efectivo : '';
            $row['pago_cheque'] = ($stk->pago_cheque > 0) ? "$".$stk->pago_cheque : '';
            $row['pago_tarjeta'] = ($stk->pago_tarjeta > 0 ) ? "$".$stk->pago_tarjeta : '';
            $row['importe_total'] = $stk->importe_total;
            $row['importe_recibido'] = $stk->importe_recibido;
            $row['importe_saldo'] = $stk->saldo;
            $row['estado'] = ($stk->metodoPago != '') ? '<h5><span class="label label-success">Cobrada</span></h5>' : '<h5><span class="label label-danger">No cobrada</span></h5>';
            $row['usuario'] = $stk->usuario;
            $row['cobrador'] = $stk->cobrador;
            
            //var_dump($marcas); 
            //add html for action
           //echo $stk->estado;
            $row['Acciones'] = '';
            if ($stk->metodoPago != '') {
            $row['Acciones'] .= '

            <div class="btn-group btn-group-md">
                <a class="btn btn-md btn-info" href="'.base_url().'ventas/ver_venta/'.$stk->id_venta.'" title="Ver">
                    <i class="glyphicon glyphicon-eye-open"></i> 
                </a>
            </div>
            
            '
            ;
            }
            else {
              
                $row['Acciones'] .= '
                <div class="btn-group btn-group-md">
                <a class="btn btn-md btn-success" href="'.base_url().'ventas/ver_venta/'.$stk->id_venta.'" title="Ver">
                    <i class="glyphicon glyphicon-usd"></i> 
                </a>
            </div>
                
                ';
            }

            $data[] = $row;
        }

        $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->ventas->count_all($tpv  , $fecha, $fecha_fin),
                "recordsFiltered" => $this->ventas->count_filtered($tpv  , $fecha, $fecha_fin),
                "data" => $data,
                        
                );
        echo json_encode($output);
    }

    private function _data_last_month_day() { 
        $month = date('m');
        $year = date('Y');
        $day = date("d", mktime(0,0,0, $month+1, 0, $year));
        return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
    }

    /** Actual month first day **/
    private function _data_first_month_day() {
    $month = date('m');
    $year = date('Y');
    return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
    }
    
    







    
    public function actualizar_estado(){
        $estado = $this->input->post('estado');
        $id_compra = $this->input->post('id');
            if($this->compras->update_stock_venta($id_venta, $detalles,$total_importe, $estado)){
                echo json_encode(true);
            }else{
                echo json_encode(false);
            }     
    }

    public function get_producto_stock(){
        $id = $this->input->post('id');
        $tpv = $this->input->post('tpv');
        $stock = $this->productos->get_stock($id, $tpv);
        echo json_encode($stock);
    }

    public function get_producto_precio(){
        $id = $this->input->post('id');
        $precio = $this->productos->get_precio_by_id($id);
        echo json_encode($precio);
    }
    
    public function pago_venta(){
        
        $id_venta = $this->input->post('id');
        $importe = floatval($this->input->post('importe'));
        $pago = $this->input->post('pago');

        parse_str($pago, $pago);
            $recibido = floatval(($pago['recibido_cheque'] + $pago['recibido_tarjeta'] + $pago['recibido_efectivo'])) ;
            $saldo = $recibido  - $importe; //- $importe;

            $datos_pago = array(
                'metodoPago'            => $pago['metodo_pago'],
                'pago_efectivo'         => $pago['recibido_efectivo'], //- $vuelto,
                'pago_tarjeta'          => $pago['recibido_tarjeta'],
                'pago_cheque'           => $pago['recibido_cheque'],
                'pago_cheque_banco'     => $pago['cheque_banco'],
                'pago_cheque_cuenta'    => $pago['cheque_cuenta'],
                'pago_cheque_numero'    => $pago['cheque_numero'],
                'importe_total'         => $importe,
                'importe_recibido'      => $recibido,
                'importe_saldo'         => $saldo,
                'tarjeta'               => $pago['tarjeta'],
                //'id_tpv'                => $tpv,
                //'estado'                => $cobrada,
                // 'tipo'                  => $tipo,
                'fecha_cobro'           => date('Y-m-d', now()),
            );

            if ($id_venta = $this->ventas->update_pago_venta($id_venta, $datos_pago)) {
                if($id_venta > 0){
                    echo 'true';    
                }else{
                    echo 'false';
                }
            }
    }

    public function guardar_venta()
    {
     
        $tpv = $this->input->post('tpv');
        $id_venta = $this->input->post('id');
        $importe = floatval($this->input->post('total'));
        $cliente = $this->input->post('cliente');
        $detalles = $this->input->post('detalles');
        $tipo = $this->input->post('tipo');
        //$pago = $this->input->post('pago');
        parse_str($detalles, $detalles);
        parse_str($cliente, $cliente);
        
            $user = $this->ion_auth->user()->row();
            $datos_venta = array(
                'cliente'       => $cliente['id_cliente'],
                'fecha'         => date('Y-m-d', now()),
                'tipo'          => $tipo,
                'id_tpv'        => $tpv,
                'importe_total' => $importe,
                //'importe_saldo' => $saldo,
                'id_empresa'    => $this->session->userdata('id_empresa'),
                'usuario'       => $user->first_name . ", " . $user->last_name,
                'cobrador'      => $user->first_name . ", " . $user->last_name,
            );
            // if ($id_venta = $this->ventas->save_venta($datos_venta, $datos_pago, $detalles, $id_venta, $tpv, $tipo)) {
            if ($id_venta = $this->ventas->save_venta($datos_venta, $detalles, $id_venta, $tpv, $tipo)) {
                if($id_venta){
                    echo 'true';    
                }else{
                    echo 'false';
                }
            }
        
    }

    function add_item(){
        // var_dump($_POST); exit();
        $datos_producto = array(
            "id_producto" => $_POST['product_id'],
            "cantidad" => $_POST['quantity'],
            "precio" => $_POST['price']
        );
        $articulo = $this->ventas->agregar_producto($datos_producto);
        if($this->input->post('ajax') != '1'){
            //redirect('compras/nueva'); // If javascript is not enabled, reload the page with new data
        }else{
            echo json_encode($articulo); // 'true'; // If javascript is enabled, return true, so the cart gets updated
        }
    }

    function ver_venta($idventa){
        $this->output->set_template('default');

        $this->data['ventas'] = $ventas = $this->ventas->get_venta($idventa);
        $this->data['detalles'] = $this->ventas->get_ventas_detalles($idventa);
        $this->data['cliente'] =  $this->ventas->get_clientes($ventas->cliente);
        $this->data['productos'] = $this->productos->get_productos();
        $this->load->view('ventas/mostrarVenta_view',  $this->data);

    }
}
