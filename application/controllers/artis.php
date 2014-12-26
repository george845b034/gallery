<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artis extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('artists_model'));

		$this->session->set_userdata('language', 'tw');
	}

	public function index()
	{
		$data['artistsData'] = $this->artists_model->getDataAll();

		$this->load->view('header');
		$this->load->view('artis', $data);
		$this->load->view('footer');
	}
}