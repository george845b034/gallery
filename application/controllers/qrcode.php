<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qrcode extends CI_Controller {

	public function index()
	{
		//Detect special conditions devices
		$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
		$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
		$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
		$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

		//do something with this information
		if( $iPad || $iPhone ){
		    header("Location: https://itunes.apple.com/tw/app/line-everybodys-marble/id891264481?mt=8&v0=WWW-GCTW-ITSTOP100-FREEAPPS&l=zh&ign-mpt=uo%3D4");
			die();
		}else if($Android){
		    header("Location: https://play.google.com/store/apps/details?id=com.linecorp.LGGRTW");
			die();
		}
	}
}