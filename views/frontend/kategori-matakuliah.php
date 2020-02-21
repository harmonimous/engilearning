<?php get_view('header');?>
    <!-- Breadcrumb -->
    <div class="breadcrumb-area" data-bgimage="<?php echo get_directory('assets');?>images/bg/fun-01.jpg" data-black-overlay="4">
        <div class="container">
            <div class="in-breadcrumb">
                <div class="row">
                    <div class="col">
                        <h3>DAFTAR MATAKULIAH</h3>
                        <!-- breadcrumb-list start -->
                        <ul class="breadcrumb-list">
                            <li class="breadcrumb-item"><a href="home">Halaman Utama</a></li>
                            <li class="breadcrumb-item"><a href="<?=set_url('matakuliah')?>">Matakuliah</a></li>
                            <li class="breadcrumb-item active">Kategori</li>
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
       
        <!-- Most Popular Courses Area -->
        <div class="most-popular-courses-area section-pb section-pt-90">
            <div class="container">
                
                <div class="row">
                    <div class="col-lg-8">
                        
                        <div class="row">
                            <?php if(have_data($type='matakuliah')):?>
                                <?php foreach(data_matakuliah() as $data):?>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <!-- single-courses -->
                                    <div class="single-popular-courses mt--30">
                                        <div class="popular-courses-image">
                                            <a href="#"><img src="<?=resize_img(base_url().'uploaded/images/'.$data->gambar_matakuliah,370,240,'img');?>"></a>
                                        </div>
                                        <div class="popular-courses-contnet">
                                            <h5><?=$data->nama_matakuliah;?></h5>
                                            <div class="post_meta">
                                                <ul>
                                                    <li><a href="#"><?=kategori_matakuliah($data);?></a></li>
                                                    <li><p>Semester : <?=$data->semester;?></p></li>
                                                </ul>
                                            </div>
                                            <p><?= substr($data->deskripsi_matakuliah,0,150);?></p>
                                            <div class="button-block">
                                                <a href="<?=site_url('matakuliah/detail/');?><?=$data->id_matakuliah;?>" class="botton-border">Detail Matakuliah</a>
                                            </div>
                                        </div>
                                    </div><!--// single-courses -->
                                </div>
                                <?php endforeach;?>
                            <?php else :?>
                                <h5>Opps! Tidak ada data untuk ditampilkan</h5>
                            <?php endif;?>
                              
                        </div>

                        <!-- paginatoin-area Start -->
                        <div class="paginatoin-area ">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?=pagination_data('matakuliah');?>
                                </div>
                            </div>
                        </div><!--// paginatoin-area End -->
                        
                    </div>
                    
                    <div class="col-lg-4">
                       
                        <div class="row widgets right-sidebar">
                           
                            <div class="col-lg-12">
                                <div class="single-widget widget-search">
                                    <form action="#" class="widget-search-form">
                                        <input type="text" placeholder="Cari Matakuliah...">
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
                                        <li><a href="<?=set_url('matakuliah/').$each->id_kategori;?>"><span class="categories-name"><?=$each->kategori?></span></a></li>
                                        <?php endforeach; ?>
                                        
                                    </ul>
                                </div>
                            </div>

                            
                        </div>
                        
                    </div>
                    
                </div>


            </div>
        </div>
        <!--// Most Popular Courses Area -->
        
    </main>
    <!--// Page Conttent -->
    
<?php get_view('footer');?>