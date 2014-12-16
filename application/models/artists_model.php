<?php
class artists_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
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

        $this->db->where('ar_id', $id);
        $this->db->delete('`gallery`.artists');

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
     * 取得藝術家的資料
     * @param  int $inPage 目前頁面
     * @param  int $inLimit 顯示多少數量
     * @return array result
     */
    public function getData($inLimit, $inPage)
    {
        $this->db->select('*');
        $this->db->from('`gallery`.artists');
        $this->db->order_by('ar_update_time', 'DESC'); 
        $this->db->limit($inLimit, $inPage);
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;
    }
}