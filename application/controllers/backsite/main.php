<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin_model', 'main_model'));

		if(!$this->admin_model->checkSession() OR !$this->admin_model->checkIp())redirect('backsite/login');
	}

	public function index()
	{
		switch ($this->input->post('type')) {
			default:
				$this->view();
				break;
		}
	}

	private function view()
	{
		$data['menu'] = $this->main_model->getMenu();

		$this->load->view('backsite/header');
		$this->load->view('backsite/navigation', $data);
		$this->load->view('backsite/main');
		$this->load->view('backsite/footer');	
	}

}