<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exhibitions_list extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('about_model', 'exhibitions_detail_model'));
	}

	public function index()
	{
		$this->about_model->setLanguage($this->input->get('lang', true));
		$type = ($this->input->get('type'))?$this->input->get('type'):'current';
		$data['exhibitionsData'] = $this->exhibitions_detail_model->getDataByDate($type);
		$data['language'] = $this->about_model->checkLanguage();
		$data['headerData'] = $this->about_model->getHeaderData();

		$this->load->view('header', $data);
		$this->load->view('exhibitions_list', $data);
		$this->load->view('footer');
	}
}