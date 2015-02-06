<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('about_model'));
		$this->load->library(array('captcha'));

	}

	public function index()
	{
		$this->about_model->setLanguage($this->input->get('lang', true));
		//驗証圖形
		$data['captcha'] = $this->captcha_create();
		$data['language'] = $this->about_model->checkLanguage();
		$data['headerData'] = $this->about_model->getHeaderData();

		$this->load->view('header', $data);
		$this->load->view('contacts', $data);
		$this->load->view('footer');
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
			'fonts' => array(FCPATH.'images/captcha/times_new_yorker.ttf'),
			'characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
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