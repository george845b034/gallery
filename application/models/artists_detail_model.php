<?php
class artists_detail_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
	
    /**
     * 新增藝術家作品資料
     * @param  int $inId 藝術家編號
     * @param  array $inArray 圖片陣列
     * @param  array $inDescription 說明陣列
     * @return array         result
     */
    public function addWorks($inId, $inArray, $inDescription)
    {
        $returnArray = array();

        $i = 0;
        foreach ($inArray as $key => $value) {
            $data = array(
                'ar_id' => $inId,
                'w_image' => $value,
                'w_description' => $inDescription[$i],
                'ar_update_user' => $this->session->userdata('username'),
                'ar_update_time' => date('Y-m-d H:i:s'),
                'ar_create_time' => date('Y-m-d H:i:s')
            );

            $this->db->insert('`gallery`.works', $data);
            $i++;
        }

        if ($this->db->affected_rows() > 0) {
            
            $returnArray['status'] = "SUCCESS";
            $returnArray['msg'] = "Modify Success";
        } else {
            $returnArray['status'] = "FAIL";
            $returnArray['msg'] = "Modify Fail";
        }
    }

    /**
     * 更新藝術家作品資料
     * @param  int $inIdArray 作品編號
     * @param  array $inDescription 說明陣列
     * @return array         result
     */
    public function updateWorks($inIdArray, $inDescription)
    {
        $returnArray = array();
        $data = array();

        if(is_array($inIdArray))
        {
            $i = 0;
            foreach ($inIdArray as $key => $value) {
                array_push($data, array(
                    'w_id' => $value,
                    'w_description' => $inDescription[$i],
                    'ar_update_user' => $this->session->userdata('username'),
                    'ar_update_time' => date('Y-m-d H:i:s')
                ));

                $i++;
            }
        }else{
            array_push($data, array(
                'w_id' => $inIdArray,
                'w_description' => $inDescription[0],
                'ar_update_user' => $this->session->userdata('username'),
                'ar_update_time' => date('Y-m-d H:i:s')
            ));            
        }
        

        $this->db->update_batch('`gallery`.works', $data, 'w_id'); 
        if ($this->db->affected_rows() > 0) {
            
            $returnArray['status'] = "SUCCESS";
            $returnArray['msg'] = "Modify Success";
        } else {
            $returnArray['status'] = "FAIL";
            $returnArray['msg'] = "Modify Fail";
        }
    }

    /**
     * 新增藝術家資料
     * @param  array $inData 輸入資料陣列
     * @return array         result
     */
    public function add($inData)
    {
        $returnArray = array();

        $data = array(
            'ar_tw_name' => $inData['ar_tw_name'],
            'ar_en_name' => $inData['ar_en_name'],
            'ar_image' => $inData['ar_image'],
            'ar_cv_image' => $inData['ar_cv_image'],
            'ar_tw_content' => $inData['ar_tw_content'],
            'ar_en_content' => $inData['ar_en_content'],
            'ar_birth_year' => $inData['ar_birth_year'],
            'ar_update_user' => $this->session->userdata('username'),
            'ar_sort' => '1 + coalesce((SELECT max(ar_sort) FROM `gallery`.artists), 0)',
            'ar_update_time' => date('Y-m-d H:i:s'),
            'ar_create_time' => date('Y-m-d H:i:s')
        );
        if(array_key_exists('ar_pdf', $inData))$data['ar_pdf'] = $inData['ar_pdf'];

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
            'ar_en_name' => $inData['ar_en_name'],
            'ar_tw_content' => $inData['ar_tw_content'],
            'ar_en_content' => $inData['ar_en_content'],
            'ar_birth_year' => $inData['ar_birth_year'],
            'ar_update_user' => $this->session->userdata('username'),
            'ar_update_time' => date('Y-m-d H:i:s'),
            'ar_create_time' => date('Y-m-d H:i:s')
        );
        if(array_key_exists('ar_pdf', $inData))$data['ar_pdf'] = $inData['ar_pdf'];
        if(array_key_exists('ar_image', $inData))$data['ar_image'] = $inData['ar_image'];
        if(array_key_exists('ar_image', $inData))$data['ar_cv_image'] = $inData['ar_cv_image'];

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
     * 刪除Works資料
     * @param  int $id 流水號
     * @return array result
     */
    public function deleteWorksData($id)
    {
        if(empty($id))return;
        $returnArray = array();

        $this->db->where('w_id', $id);
        $this->db->delete('`gallery`.works');

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
     * 取得藝術家作品的資料By藝術家編號
     * @param  int $inId   流水號
     * @return array result
     */
    public function getWorksDataByArId($inId)
    {
        $this->db->select('*');
        $this->db->from('`gallery`.works');
        $this->db->where('ar_id', $inId);
        $query = $this->db->get();
        
        $result = $query->result_array();
        
        return $result;
    }

    /**
     * 取得藝術家作品的資料By藝術家編號
     * @param  int $inId   流水號
     * @return array result
     */
    public function getWorksDataByWId($inId)
    {
        $this->db->select('*');
        $this->db->from('`gallery`.works');
        $this->db->where('w_id', $inId);
        $query = $this->db->get();
        
        $result = $query->row_array();
        
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

    /**
     * 取得藝術家的作品資料
     * @return array result
     */
    public function getArtitsWithWork($inId)
    {
        $this->db->select('*');
        $this->db->from('`gallery`.works AS a');
        $this->db->join('`gallery`.artists AS b', 'a.ar_id = b.ar_id');
        $this->db->where('b.ar_id', $inId);
        $query = $this->db->get();
        
        $result = $query->result_array();
        return $result;
    }

    /**
     * 取得藝術家的作品資料
     * @param  int $inId 藝術家的編號
     * @param  int $inPage 目前頁面
     * @param  int $inLimit 顯示多少數量
     * @return array result
     */
    public function getArtitsWithWorkForLimit($inId, $inLimit = '', $inPage = '')
    {
        $this->db->select('*');
        $this->db->from('`gallery`.works AS a');
        $this->db->join('`gallery`.artists AS b', 'a.ar_id = b.ar_id');
        $this->db->where('b.ar_id', $inId);
        $query = $this->db->get();
        if($inLimit !=='' && $inPage !== '')$this->db->limit($inLimit, $inPage);
        
        $result = $query->result_array();
        return $result;
    }

}