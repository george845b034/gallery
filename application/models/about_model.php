<?php
class about_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
	
    /**
     * 更新資料
     * @param  string $inImage   圖片名
     * @param  string $inTwIntro 中文介紹
     * @param  string $inCnIntro 簡中介紹
     * @param  string $inEnIntro 英文介紹
     * @param  string $inJpIntro 日文介紹
     * @return array             result
     */
    public function update($inImage, $inTwIntro, $inCnIntro, $inEnIntro, $inJpIntro)
    {
        $returnArray = array();

    	$data = array(
    		'ab_tw_introduction' => $inTwIntro,
    		'ab_cn_introduction' => $inCnIntro,
    		'ab_en_introduction' => $inEnIntro,
            'ab_jp_introduction' => $inJpIntro,
            'ab_update_user' => $this->session->userdata('username'),
    		'ab_update_time' => date('Y-m-d H:i:s')
    	);

        if($inImage != '')$data['ab_image'] = $inImage;
		$this->db->update('`gallery`.about', $data, "ab_id = 1");
		
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
     * 取得關於我的資料
     * @return array result
     */
    public function getData()
    {
        $this->db->select('*');
        $this->db->from('`gallery`.about');
        $this->db->where('ab_id', 1);
        $query = $this->db->get();
        
        $result = $query->row_array();
        return $result;
    }

    /**
     * 取得表頭的資料
     * @return array result
     */
    public function getHeaderData()
    {
        $this->db->select('*');
        $this->db->from('`gallery`.header');
        $this->db->where('h_id', 1);
        $query = $this->db->get();
        
        $result = $query->row_array();
        return $result;
    }


    /**
     * 設定語言
     * @param void result
     */
    public function setLanguage($inLan)
    {
        switch ($inLan) {
            case 'en':
                setcookie('lang', 'en', 0, "/");
                $_COOKIE['lang'] = 'en';
                break;
            default:
                setcookie('lang', 'tw', 0, "/");
                $_COOKIE['lang'] = 'tw';
                break;
        }
    }

    /**
     * 檢查語言
     * @return string return
     */
    public function checkLanguage()
    {
        $lang = 'tw';
        if(!isset($_COOKIE['lang'])) {
            setcookie('lang', 'tw', 0, "/");
        } else {
            $lang = $_COOKIE['lang'];
        }

        return $lang;
    }

}