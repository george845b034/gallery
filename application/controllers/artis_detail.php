<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artis_detail extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('artists_model'));

		$this->session->set_userdata('language', 'tw');
	}

	public function index()
	{
		$id = $this->input->get('id');
		if(empty($id))redirect('main');

		$data['artistsData'] = $this->artists_model->getDataById($id);
		$data['artistsList'] = $this->artists_model->getDataAll();
		if(count($data['artistsData']) <= 0)redirect('main');

		$this->load->view('header');
		$this->load->view('artis_detail', $data);
		$this->load->view('footer');
	}
}