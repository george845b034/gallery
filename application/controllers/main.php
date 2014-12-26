<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('about_model', 'exhibitions_model', 'artists_model', 'publications_model'));

		$this->session->set_userdata('language', 'tw');
	}

	public function index()
	{
		$data['aboutData'] = $this->about_model->getData();
		$data['exhibitionsData'] = $this->exhibitions_model->getLastData();
		$data['artistsData'] = $this->artists_model->getDataAll();
		$data['publicationsData'] = $this->publications_model->getDataAll();

		$this->load->view('header');
		$this->load->view('main', $data);
		$this->load->view('footer');
	}
}