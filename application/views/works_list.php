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
                <span><?php echo $exhibitionsData[0]['e_'. $language .'_name'];?></span>
                <br/>
                <em><?php echo $exhibitionsData[0]['e_start_date'] . ' ~ ' . $exhibitionsData[0]['e_end_date'];?></em>
            </span> 
            <div class="exhi L">
                <div class="ex_leftb">
                    <?php
                        $i = 0;
                        foreach ($exhibitionsData as $key => $value) {
                            echo '<a href="works?index='. $i .'&id='. $value['e_id'] .'"><img class="worksImage" src="./uploads/images/works/thumb/'. $value['w_image'] .'"></a>';
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
                    <li><a href="exhibitions?id=<?php echo $exhibitionsData[0]['e_id'];?>"><?php echo $headerData['h_'. $language .'_installation_views'];?></a></li><br>
                </ul>
            </nav>
        </div> 
</div>
   
<div class="footer_con"></div>
<script type="text/javascript">
    document.styleSheets[1].disabled = true;
</script>