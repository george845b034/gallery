<?php
class main_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
	
    /**
     * 取得選單
     * @return array result
     */
	public function getMenu()
	{
		$this->db->select('*');
		$this->db->from('`backsite`.menu');
		$query = $this->db->get();
		
		return $query->result_array();
	}

	/**
	 * 取得子選單的資料
	 * @param  int $inId
	 * @return array result
	 */
	public  function getSubMenu($inId)
	{
		$this->db->select('*');
		$this->db->from('`backsite`.submenu');
		$this->db->where('m_id', $inId);
		$query = $this->db->get();
		
		return $query->result_array();	
	}
}