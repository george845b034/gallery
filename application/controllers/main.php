<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('about_model', 'exhibitions_model', 'artists_model', 'publications_model'));
		$this->load->library(array('captcha'));
	}

	public function index()
	{
		$this->about_model->setLanguage($this->input->get('lang', true));
		$type = $this->input->post('type', true);

		if($type == 1)$this->email();

		//驗証圖形
		$data['captcha'] = $this->captcha_create();

		$data['aboutData'] = $this->about_model->getData();
		$data['exhibitionsData'] = $this->exhibitions_model->getLastData();
		$data['artistsData'] = $this->artists_model->getDataAll();
		$data['publicationsData'] = $this->publications_model->getDataAll();
		$data['language'] = $this->about_model->checkLanguage();
		$data['headerData'] = $this->about_model->getHeaderData();
		
		$this->load->view('header', $data);
		$this->load->view('main', $data);
		$this->load->view('footer');
	}

	public function email()
	{
		$email = $this->input->post('email', true);
		$name = $this->input->post('name', true);
		$content = $this->input->post('content', true);

		if(!$email || !$name || !$content)
		{
			echo json_encode('fail! input empty');
			return;
		}
		$captchaInfo = $this->session->userdata('captcha_info');
		if($this->input->post('token') != $captchaInfo['code'])
		{
			echo json_encode('fail! captcha not match');
			return;
		}

		$this->load->library('email');

		$config = array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'george845b034@gmail.com',
		    'smtp_pass' => 'atyiurebisjvpnvc',
		    'mailtype'  => 'text', 
		    'smtp_timeout' => '4',
		    'crlf'  => '\r\n', 
		    'newline'  => '\r\n', 
		    'charset'   => 'utf-8'
		);

		// $config = array(
		//     'protocol' => 'smtp',
		//     'smtp_host' => 'mail.syntrend.com.tw',
		//     'smtp_port' => 25,
		//     'smtp_user' => 'cs',
		//     'smtp_pass' => 'cs@1100',
		//     'mailtype'  => 'text', 
		//     'smtp_timeout' => '4',
		//     'crlf'  => '\r\n', 
		//     'newline'  => '\r\n', 
		//     'charset'   => 'utf-8'
		// );

		$this->email->initialize($config);
		$this->email->set_newline("\r\n");

		$this->email->from($email, $name);
		$this->email->to('george.cc.chang@syntrend.com.tw');
		$this->email->subject('From website email');
		$this->email->message($content);

		if($this->email->send())
		{
			echo json_encode('Success sending');
		}else{
			echo json_encode('Fail send email');
		}
		
		// echo $this->email->print_debugger();
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