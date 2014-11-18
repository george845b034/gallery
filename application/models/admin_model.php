<?php
class admin_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
	
	/**
	 * 檢查是否有使用者
	 * @param  string $inAccount
	 * @param  string $inPassword
	 * @return int
	 */
	public function login($inAccount, $inPassword)
	{
		$tempPermissionArray = array();

		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('a_account', $inAccount);
		$this->db->where('a_password', md5($inPassword));
		$this->db->where('a_flag', 1);
		$query = $this->db->get();
		$result = $query->row_array();

		if(count( $this->db->count_all_results() ) == 1)
		{
			$this->session->set_userdata('is_login', 1);
			$this->session->set_userdata('username', $result['a_username']);

			//權限
			$this->db->select('*');
			$this->db->from('admin_permission');
			$this->db->where('a_id', $result['a_id']);
			$query = $this->db->get();
			$permission = $query->result_array();

			foreach ($permission as $key => $value) {
				array_push($tempPermissionArray, $value['ap_name']);
			}
			$this->session->set_userdata('permission', $tempPermissionArray);

			return 1;
		}else{
			return 0;
		}
	}

	/**
	 * 確認是否有登入
	 * @return boolean
	 */
	public function checkSession()
	{
		if( $this->session->userdata('is_login') == 1 ){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * 確認ip位子
	 * @return boolean
	 */
	public function checkIp()
	{
		//確認ip位子
		if( WEB_IP == $this->input->ip_address() OR $this->input->ip_address() == '127.0.0.1' ){
			return true;
		}else{
			return false;
		}	
	}
}