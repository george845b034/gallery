<?php
class publications_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
	
    /**
     *  取得全部的藝術家
     * @return array result
     */
    public function getDataAll()
    {
        $this->db->select('*');
        $this->db->from('`gallery`.publications');
        $this->db->order_by('p_update_time', 'DESC');
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;   
    }
}