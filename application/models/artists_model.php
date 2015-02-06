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
        $this->db->order_by('ar_sort', 'ASC');
        $this->db->order_by('ar_update_time', 'DESC'); 
        $this->db->limit($inLimit, $inPage);
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;
    }

    /**
     *  取得全部的藝術家
     * @return array result
     */
    public function getDataAll()
    {
        $this->db->select('*');
        $this->db->from('`gallery`.artists');
        $this->db->order_by('ar_sort', 'ASC');
        $this->db->order_by('ar_update_time', 'DESC');
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;   
    }

    /**
     *  取得藝術家ｂｙ　ｉｄ
     * @return array result
     */
    public function getDataById($inId)
    {
        $this->db->select('*');
        $this->db->from('`gallery`.artists');
        $this->db->where('ar_id', $inId);
        $query = $this->db->get();
        
        $result = $query->row_array();
        return $result;   
    }

    public function updateDataSort($inId, $inSymbol)
    {
        //找出最大排序值
        $this->db->select('MAX(ar_sort) AS max');
        $this->db->from('`gallery`.artists');
        $query = $this->db->get();
        
        $maxResult = $query->row_array();

        //找出目標排序
        $this->db->select('*');
        $this->db->from('`gallery`.artists');
        $this->db->where('ar_id', $inId);
        $query = $this->db->get();
        
        $result = $query->row_array();

        $currentSort = $result['ar_sort'] + $inSymbol;

        if($currentSort < 0)$currentSort = 0;
        if($currentSort >= $maxResult['max'])$currentSort = $maxResult['max'];

        $data = array('ar_sort' => $result['ar_sort']);
        $this->db->update('`gallery`.artists', $data, "ar_sort =" . $currentSort);

        $data = array('ar_sort' => $currentSort);
        $this->db->update('`gallery`.artists', $data, "ar_id =" . $inId);

        if ($this->db->affected_rows() > 0) {
            
            $returnArray['status'] = "SUCCESS";
            $returnArray['msg'] = "Modify Success";
        } else {
            $returnArray['status'] = "FAIL";
            $returnArray['msg'] = "Modify Fail";
        }
        
        return $returnArray;
    }
}