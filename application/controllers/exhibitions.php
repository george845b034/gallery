<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exhibitions extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('exhibitions_model'));

		$this->session->set_userdata('language', 'tw');
	}

	public function index()
	{
		//修改為讀ｉｄ
		$data['exhibitionsData'] = $this->exhibitions_model->getLastData();

		$this->load->view('header');
		$this->load->view('exhibitions', $data);
		$this->load->view('footer');
	}
}