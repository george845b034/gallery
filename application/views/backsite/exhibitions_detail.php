<style>
    .popupImage{
        cursor: pointer;
    }
    input[type="file"], .originalImage, .multiOriginalImage, .worksOriginalImage{
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
                <li><a href="exhibitions">展覽</a></li>
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
                                            <input type="hidden" name="e_id" value="<?php echo $e_id;?>">
                                            <input type="hidden" name="type" value="<?php echo $type;?>">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="btn btn-success control-label" id="upload" for="e_image">選擇展覽列表照片</label>
                                                    <em style="display: block">上傳尺寸1920*1080(2mb)</em>
                                                    <input class="form-control" type="file" id="e_image" name="e_image" accept="image/*" required>
                                                </div>
                                                <div class="col-md-9 imageParent">
                                                    <div id="preview">
                                                        <div id="container">
                                                            <div class="popupImage">
                                                                <?php 
                                                                    if(array_key_exists('e_image', $result))
                                                                        echo '<img src="'. base_url() .'uploads/images/exhibitions/'. $result['e_image'] .'" height="80" width="80">';
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="originalImage">
                                                        <?php 
                                                            if(array_key_exists('e_image', $result))
                                                                echo '<img src="'. base_url() .'uploads/images/exhibitions/'. $result['e_image'] .'">';
                                                        ?>
                                                    </div>    
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="btn btn-success control-label" id="upload" for="multi_upload">選擇展覽場瀏覽照片</label>
                                                    <em style="display: block">上傳尺寸1920*1080(2mb)</em>
                                                    <input class="form-control" type="file" id="multi_upload" name="eiv_image[]" accept="image/*" required multiple>
                                                </div>
                                                <div class="col-md-9 multiPopupImage">
                                                    <?php
                                                        $tempArray = array();
                                                        $i = 0;
                                                        if(count($resultInstallationsView))
                                                            foreach ($resultInstallationsView as $key => $value) {
                                                                $tempArray[$i] = uniqid(rand());
                                                                echo '<img name="'. $tempArray[$i] .'" src="'. base_url() .'uploads/images/exhibitions/thumb/'. $value['e_image'] .'" class="popupImageForMulti cursor" height="80" width="80" style="padding-right: 10px;">';
                                                                $i++;
                                                            }
                                                    ?>
                                                    <div class="multiOriginalImage">
                                                        <?php 
                                                            $i = 0;
                                                            if(count($resultInstallationsView))
                                                                foreach ($resultInstallationsView as $key => $value) {
                                                                    echo '<img name="'. $tempArray[$i] .'" src="'. base_url() .'uploads/images/exhibitions/'. $value['e_image'] .'">';
                                                                    $i++;
                                                                }
                                                        ?>
                                                    </div>    
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="control-label"><b>關聯藝術家</b></label>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <select name="ar_id" class="form-control">
                                                            <option value="0">請選擇</option>
                                                            <?php
                                                                foreach ($artistsData as $key => $value) {
                                                                    $selected = ($result['ar_id'] == $value['ar_id'])?'selected="selected"':'';
                                                                    echo '<option value="'. $value['ar_id'] .'" '. $selected .'>'. $value['ar_tw_name'] .'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="control-label"><b>展覽日期</b></label>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="text" name="e_start_date" class="form-control datepicker" placeholder="輸入起始日期" value="<?php echo (array_key_exists('e_start_date', $result))?$result['e_start_date']:'';?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="e_end_date" class="form-control datepicker" placeholder="輸入迄止日期" value="<?php echo (array_key_exists('e_end_date', $result))?$result['e_end_date']:'';?>">
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
                                                            <li role="presentation"><a href="#tw" aria-controls="tw" role="tab" data-toggle="tab">中文資料</a></li>
                                                            <li role="presentation"><a href="#en" aria-controls="en" role="tab" data-toggle="tab">英文資料</a></li>
                                                            <li role="presentation" class="active"><a href="#works" aria-controls="works" role="tab" data-toggle="tab">作品/works</a></li>
                                                        </ul>

                                                        <!-- Tab panes -->
                                                        <div class="tab-content">
                                                            <div role="tabpanel" class="tab-pane" id="tw">
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <label class="control-label"><b>展覽名字</b></label>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <input type="text" name="e_tw_name" class="form-control" placeholder="輸入展覽名字" value="<?php echo (array_key_exists('e_tw_name', $result))?$result['e_tw_name']:'';?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <label class="control-label"><b>展覽描述</b></label>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <input type="text" name="e_tw_description" class="form-control" placeholder="輸入展覽描述" value="<?php echo (array_key_exists('e_tw_description', $result))?$result['e_tw_description']:'';?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <label class="control-label"><b>展覽住址</b></label>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <input type="text" name="e_tw_address" class="form-control" placeholder="輸入展覽住址" value="<?php echo (array_key_exists('e_tw_address', $result))?$result['e_tw_address']:'';?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <label class="control-label"><b>展覽說明</b></label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <textarea name="e_tw_content" class="form-control" cols="100" rows="10" required placeholder="輸入展覽說明"><?php echo (array_key_exists('e_tw_content', $result))?$result['e_tw_content']:'';?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div role="tabpanel" class="tab-pane" id="en">
                                                                <br/><div class="row">
                                                                    <div class="col-md-2">
                                                                        <label class="control-label"><b>展覽名字</b></label>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <input type="text" name="e_en_name" class="form-control" placeholder="輸入展覽名字" value="<?php echo (array_key_exists('e_en_name', $result))?$result['e_en_name']:'';?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <label class="control-label"><b>展覽描述</b></label>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <input type="text" name="e_en_description" class="form-control" placeholder="輸入展覽描述" value="<?php echo (array_key_exists('e_en_description', $result))?$result['e_en_description']:'';?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br/><div class="row">
                                                                    <div class="col-md-2">
                                                                        <label class="control-label"><b>展覽住址</b></label>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <input type="text" name="e_en_address" class="form-control" placeholder="輸入展覽住址" value="<?php echo (array_key_exists('e_en_address', $result))?$result['e_en_address']:'';?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <label class="control-label"><b>展覽說明</b></label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <textarea name="e_en_content" class="form-control" cols="100" rows="10" required placeholder="輸入展覽說明"><?php echo (array_key_exists('e_en_content', $result))?$result['e_en_content']:'';?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div role="tabpanel" class="tab-pane active" id="works">
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <select class="form-control" id="workSelect">
                                                                            <option value="">選擇藝術家</option>
                                                                            <?php
                                                                                foreach ($artistsWithWork as $key => $value) {
                                                                                    echo '<option value="'. $value['ar_id'] .'">'. $value['ar_tw_name'] .'</option>';
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row worksPopupImage">
                                                                    <div class="worksOriginalImage">
                                                                        <?php
                                                                            $tempArray = array();
                                                                            $i = 0;
                                                                            foreach ($works as $key => $value) {
                                                                                $tempArray[$i] = uniqid(rand());
                                                                                echo '
                                                                                    <img class="workSelected" name="'. $tempArray[$i] .'" src="../uploads/images/works/'. $value['w_image'] .'">
                                                                                    <input type="hidden" name="w_id[]" value="'. $value['w_id'] .'">
                                                                                ';
                                                                                $i++;
                                                                            }
                                                                        ?>
                                                                    </div>
                                                                    <?php
                                                                        $i = 0;
                                                                        foreach ($works as $key => $value) {
                                                                            echo '
                                                                                <div class="col-sm-4 imageButton text-center workSelected">
                                                                                    <img name="'. $tempArray[$i] .'" class="worksImage popupForWorks cursor" src="../uploads/images/works/thumb/'. $value['w_image'] .'">
                                                                                    <span name="'. $value['w_id'] .'" type="button" class="btn btn-danger btn-group-justified worksJoinDelete" style="margin-bottom: 10px; visibility: hidden;">刪除</span>
                                                                                </div>
                                                                            ';
                                                                            $i++;
                                                                        }
                                                                    ?>
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
                                                    <button class="btn btn-primary ladda-button" data-style="zoom-in" id="submit" data-returnurl="exhibitions"><span class="ladda-label">Submit</span></button>
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
<script type="text/javascript" src="<?php echo base_url();?>js/backsite/mutilUploadPreview.js"></script>