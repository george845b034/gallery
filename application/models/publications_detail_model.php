<?php
class publications_detail_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
	
    public function add($inData)
    {
        $returnArray = array();

        $data = array(
            'p_tw_name' => $inData['p_tw_name'],
            'p_en_name' => $inData['p_en_name'],
            'p_image' => $inData['p_image'],
            'p_tw_content' => $inData['p_tw_content'],
            'p_en_content' => $inData['p_en_content'],
            'p_update_user' => $this->session->userdata('username'),
            'p_update_time' => date('Y-m-d H:i:s'),
            'p_create_time' => date('Y-m-d H:i:s')
        );

        $this->db->insert('`gallery`.publications', $data);
        
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
            'p_tw_name' => $inData['p_tw_name'],
            'p_en_name' => $inData['p_en_name'],
            'p_tw_content' => $inData['p_tw_content'],
            'p_en_content' => $inData['p_en_content'],
            'p_update_user' => $this->session->userdata('username'),
            'p_update_time' => date('Y-m-d H:i:s'),
            'p_create_time' => date('Y-m-d H:i:s')
        );
        if(array_key_exists('p_image', $inData))$data['p_image'] = $inData['p_image'];
		$this->db->update('`gallery`.publications', $data, "p_id =" . $inData['p_id']);
		
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
        $this->db->from('`gallery`.publications');
        $this->db->where('p_id', $inId);
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
        $this->db->from('`gallery`.publications');
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;   
    }
}