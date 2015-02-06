
    <link href="./css/plugin/normalize.css" rel="stylesheet">
    <div class="contact">
        <div class="con_left">
            <span class="title_con">
                <h1><?php echo $headerData['h_'. $language .'_installation_views'];?></h1>
                <p><?php echo $exhibitionsData['e_start_date'];?> ~ <?php echo $exhibitionsData['e_end_date'];?></p>
            </span> 
            <div class="exhi">
                <!-- <div class="ex_left">
                    <img src="uploads/images/exhibitions/ex01.png">
                </div> -->
                <select id="fxselect" name="fxselect" style="display: none">
                    <option value="-1">Choose an effect...</option>
                    <option value="fxCorner">Corner scale</option>
                    <option value="fxVScale">Vertical scale</option>
                    <option value="fxFall">Fall</option>
                    <option value="fxFPulse">Forward pulse</option>
                    <option value="fxRPulse">Rotate pulse</option>
                    <option value="fxHearbeat">Hearbeat</option>
                    <option value="fxCoverflow" selected>Coverflow</option>
                    <option value="fxRotateSoftly">Rotate me softly</option>
                    <option value="fxDeal">Deal 'em</option>
                    <option value="fxFerris">Ferris wheel</option>
                    <option value="fxShinkansen">Shinkansen</option>
                    <option value="fxSnake">Snake</option>
                    <option value="fxShuffle">Shuffle</option>
                    <option value="fxPhotoBrowse">Photo Browse</option>
                    <option value="fxSlideBehind">Slide Behind</option>
                    <option value="fxVacuum">Vacuum</option>
                    <option value="fxHurl">Hurl it</option>
                </select>
                <div id="component" class="component component-small">
                    <ul class="itemwrap">
                        <?php
                            $i = 0;
                            foreach ($installationView as $key => $value) {
                                $isFrist = ($i == 0)?' class="current"':'';
                                echo '
                                    <li '. $isFrist .'>
                                        <img src="uploads/images/exhibitions/'. $value['e_image'] .'">
                                    </li>
                                ';
                                $i++;
                            }
                        ?>
                    </ul>
                    <nav>
                        <a class="prev" href="#">Previous item</a>
                        <a class="next" href="#">Next item</a>
                    </nav>
                </div>
                <div class="tx_cn">
                    <p>
                        <?php echo nl2br($exhibitionsData['e_'. $language .'_content']);?>
                    </p>
                </div>
                <div class="tx_cn">
                    
                </div>
            </div> 
        </div>
        <div class="con_right">
            <nav>
                <ul>
                    <!-- <li><a href="artis">Artists/藝術家</a></li><br>
                    <li><a href="schedule">Exhibition Schedule/展覽日程</a></li> -->
                    <li><a href="works_list?id=<?php echo $exhibitionsData['e_id'];?>"><?php echo $headerData['h_'. $language .'_works'];?></a></li>
                </ul>
            </nav>
        </div>  
    </div>  
    <div class="footer_con"></div>
    <script src="./js/plugin/classie.js"></script>
    <script src="./js/plugin/jquery-1.11.1.min.js"></script>
    <script src="./js/plugin/main.js"></script>