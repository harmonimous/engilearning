<?php get_view('header');?>

    <!-- Hero Slider start -->
    <div class="hero-slider">
       
        <div class="hero-slider-active owl-carousel">
           
            <div class="singleSlide" data-black-overlay="3">
                <div class="itemBg">
                    <img src="<?=resize_img(get_directory('assets')."images/slider/gedungc.jpg",1366,786,'img');?>" alt="">
                </div>
                <!-- Hero Content One Start -->
                <div class="container">
                    <div class="hero-content-one">
                        <div class="row">
                            <div class="col"> 
                                <div class="slider-text-info">
                                    <h1><span>Selamat Datang di</span> <br> Engilearning </h1>
                                    <a href="<?=set_url('team')?>" class="btn slider-btn uppercase"><span>Tentang Kami</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Hero Content One End -->
            </div>
            
        </div>
    </div>
    <!-- Hero Slider end -->
    
    <!-- Our Course Categories Area -->
    <div class="our-course-categories-area section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ml-auto mr-auto">
                    <!-- section-title -->
                    <div class="section-title-three">
                        <h4>Engilearning</h4>
                        <h3>E-learning Program Studi Teknik Informatika</h3>
                        <p>Program Studi Teknik Informatika memiliki <?=$matakuliah;?> matakuliah yang dapat
                        mahasiswa pelajari dalam e-learning ini.<p>
                    </div>
                    <div class="all-course-btn">
                        <a href="<?=set_url('matakuliah')?>" class="all-course">Daftar Matakuliah</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!--// Our Course Categories Area -->

 
    <!-- Project Count Area Start -->
    <div class="project-count-area section-ptb-160 project-count-bg">
        <div class="container">
           
            <div class="row">
                <div class="col-lg-8  ml-auto mr-auto">
                    <!-- section-title -->
                    <div class="section-title">
                        <h4>Engilearning</h4>
                        <h3 class="text-white">E-learning Program Studi Teknik Informatika</h3>
                    </div><!--// section-title -->
                </div>
            </div>
            
            <div class="project-count-inner">
                <div class="row">
                    <div class="col-lg-10 ml-auto mr-auto">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <!-- counter start -->
                                <div class="counter text-center">
                                    <h3 class="counter-active"><?=$dosen;?></h3>
                                    <p>Dosen</p>
                                </div>
                                <!-- counter end -->
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <!-- counter start -->
                                <div class="counter text-center">
                                    <h3 class="counter-active"><?=$matakuliah;?></h3>
                                    <p>Matakuliah</p>
                                </div>
                                <!-- counter end -->
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <!-- counter start --> 
                                <div class="counter text-center">
                                    <h3 class="counter-active"><?=$mahasiswa;?></h3>
                                    <p>Mahasiswa</p>
                                </div>
                                <!-- counter end -->
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <!-- counter start --> 
                                <div class="counter text-center">
                                    <h3 class="counter-active"><?=$materi;?></h3>
                                    <p>Materi</p>
                                </div>
                                <!-- counter end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Project Count Area End -->

<?php get_view('footer');?> 