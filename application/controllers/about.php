<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('about_model'));
	}

	public function index()
	{
		$data['aboutData'] = $this->about_model->getData();
		
		$this->load->view('header');
		$this->load->view('about', $data);
		$this->load->view('footer');
	}
}