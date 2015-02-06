<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qrcode extends CI_Controller {

	public function index()
	{
		//Detect special conditions devices
		// $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
		// $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		// $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
		// $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
		// $webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

		// //do something with this information
		// if( $iPad || $iPhone ){
		//     header("Location: https://itunes.apple.com/tw/app/line-everybodys-marble/id891264481?mt=8&v0=WWW-GCTW-ITSTOP100-FREEAPPS&l=zh&ign-mpt=uo%3D4");
		// 	die();
		// }else if($Android){
		//     header("Location: https://play.google.com/store/apps/details?id=com.linecorp.LGGRTW");
		// 	die();
		// }
		// 
		// 
		

		$this->load->library('email');

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
		

		$this->email->initialize($config);
		$this->email->set_newline("\r\n");

		$this->email->from('george845b034@gmail.com', 'george');
		$this->email->to('george.cc.chang@syntrend.com.tw');
		$this->email->subject('From website email');
		$this->email->message('TESTTESTTESTTESTTESTTESTTESTTESTTESTTEST');

		if($this->email->send())
		{
			echo json_encode('Success sending');
		}else{
			echo json_encode('Fail send email');
		}
	}
}