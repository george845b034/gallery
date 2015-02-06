<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publications extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('publications_model'));

	}

	public function index()
	{
		$data['publicationsData'] = $this->publications_model->getDataAll();
		$data['language'] = ($this->session->userdata('language'))?$this->session->userdata('language'):'tw';

		$this->load->view('header');
		$this->load->view('publications', $data);
		$this->load->view('footer');
	}
}