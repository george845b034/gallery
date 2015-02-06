<div class="contact">

        <div class="con_left" style="width:70%;">
            <span class="title_con">
                <h1>Publications</h1>
            </span> 
            <div class="exhi L">
                <div class="ex_leftb">
                    <?php
                        $lenth = (count($publicationsData) < 6)?count($publicationsData):6;
                        for ($i=0; $i < $lenth; $i++) { 
                            echo '<a href="publications"><img src="uploads/images/publications/thumb/'. $publicationsData[$i]['p_image'] .'" data-title="'. $publicationsData[$i]['p_'. $language .'_name'] .'" data-content="'. $publicationsData[$i]['p_'. $language .'_content'] .'"></a>';
                        }
                    ?>
                </div>
                <!-- <div class="pagination">
                    <ul>
                        <li class="previous"><a href="#fakelink" class="fui-arrow-left"></a></li>
                        <li class="active"><a href="#fakelink">1</a></li>
                        <li><a href="#fakelink">2</a></li>
                        <li><a href="#fakelink">3</a></li>
                        <li><a href="#fakelink">4</a></li>
                        <li><a href="#fakelink">5</a></li>
                        <li><a href="#fakelink">6</a></li>
                        <li><a href="#fakelink">7</a></li>
                        <li><a href="#fakelink">8</a></li>
                        <li class="next"><a href="#fakelink" class="fui-arrow-right"></a></li>
                    </ul>
                </div> -->
            </div> 
        </div>
        <div class="con_right publications_content" style="width:30%;">
            <p><?php echo $publicationsData[0]['p_'. $language .'_name'];?></p>
            <p>
                <?php echo $publicationsData[0]['p_'. $language .'_content'];?>
            </p>
        </div> 
</div>
   
<div class="footer_con"></div>