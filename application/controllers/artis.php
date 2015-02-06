<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artis extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('about_model', 'artists_model'));
	}

	public function index()
	{
		$this->about_model->setLanguage($this->input->get('lang', true));
		$data['artistsData'] = $this->artists_model->getDataAll();
		$data['language'] = $this->about_model->checkLanguage();
		$data['headerData'] = $this->about_model->getHeaderData();

		$this->load->view('header', $data);
		$this->load->view('artis', $data);
		$this->load->view('footer');
	}
}