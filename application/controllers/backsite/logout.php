<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//先清session
		$this->session->sess_destroy();
		redirect('/backsite/login', 'refresh');
	}

}