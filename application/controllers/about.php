<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('about_model'));
	}

	public function index()
	{
		$this->about_model->setLanguage($this->input->get('lang', true));
		$data['aboutData'] = $this->about_model->getData();
		$data['language'] = $this->about_model->checkLanguage();
		$data['headerData'] = $this->about_model->getHeaderData();
		
		$this->load->view('header', $data);
		$this->load->view('about', $data);
		$this->load->view('footer');
	}
}