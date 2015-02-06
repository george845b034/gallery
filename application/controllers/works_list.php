<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Works_list extends CI_Controller {

	var $displayCount = 50;
	var $totalRows;
	var $id;

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('about_model', 'exhibitions_detail_model'));

		$this->load->library('pagination');
	}

	public function index()
	{
		$this->about_model->setLanguage($this->input->get('lang', true));
		$this->id = $id = $this->input->get('id');
		$currentPaage = ($this->input->get('page'))?$this->input->get('page'):0;
		$this->totalRows = $this->exhibitions_detail_model->getWorksConnectExhibitionsData($id);
		$this->paginationStart();
		if(empty($id))redirect('exhibitions_list?type=current');
		$data['exhibitionsData'] = $this->exhibitions_detail_model->getWorksConnectExhibitionsData($id, $this->displayCount, $currentPaage);
		$data['language'] = $this->about_model->checkLanguage();
		$data['headerData'] = $this->about_model->getHeaderData();

		if(count($data['exhibitionsData']) <= 0)redirect('exhibitions_list?type=current');

		$this->load->view('header', $data);
		$this->load->view('works_list', $data);
		$this->load->view('footer');
	}

	/**
	 * 分頁設定
	 * @return void result
	 */
	private function paginationStart()
	{
		$config['base_url'] = base_url('works_list?id=' . $this->id);
		$config['total_rows'] = count($this->totalRows);
		$config['per_page'] = $this->displayCount;
		$config['uri_segment'] = 3;
		$config['num_links'] = 4;
		//以下是設定樣式
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		$config['query_string_segment'] = 'page';
		$config['enable_query_strings'] = TRUE;
		$config['page_query_string'] = TRUE;

		$this->pagination->initialize($config); 
	}
}