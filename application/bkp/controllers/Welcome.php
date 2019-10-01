<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model','dboard');

		$this->_init();
	}

	private function _init()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$this->output->set_template('dashboardPanel');

		$this->load->js('assets/themes/default/js/jquery-1.11.3.min.js');
		
		// $this->load->js('assets/themes/default/hero_files/bootstrap-collapse.js');
	}

	public function index()
	{
		//$this->load->css('assets/themes/default/css/paper-dashboard.css');
		$this->load->section('sidebar', 'ci_simplicity/sidebar');

		$this->data['total_venta'] = $this->dboard->get_total_operacion('egreso');
		$this->data['total_compra'] = $this->dboard->get_total_operacion('ingreso');
		$this->data['total_cobro'] = $this->dboard->get_total();
		$this->data['ventas_totFactura'] = $this->dboard->get_ventasTipo('factura');
		$this->data['ventas_totPedido'] = $this->dboard->get_ventasTipo('pedido');
		$this->data['ventas_totTPV'] = $this->dboard->get_ventasTPV();
		$this->data['ventas_metodo'] = $this->dboard->get_ventasMetodo();
		$this->data['proyeccion_compras'] = $this->dboard->get_proyeccion('ingreso');
		$this->data['proyeccion_ventas'] = $this->dboard->get_proyeccion('egreso');
		$this->data['mas_vendidos'] = $this->dboard->get_masVendidos('egreso');
		$this->data['mayorMargen'] = $this->dboard->get_mayorMargen();


		//$this->data['total_tarjeta'] = $this->dboard->get_total('tarjera');

		$this->load->view('welcome_message', $this->data);
	}
}
