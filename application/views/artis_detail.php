
    <div class="contact">
        <div class="con_left">
            <span class="title_con">
                <h1><?php echo $artistsData['ar_'. $language .'_name'];?></h1>
                <!-- <em>B. <?php echo $artistsData['ar_birth_year'];?></em> -->
                <p>B. <?php echo $artistsData['ar_birth_year'];?></p>
            </span> 
            <div class="exhi">
                <div class="row">
                    <img src="uploads/images/artists/<?php echo $artistsData['ar_cv_image'];?>">
                    <!-- <img src="uploads/images/artists/ex01.png"> -->
                </div>
                <div class="tx_cn row">
                    <p>
                        <?php echo nl2br($artistsData['ar_'. $language .'_content']);?>
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
                            echo '<option value="'. $value['ar_id'] .'" '. $selected .'>'. $value['ar_'. $language .'_name'] .'</option>';
                        }
                    ?>
                </select>
            </div>
            <nav>
                <ul>
                    <li><a href="artists_works_list?id=<?php echo $artistsData["ar_id"];?>"><?php echo $headerData['h_'. $language .'_works'];?>　　　</a></li><br>
                    <!-- <li><a href="schedule?id=<?php echo $id;?>">Exhibition Schedule/展覽日程</a></li><br> -->
                    <?php
                        if($artistsData["ar_pdf"] != '')
                            echo '<li><a href="./uploads/pdf/'. $artistsData["ar_pdf"] .'" target="_blank">'. $headerData['h_'. $language .'_biography'] .'</a></li>';
                    ?>
                </ul>
            </nav>
        </div>  
    </div>  
    <div class="footer_con"></div>