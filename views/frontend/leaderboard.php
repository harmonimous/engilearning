<?php get_view('header');?>
<!-- Breadcrumb -->
<div class="breadcrumb-area" data-bgimage="<?php echo get_directory('assets');?>images/bg/fun-01.jpg" data-black-overlay="4">
    <div class="container">
        <div class="in-breadcrumb">
            <div class="row">
                <div class="col">
                    <h3>Rangking Mahasiswa</h3>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="<?=set_url('home');?>">Home</a></li>
                        <li class="breadcrumb-item active">Ranking</li>
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
   
    <div class="wishlist-main-content section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#" class="cart-table">
                        <div class=" table-content table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="plantmore-product-thumbnail" width="2%">No</th>
                                        <th class="plantmore-product-remove" width="2%">Level</th>
                                        <th class="cart-product-name" width="50%">Nama Mahasiswa</th>
                                        <th class="plantmore-product-price" width="15%">Kelas</th>
                                        <th class="plantmore-product-stock-status" width="5%">Semester</th>
                                        <th class="plantmore-product-add-cart" width="20%">Point Experience</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php $no=0;?>
                                	<?php foreach ($mahasiswa as $item):
                                		$no++;
                                	?>
                                    <tr>
                                        <td class="plantmore-product-thumbnail" width="2%"><?=$no;?></td>
                                        <td class="plantmore-product-name" width="2%"><?=$item->level;?></td>
                                        <td class="plantmore-product-price" width="50%"><?=$item->nama_mahasiswa;?></td>
                                        <td class="plantmore-product-stock-status" width="15%"><?=$item->nama_kelas;?></td>
                                        <td class="plantmore-product-add-cart" width="5%"><?=$item->semester;?></td>
                                        <td class="plantmore-product-remove" width="20%"><?=$item->point_exp;?></td>
                                    </tr>
                                	<?php endforeach?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<!--// Page Conttent -->
<?php get_view('footer')?>