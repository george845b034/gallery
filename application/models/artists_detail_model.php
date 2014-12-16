<?php
class artists_detail_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
	
    public function add($inData)
    {
        $returnArray = array();

        $data = array(
            'ar_tw_name' => $inData['ar_tw_name'],
            'ar_cn_name' => $inData['ar_cn_name'],
            'ar_en_name' => $inData['ar_en_name'],
            'ar_jp_name' => $inData['ar_jp_name'],
            'ar_image' => $inData['ar_image'],
            'ar_cv_image' => $inData['ar_cv_image'],
            'ar_tw_content' => $inData['ar_tw_content'],
            'ar_cn_content' => $inData['ar_cn_content'],
            'ar_en_content' => $inData['ar_en_content'],
            'ar_jp_content' => $inData['ar_jp_content'],
            'ar_update_user' => $this->session->userdata('username'),
            'ar_update_time' => date('Y-m-d H:i:s'),
            'ar_create_time' => date('Y-m-d H:i:s')
        );

        $this->db->insert('`gallery`.artists', $data);
        
        if ($this->db->affected_rows() > 0) {
            
            $returnArray['status'] = "SUCCESS";
            $returnArray['msg'] = "Modify Success";
        } else {
            $returnArray['status'] = "FAIL";
            $returnArray['msg'] = "Modify Fail";
        }

        return $returnArray;
    }

    /**
     * 更新資料
     * @param  array $inData 輸入資料陣列
     * @return array         result
     */
    public function update($inData)
    {
        $returnArray = array();

    	$data = array(
            'ar_tw_name' => $inData['ar_tw_name'],
            'ar_cn_name' => $inData['ar_cn_name'],
            'ar_en_name' => $inData['ar_en_name'],
            'ar_jp_name' => $inData['ar_jp_name'],
            'ar_image' => $inData['ar_image'],
            'ar_cv_image' => $inData['ar_cv_image'],
            'ar_tw_content' => $inData['ar_tw_content'],
            'ar_cn_content' => $inData['ar_cn_content'],
            'ar_en_content' => $inData['ar_en_content'],
            'ar_jp_content' => $inData['ar_jp_content'],
            'ar_update_user' => $this->session->userdata('username'),
            'ar_update_time' => date('Y-m-d H:i:s'),
            'ar_create_time' => date('Y-m-d H:i:s')
        );

		$this->db->update('`gallery`.artists', $data, "ar_id =" . $inData['ar_id']);
		
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
     * @param  int $inId   流水號
     * @return array result
     */
    public function getData($inId)
    {
        $this->db->select('*');
        $this->db->from('`gallery`.artists');
        $this->db->where('ar_id', $inId);
        $query = $this->db->get();
        
        $result = $query->row_array();
        return $result;
    }

    /**
     * 取得全部藝術家的資料
     * @return array result
     */
    public function getArtistsAll()
    {
        $this->db->select('*');
        $this->db->from('`gallery`.artists');
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;   
    }
}