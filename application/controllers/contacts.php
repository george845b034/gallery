<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends CI_Controller {

	public function index()
	{
		$this->load->view('header');
		$this->load->view('contacts');
		$this->load->view('footer');
	}
}