    <div class="contact">
        <div class="con_center">
            <span class="title_w110">
                <h1>Artists</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam velit, vulputate eu pharetra nec, mattis ac neque. Duis vulputate commodo lectus, ac blandit elit tincidunt id.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam velit, vulputate eu pharetra nec, mattis ac neque. Duis vulputate commodo lectus, ac blandit elit tincidunt id.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam velit, vulputate eu pharetra nec, mattis ac neque. Duis vulputate commodo lectus, ac blandit elit tincidunt id.</p>
            </span>
            <div class="artisname">
                <nav>
                    <ul>
                        <?php
                            $lenth = (count($artistsData) < 8)?count($artistsData):8;
                            for ($i=0; $i < $lenth; $i++) { 
                                echo '<li style="text-align: left;"><img src="uploads/images/artists/30.png"><a href="./artis_detail?id='. $artistsData[$i]['ar_id'] .'">'. $artistsData[$i]['ar_'. $language .'_name'] .'</a></li>';
                            }
                        ?>
                    </ul>
                </nav>
                <nav>
                    <ul>
                        <?php
                            $lenth = (count($artistsData) < 16)?count($artistsData):16;
                            for ($i=8; $i < $lenth; $i++) { 
                                echo '<li style="text-align: left;" data-content="'. $artistsData[$i]['ar_'. $language .'_content'] .'"><img src="uploads/images/artists/30.png"><a href="./artis_detail?id='. $artistsData[$i]['ar_id'] .'">'. $artistsData[$i]['ar_'. $language .'_name'] .'</a></li>';
                            }
                        ?>
                    </ul>
                </nav>
                <nav>
                    <ul>
                        <?php
                            $lenth = (count($artistsData) < 24)?count($artistsData):24;
                            for ($i=16; $i < $lenth; $i++) { 
                                echo '<li style="text-align: left;" data-content="'. $artistsData[$i]['ar_'. $language .'_content'] .'"><img src="uploads/images/artists/30.png"><a href="./artis_detail?id='. $artistsData[$i]['ar_id'] .'">'. $artistsData[$i]['ar_'. $language .'_name'] .'</a></li>';
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="footer_con"></div>
