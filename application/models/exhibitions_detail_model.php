<?php
class exhibitions_detail_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
	
    public function add($inData)
    {
        $returnArray = array();

        $data = array(
            'e_tw_name' => $inData['e_tw_name'],
            'e_en_name' => $inData['e_en_name'],
            'e_image' => $inData['e_image'],
            'ar_id' => $inData['ar_id'],
            'e_tw_content' => $inData['e_tw_content'],
            'e_en_content' => $inData['e_en_content'],
            'e_tw_description' => $inData['e_tw_description'],
            'e_en_description' => $inData['e_en_description'],
            'e_start_date'  => $inData['e_start_date'],
            'e_end_date'    => $inData['e_end_date'],
            'e_tw_address'     => $inData['e_tw_address'],
            'e_en_address'     => $inData['e_en_address'],
            'e_update_user' => $this->session->userdata('username'),
            'e_update_time' => date('Y-m-d H:i:s'),
            'e_create_time' => date('Y-m-d H:i:s')
        );

        $this->db->insert('`gallery`.exhibitions', $data);
        
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
            'e_tw_name' => $inData['e_tw_name'],
            'e_en_name' => $inData['e_en_name'],
            'ar_id' => $inData['ar_id'],
            'e_tw_content' => $inData['e_tw_content'],
            'e_en_content' => $inData['e_en_content'],
            'e_tw_description' => $inData['e_tw_description'],
            'e_en_description' => $inData['e_en_description'],
            'e_start_date'  => $inData['e_start_date'],
            'e_end_date'    => $inData['e_end_date'],
            'e_tw_address'     => $inData['e_tw_address'],
            'e_en_address'     => $inData['e_en_address'],
            'e_update_user' => $this->session->userdata('username'),
            'e_update_time' => date('Y-m-d H:i:s'),
            'e_create_time' => date('Y-m-d H:i:s')
        );
        if(array_key_exists('e_image', $inData))$data['e_image'] = $inData['e_image'];
		$this->db->update('`gallery`.exhibitions', $data, "e_id =" . $inData['e_id']);
		
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
     * 刪除且新增展覽場圖片
     * @param  int $inId    流水號
     * @param  array $inArray 圖片陣列
     * @return string          result
     */
    public function updateInstallationView($inId, $inArray)
    {
        $returnArray = array();

        $this->db->where('eiv_id', $inId);
        $this->db->delete('`gallery`.exhibitions_installation_views');

        foreach ($inArray as $key => $value) {
            $data = array(
                'e_id' => $inId,
                'e_image' => $value,
                'eiv_update_user' => $this->session->userdata('username'),
                'eiv_update_time' => date('Y-m-d H:i:s'),
                'eiv_create_time' => date('Y-m-d H:i:s')
            );

            $this->db->insert('`gallery`.exhibitions_installation_views', $data);
        }

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
     * 新增和更新作品
     * @param int $inEId 展覽編號
     * @param int $inWIdArray 作品編號陣列
     */
    public function addWorksAndUpdate($inEId, $inWIdArray)
    {
         if(empty($inEId))return;
        $returnArray = array();

        $this->db->where('e_id', $inEId);
        $this->db->delete('`gallery`.exhibitions_connection_works');

        foreach ($inWIdArray as $key => $value) {
            $data = array(
                'e_id' => $inEId,
                'w_id' => $value,
            );

            $this->db->insert('`gallery`.exhibitions_connection_works', $data);
        }

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
     * 取得作品關聯展覽的資料
     * @param  int $inEId 展覽的編號
     * @param  int $inPage 目前頁面
     * @param  int $inLimit 顯示多少數量
     * @return array      result
     */
    public function getWorksConnectExhibitionsData($inEId, $inLimit = '', $inPage = '')
    {
        $this->db->select('*');
        $this->db->from('`gallery`.exhibitions_connection_works AS a');
        $this->db->join('`gallery`.exhibitions AS b', 'a.e_id = b.e_id');
        $this->db->join('`gallery`.works AS c', 'a.w_id = c.w_id');
        $this->db->where('a.e_id', $inEId);
        
        if($inLimit !=='' && $inPage !== '')$this->db->limit($inLimit, $inPage);
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;   
    }

    /**
     * 取得詳細資料
     * @param  int $inId 流水號
     * @return array result
     */
    public function getDetailDataById($inId)
    {
        $this->db->select('*');
        $this->db->from('`gallery`.exhibitions');
        $this->db->where('e_id', $inId);
        $query = $this->db->get();
        
        $result = $query->row_array();
        return $result;
    }

    /**
     * 取得展覽的資料
     * @param  int $inId   流水號
     * @return array result
     */
    public function getData($inId)
    {
        $this->db->select('*');
        $this->db->from('`gallery`.exhibitions');
        $this->db->where('e_id', $inId);
        $query = $this->db->get();
        
        $result = $query->row_array();
        return $result;
    }

    /**
     * 取得展覽場圖片的資料
     * @param  int $inId   流水號
     * @return array result
     */
    public function getInstallationsViewData($inId)
    {
        if(!$inId)return;
        $this->db->select('*');
        $this->db->from('`gallery`.exhibitions_installation_views');
        $this->db->where('e_id', $inId);
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;
    }

    /**
     * 取得全部展覽的資料
     * @return array result
     */
    public function getDataAll()
    {
        $this->db->select('*');
        $this->db->from('`gallery`.exhibitions');
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;   
    }

    /**
     * 取得展覽的資料依日期
     * @param  string $inType   型態
     * @return array result
     */
    public function getDataByDate($inType)
    {
        $this->db->select('*');
        $this->db->from('`gallery`.exhibitions');

        switch ($inType) {
            case 'upcoming':
                $this->db->where('e_start_date >', date('Y-m-d'));
                break;
            case 'past':
                $this->db->where('e_end_date <', date('Y-m-d'));
                break;
            default:
                $this->db->where('e_start_date <=', date('Y-m-d'));
                $this->db->where('e_end_date >=', date('Y-m-d'));
                break;
        }

        $query = $this->db->get();
        $result = $query->result_array();
        return $result;   
    }

    /**
     * 取得藝術家的作品資料
     * @return array result
     */
    public function getArtitsWithWork()
    {
        $this->db->select('*');
        $this->db->from('`gallery`.works AS a');
        $this->db->join('`gallery`.artists AS b', 'a.ar_id = b.ar_id');
        $this->db->group_by('b.ar_id');
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;
    }

    /**
     * 取得作品資料
     * @param  int $inId 藝術家編號
     * @return array result
     */
    public function getWorkData($inId)
    {
        $this->db->select('*');
        $this->db->from('`gallery`.works');
        $this->db->where('ar_id', $inId);
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;
    }
}