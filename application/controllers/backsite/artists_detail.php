<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artists_detail extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('main_model', 'admin_model', 'artists_detail_model'));
		$this->load->helper(array('file', 'directory'));

		if(!$this->admin_model->checkSession() OR !$this->admin_model->checkIp())redirect('backsite/login');
	}

	public function index()
	{
		switch ($this->input->post('type')) {
			//新增
			case 1:
				$returnArray = array();
				if($this->input->post('token') == $this->session->userdata('csrf_token') && $this->input->post('token'))
				{
					//上傳圖片
					$uploadArName = $this->uploadConfig('jpg|png', 'ar_image');
					$uploadArCvName = $this->uploadConfig('jpg|png', 'ar_cv_image');
					
					$inputData = $this->input->post(NULL, TRUE);
					$inputData['ar_image'] = $uploadArName;
					$inputData['ar_cv_image'] = $uploadArCvName;

					echo json_encode($this->artists_detail_model->add($inputData));	
				}else{
					$returnArray['status'] = "FAIL";
            		$returnArray['msg'] = "Token Fail";
            		echo json_encode($returnArray);	
				}

				$this->session->unset_userdata('csrf_token');
				
				break;
			//修改
			case 2:
				$returnArray = array();
				if($this->input->post('token') == $this->session->userdata('csrf_token') && $this->input->post('token'))
				{
					//上傳圖片
					$uploadArName = $this->uploadConfig('jpg|png', 'ar_image');
					$uploadArCvName = $this->uploadConfig('jpg|png', 'ar_cv_image');
					
					$inputData = $this->input->post(NULL, TRUE);
					$inputData['ar_image'] = $uploadArName;
					$inputData['ar_cv_image'] = $uploadArCvName;

					echo json_encode($this->artists_detail_model->update($inputData));	
				}else{
					$returnArray['status'] = "FAIL";
            		$returnArray['msg'] = "Token Fail";
            		echo json_encode($returnArray);	
				}

				$this->session->unset_userdata('csrf_token');
				$this->deleteImages();
				break;
			default:
				$this->view();
				break;
		}
	}

	private function view()
	{
		$getId = $this->input->get('id', TRUE);
		$data['result'] = $this->artists_detail_model->getData($getId);
		$name = ($data['result'])?' - <b>' . $data['result']['ar_tw_name'] . '</b>':'';
		$title = ($data['result'])?'':'新增';
		$data['breadName'] = ($name == '')?$title:$name;
		$data['type'] = ($data['result'])?2:1;
		$data['menu'] = $this->main_model->getMenu();
		$data['page_title'] = $title . ' 藝術家' . $name;
		$data['ar_id'] = $getId;
		//csrf token
		$data['token'] = md5(uniqid());
		$this->session->set_userdata('csrf_token', $data['token']);

		$this->load->view('backsite/header', $data);
		$this->load->view('backsite/navigation', $data);
		$this->load->view('backsite/artists_detail', $data);
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
		$config['upload_path'] = './uploads/images/artists';
        $config['allowed_types'] = $inType;
        $config['overwrite'] = true;

        //判斷是否有目錄及新增目錄
    	if(!is_dir('./uploads/images/artists'))
		{
			mkdir('./uploads/images/artists', 0775);
			chmod('./uploads/images/artists', 0775);
		}
        /*****End 處理目錄名稱 *****/

		if(isset($_FILES[$inName]))
		{
			$this->load->library('upload', $config);
			$this->upload->do_multi_upload($inName);
			
			return $_FILES[$inName]['name'];
		}

		return '';
	}

	/**
	 * 刪除圖片
	 * @return void result
	 */
	private function deleteImages()
	{
		$data = $this->artists_detail_model->getArtistsAll();

		$temp = array();
		foreach ($data as $key => $value) {
			array_push($temp, $value['ar_image']);
			array_push($temp, $value['ar_cv_image']);
		}

		$map = directory_map('./uploads/images/artists', 1);

		$resultDiff = array_diff($temp, $map);
		foreach ($resultDiff as $key => $value) {
			if (is_file( FCPATH . 'uploads/images/artists/' . $value))
				unlink(FCPATH . 'uploads/images/artists/' . $value);
		}
		
	}
}