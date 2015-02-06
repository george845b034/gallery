
    <div class="contact">
        <div class="con_left">
            <span class="title_con">
                <h1><?php echo $headerData['h_'. $language .'_current_exhibitions'];?></h1>
            </span> 
            <div class="row exhi">

                <?php
                    foreach ($exhibitionsData as $key => $value) {
                        echo '
                            <div class="col-md-4">
                                <a href="works_list?id='. $value['e_id']  .'">
                                    <div class="row">
                                        <img src="uploads/images/exhibitions/thumb/'. $value['e_image'] .'">
                                    </div>
                                    <div class="row">
                                        <div>'. $value['e_'. $language .'_name'] .'</div>
                                        <div>'. $value['e_'. $language .'_description'] .'</div>
                                        <div>'. $value['e_'. $language .'_address'] .'</div>
                                        <div>'. $value['e_start_date'] .' - '. $value['e_end_date'] .'</div>    
                                    </div>
                                </a>
                            </div>
                        ';
                    }
                ?>
            </div> 
        </div>
        <div class="con_right">
            <nav>
                <ul>
                    <li><a href="exhibitions_list?type=current"><?php echo $headerData['h_'. $language .'_currnet_exhibitions'];?></a></li><br>
                    <li><a href="exhibitions_list?type=upcoming"><?php echo $headerData['h_'. $language .'_upcoming_exhibitions'];?></a></li><br>
                    <li><a href="exhibitions_list?type=past"><?php echo $headerData['h_'. $language .'_past_exhibitions'];?></a></li><br>
                    <!-- <li><a href="artis">Artists/藝術家</a></li><br>
                    <li><a href="schedule">Exhibition Schedule/展覽日程</a></li> -->
                </ul>
            </nav>
        </div>  
    </div>  
    <div class="footer_con"></div>