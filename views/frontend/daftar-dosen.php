<?php get_view('header');?>
    <!-- Breadcrumb -->
    <div class="breadcrumb-area" data-bgimage="<?php echo get_directory('assets');?>images/bg/fun-01.jpg" data-black-overlay="4">
        <div class="container">
            <div class="in-breadcrumb">
                <div class="row">
                    <div class="col">
                        <h3>Tentang Kami</h3>
                        <!-- breadcrumb-list start -->
                        <ul class="breadcrumb-list">
                            <li class="breadcrumb-item"><a href="home">Halaman Utama</a></li>
                            <li class="breadcrumb-item active">Tentang Kami</li>
                        </ul>
                        <!-- breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Breadcrumb -->
    
    
    <!-- Page Conttent -->
    <main class="page-content">
        <!-- About Us Area -->
        <div class="about-us-area section-ptb">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-us-contents">
                            <h3>Apa itu <span><i>Engilearning </i>?</span></h3>
                            <p><i>"Engilearning"</i> merupakan singkatan dari <i>Engineering</i> dan <i>E-learning</i>, dimana situs <i>E-learning</i> ini diperuntukan bagi mahasiswa Program Studi Teknik Informatika untuk dapat mempelajari materi perkuliahan dimanapun dan kapanpun.</p> 
                            <div class="about-us-btn">
                                <a href="<?=set_url('matakuliah');?>">Lihat Matakuliah</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 ">
                        <div class="about-us-image text-right">
                            <a href="https://www.youtube.com/watch?v=mgmepMoce1E" class="popup-youtube"><img src="<?php echo get_directory('assets');?>/images/about/youtube.png" alt="">
                            <span><img src="<?php echo get_directory('assets');?>/images/icon/video-icon.png" alt=""></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// About Us Area -->
        
        <!-- Our Team Area -->
        
       
        <div class="our-team-area section-ptb">
            <div class="container">

               <div class="row">
                    <div class="col-lg-8  ml-auto mr-auto">
                        <div class="section-title-two">
                            <h4>Dosen</h4>
                            <h3>Teknik Informatika</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php foreach($dosen as $each): ?>
                    <div class="col-lg-3" style="margin-bottom: 20px;">
                        <div class="single-team mt--30">
                            <div class="single-team-image">
                                <img src="<?=resize_img(base_url('uploaded/images/').$each->gambar_dosen,250,250,'img');?>" alt="NO IMAGE">
                            </div>
                            <div class="single-team-info">
                                <h5><?=$each->nama_dosen;?></h5>
                            </div>
                            <ul class="personsl-socail">
                                <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-rss"></i></a></li>
                                <li><a href="https://www.instagram.com/asriyanik1/?hl=id" target="_blank"><i class="zmdi zmdi-instagram"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
            </div>
        </div>
        <!--// Our Team Area -->
  		
        
        
    </main>
    <!--// Page Conttent -->

<?php get_view('footer');?> 