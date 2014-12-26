    <div class="contact">
        <div class="con_left">
            <span class="title_con">
                <h1>Current Exhibitions</h1>
                <p><?php echo $exhibitionsData['e_start_date'];?> ~ <?php echo $exhibitionsData['e_end_date'];?></p>
            </span> 
            <div class="exhi">
                <div class="ex_left">
                    <img src="uploads/images/exhibitions/ex01.png">
                </div>
                <div class="ex_right" style="visibility:hidden;">
                    <img src="uploads/images/exhibitions/ex02.png">
                </div>
                <div class="ex_bottom">
                    <h1>Group Show</h1>
                    <p>
                        <?php echo $exhibitionsData['e_address'];?>
                    </p>
                </div>
                <div class="tx_cn">
                    <p>
                        <?php echo $exhibitionsData['e_'. $this->session->userdata('language') .'_content'];?>
                    </p>
                </div>
                <div class="tx_cn">
                    
                </div>
            </div> 
        </div>
        <div class="con_right">
            <nav>
                <ul>
                    <li><a href="artis">Artists/藝術家</a></li><br>
                    <li><a href="schedule">Exhibition Schedule/展覽日程</a></li>
                </ul>
            </nav>
        </div>  
    </div>  
    <div class="footer_con"></div>