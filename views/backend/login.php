<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <!-- Prevent the demo from appearing in search engines (REMOVE THIS) -->
    <meta name="robots" content="noindex">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="<?php echo get_directory('assets');?>vendor/perfect-scrollbar.css" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="<?php echo get_directory('assets');?>css/material-icons.css" rel="stylesheet">
    <link type="text/css" href="<?php echo get_directory('assets');?>css/material-icons.rtl.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link type="text/css" href="<?php echo get_directory('assets');?>css/fontawesome.css" rel="stylesheet">
    <link type="text/css" href="<?php echo get_directory('assets');?>css/fontawesome.rtl.css" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="<?php echo get_directory('assets');?>css/app.css" rel="stylesheet">
    <link type="text/css" href="<?php echo get_directory('assets');?>css/app.rtl.css" rel="stylesheet">





</head>
<body class="login">


    <div class="d-flex align-items-center" style="min-height: 100vh">
        <div class="col-sm-8 col-md-6 col-lg-4 mx-auto" style="min-width: 300px;">
            <div class="text-center mt-5 mb-1">
                <div class="avatar avatar-lg">
                    <img src="<?php echo get_directory('assets');?>images/logo/primary.svg" class="avatar-img rounded-circle" alt="LearnPlus" />
                </div>
            </div>
            <div class="d-flex justify-content-center mb-5 navbar-light">
                <a href="<?=site_url('home')?>" class="navbar-brand m-0">Engilearning</a>
            </div>
            <div class="card navbar-shadow">
                <div class="card-header text-center">
                    <h4 class="card-title">Masuk</h4>
                    <p class="card-subtitle">Akses Dosen</p>
                </div>
                <div class="card-body">
                    <form action="<?=set_url('login');?>" novalidate method="post">
                        <div class="form-group">
                            <label class="form-label" for="nid">NID:</label>
                            <div class="input-group input-group-merge">
                                <input id="nid" type="nid" name="nid" required class="form-control form-control-prepended" placeholder="NID">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="far fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Password:</label>
                            <div class="input-group input-group-merge">
                                <input id="password" type="password" name="password" required class="form-control form-control-prepended" placeholder="Password">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_error('NID');?>
                        <?php echo form_error('password');?>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                        <div class="text-center">
                            <a href="guest-forgot-password.html" class="text-black-70" style="text-decoration: underline;">Lupa Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="<?php echo get_directory('assets');?>vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="<?php echo get_directory('assets');?>vendor/popper.min.js"></script>
    <script src="<?php echo get_directory('assets');?>vendor/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="<?php echo get_directory('assets');?>vendor/perfect-scrollbar.min.js"></script>

    <!-- MDK -->
    <script src="<?php echo get_directory('assets');?>vendor/dom-factory.js"></script>
    <script src="<?php echo get_directory('assets');?>vendor/material-design-kit.js"></script>

    <!-- App JS -->
    <script src="<?php echo get_directory('assets');?>js/app.js"></script>

    <!-- Highlight.js -->
    <script src="<?php echo get_directory('assets');?>js/hljs.js"></script>

    <!-- App Settings (safe to remove) -->
    <script src="<?php echo get_directory('assets');?>js/app-settings.js"></script>





</body>
</html>