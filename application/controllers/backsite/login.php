<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('captcha'));
		$this->config->set_item('language', 'zh-tw');
		$this->load->model(array('admin_model'));
		$this->load->library('form_validation');
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
				echo ($this->input->post('captcha') == $this->session->userdata('captcha'))?true:false;
				break;
			//驗証帳密
			case 3:
				echo ($this->admin_model->login($this->input->post('account'), $this->input->post('password')) == 1 )?true:false;
				break;
			//取得驗証圖片
			case 4:
				echo $this->captcha_img();
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
		$data['captcha'] = $this->captcha_img();
		//csrf token
		$data['token'] = md5(uniqid());
		$this->session->set_userdata('csrf_token', $data['token']);

		$this->load->view('backsite/header');
		$this->load->view('backsite/login', $data);
		$this->load->view('backsite/footer');	
	}

	/**
	 * 檢驗輸入欄位
	 * @return void
	 */
	public function login_validation()
	{
		$this->form_validation->set_rules('account', 'Account', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('captcha', 'Captcha', 'required|callback_captcha_check');

		if($this->input->post('token') == $this->session->userdata('csrf_token'))
		{
			if ($this->form_validation->run() == FALSE)
			{
				$this->index();
			}
			else
			{
				if($this->admin_model->checkAdmin($this->input->post('account'), $this->input->post('password')) == 1)
				{
					redirect('./backsite/main', 'refresh');
					exit();
				}

				$this->form_validation->set_rules('account_check');
				$this->form_validation->run();
				$this->index();
			}
		}else{
			show_404();
		}
	}

	/**
	 * 驗証數字
	 * @param  string $str
	 * @return boolean
	 */
	public function captcha_check($str)
	{
		if ($str != $this->session->userdata('captcha'))
		{
			$this->form_validation->set_rules('captcha_check');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/**
	 * 驗証器
	 * @return string html img
	 */
	private function captcha_img()
    {
        $pool = '0123456789';
        $word = '';
        for ($i = 0; $i < 4; $i++){
            $word .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
        }
        $this->session->set_userdata('captcha', $word);
        $vals = array(
            'word'  => $word,
            'img_path'  => './captcha/',
            'img_url'  => base_url() . '/captcha/',
		    'img_width'	=> 100,
		    'img_height' => 30,
            'expiration' => 1200
            );
        $cap = create_captcha($vals);
        
        return $cap['image'];
    }
}