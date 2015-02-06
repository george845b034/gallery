<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publications_detail extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('main_model', 'admin_model', 'publications_detail_model'));
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
					$uploadArName = $this->uploadConfig('jpg|png', 'p_image');
					
					$inputData = $this->input->post(NULL, TRUE);
					$inputData['p_image'] = $uploadArName;

					echo json_encode($this->publications_detail_model->add($inputData));	
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
					$uploadArName = $this->uploadConfig('jpg|png', 'p_image');
					
					$inputData = $this->input->post(NULL, TRUE);
					$inputData['p_image'] = $uploadArName;
					if($inputData['p_image'] == '')unset($inputData['p_image']);
					
					echo json_encode($this->publications_detail_model->update($inputData));	
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
		$data['result'] = $this->publications_detail_model->getData($getId);
		$name = ($data['result'])?' - <b>' . $data['result']['p_tw_name'] . '</b>':'';
		$title = ($data['result'])?'':'新增';
		$data['breadName'] = ($name == '')?$title:$name;
		$data['type'] = ($data['result'])?2:1;
		$data['menu'] = $this->main_model->getMenu();
		$data['page_title'] = $title . ' 消息' . $name;
		$data['p_id'] = $getId;
		//csrf token
		$data['token'] = md5(uniqid());
		$this->session->set_userdata('csrf_token', $data['token']);

		$this->load->view('backsite/header', $data);
		$this->load->view('backsite/navigation', $data);
		$this->load->view('backsite/publications_detail', $data);
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
		$config['upload_path'] = './uploads/images/publications';
        $config['allowed_types'] = $inType;
        $config['overwrite'] = true;

        //判斷是否有目錄及新增目錄
    	if(!is_dir('./uploads/images/publications'))
		{
			mkdir('./uploads/images/publications', 0775);
			chmod('./uploads/images/publications', 0775);
		}
        /*****End 處理目錄名稱 *****/

		if(isset($_FILES[$inName]))
		{
			$this->load->library('upload', $config);
			$this->upload->do_multi_upload($inName);
			$this->load->library('image_lib');
			
			//縮圖
			$config['image_library'] = 'gd2';
			$config['source_image']	= $_FILES[$inName]['tmp_name'];
			$config['new_image']	= $config['upload_path'] . '/thumb/'. $_FILES[$inName]['name'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width']	 = 252;
			$config['height']	= 161;
			 
			$this->image_lib->initialize($config);
			if ( ! $this->image_lib->resize())
			{
				echo $this->image_lib->display_errors();
			}

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
		$data = $this->publications_detail_model->getArtistsAll();

		$temp = array();
		foreach ($data as $key => $value) {
			array_push($temp, $value['p_image']);
		}

		$map = directory_map('./uploads/images/publications', 1);

		$resultDiff = array_diff($temp, $map);
		foreach ($resultDiff as $key => $value) {
			if (is_file( FCPATH . 'uploads/images/publications/' . $value))
				unlink(FCPATH . 'uploads/images/publications/' . $value);
			if (is_file( FCPATH . 'uploads/images/publications/thumb/' . $value))
				unlink(FCPATH . 'uploads/images/publications/thumb/' . $value);
		}
		
	}
}