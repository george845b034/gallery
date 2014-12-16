<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Syntrend_app extends CI_Controller {

	public function index()
	{
		$response = json_decode(file_get_contents('http://opendata.dot.taipei.gov.tw/opendata/allavailable.json'), true);
		$data = array();

		foreach ($response['data']['park'] as $key => $value) {
			if($value['id'] == '214')$data = $value;
		}

		$this->load->view('syntrend_app', $data);
	}
}