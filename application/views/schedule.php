    <div class="contact">
        <div class="con_left">
            <span class="title_con">
                <h1><?php echo ($id)?$artistsData[0]['ar_'. $language .'_name']:'Exhibition Schedule';?></h1>
                <p>Biography</p>
            </span> 
            <div class="exhi">
                <div class="tx_cn">
                    <?php
                        foreach ($artistsData as $key => $value) {
                            echo '
                                <p>
                                    '. $value['e_name'] .'<br>
                                    '. nl2br($value['e_'. $language .'_content']) .'<br>
                                    '. $value['e_start_date'] .'~'. $value['e_end_date'] .'<br>
                                    '. $value['e_address'] .'<br>
                                    <img src="images/theme/line2.png">
                                </p>
                            ';
                        }
                    ?>
                </div>
            </div> 
        </div>
        <div class="con_right">
            <div class="sebar">
                <select class="form-control select select-primary select2-offscreen select-schedule" data-toggle="select" tabindex="-1" title="">
                    <?php
                        foreach ($artistsList as $key => $value) {

                            $selected = ($id && $artistsData[0]['ar_id'] == $value['ar_id'])?'selected="selected"':'';
                            if(!$id)echo '<option value="0">select</option>';
                            echo '<option value="'. $value['ar_id'] .'" '. $selected .'>'. $value['ar_'. $language .'_name'] .'</option>';
                        }
                    ?>
                </select>
            </div>
            <nav>
                <ul>
                    <li><a href="artis">Artists/藝術家</a></li><br>
                    <li><a href="schedule">Exhibition Schedule/展覽日程</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="footer_con"></div>
