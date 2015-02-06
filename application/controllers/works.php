<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Works extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('about_model', 'artists_detail_model', 'exhibitions_detail_model'));
	}

	public function index()
	{
		$this->about_model->setLanguage($this->input->get('lang', true));
		$index = $this->input->get('index');
		$id = $this->input->get('id');
		// if(!$id)redirect('works_list');

		if(!$id){
			$artistsId = $this->input->get('artistsId');
			if(!$artistsId)redirect('works_list');
			$data['worksData'] = $this->artists_detail_model->getArtitsWithWork($artistsId);
		}else{
			$data['worksData'] = $this->exhibitions_detail_model->getWorksConnectExhibitionsData($id);
		}
		$data['language'] = $this->about_model->checkLanguage();
		$data['headerData'] = $this->about_model->getHeaderData();
		$data['index'] = ($index)?$index:0;

		if(count($data['worksData']) <= 0)redirect('works_list');

		$this->load->view('header', $data);
		$this->load->view('works', $data);
		$this->load->view('footer');
	}
}