<!doctype html>
<html class="no-js" lang="en">


<!-- Mirrored from demo.devitems.com/Engilearning-v1/Engilearning/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 27 Jan 2019 17:30:43 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Engilearning || Teknik Informatika</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_directory('assets');?>images/index.png">
    
    <!-- CSS 
    ========================= -->
   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo get_directory('assets');?>css/bootstrap.min.css">
    
    <!-- Fonts CSS -->
    <link rel="stylesheet" href="<?php echo get_directory('assets');?>css/material-design-iconic-font.min.css">
    
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="<?php echo get_directory('assets');?>css/plugins.css">
    
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="<?php echo get_directory('assets');?>css/style.css">
    
    <!-- Modernizer JS -->
    <script src="<?php echo get_directory('assets');?>js/vendor/modernizr-3.6.0.min.js"></script>
</head>

<body>

<div class="main-wrapper">
   
    <header class="header-area">
        <div class="header-bottom-area header-sticky header-sticky">
            <div class="container">
                <div class="row">
                   
                    <div class="col-lg-3 col-md-5 col-6">
                        
                        <!-- logo-area -->
                        <div class="logo-area">
                            <a href="<?=site_url('home');?>"><img src="<?php echo get_directory('assets');?>images/logo/logo-ti.png" alt=""></a>
                        </div><!--// logo-area -->
                        
                    </div>
                    
                    <div class="col-lg-9 col-md-7 col-6"> 
                        <div class="header-bottom-right">
                            <!-- main-menu -->
                            <div class="main-menu">
                                <nav class="main-navigation">
                                    <ul>
                                        <li class="active"><a href="<?=site_url('home');?>">UTAMA</a></li>
                                        <li class="active"><a href="<?=site_url('matakuliah');?>">MATA KULIAH</a></li>
                                        <li><a href="<?=site_url('team');?>">PRODI</a></li>
                                        <li><a href="<?=site_url('leaderboard');?>">RANKING</a></li>
                                        <li><a href="<?=is_login_link();?>"><?=is_login_print();?></a></li>
                                    </ul>
                                </nav>
                            </div><!--// main-menu -->
                        </div>
                    </div>
                    
                     <div class="col">
                        <!-- mobile-menu start -->
                        <div class="mobile-menu d-block d-lg-none"></div>
                        <!-- mobile-menu end -->
                    </div>
                    
                </div>
            </div>
        </div>
    </header>
    