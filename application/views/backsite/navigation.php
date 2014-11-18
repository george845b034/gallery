<section class="vbox">
    <!-- navigation bar -->
    <header class="bg-dark dk header navbar navbar-fixed-top-xs">
        <div class="navbar-header aside-md">
            <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
                <i class="fa fa-bars"></i>
            </a>
            <a href="#" class="navbar-brand" data-toggle="fullscreen"><img src="../images/theme/logo.png" class="m-r-sm">Syntrend</a>
            <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
                <i class="fa fa-cog"></i>
            </a>
        </div>
        <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="thumb-sm avatar pull-left">
                        <img src="../images/theme/avatar_default.jpg">
                    </span>
                    <?php echo $this->session->userdata('username');?> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu animated fadeInRight">
                    <span class="arrow top"></span>
                    <li>
                        <a href="logout">Logout</a>
                    </li>
                </ul>
            </li>
        </ul>      
    </header>
    <!-- /navigation bar -->
    <section>
        <section class="hbox stretch">
            <!-- 左側選單 -->
            <aside class="bg-dark lter aside-md hidden-print" id="nav">          
                <section class="vbox">
                    <section class="w-f scrollable">
                        <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                            <!-- nav -->
                            <nav class="nav-primary hidden-xs">
                                <ul class="nav">
                                    <li  class="active">
                                        <a href="index.html"   class="active">
                                            <i class="fa fa-dashboard icon">
                                                <b class="bg-danger"></b>
                                            </i>
                                            <span>Main</span>
                                        </a>
                                    </li>
                                    <?php
                                        //權限資料
                                        $permission = ($this->session->userdata('permission'))?$this->session->userdata('permission'):array();

                                        //選單
                                        foreach ($menu as $key => $value) {

                                            //子選單資料
                                            $subMenu = $this->main_model->getSubMenu($value['m_id']);

                                            //權限
                                            if( count($subMenu) OR in_array($value['m_url'], $permission) ){

                                                echo '
                                                    <li >
                                                        <a href="'. $value['m_url'] .'"  >
                                                            <i class="fa '. $value['m_icon'] .' icon">
                                                                <b class="'. $value['m_color'] .'"></b>
                                                            </i>
                                                            <span>'. $value['m_name'] .'</span>
                                                        </a>';
                                            }

                                            //子選單
                                            foreach ($subMenu as $key2 => $value2) {
                                                //權限
                                                if( count($subMenu) OR in_array($value['m_url'], $permission) ){

                                                    echo '
                                                        <ul class="nav lt">
                                                            <li >
                                                                <a href="'. $value2['a_url'] .'" >
                                                                    <i class="fa fa-angle-right"></i>
                                                                    <span>'. $value2['a_name'] .'</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        ';
                                                }
                                            }

                                            //權限
                                            if( count($subMenu) OR in_array($value['m_url'], $permission) ){

                                                echo '
                                                    </li>
                                                ';
                                            }

                                        }
                                    ?>
                                </ul>
                            </nav>
                            <!-- / nav -->
                        </div>
                    </section>
                    <footer class="footer lt hidden-xs b-t b-dark">
                        <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon">
                            <i class="fa fa-angle-left text"></i>
                            <i class="fa fa-angle-right text-active"></i>
                        </a>
                    </footer>
                </section>
            </aside>
            <!-- /左側選單 -->