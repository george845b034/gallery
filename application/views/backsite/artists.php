<!-- 右側內容 -->
<section id="content">
    <section class="vbox">          
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="main"><i class="fa fa-home"></i> Main</a></li>
                <li class="active"><?php echo $page_title;?></li>
            </ul>
            <div class="m-b-md">
                <h3 class="m-b-none"><?php echo $page_title;?></h3>
                <hr>
                <div class="example example-four">
                    <div class="hider">
                        <div class="slider-wrap" id="example-four-slider-wrap">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="text-right">
                                        <a href="artists_detail"><button class="btn btn-info"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button></a>
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width:30%">藝術家名稱</th>
                                                <th style="width:30%">照片</th>
                                                <th style="width:20%">排序</th>
                                                <th style="width:10%">編輯</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $max = count($result) -1;
                                                foreach ($result as $key => $value) {

                                                    $sortUp = ($key == 0)?'<p>　</p>':'<p><button class="btn btn-default btn-xs shortUp" type="button" name="'. $value['ar_id'] .'"> <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></button></p>';
                                                    $sortDown = ($key == $max)?'<p>　</p>':'<p><button class="btn btn-default btn-xs shortDown" name="'. $value['ar_id'] .'"> <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></button></p>';
                                                    $imgSrc = (is_array(getimagesize(base_url() .'uploads/images/artists/'. $value['ar_image'])))?base_url() .'uploads/images/artists/'. $value['ar_image']:base_url() .'uploads/images/artists/'. $value['ar_cv_image'];

                                                    echo '
                                                        <tr>
                                                            <td>'. $value['ar_tw_name'] .'</td>
                                                            <td><img src="'. $imgSrc .'" style="max-height: 160px;"></td>
                                                            <td>
                                                                '. $sortUp .'
                                                                '. $sortDown .'
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-default btn-xs edit_dom" type="button" name="'. $value['ar_id'] .'">編輯</button>
                                                                <button class="btn btn-danger btn-xs remove_dom" name="'. $value['ar_id'] .'">刪除</button>
                                                            </td>
                                                        </tr>
                                                    ';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <br/>
                                    <div class="text-center">
                                        <?php echo $this->pagination->create_links();?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</section>


<!-- /右側內容 -->
<script type="text/javascript" src="<?php echo base_url();?>js/backsite/artists.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/backsite/plugin/bootbox.min.js"></script>