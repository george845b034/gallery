<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publications extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('publications_model'));

		$this->session->set_userdata('language', 'tw');
	}

	public function index()
	{
		$data['publicationsData'] = $this->publications_model->getDataAll();

		$this->load->view('header');
		$this->load->view('publications', $data);
		$this->load->view('footer');
	}
}