<style>
    .popupImage{
        cursor: pointer;
    }
    input[type="file"], .originalImage, .multiOriginalImage{
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
                <li><a href="artists">藝術家列表</a></li>
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
                                            <input type="hidden" name="ar_id" value="<?php echo $ar_id;?>">
                                            <input type="hidden" name="type" value="<?php echo $type;?>">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="btn btn-success control-label" id="upload" for="ar_image">選擇藝術家照片</label>
                                                    <em style="display: block">上傳尺寸1920*1080(2mb)</em>
                                                    <input class="form-control" type="file" id="ar_image" name="ar_image" accept="image/*" required>
                                                </div>
                                                <div class="col-md-9 imageParent">
                                                    <div id="preview">
                                                        <div id="container">
                                                            <div class="popupImage">
                                                                <?php 
                                                                    if(array_key_exists('ar_image', $result))
                                                                        echo '<img src="'. base_url() .'uploads/images/artists/'. $result['ar_image'] .'" height="80" width="80">';
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="originalImage">
                                                        <?php 
                                                            if(array_key_exists('ar_image', $result))
                                                                echo '<img src="'. base_url() .'uploads/images/artists/'. $result['ar_image'] .'">';
                                                        ?>
                                                    </div>    
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="btn btn-success control-label" id="upload" for="ar_cv_image">選擇內頁照片</label>
                                                    <em style="display: block">上傳尺寸1920*1080(2mb)</em>
                                                    <input class="form-control" type="file" id="ar_cv_image" name="ar_cv_image" accept="image/*" required>
                                                </div>
                                                <div class="col-md-9 imageParent">
                                                    <div id="preview">
                                                        <div id="container">
                                                            <div class="popupImage">
                                                                <?php 
                                                                    if(array_key_exists('ar_cv_image', $result))
                                                                        echo '<img src="'. base_url() .'uploads/images/artists/'. $result['ar_cv_image'] .'" height="80" width="80">';
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="originalImage">
                                                        <?php 
                                                            if(array_key_exists('ar_cv_image', $result))
                                                                echo '<img src="'. base_url() .'uploads/images/artists/'. $result['ar_cv_image'] .'">';
                                                        ?>
                                                    </div>    
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="btn btn-success control-label" id="fileUpload" for="ar_pdf">選擇簡歷PDF</label>
                                                    <em style="display: block"></em>
                                                    <input class="form-control" type="file" id="ar_pdf" name="ar_pdf" accept="application/pdf" required>
                                                </div>
                                                <div class="col-md-9 pdfDisplay">
                                                    <?php echo (array_key_exists('ar_pdf', $result))?$result['ar_pdf']:'';?>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="control-label"><b>生日年份</b></label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" name="ar_birth_year" class="form-control" placeholder="輸入年份" value="<?php echo (array_key_exists('ar_birth_year', $result))?$result['ar_birth_year']:'';?>"> 
                                                </div>
                                            </div>
                                            <br/>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div role="tabpanel">

                                                        <!-- Nav tabs -->
                                                        <ul class="nav nav-tabs" role="tablist">
                                                            <li role="presentation"><a href="#tw" aria-controls="tw" role="tab" data-toggle="tab">中文資料</a></li>
                                                            <li role="presentation"><a href="#en" aria-controls="en" role="tab" data-toggle="tab">英文資料</a></li>
                                                            <li role="presentation" class="active"><a href="#works" aria-controls="works" role="tab" data-toggle="tab">作品/works</a></li>
                                                        </ul>

                                                        <!-- Tab panes -->
                                                        <div class="tab-content">
                                                            <div role="tabpanel" class="tab-pane" id="tw">
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <label class="control-label"><b>名字</b></label>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="ar_tw_name" class="form-control" placeholder="輸入名字" value="<?php echo (array_key_exists('ar_tw_name', $result))?$result['ar_tw_name']:'';?>">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <label class="control-label"><b>簡歷</b></label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <textarea name="ar_tw_content" class="form-control" cols="60" rows="10" required placeholder="輸入簡歷"><?php echo (array_key_exists('ar_tw_content', $result))?$result['ar_tw_content']:'';?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div role="tabpanel" class="tab-pane" id="en">
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <label class="control-label"><b>名字</b></label>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="ar_en_name" class="form-control" placeholder="輸入名字" value="<?php echo (array_key_exists('ar_en_name', $result))?$result['ar_en_name']:'';?>">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <label class="control-label"><b>簡歷</b></label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <textarea name="ar_en_content" class="form-control" cols="60" rows="10" required placeholder="輸入簡歷"><?php echo (array_key_exists('ar_en_content', $result))?$result['ar_en_content']:'';?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div role="tabpanel" class="tab-pane active" id="works">
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <label class="btn btn-success control-label" id="upload" for="worksUpload">新增作品圖片</label>
                                                                        <em style="display: block">上傳尺寸1920*1080(2mb)</em>
                                                                        <input class="form-control" type="file" id="worksUpload" name="w_image[]" accept="image/*" required multiple>
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row worksPopupImage">
                                                                    
                                                                    <?php
                                                                        $tempArray = array();
                                                                        $i = 0;
                                                                        if(count($resultWorks))
                                                                            foreach ($resultWorks as $key => $value) {
                                                                                $tempArray[$i] = uniqid(rand());
                                                                                echo '
                                                                                    <div class="col-sm-4 imageButton text-center">
                                                                                        <img name="'. $tempArray[$i] .'" class="worksImage popupForWorks cursor" src="'. base_url() .'uploads/images/works/thumb/'. $value['w_image'] .'">
                                                                                        <textarea name="w_description[]" cols="48" rows="10" >'. $value['w_description'] .'</textarea>
                                                                                        <input type="hidden" name="w_id_hidden[]" value="'. $value['w_id'] .'">
                                                                                        <span name="'. $value['w_id'] .'" type="button" class="btn btn-danger btn-group-justified worksDelete" style="margin-bottom:10px;visibility:hidden;">刪除</span>
                                                                                    </div>
                                                                                ';
                                                                                $i++;
                                                                            }
                                                                    ?>

                                                                    <div class="multiOriginalImage">
                                                                        <?php 
                                                                            $i = 0;
                                                                            if(count($resultWorks))
                                                                                foreach ($resultWorks as $key => $value) {
                                                                                    echo '<img name="'. $tempArray[$i] .'" src="'. base_url() .'uploads/images/works/'. $value['w_image'] .'">';
                                                                                    $i++;
                                                                                }
                                                                        ?>
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
                                                    <button class="btn btn-primary ladda-button" data-style="zoom-in" id="submit" data-returnurl="artists"><span class="ladda-label">Submit</span></button>
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

<script type="text/javascript" src="<?php echo base_url();?>js/backsite/plugin/bootbox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/backsite/notication.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/backsite/upload.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/js/plugin/spin.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/js/plugin/ladda.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/backsite/artists_detail.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/backsite/worksUpload.js"></script>