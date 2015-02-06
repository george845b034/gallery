<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artis_detail extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('about_model', 'artists_detail_model'));
	}

	public function index()
	{
		$this->about_model->setLanguage($this->input->get('lang', true));
		$id = $this->input->get('id');
		if(empty($id))redirect('main');

		$data['artistsData'] = $this->artists_detail_model->getDataById($id);
		$data['artistsList'] = $this->artists_detail_model->getDataAll();
		$data['language'] = $this->about_model->checkLanguage();
		$data['headerData'] = $this->about_model->getHeaderData();
		$data['id'] = $id;
		if(count($data['artistsData']) <= 0)redirect('main');

		$this->load->view('header', $data);
		$this->load->view('artis_detail', $data);
		$this->load->view('footer');
	}
}