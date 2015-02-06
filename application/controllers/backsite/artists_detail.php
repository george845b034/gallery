<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artists_detail extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('main_model', 'admin_model', 'artists_detail_model'));
		$this->load->helper(array('file', 'directory'));
		$this->load->library('upload');

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
					$uploadArName = $this->uploadConfig('jpg|png', 'ar_image', 32, 32, 'artists');
					$uploadArCvName = $this->uploadConfig('jpg|png', 'ar_cv_image', 600, 392, 'artists');
					$arrayName = $this->uploadConfig('jpg|png', 'w_image', 600, 392, 'works');
					$pdfName = $this->uploadPdf('ar_pdf');
					
					$inputData = $this->input->post(NULL, TRUE);
					$inputData['ar_image'] = $uploadArName;
					$inputData['ar_cv_image'] = $uploadArCvName;
					$inputData['ar_pdf'] = $pdfName;

					echo json_encode($this->artists_detail_model->add($inputData));	
					if(is_array($arrayName))$this->artists_detail_model->addWorks($this->db->insert_id(), $arrayName, $this->input->post('w_description'));
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
					$uploadArName = $this->uploadConfig('jpg|png', 'ar_image', 32, 32, 'artists');
					$uploadArCvName = $this->uploadConfig('jpg|png', 'ar_cv_image', 600, 392, 'artists');
					$arrayName = $this->uploadConfig('jpg|png', 'w_image', 600, 392, 'works');
					$pdfName = $this->uploadPdf('ar_pdf');
					
					$inputData = $this->input->post(NULL, TRUE);
					$inputData['ar_image'] = $uploadArName;
					$inputData['ar_cv_image'] = $uploadArCvName;
					$inputData['ar_pdf'] = $pdfName;
					if($inputData['ar_image'] == '')unset($inputData['ar_image']);
					if($inputData['ar_cv_image'] == '')unset($inputData['ar_cv_image']);
					if($inputData['ar_pdf'] == '')unset($inputData['ar_pdf']);
					
					$this->artists_detail_model->updateWorks($this->input->post('w_id_hidden'), $this->input->post('w_description'));
					if(is_array($arrayName))$this->artists_detail_model->addWorks($inputData['ar_id'], $arrayName, $this->input->post('w_description'));
					echo json_encode($this->artists_detail_model->update($inputData));	
				}else{
					$returnArray['status'] = "FAIL";
            		$returnArray['msg'] = "Token Fail";
            		echo json_encode($returnArray);	
				}

				$this->session->unset_userdata('csrf_token');
				$this->deleteImages();
				break;
			//刪除works
			case 3:
				if(!$this->input->post('id'))return;

				$returnArray = $this->artists_detail_model->getWorksDataByWId($this->input->post('id'));
				$this->deleteWorksImagesByName($returnArray['w_image']);
				echo json_encode($this->artists_detail_model->deleteWorksData($this->input->post('id')));
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
		$data['resultWorks'] = $this->artists_detail_model->getWorksDataByArId($getId);
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
	 * 上傳pdf檔
	 * @param  string $inName 檔案名稱
	 * @return string result
	 */
	private function uploadPdf($inName)
	{
		$newName = '';
		$config = array();
		$config['upload_path'] = './uploads/pdf';
        $config['allowed_types'] = 'pdf';
        $config['overwrite'] = true;

        //判斷是否有目錄及新增目錄
    	if(!is_dir('./uploads/pdf'))
		{
			mkdir('./uploads/pdf', 0775);
			chmod('./uploads/pdf', 0775);
		}

		if(isset($_FILES[$inName]))
		{
			//處理中文 WINNT 和 Linux的編碼
			if(PHP_OS == 'WINNT')$_FILES[$inName]["name"] = mb_convert_encoding($_FILES[$inName]["name"],"big5","utf8");

			$this->upload->initialize($config);
			if ( ! $this->upload->do_multi_upload($inName))
			{
				$error = array('error' => $this->upload->display_errors());

				$result['message'] = $error;
				$result['status'] = 'FAIL';
			}

			$uploadData = $this->upload->data();
			//處理中文
			$newName = (PHP_OS == 'WINNT')?mb_convert_encoding($uploadData["file_name"],"utf8","big5"):$uploadData["file_name"];
		}

		return $newName;
	}
	
	/**
	 * 上傳檔案
	 * @param  string $inType 上傳的型態
	 * @param  string $inName 變數名稱
	 * @param  int $inWidth 縮圖寬度
	 * @param  int $inHeight 縮圖高度
	 * @param  string $inFolder 資料夾名稱
	 * @return array result
	 */
	private function uploadConfig($inType, $inName, $inWidth, $inHeight, $inFolder)
	{
		/*****Begin 處理目錄名稱 *****/
		$tempArray = array();
		$config = array();
		$data = array();
		$config['upload_path'] = './uploads/images/' . $inFolder;
        $config['allowed_types'] = $inType;
        $config['overwrite'] = true;

        //判斷是否有目錄及新增目錄
    	if(!is_dir('./uploads/images/' . $inFolder))
		{
			mkdir('./uploads/images/' . $inFolder, 0775);
			chmod('./uploads/images/' . $inFolder, 0775);
		}
        /*****End 處理目錄名稱 *****/

		if(isset($_FILES[$inName]))
		{
			$this->upload->initialize($config);
			if ( ! $this->upload->do_multi_upload($inName))
			{
				$error = array('error' => $this->upload->display_errors());

				$result['message'] = $error;
				$result['status'] = 'FAIL';
			}
			else
			{
				$this->upload->initialize($config);
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
			if (is_file( FCPATH . 'uploads/images/artists/thumb/' . $value))
				unlink(FCPATH . 'uploads/images/artists/thumb/' . $value);
		}
		
	}
	/**
	 * 刪除圖片
	 * @param  string $inName 資料夾名稱
	 * @return void result
	 */
	private function deleteWorksImagesByName($inName)
	{
		if (is_file( FCPATH . 'uploads/images/works/' . $inName))
			unlink(FCPATH . 'uploads/images/works/' . $inName);
		if (is_file( FCPATH . 'uploads/images/works/thumb/' . $inName))
			unlink(FCPATH . 'uploads/images/works/thumb/' . $inName);
	}
}