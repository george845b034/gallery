<style type="text/css">
    ul li {
        list-style: none;
        margin-bottom: 25px;
    }
</style>

<div class="contact">

        <div class="con_left" style="width:70%;">
            <span class="title_con">
                <h1><?php echo $headerData['h_'. $language .'_works'];?></h1>
                <span><?php echo $artistsData[0]['ar_'. $language .'_name'];?></span>
                <br/>
                <em>b.<?php echo $artistsData[0]['ar_birth_year'];?></em>
            </span> 
            <div class="exhi L">
                <div class="ex_leftb">
                    <?php
                        $i = 0;
                        foreach ($artistsData as $key => $value) {
                            echo '<a href="works?index='. $i .'&artistsId='. $value['ar_id'] .'"><img class="worksImage" src="./uploads/images/works/thumb/'. $value['w_image'] .'"></a>';
                            $i++;
                        }
                    ?>
                </div>
                <br/>
                <div class="text-center">
                    <?php echo $this->pagination->create_links();?>
                </div>
            </div>
        </div>
        <div class="con_right publications_content" style="width:26%;">
            <nav>
                <ul>
                    <!-- <li><a href="exhibitions?id=<?php echo $artistsData[0]['e_id'];?>"><?php echo $headerData['h_'. $language .'_installation_views'];?></a></li><br> -->
                    <?php
                        if($artistsData[0]["ar_pdf"] != '')
                            echo '<li><a href="./uploads/pdf/'. $artistsData[0]["ar_pdf"] .'" target="_blank">'. $headerData['h_'. $language .'_biography'] .'</a></li>';
                    ?>
                </ul>
            </nav>
        </div> 
</div>
   
<div class="footer_con"></div>
<script type="text/javascript">
    document.styleSheets[1].disabled = true;
</script>