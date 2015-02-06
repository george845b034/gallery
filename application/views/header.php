<!doctype html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=""/>
    <meta charset="UTF-8">
    <title>展演中心</title>
        <!-- Loading Bootstrap -->
        <link href="./css/bootstrap/bootstrap.min.css" rel="stylesheet">
        <!-- Loading Flat UI -->
        <link href="./css/front_theme/flat-ui.css" rel="stylesheet">
        <link href="./css/front_theme/demo.css" rel="stylesheet">
        <link href="./css/front_theme/css.css" rel="stylesheet">
        <link href="./css/plugin/ladda-themeless.css" rel="stylesheet">
        <link href="./css/plugin/pnotify.custom.min.css" rel="stylesheet">

        <link href="./css/plugin/fxsmall.css" rel="stylesheet">
        <link href="./css/plugin/demo.css" rel="stylesheet">
        <link href="./css/plugin/component.css" rel="stylesheet">
        <script src="./js/plugin/modernizr.custom.js"></script>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
            <script src="./front/js/html5shiv.js"></script>
            <script src="./front/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <?php
        $parameter = ($_SERVER['QUERY_STRING'] != '')?'?' . $_SERVER['QUERY_STRING'] . '&':'?';
    ?>
    <body>
        <div class="main">
        <div class="headbar navbar-fixed-top">
            <ul>
                <li><a href="main"><img src="images/theme/syntrendLogo.png"></a></li>
                <li><a href="exhibitions_list?type=current"><?php echo $headerData['h_'. $language .'_exhibitions'];?></a></li>
                <li><a href="artis"><?php echo $headerData['h_'. $language .'_artists'];?></a></li>
                <!-- <li><a href="publications">Publications</a></li> -->
                <li><a href="contacts"><?php echo $headerData['h_'. $language .'_contact'];?></a></li>
                <li><a href="about"><?php echo $headerData['h_'. $language .'_about'];?></a></li>
            </ul>
            <ul class="baricons" style="margin-left: 840px;">
                <li><a href="<?php echo $parameter;?>lang=tw">中文</a></li>
                <li><a href="<?php echo $parameter;?>lang=en">English</a></li>
                <li><a href=""><img src="images/theme/share.png"></a></li>
                <li><a href=""><img src="images/theme/fb.png"></a></li>
                <li><a href="main"><img src="images/theme/home.png"></a></li>
            </ul>
        </div>