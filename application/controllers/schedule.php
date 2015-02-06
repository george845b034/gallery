<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('exhibitions_model'));
	}

	public function index()
	{
		$id = $this->input->get('id');
		// if(empty($id))redirect('main');

		$data['id'] = $id;
		$data['artistsData'] = (empty($id))?$this->exhibitions_model->getAllData():$this->exhibitions_model->getDataById($id);
		$data['artistsList'] = $this->exhibitions_model->getAllData();
		$data['language'] = ($this->session->userdata('language'))?$this->session->userdata('language'):'tw';
		if(count($data['artistsData']) <= 0)redirect('main');

		$this->load->view('header');
		$this->load->view('schedule', $data);
		$this->load->view('footer');
	}
}