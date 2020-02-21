<?php get_view('header');?>
    <!-- Breadcrumb -->
    <div class="breadcrumb-area" data-bgimage="<?php echo get_directory('assets');?>images/bg/fun-01.jpg" data-black-overlay="4">
        <div class="container">
            <div class="in-breadcrumb">
                <div class="row">
                    <div class="col">
                        <h3><?=$matakuliah->nama_matakuliah;?></h3>
                        <!-- breadcrumb-list start -->
                        <ul class="breadcrumb-list">
                            <li class="breadcrumb-item"><a href="<?=set_url('home');?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?=set_url('matakuliah');?>">Matakuliah</a></li>
                            <li class="breadcrumb-item active"><?=$matakuliah->nama_matakuliah;?></li>
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
       
        <!--  Courses Details Area -->
        <div class="courses-details-area section-pb section-pt-90">
            <div class="container">
                
                <div class="row">
                    <div class="col-lg-8">
                        
                        <div class="row">

                            <div class="col-lg-12 col-12">
                                <!-- single-courses -->
                                <div class="single-courses-details mt--30">
                                    <div class="course-image">
                                        <img src="<?=resize_img(base_url('uploaded/images/').$matakuliah->gambar_matakuliah,770,320,'img');?>" alt="">
                                    </div>
                                    <div class="popular-courses-contnet">
                                        <h5><?=$matakuliah->nama_matakuliah;?></h5>
                                        <div class="post_meta">
                                            <ul>
                                                <li><p>Kategori : <?=$matakuliah->kategori;?></></li>
                                                <li><p>Semester : <?=$matakuliah->semester;?></p></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!--// single-courses -->
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="row course-details-tab-area">
                                    <div class="col-12">
                                        <div class="details-tabs-list">
                                            <ul class="nav" role="tablist">
                                               <li class="active"><a class="active" href="#overview" role="tab" data-toggle="tab">Detil Matakuliah</a></li>
                                               <li><a href="#instructor"  role="tab" data-toggle="tab"> Dosen Pengampu  </a></li>
                                        </div>
                                    </div>
                                    
                                    <!-- courses-details start -->
                                    <div class="col-lg-12">
                                        <div class="courses-details-tab-panel">
                                            <!-- tab-contnt start -->
                                            <div class="tab-content">

                                                <div class="tab-pane active" id="overview">
                                                   <div class="courses-details-cont">
                                                       <h5><?=$matakuliah->nama_matakuliah;?> :</h5>
                                                       <?php if($matakuliah->deskripsi_matakuliah == ""):?>
                                                       <p>Tidak Ada Deskripsi</p>
                                                        <?php else :?>
                                                        <?=$matakuliah->deskripsi_matakuliah;?>
                                                        <?php endif ?>
                                                   </div>
                                                </div>

                                                <div class="tab-pane" id="instructor">
                                                    <div class="details-list mt-0">
                                                        <ul>
                                                            <li><a href="#"><i class="zmdi zmdi-arrow-right"></i> <?=$matakuliah->nama_dosen;?></a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div><!--// tab-contnt start -->
                                        </div>
                                    </div><!--// courses-details start -->
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <a type="button" class="register-now-button" href="<?=set_url('mahasiswa/learn/');?><?=$matakuliah->id_matakuliah;?>">
								  Pelajari
								</a>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="related-courses-area section-pt">
                                    <h4>Related Courses</h4>
                                    
                                    <div class="row">
                                        <?php foreach($related as $each):?>
                                        <div class="col-lg-4">
                                            <!-- single-courses -->
                                            <div class="single-popular-courses mt--30">
                                                <div class="popular-courses-image">
                                                    <a href="#"><img src="<?=resize_img(base_url('uploaded/images/').$each->gambar_matakuliah,770,320,'img');?>" alt=""></a>
                                                </div>
                                                <div class="popular-courses-contnet">
                                                    <h5><?=$each->nama_matakuliah;?></h5>
                                                    <div class="post_meta">
                                                        <ul>
                                                            <li><?=$each->kategori;?></a></li>
                                                        </ul>
                                                    </div>
                                                    <p><?=substr($each->deskripsi_matakuliah,0,80);?></p>
                                                    <div class="button-block">
                                                        <a href="<?=site_url('matakuliah/detail/');?><?=$each->id_matakuliah;?>" class="botton-border">Lihat</a>
                                                    </div>
                                                </div>
                                            </div><!--// single-courses -->
                                        </div>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        
                    </div>
                    
                    <div class="col-lg-4">
                       
                        <div class="row widgets right-sidebar">
                           
                            <div class="col-lg-12">
                                <div class="single-widget widget-search">
                                    <form action="#" class="widget-search-form">
                                        <input type="text" placeholder="Search...">
                                        <button type="submit"><i class="zmdi zmdi-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="single-widget widget-categories">
                                    <h4 class="widget-title">
                                        <span>Kategori Matakuliah</span>
                                    </h4>
                                    <ul>
                                        <?php foreach($kategori as $each): ?>
                                        <li><a href="<?=set_url('matakuliah');?>/<?=humanize($each->kategori)?>"><span class="categories-name"><?=$each->kategori?></span></a></li>
                                        <?php endforeach; ?>
                                        
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>


            </div>
        </div>
        <!--//  Courses Details Area -->   
    </main>
    <!--// Page Conttent -->
<?php get_view('footer')?>