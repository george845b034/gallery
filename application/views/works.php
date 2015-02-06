
    <link href="./css/plugin/normalize.css" rel="stylesheet">
    <div class="contact">
        <div class="con_left">
            <span class="title_con">
                <h1><?php echo (array_key_exists('e_'. $language .'_name', $worksData[0]))?$worksData[0]['e_'. $language .'_name']:$worksData[0]['ar_'. $language .'_name'];?></h1>
                <p><?php echo (array_key_exists('e_start_date', $worksData[0]))?$worksData[0]['e_start_date'] .' ~ '. $worksData[0]['e_end_date']:'B.' . $worksData[0]['ar_birth_year'];?></p>
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
                            foreach ($worksData as $key => $value) {
                                $isFrist = ($index == $key)?' class="current"':'';
                                echo '
                                    <li '. $isFrist .'>
                                        <img src="uploads/images/works/'. $value['w_image'] .'">
                                        <p>
                                            '. nl2br($value['w_description']) .'
                                        </p>
                                    </li>
                                ';
                            }
                        ?>
                    </ul>
                    <nav>
                        <a class="prev" href="#">Previous item</a>
                        <a class="next" href="#">Next item</a>
                    </nav>
                </div>
                <div class="tx_cn">
                </div>
                <div class="tx_cn">
                    
                </div>
            </div> 
        </div>
        <div class="con_right">
            <nav>
                <ul>
                    <!-- <li><a href="exhibitions?id=<?php echo $worksData[0]['e_id'];?>"><?php echo $headerData['h_'. $language .'_installation_views'];?></a></li><br> -->
                    <?php
                        if(array_key_exists('ar_pdf', $worksData[0]))
                            echo '<li><a href="./uploads/pdf/'. $worksData[0]["ar_pdf"] .'" target="_blank">'. $headerData['h_'. $language .'_biography'] .'</a></li>';
                        if(array_key_exists('e_id', $worksData[0]))
                            echo '<li><a href="exhibitions?id='. $worksData[0]['e_id'] .'">'. $headerData['h_'. $language .'_installation_views'] .'</a></li>';
                    ?>
                </ul>
            </nav>
        </div>  
    </div>  
    <!-- <div class="footer_con"></div> -->
    <script src="./js/plugin/classie.js"></script>
    <script src="./js/plugin/jquery-1.11.1.min.js"></script>
    <script src="./js/plugin/main.js"></script>