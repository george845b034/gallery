<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exhibitions extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('about_model', 'exhibitions_detail_model'));
	}

	public function index()
	{
		$this->about_model->setLanguage($this->input->get('lang', true));
		$id = $this->input->get('id');
		if(empty($id))redirect('exhibitions_list');

		$data['exhibitionsData'] = $this->exhibitions_detail_model->getDetailDataById($id);
		$data['installationView'] = $this->exhibitions_detail_model->getInstallationsViewData($id);
		$data['language'] = $this->about_model->checkLanguage();
		$data['headerData'] = $this->about_model->getHeaderData();

		if(count($data['exhibitionsData']) <= 0)redirect('exhibitions_list');

		$this->load->view('header', $data);
		$this->load->view('exhibitions', $data);
		$this->load->view('footer');
	}
}