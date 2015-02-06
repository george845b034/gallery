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

    /**
     * 刪除資料
     * @param  int $id 流水號
     * @return array result
     */
    public function deleteData($id)
    {
        if(empty($id))return;
        $returnArray = array();

        $this->db->where('p_id', $id);
        $this->db->delete('`gallery`.publications');

        if ($this->db->affected_rows() >= 0) {
            
            $returnArray['status'] = "SUCCESS";
            $returnArray['msg'] = "Modify Success";
        } else {
            $returnArray['status'] = "FAIL";
            $returnArray['msg'] = "Modify Fail";
        }

        return $returnArray;
    }

    /**
     * 取得刊物的資料
     * @param  int $inPage 目前頁面
     * @param  int $inLimit 顯示多少數量
     * @return array result
     */
    public function getData($inLimit, $inPage)
    {
        $this->db->select('*');
        $this->db->from('`gallery`.publications');
        $this->db->order_by('p_update_time', 'DESC'); 
        $this->db->limit($inLimit, $inPage);
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;
    }

}