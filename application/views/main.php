    <div class="contact">
    	<div class="box01" style="background: url(uploads/images/introduction/titlebanner.png) no-repeat center;">
        	<span class="t1">
                <h1 id="aboutClick" class="cursor">About</h1>
                <p>
                    <?php echo $aboutData['ab_'. $this->session->userdata('language') .'_introduction'];?>
                </p>
            </span>
        </div>
        <div class="box02">
            <span class="t2">
                <h1 class="cursor exhibitionsClick">Current Exhibitions</h1>
                <p><?php echo $exhibitionsData['e_start_date'];?> ~ <?php echo $exhibitionsData['e_end_date'];?></p>
                </span>
             <span class="exhib_right">
                <h1 class="cursor exhibitionsClick">Group Show</h1>
                <p>
                    <?php echo $exhibitionsData['e_address'];?>
                </p>
                <p>
                    <?php echo $exhibitionsData['e_'. $this->session->userdata('language') .'_content'];?>
                </p>
            </span>
            <div class="exhib01" style="background: url(uploads/images/exhibitions/ex01.png) no-repeat center;"></div>
        </div>
        <div class="box03">
            <span class="t3">
                <h1 id="artistsClick" class="cursor">Artists</h1>
                <p>
                    <?php echo $artistsData[0]['ar_'. $this->session->userdata('language') .'_content'];?>
                </p>
            </span> 
            <div class="artisname">
                <nav>
                    <ul>
                        <?php
                            $lenth = (count($artistsData) < 8)?count($artistsData):8;
                            for ($i=0; $i < $lenth; $i++) { 
                                echo '<li style="text-align: left;" data-content="'. $artistsData[$i]['ar_'. $this->session->userdata('language') .'_content'] .'"><img src="uploads/images/artists/30.png" width="30" height="30"><a href="./artis_detail?id='. $artistsData[$i]['ar_id'] .'">'. $artistsData[$i]['ar_'. $this->session->userdata('language') .'_name'] .'</a></li>';
                            }
                        ?>
                    </ul>
                </nav>
                <nav>
                    <ul>
                        <?php
                            $lenth = (count($artistsData) < 16)?count($artistsData):16;
                            for ($i=8; $i < $lenth; $i++) { 
                                echo '<li style="text-align: left;" data-content="'. $artistsData[$i]['ar_'. $this->session->userdata('language') .'_content'] .'"><img src="uploads/images/artists/30.png" width="30" height="30"><a href="./artis_detail?id='. $artistsData[$i]['ar_id'] .'">'. $artistsData[$i]['ar_'. $this->session->userdata('language') .'_name'] .'</a></li>';
                            }
                        ?>
                    </ul>
                </nav>
                <nav>
                    <ul>
                        <?php
                            $lenth = (count($artistsData) < 24)?count($artistsData):24;
                            for ($i=16; $i < $lenth; $i++) { 
                                echo '<li style="text-align: left;" data-content="'. $artistsData[$i]['ar_'. $this->session->userdata('language') .'_content'] .'"><img src="uploads/images/artists/30.png" width="30" height="30"><a href="./artis_detail?id='. $artistsData[$i]['ar_id'] .'">'. $artistsData[$i]['ar_'. $this->session->userdata('language') .'_name'] .'</a></li>';
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="box04">
            <div class="tit">
                <span class="t4">
                    <h1 id="publicationsClick" class="cursor">Publications</h1>
                        <p>
                            
                        </p>
                </span>
            </div>
            <div class="publicpic">
                <?php
                    $lenth = (count($publicationsData) < 6)?count($publicationsData):6;
                    for ($i=0; $i < $lenth; $i++) { 
                        echo '<a href="publications"><img src="uploads/images/publications/'. $publicationsData[$i]['p_image'] .'" data-title="'. $publicationsData[$i]['p_'. $this->session->userdata('language') .'_name'] .'" data-content="'. $publicationsData[$i]['p_'. $this->session->userdata('language') .'_content'] .'"></a>';
                    }
                ?>
            </div>
            <span class="public_right publications_content">
            	<p><?php echo $publicationsData[0]['p_'. $this->session->userdata('language') .'_name'];?></p>
                <p>
                    <?php echo $publicationsData[0]['p_'. $this->session->userdata('language') .'_content'];?>
                </p>
            </span>
        </div>
    </div>
    <div class="box05">
        <span class="t5">
            <h1>Contacts</h1>
                <p>
                    Representing over forty artists and estates, David Zwirner is a contemporary art gallery active in both the primary and secondary markets. 
                    Since opening its doors in 1993, it has been home to innovative, singular, group of artists.
                </p>
            <div class="row21">
                <div class="col-xs-3 b">
                    <div class="form-group">
                        <input type="text" value="" placeholder="Name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" value="" placeholder="Email" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" value="" placeholder="capcha number" class="form-control" />
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="form-group">
                        <input type="text" value="" placeholder="content" class="form-control s"  style="height: 89px;"/>
                    </div>
                    <div class="form-group">
                        <img src="http://127.0.0.1:8000/gallery/viewcaptcha?t=0.67334600+1419390699" width="500" height="45">
                    </div>
                </div>
                <div class="bt">
                    <div class="col-xs-3 column-b">
                        <a href="#fakelink" class="btn btn-block btn-lg btn-success">送出</a>
                    </div>
                </div>
            </div>
        </span>
        <div class="footer"></div>
    </div>