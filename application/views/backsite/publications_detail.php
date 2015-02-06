<style>
    .popupImage{
        cursor: pointer;
    }
    input[type="file"], .originalImage{
        display: none;
    }
    #preview {
        /*position: absolute;*/
        top: 80px;
        left: 725px;
        width: 80px;
        height: 80px;
        overflow: hidden;
    }
</style>
<!-- 右側內容 -->
<section id="content">
    <section class="vbox">          
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="main"><i class="fa fa-home"></i> Main</a></li>
                <li><a href="artists">消息</a></li>
                <li class="active"><?php echo str_replace('-', '', $breadName);?></li>
            </ul>
            <div class="m-b-md">
                <h3 class="m-b-none"><?php echo $page_title;?></h3>
                <hr>
                <div class="example example-four">
                    <div class="hider">
                        <div class="slider-wrap" id="example-four-slider-wrap">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <form class="form-horizontal" enctype="multipart/form-data">
                                            <input type="hidden" name="token" value="<?php echo $token;?>">
                                            <input type="hidden" name="p_id" value="<?php echo $p_id;?>">
                                            <input type="hidden" name="type" value="<?php echo $type;?>">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="btn btn-success control-label" id="upload" for="p_image">選擇最新消息照片</label>
                                                    <em style="display: block">上傳尺寸1920*1080(2mb)</em>
                                                    <input class="form-control" type="file" id="p_image" name="p_image" accept="image/*" required>
                                                </div>
                                                <div class="col-md-9 imageParent">
                                                    <div id="preview">
                                                        <div id="container">
                                                            <div class="popupImage">
                                                                <?php 
                                                                    if(array_key_exists('p_image', $result))
                                                                        echo '<img src="'. base_url() .'uploads/images/publications/'. $result['p_image'] .'" height="80" width="80">';
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="originalImage">
                                                        <?php 
                                                            if(array_key_exists('p_image', $result))
                                                                echo '<img src="'. base_url() .'uploads/images/publications/'. $result['p_image'] .'">';
                                                        ?>
                                                    </div>    
                                                </div>
                                            </div>
                                            <br/>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div role="tabpanel">

                                                        <!-- Nav tabs -->
                                                        <ul class="nav nav-tabs" role="tablist">
                                                            <li role="presentation" class="active"><a href="#tw" aria-controls="tw" role="tab" data-toggle="tab">中文資料</a></li>
                                                            <li role="presentation"><a href="#en" aria-controls="en" role="tab" data-toggle="tab">英文資料</a></li>
                                                        </ul>

                                                        <!-- Tab panes -->
                                                        <div class="tab-content">
                                                            <div role="tabpanel" class="tab-pane active" id="tw">
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <label class="control-label"><b>最新消息名字</b></label>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="p_tw_name" class="form-control" placeholder="輸入刊物名字" value="<?php echo (array_key_exists('p_tw_name', $result))?$result['p_tw_name']:'';?>">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <label class="control-label"><b>最新消息內容</b></label>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <textarea name="p_tw_content" class="form-control" cols="30" rows="10" required placeholder="輸入刊物內容"><?php echo (array_key_exists('p_tw_content', $result))?$result['p_tw_content']:'';?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div role="tabpanel" class="tab-pane" id="en">
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <label class="control-label"><b>最新消息名字</b></label>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="p_en_name" class="form-control" placeholder="輸入刊物名字" value="<?php echo (array_key_exists('p_en_name', $result))?$result['p_en_name']:'';?>">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <label class="control-label"><b>最新消息內容</b></label>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <textarea name="p_en_content" class="form-control" cols="30" rows="10" required placeholder="輸入刊物內容"><?php echo (array_key_exists('p_en_content', $result))?$result['p_en_content']:'';?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br/>
                                            <br/>
                                            <div class="row">
                                                 <div class="col-md-10 text-right">
                                                    <span class="btn btn-warning" id="goBack">Go Back</span>
                                                    <button class="btn btn-primary ladda-button" data-style="zoom-in" id="submit" data-returnurl="publications"><span class="ladda-label">Submit</span></button>
                                                    <!-- <span class="btn btn-primary" id="submit" data-style="zoom-in">Submit</span> -->
                                                </div>
                                            </div>
                                        </form>
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

<script type="text/javascript" src="<?php echo base_url();?>js/backsite/notication.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/backsite/upload.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/js/plugin/spin.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/js/plugin/ladda.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/backsite/artists_detail.js"></script>