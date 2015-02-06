<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exhibitions_detail extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('main_model', 'admin_model', 'artists_model', 'exhibitions_detail_model'));
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
					$uploadArName = $this->uploadConfig('jpg|png', 'e_image', 252, 161);
					$arrayName = $this->uploadConfig('jpg|png', 'eiv_image', 600, 392);
					
					$inputData = $this->input->post(NULL, TRUE);
					$inputData['e_image'] = $uploadArName;

					echo json_encode($this->exhibitions_detail_model->add($inputData));
					if($this->input->post('w_id'))$this->exhibitions_detail_model->addWorksAndUpdate($this->db->insert_id(), $this->input->post('w_id'));
					if(is_array($arrayName))$this->exhibitions_detail_model->updateInstallationView($this->db->insert_id(), $arrayName);
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
					$uploadArName = $this->uploadConfig('jpg|png', 'e_image', 252, 161);
					$arrayName = $this->uploadConfig('jpg|png', 'eiv_image', 600, 392);
					
					$inputData = $this->input->post(NULL, TRUE);
					$inputData['e_image'] = $uploadArName;
					if($inputData['e_image'] == '')unset($inputData['e_image']);
					
					if(is_array($arrayName))$this->exhibitions_detail_model->updateInstallationView($inputData['e_id'], $arrayName);
					if($this->input->post('w_id'))$this->exhibitions_detail_model->addWorksAndUpdate($inputData['e_id'], $this->input->post('w_id'));
					echo json_encode($this->exhibitions_detail_model->update($inputData));	
				}else{
					$returnArray['status'] = "FAIL";
            		$returnArray['msg'] = "Token Fail";
            		echo json_encode($returnArray);	
				}

				$this->session->unset_userdata('csrf_token');
				$this->deleteImages();
				break;
			//取得作品資料
			case 3:
				if(!$this->input->post('id'))return;
				echo json_encode($this->exhibitions_detail_model->getWorkData($this->input->post('id')));
				break;
			default:
				$this->view();
				break;
		}
	}

	private function view()
	{
		$getId = $this->input->get('id', TRUE);
		$data['result'] = $this->exhibitions_detail_model->getData($getId);
		$data['resultInstallationsView'] = $this->exhibitions_detail_model->getInstallationsViewData($getId);
		$data['artistsData'] = $this->artists_model->getDataAll();
		$data['artistsWithWork'] = $this->exhibitions_detail_model->getArtitsWithWork();
		$data['works'] = $this->exhibitions_detail_model->getWorksConnectExhibitionsData($getId);

		$name = ($data['result'])?' - <b>' . $data['result']['e_tw_name'] . '</b>':'';
		$title = ($data['result'])?'':'新增';
		$data['breadName'] = ($name == '')?$title:$name;
		$data['type'] = ($data['result'])?2:1;
		$data['menu'] = $this->main_model->getMenu();
		$data['page_title'] = $title . ' 展覽' . $name;
		$data['e_id'] = $getId;
		//csrf token
		$data['token'] = md5(uniqid());
		$this->session->set_userdata('csrf_token', $data['token']);

		$this->load->view('backsite/header', $data);
		$this->load->view('backsite/navigation', $data);
		$this->load->view('backsite/exhibitions_detail', $data);
		$this->load->view('backsite/footer');
	}

	/**
	 * 上傳檔案
	 * @param  string $inType 上傳的型態
	 * @param  string $inName 變數名稱
	 * @param  int $inWidth 縮圖寬度
	 * @param  int $inHeight 縮圖高度
	 * @return array result
	 */
	private function uploadConfig($inType, $inName, $inWidth, $inHeight)
	{
		/*****Begin 處理目錄名稱 *****/
		$tempArray = array();
		$config['upload_path'] = './uploads/images/exhibitions';
        $config['allowed_types'] = $inType;
        $config['overwrite'] = true;

        //判斷是否有目錄及新增目錄
    	if(!is_dir('./uploads/images/exhibitions'))
		{
			mkdir('./uploads/images/exhibitions', 0775);
			chmod('./uploads/images/exhibitions', 0775);
		}
        /*****End 處理目錄名稱 *****/

		if(isset($_FILES[$inName]))
		{
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_multi_upload($inName))
			{
				$error = array('error' => $this->upload->display_errors());

				$result['message'] = $error;
				$result['status'] = 'FAIL';
			}
			else
			{
				$data = $this->upload->get_multi_upload_data();
				$this->load->library('image_lib');
				
				//單一縮圖
				if( count($data) == 0 )
				{
					$config['image_library'] = 'gd2';
					$config['source_image']	= $_FILES[$inName]['tmp_name'];
					$config['new_image']	= $config['upload_path'] . '/thumb/'. $_FILES[$inName]['name'];
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width']	 = $inWidth;
					$config['height']	= $inHeight;
					 
					$this->image_lib->initialize($config);
					if ( ! $this->image_lib->resize())
					{
						echo $this->image_lib->display_errors();
					}
				}

				foreach ($data as $key => $value) {
					//縮圖
					$config['image_library'] = 'gd2';
					$config['source_image']	= $value['full_path'];
					$config['new_image']	= $value['file_path']. 'thumb/'. $value['file_name'];
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width']	 = $inWidth;
					$config['height']	= $inHeight;
					 
					$this->image_lib->initialize($config);
					if ( ! $this->image_lib->resize())
					{
						echo $this->image_lib->display_errors();
					}

					array_push($tempArray, $value['file_name']);
				}
			}

			if( count($data) == 0 )
			{
				return $_FILES[$inName]['name'];
			}else{
				return $tempArray;
			}
		}

		return '';
	}

	/**
	 * 刪除圖片
	 * @return void result
	 */
	private function deleteImages()
	{
		$data = $this->exhibitions_detail_model->getDataAll();

		$temp = array();
		foreach ($data as $key => $value) {
			array_push($temp, $value['e_image']);
		}

		$map = directory_map('./uploads/images/exhibitions', 1);

		$resultDiff = array_diff($temp, $map);
		foreach ($resultDiff as $key => $value) {
			if (is_file( FCPATH . 'uploads/images/exhibitions/' . $value))
				unlink(FCPATH . 'uploads/images/exhibitions/' . $value);
			if (is_file( FCPATH . 'uploads/images/exhibitions/thumb/' . $value))
				unlink(FCPATH . 'uploads/images/exhibitions/thumb/' . $value);
		}
		
	}
}