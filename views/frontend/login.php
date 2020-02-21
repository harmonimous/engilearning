<?php get_view('header');?>
    <!-- Page Conttent -->
    <main class="page-content">
       
        <div class="register-page section-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <!-- login-register-tab-list start -->
                            <div class="login-register-tab-list nav">
                                <a class="active" data-toggle="tab" href="#login">
                                    <h4> Login Mahasiswa </h4>
                                </a>
                            </div>
                            <!-- login-register-tab-list end -->
                            <div class="tab-content">
                                <div id="login" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="<?=set_url('login');?>" method="post">
                                                <div class="login-input-box">
                                                    <input type="text" id="nim" name="nim" placeholder="NIM" autocomplete="off" required="" autofocus="true">
                                                    <input type="password" id="password" name="password" placeholder="Password" autocomplete="off" required="">
                                                </div>
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                        <input type="checkbox">
                                                        <label>Ingatkan</label>
                                                        <a href="#">Lupa Password?</a>
                                                    </div>
                                                    <div class="button-box">
                                                        <button class="login-btn btn" type="submit"><span>Login</span></button>
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
            </div>
        </div>
        
    </main>
    <!--// Page Conttent -->
    
<?php get_view('footer');?>