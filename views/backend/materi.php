<?php get_view('header');?>
<div class="mdk-header-layout__content">
    <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
        <div class="mdk-drawer-layout__content page ">

            <div class="container-fluid page__container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=set_url('dashboard');?>">Home</a></li>
                    <li class="breadcrumb-item active"><?=header_title();?></li>
                </ol>

                <div class="media align-items-center mb-headings">
                    <div class="media-body">
                        <h1 class="h2"><?=header_title();?></h1>
                    </div>
                    <div class="media-right d-flex align-items-center">
                        <a href="#add" class="btn btn-success mr-2">Tambah Materi</a>
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-white"><i class="material-icons">tune</i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-item">
                                    <form action="#">
                                        <div class="form-group mb-0">
                                            <label class="form-label" for="custom-select">Berdasarkan Matakuliah</label><br>
                                            <select id="filterby-matakuliah" name="filterby-matakuliah" class="form-control custom-select" style="width: 200px;" onchange="location=this.value;">
                                                <option selected>Semua</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--alert-->
                <div id='alert-materi'>
                </div>

                <!--card-->
                <div class="card-columns" id="materi-card" name="materi-card">
                    
                </div>

                <!-- Pagination -->
                <ul class="pagination justify-content-center pagination-sm" id="pagination-materi" name="pagination-materi">
                    
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
                <form id="form-materi" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Informasi Materi</h4>
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label class="form-label" for="title">Judul Materi</label>
                                        <input type="text" id="judul-materi" name="judul-materi" class="form-control" placeholder="Ketik Judul Materi">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="category">Matakuliah</label>
                                        <select id="matakuliah" name="matakuliah" class="custom-select form-control">
                                            <option value="">Pilih Matakuliah</option>
                                            <?php foreach($matakuliah as $each): ?>
                                            <option value="<?=$each->id_matakuliah;?>"><?=$each->nama_matakuliah;?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group mb-0">
                                        <label class="form-label">Keterangan</label>
                                        <div id="editorarea">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <input type="hidden" name="hidden-id" id="hidden-id"/>
                </form>
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <button type="submit" id="submit-materi" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_view('footer');?>
