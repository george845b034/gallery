    <div class="contact">
        <div class="con_left">
            <span class="title_con">
                <h1><?php echo $artistsData['ar_'. $this->session->userdata('language') .'_name'];?></h1>
                <p>Biography</p>
            </span> 
            <div class="exhi">
                <div class="ex_left">
                    <!-- <img src="images/ex01.png"> -->
                </div>
                <div class="tx_cn">
                    <p>
                        <?php echo $artistsData['ar_'. $this->session->userdata('language') .'_content'];?>
                    </p>
                </div>
                <div class="tx_cn">
                    
                </div>
            </div> 
        </div>
        <div class="con_right">
            <div class="sebar">
                <select class="form-control select select-primary select2-offscreen select-artists" data-toggle="select" tabindex="-1" >
                    <?php
                        foreach ($artistsList as $key => $value) {

                            $selected = ($artistsData['ar_id'] == $value['ar_id'])?'selected="selected"':'';
                            echo '<option value="'. $value['ar_id'] .'" '. $selected .'>'. $value['ar_'. $this->session->userdata('language') .'_name'] .'</option>';
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