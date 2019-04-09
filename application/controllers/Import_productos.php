<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import_productos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('import_model','mimport');
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
        $data = $this->mimport->import_productos();
        $this->load->view('import/import_view' , $data);
    }
}