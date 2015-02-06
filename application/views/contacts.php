    <div class="contact">
        <span class="t5">
            <h1>Contacts</h1>
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
    </div>
    <div class="footer_con"></div>
    <script src="./js/plugin/spin.js"></script>
    <script src="./js/plugin/ladda.js"></script>
