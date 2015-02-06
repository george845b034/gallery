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

    /**
     * 取得全部的展覽資料
     * @return array result
     */
    public function getAllData()
    {
        $this->db->select('*');
        $this->db->from('`gallery`.exhibitions AS a');
        $this->db->join('`gallery`.artists AS b', 'a.ar_id = b.ar_id');
        $this->db->order_by('e_update_time', 'DESC');
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;
    }

    /**
     * 取得展覽資料by id
     * @param  int $inId 藝術家編號
     * @return array result
     */
    public function getDataById($inId)
    {
        $this->db->select('*');
        $this->db->from('`gallery`.exhibitions AS a');
        $this->db->join('`gallery`.artists AS b', 'a.ar_id = b.ar_id');
        $this->db->where('b.ar_id', $inId);
        $this->db->order_by('e_update_time', 'DESC');
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;
    }

    /**
     * 取得展覽資料by 展覽編號
     * @param  int $inId 展覽編號
     * @return array result
     */
    public function getDataByEId($inId)
    {
        $this->db->select('*');
        $this->db->from('`gallery`.exhibitions');
        $this->db->where('e_id', $inId);
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;
    }

    /**
     * 取得展覽的資料
     * @param  int $inPage 目前頁面
     * @param  int $inLimit 顯示多少數量
     * @return array result
     */
    public function getData($inLimit, $inPage)
    {
        $this->db->select('*');
        $this->db->from('`gallery`.exhibitions');
        $this->db->order_by('e_update_time', 'DESC'); 
        $this->db->limit($inLimit, $inPage);
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;
    }
}