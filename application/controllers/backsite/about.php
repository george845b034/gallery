<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('main_model', 'admin_model', 'about_model'));
		$this->load->helper('file');

		if(!$this->admin_model->checkSession() OR !$this->admin_model->checkIp())redirect('backsite/login');
	}

	public function index()
	{
		switch ($this->input->post('type')) {
			case 1:
				$returnArray = array();
				if($this->input->post('token') == $this->session->userdata('csrf_token') && $this->input->post('token'))
				{
					//上傳圖片
					$uploadName = $this->uploadConfig('jpg|png', 'image');

					echo json_encode($this->about_model->update($uploadName, 
						$this->input->post('tw_introduction'), 
						$this->input->post('cn_introduction'), 
						$this->input->post('en_introduction'), 
						$this->input->post('jp_introduction')
					));	
				}else{
					$returnArray['status'] = "FAIL";
            		$returnArray['msg'] = "Token Fail";
            		echo json_encode($returnArray);	
				}

				$this->session->unset_userdata('csrf_token');
				break;
			default:
				$this->view();
				break;
		}
	}

	private function view()
	{
		$data['result'] = $this->about_model->getData();
		$data['menu'] = $this->main_model->getMenu();
		$data['page_title'] = '關於藝廊';
		//csrf token
		$data['token'] = md5(uniqid());
		$this->session->set_userdata('csrf_token', $data['token']);

		$this->load->view('backsite/header', $data);
		$this->load->view('backsite/navigation', $data);
		$this->load->view('backsite/about', $data);
		$this->load->view('backsite/footer');	
	}

	/**
	 * 上傳檔案
	 * @param  string $inType 上傳的型態
	 * @param  string $inName 變數名稱
	 * @return array result
	 */
	private function uploadConfig($inType, $inName)
	{
		/*****Begin 處理目錄名稱 *****/
		$tempArray = array();
		$config['upload_path'] = './uploads/images/introduction';
        $config['allowed_types'] = $inType;
        $config['overwrite'] = true;

        //判斷是否有目錄及新增目錄
    	if(!is_dir('./uploads/images/introduction'))
		{
			mkdir('./uploads/images/introduction', 0775);
			chmod('./uploads/images/introduction', 0775);
		}
        /*****End 處理目錄名稱 *****/

		if(isset($_FILES[$inName]))
		{
	        //先刪除檔案
	        delete_files('./uploads/images/introduction');

			$this->load->library('upload', $config);
			$this->upload->do_multi_upload($inName);
			
			return $_FILES[$inName]['name'];
		}

		return '';
	}
}