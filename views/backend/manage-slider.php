<?php get_view('header');?>
<div class="mdk-header-layout__content">
    <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
        <div class="mdk-drawer-layout__content page ">
            <div class="container-fluid page__container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=set_url('dashboard');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active"><?=header_title();?></li>
                </ol>

                <div class="d-flex flex-column flex-sm-row flex-wrap mb-headings align-items-start align-items-sm-center">
                    <div class="flex mb-2 mb-sm-0">
                        <h1 class="h2"><?=header_title();?></h1>
                    </div>
                    <p><a href="#add" class="btn btn-success">Tambah <i class="material-icons">add</i></a></p>   
                </div>

                <div class="card card-body border-left-3 border-left-primary navbar-shadow mb-4">
                    <form action="#">
                        <div class="d-flex flex-wrap2 align-items-center mb-headings">
                            <div class="flex search-form ml-3 search-form--light">
                                <input type="text" class="form-control" placeholder="Cari Slider" id="search" name="search">
                                <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
                            </div>
                        </div>

                        <div id="count-slider" class="d-flex flex-column flex-sm-row align-items-sm-center" style="white-space: nowrap;">  
                        </div>
                    </form>
                </div>

                <!--alert-->
                <div id='alert-slider'>
                </div>
                 
                <!--content-->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                                <table id="tbl-slider" class="table mb-0" >
                                    <thead>
                                        <tr>

                                            <th>No</th>
                                            <th>slider</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                    
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <ul class="pagination justify-content-center pagination-sm" id="pagination-slider" name="pagination-slider">
                </ul>
            </div>
        </div>
    </div>
</div>
<?php get_view('menu');?>
<div class="modal fade" id="mymodal">
    <div id="modalsize" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="modalheader">Judul</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-slider" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Informasi Slider Halaman Utama</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label" for="title">Teks Slider</label>
                                        <input required type="text" id="text" name="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="title">Sub Teks Slider</label>
                                        <input required type="text" id="subtext" name="subtext" class="form-control" placeholder="Ketik Nama slider">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Gambar Slider</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label" for="category">Gambar </label>
                                        <div class="custom-file" id="fileupload">
                                            <input type="file" id="gambarslider" name="gambarslider" class="dropify" data-default-file="">
                                            <input type="hidden" name="gambarlama" id="gambarlama"/>
                                        </div>
                                    </div>
                                <div>
                            </div>
                        </div>
                    </div>
                <input type="hidden" name="hidden-id" id="hidden-id"/> 
                </form> 
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button type="submit" id="submit-slider" class="btn btn-success"></button>
        </div>
    </div>
</div>
<?php get_view('footer');?>