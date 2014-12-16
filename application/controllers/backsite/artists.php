<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artists extends CI_Controller {

	var $displayCount = 50;

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('main_model', 'admin_model', 'artists_model'));
		$this->load->helper('file');
		$this->load->library('pagination');



		if(!$this->admin_model->checkSession() OR !$this->admin_model->checkIp())redirect('backsite/login');
	}

	public function index()
	{
		switch ($this->input->post('type')) {
			case 1:
				echo json_encode($this->artists_model->deleteData($this->input->post('id')));
				break;
			default:
				$this->view();
				break;
		}
	}

	private function view()
	{
		$currentPaage = ($this->input->get('page'))?$this->input->get('page'):0;
		$this->paginationStart();
		$data['result'] = $this->artists_model->getData($this->displayCount, $currentPaage);
		$data['menu'] = $this->main_model->getMenu();
		$data['page_title'] = '藝術家列表';

		$this->load->view('backsite/header', $data);
		$this->load->view('backsite/navigation', $data);
		$this->load->view('backsite/artists', $data);
		$this->load->view('backsite/footer');	
	}

	/**
	 * 分頁設定
	 * @return void result
	 */
	private function paginationStart()
	{
		$config['base_url'] = base_url('/backsite/artists?g=1');
		$config['total_rows'] = $this->db->count_all_results('`gallery`.artists');
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