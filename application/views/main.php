    <div class="contact">
    	<div class="box01" style="background: url(uploads/images/introduction/titlebanner.png) no-repeat center;">
        	<span class="t1">
                <h1 id="aboutClick" class="cursor"><?php echo $headerData['h_'. $language .'_about'];?></h1>
                <p>
                    <?php echo nl2br($aboutData['ab_'. $language .'_introduction']);?>
                </p>
            </span>
        </div>
        <div class="box02">
            <span class="t2">
                <h1 class="cursor exhibitionsClick"><?php echo $headerData['h_'. $language .'_current_exhibitions'];?></h1>
                <p><?php echo $exhibitionsData['e_start_date'];?> ~ <?php echo $exhibitionsData['e_end_date'];?></p>
                </span>
             <span class="exhib_right">
                <h1 class="cursor exhibitionsClick"><?php echo $exhibitionsData['e_'. $language .'_name'];?></h1>
                <p>
                    <?php echo $exhibitionsData['e_'. $language .'_address'];?>
                </p>
                <p>
                    <?php echo nl2br($exhibitionsData['e_'. $language .'_content']);?>
                </p>
            </span>
            <div class="exhib01" style="background: url(uploads/images/exhibitions/<?php echo $exhibitionsData['e_image'];?>) no-repeat center;"></div>
        </div>
        <div class="box03">
            <span class="t3">
                <h1 id="artistsClick" class="cursor"><?php echo $headerData['h_'. $language .'_artists'];?></h1>
                <p>
                    <?php echo ($artistsData[0]['ar_'. $language .'_content']);?>
                </p>
            </span> 
            <div class="artisname">
                <nav>
                    <ul>
                        <?php
                            $lenth = (count($artistsData) < 8)?count($artistsData):8;
                            for ($i=0; $i < $lenth; $i++) { 
                                echo '<li style="text-align: left;" data-content="'. ($artistsData[$i]['ar_'. $language .'_content']) .'"><img src="uploads/images/artists/30.png" width="30" height="30"><a href="./artis_detail?id='. $artistsData[$i]['ar_id'] .'">'. $artistsData[$i]['ar_'. $language .'_name'] .'</a></li>';
                            }
                        ?>
                    </ul>
                </nav>
                <nav>
                    <ul>
                        <?php
                            $lenth = (count($artistsData) < 16)?count($artistsData):16;
                            for ($i=8; $i < $lenth; $i++) { 
                                echo '<li style="text-align: left;" data-content="'. nl2br($artistsData[$i]['ar_'. $language .'_content']) .'"><img src="uploads/images/artists/30.png" width="30" height="30"><a href="./artis_detail?id='. $artistsData[$i]['ar_id'] .'">'. $artistsData[$i]['ar_'. $language .'_name'] .'</a></li>';
                            }
                        ?>
                    </ul>
                </nav>
                <nav>
                    <ul>
                        <?php
                            $lenth = (count($artistsData) < 24)?count($artistsData):24;
                            for ($i=16; $i < $lenth; $i++) { 
                                echo '<li style="text-align: left;" data-content="'. nl2br($artistsData[$i]['ar_'. $language .'_content']) .'"><img src="uploads/images/artists/30.png" width="30" height="30"><a href="./artis_detail?id='. $artistsData[$i]['ar_id'] .'">'. $artistsData[$i]['ar_'. $language .'_name'] .'</a></li>';
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="box04">
            <div class="tit">
                <span class="t4">
                    <h1 id="publicationsClick" class="cursor"><?php echo $headerData['h_'. $language .'_publications'];?></h1>
                        <p>
                            
                        </p>
                </span>
            </div>
            <div class="publicpic">
                <?php
                    $lenth = (count($publicationsData) < 6)?count($publicationsData):6;
                    for ($i=0; $i < $lenth; $i++) { 
                        echo '<a href="publications"><img src="uploads/images/publications/thumb/'. $publicationsData[$i]['p_image'] .'" data-title="'. $publicationsData[$i]['p_'. $language .'_name'] .'" data-content="'. $publicationsData[$i]['p_'. $language .'_content'] .'"></a>';
                    }
                ?>
            </div>
            <span class="public_right publications_content">
                <p><?php echo $publicationsData[0]['p_'. $language .'_name'];?></p>
                <p>
                    <?php echo nl2br($publicationsData[0]['p_'. $language .'_content']);?>
                </p>
            </span>
        </div>
    </div>
    <div class="box05">
        <span class="t5">
            <h1><?php echo $headerData['h_'. $language .'_contact'];?></h1>
                <p>
                    Representing over forty artists and estates, David Zwirner is a contemporary art gallery active in both the primary and secondary markets. 
                    Since opening its doors in 1993, it has been home to innovative, singular, group of artists.
                </p>
            <div class="row21">
                <form>
                    <div class="col-xs-3 b">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Email" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="token" placeholder="captcha number" class="form-control" />
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="row">
                            <div class="col-xs-12">
                                <textarea type="text" name="content" placeholder="content" class="form-control s"  style="height: 89px;"/></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <img src="<?php echo $captcha['image_src'];?>" alt="CAPTCHA security code" width="500px" height="45px" />
                            </div>
                        </div>
                    </div>
                    <div class="bt">
                        <div class="col-xs-3 column-b">
                            <button class="btn btn-block btn-lg btn-success ladda-button" data-style="zoom-in"><span class="ladda-label">送出</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </span>
        <div class="footer"></div>
    </div>
    <script src="./js/plugin/spin.js"></script>
    <script src="./js/plugin/ladda.js"></script>