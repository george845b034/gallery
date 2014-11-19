<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('captcha'));
		$this->config->set_item('language', 'zh-tw');
		$this->load->model(array('admin_model'));
		$this->load->library(array('form_validation', 'captcha'));
	}

	public function index()
	{
		switch ($this->input->post('type')) {
			//取得token
			case 1:
				echo ($this->input->post('token') == $this->session->userdata('csrf_token'))?true:false;
				$this->session->unset_userdata('csrf_token');
				break;
			//取得驗証
			case 2:
				echo ($this->input->post('captcha') == $this->session->userdata('captcha_info')['code'])?true:false;
				break;
			//驗証帳密
			case 3:
				echo ($this->admin_model->login($this->input->post('account'), $this->input->post('password')) == 1 )?true:false;
				break;
			//取得驗証圖片
			case 4:
				echo json_encode($this->captcha_create());
				break;
			default:
				$this->view();
				break;
		}
	}

	private function view()
	{
		$data = array();
		//驗証圖形
		$data['captcha'] = $this->captcha_create();

		//csrf token
		$data['token'] = md5(uniqid());
		$this->session->set_userdata('csrf_token', $data['token']);

		$this->load->view('backsite/header');
		$this->load->view('backsite/login', $data);
		$this->load->view('backsite/footer');	
	}

	/**
	 * 驗証圖形產生
	 * @return void
	 */
	private function captcha_create()
	{
		$data = $this->captcha->main(array(
			'code' => '',
			'min_length' => 5,
			'max_length' => 5,
			'png_backgrounds' => array(base_url('/images/captcha/captcha_bg.png')),
			'fonts' => array(FCPATH.'/images/captcha/times_new_yorker.ttf'),
			'characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',
			'min_font_size' => 22,
			'max_font_size' => 28,
			'color' => '#000',
			'angle_min' => 0,
			'angle_max' => 15,
			'shadow' => true,
			'shadow_color' => '#CCC',
			'shadow_offset_x' => -2,
			'shadow_offset_y' => 2
		));
		
		$this->session->set_userdata('captcha_info', $data);

		return $data;
	}
}