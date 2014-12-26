<?php
class exhibitions_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
	
    /**
     * 取得最後一筆的展覽
     * @return array result
     */
    public function getLastData()
    {
        $this->db->select('*');
        $this->db->from('`gallery`.exhibitions');
        $this->db->order_by('e_update_time', 'DESC');
        $query = $this->db->get();
        
        $result = $query->row_array();
        return $result;
    }
}