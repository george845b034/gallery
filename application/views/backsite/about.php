<style>
    .popupImage{
        cursor: pointer;
    }
    #id_image_large, .originalImage{
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
                <li class="active"><?php echo $page_title;?></li>
            </ul>
            <div class="m-b-md">
                <h3 class="m-b-none"><?php echo $page_title;?></h3>
                <hr>
                <div class="form-group">
                    <form class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="token" value="<?php echo $token;?>">
                        <div class="row">
                            <div class="col-md-1">
                                <label class="btn btn-success control-label" id="upload" for="id_image_large">選擇照片</label>
                                <input class="form-control" type="file" id="id_image_large" name="image" accept="image/*">
                            </div>
                            <div class="col-md-10 imageParent">
                                <div id="preview">
                                    <div id="container">
                                        <div class="popupImage">
                                            <?php 
                                                if($result['ab_image'] != '')
                                                    echo '<img src="'. base_url() .'uploads/images/introduction/'. $result['ab_image'] .'" height="80" width="80">';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="originalImage">
                                    <?php 
                                        if($result['ab_image'] != '')
                                            echo '<img src="'. base_url() .'uploads/images/introduction/'. $result['ab_image'] .'">';
                                    ?>
                                </div>    
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-10">
                                <div role="tabpanel">

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">中文介紹</a></li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">簡中介紹</a></li>
                                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">英文介紹</a></li>
                                        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">日文介紹</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="home">
                                            <br/>
                                            <div class="row">   
                                                <div class="col-md-12">
                                                    <textarea name="tw_introduction" class="form-control" cols="30" rows="10" required><?php echo $result['ab_tw_introduction'];?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="profile">
                                            <br/>
                                            <div class="row">   
                                                <div class="col-md-12">
                                                    <textarea name="cn_introduction" class="form-control" cols="30" rows="10" required><?php echo $result['ab_cn_introduction'];?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="messages">
                                            <br/>
                                            <div class="row">   
                                                <div class="col-md-12">
                                                    <textarea name="en_introduction" class="form-control" cols="30" rows="10" required><?php echo $result['ab_en_introduction'];?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="settings">
                                            <br/>
                                            <div class="row">   
                                                <div class="col-md-12">
                                                    <textarea name="jp_introduction" class="form-control" cols="30" rows="10" required><?php echo $result['ab_jp_introduction'];?></textarea>
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
                                <span class="btn btn-info" id="submit">Submit</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
</section>
<!-- /右側內容 -->

<script type="text/javascript" src="<?php echo base_url();?>js/backsite/notication.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/backsite/upload.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/backsite/about.js"></script>