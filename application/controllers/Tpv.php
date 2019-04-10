<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tpv extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('producto_model', 'productos');
        $this->load->model('cliente_model', 'clientes');
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
        $this->data['clientes'] = $this->clientes->get_clientes();
        $this->data['productos'] = $this->productos->get_productos();
        $this->data['tpv'] = $this->tpvs->get_tpv();
        $this->data['tpv_active'] = $this->tpvs->get_tpv_active();
        $this->load->view('tpv/tpv_view', $this->data);
    }


    function add_cart_item()
    {

        if ($this->tpvs->validate_add_cart_item() == true) {

            // Check if user has javascript enabled
            if ($this->input->post('ajax') != '1') {
                //redirect('tpv'); // If javascript is not enabled, reload the page with new data
            } else {
                echo 'true'; // If javascript is enabled, return true, so the cart gets updated
            }
        }
    }

    function delete_cart_item()
    {

        if ($this->tpvs->validate_delete_cart_item() == true) {

            // Check if user has javascript enabled
            if ($this->input->post('ajax') != '1') {
                //echo 'false';
                //redirect('tpv'); // If javascript is not enabled, reload the page with new data
            } else {
                echo 'true'; // If javascript is enabled, return true, so the cart gets updated
            }
            echo 'true';
        }
    }

    function update_cart()
    {
        //echo  $this->input->post('ajax');

        if ($this->tpvs->validate_update_cart() == true) {

            if ($this->input->post('ajax') != '1') {
                //echo 'true';
                //redirect('tpv'); // If javascript is not enabled, reload the page with new data
                echo 'truee';

                //echo 'true';
            } else {

                echo 'true'; // If javascript is enabled, return true, so the cart gets updated
            }
        }
        //redirect('tpv');
    }

    function show_cart()
    {
        $this->load->view('tpv/cart');
    }

    function empty_cart()
    {
        $this->cart->destroy(); // Destroy all cart data
        redirect('tpv'); // Refresh te page
    }

    public function guardar_compra()
    {
        // var_dump($this->input->post());
        // exit(0);
        $tipo = $this->input->post('tipo');
        $tpv = $this->input->post('tpv');
        $importe = $this->input->post('importe');
        $cliente = $this->input->post('cliente');
        parse_str($cliente, $cliente);

        if ($tipo == 'factura') {
            $idVenta = $this->input->post('idVenta');
            $cobrada = 'cobrada';

            $pago = $this->input->post('pago');
            parse_str($pago, $pago);
            if ($pago['metodo_pago'] == 'efectivo') {
                $vuelto = ($pago['recibido_cheque'] + $pago['recibido_tarjeta'] + $pago['recibido_efectivo']) - $importe;
            } else {
                $vuelto = 0;
            }

            $datos_pago = array(
                'metodoPago'            => $pago['metodo_pago'],
                'pago_efectivo'         => $pago['recibido_efectivo'] - $vuelto,
                'pago_tarjeta'          => $pago['recibido_tarjeta'],
                'pago_cheque'           => $pago['recibido_cheque'],
                'pago_cheque_banco'     => $pago['cheque_banco'],
                'pago_cheque_cuenta'    => $pago['cheque_cuenta'],
                'pago_cheque_numero'    => $pago['cheque_numero'],
                'importe_total'         => $importe,
                'tarjeta'               => $pago['tarjeta'],
                'id_tpv'                => $tpv,
                'estado'                => $cobrada,
                'tipo'                  => $tipo,
                'fecha_cobro'           => date('Y-m-d', now()),
            );
            if ($this->tpvs->update_compra($datos_pago , $idVenta)) {
                    echo 'true';    
                }else{
                    echo 'false';
                }
            

        } elseif ($tipo == 'pedido') {
            $cobrada = 'no cobrada';
            $datos_pago = array(
                'metodoPago'         => '',
                'pago_efectivo'      => '',
                'pago_tarjeta'       => '',
                'pago_cheque'        => '',
                'tarjeta'            => '',
                'pago_cheque_banco'  => '',
                'pago_cheque_cuenta' => '',
                'pago_cheque_numero' => '',
                'id_tpv'        => $tpv,
            );

            $user = $this->ion_auth->user()->row();
            $datos_venta = array(
                'cliente'    => $cliente['cli_nombre'],
                'fecha'      => date('Y-m-d', now()),
                'tipo'       => $tipo,
                'estado'     => $cobrada,
                'id_empresa' => $this->session->userdata('id_empresa'),
                'usuario'    => $user->first_name . ", " . $user->last_name,
                'cobrador'   => $user->first_name . ", " . $user->last_name,
                //'dir' => $cliente['direccion'],
            );
            $detalles = $this->cart->contents();
            if ($id_venta = $this->tpvs->save_compra($datos_venta, $datos_pago, $detalles, $tpv, $cliente, $tipo)) {
                if($id_venta){
                    echo $this->cart->destroy();
                    echo 'true';    
                }else{
                    echo 'false';
                }
            }
        }
    }

    public function cobrar_compra()
    {
        $tipo       = $this->input->post('tipo');
        $id_venta   = $this->input->post('idVenta');
        $importe    = $this->input->post('importe');

        if ($tipo == 'factura') {
            $cobrada = 'cobrada';

            $pago = $this->input->post('pago');
            parse_str($pago, $pago);
            //var_dump($pago);
            if ($pago['metodo_pago'] == 'efectivo') {
                $vuelto = ($pago['recibido_cheque'] + $pago['recibido_tarjeta'] + $pago['recibido_efectivo']) - $importe;
            } else {
                $vuelto = 0;
            }

            $user = $this->ion_auth->user()->row();
            $datos_pago = array(
                'metodoPago'    => $pago['metodo_pago'],
                'pago_efectivo' => $pago['recibido_efectivo'] - $vuelto,
                'pago_tarjeta'  => $pago['recibido_tarjeta'],
                'tarjeta'       => $pago['tarjeta'],
                'pago_cheque'           => $pago['recibido_cheque'],
                'pago_cheque_banco'     => $pago['cheque_banco'],
                'pago_cheque_cuenta'    => $pago['cheque_cuenta'],
                'pago_cheque_numero'    => $pago['cheque_numero'],
                'importe_total' => $importe,
                'fecha_cobro'   => date('Y-m-d', now()),
                'estado' => $cobrada,
                'cobrador' => $user->first_name . ", " . $user->last_name,
            );
        }
        //$detalles = $this->cart->contents();
        if ($this->tpvs->update_compra($datos_pago, $id_venta)) {
            //echo $this->cart->destroy();
            echo 'true';
        }
    }
}
