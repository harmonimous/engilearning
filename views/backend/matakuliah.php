<?php get_view('header');?>
<div class="mdk-header-layout__content">
    <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
        <div class="mdk-drawer-layout__content page ">
            <div class="container-fluid page__container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="instructor-dashboard.html">Dashboard</a></li>
                    <li class="breadcrumb-item active"><?=header_title();?></li>
                </ol>

                <div class="d-flex flex-column flex-sm-row flex-wrap mb-headings align-items-start align-items-sm-center">
                    <div class="flex mb-2 mb-sm-0">
                        <h1 class="h2"><?=header_title();?></h1>
                    </div>
                    <p><a href="#add" class="btn btn-success">Tambah Matakuliah <i class="material-icons">add</i></a></p>   
                </div>

                <div class="card card-body border-left-3 border-left-primary navbar-shadow mb-4">
                    
                        <div class="d-flex flex-wrap2 align-items-center mb-headings">
                            <div class="flex search-form ml-3 search-form--light">
                                <input type="text" class="form-control" placeholder="Cari Matakuliah" id="search">
                                <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
                            </div>
                        </div>

                        <div id="count-matakuliah" class="d-flex flex-column flex-sm-row align-items-sm-center" style="white-space: nowrap;">   
                        </div>
                </div>
                <!--alert-->
                <div id='alert-matakuliah'>
                </div>
                <!--card-->
                <div class="row" id="matakuliah-card" name="matakuliah-card">
                </div>
                <!-- Pagination -->
                <ul class="pagination justify-content-center pagination-sm" id="pagination-matakuliah" name="pagination-matakuliah">
                    
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
                <form id="form-matakuliah" action="" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Informasi Dasar</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label" for="title">Kode Matakuliah</label>
                                    <input type="text" id="kode-matakuliah" name="kode-matakuliah" class="form-control" placeholder="Ketik Kode Matakuliah">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="title">Nama Matakuliah</label>
                                    <input type="text" id="nama-matakuliah" name="nama-matakuliah" class="form-control" placeholder="Ketik nama Mata kuliah">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Dosen Pengampu</label>
                                    <input class="form-control" type="text" list="listdosen" id="dosen-pengampu" name="dosen-pengampu" placeholder="Ketik nama Dosen" required>
                                        <datalist id="listdosen">
                                        <?php foreach($dosen as $each): ?>
                                        <option value="<?=$each->nid;?>"><?=$each->nama_dosen;?></option>
                                        <?php endforeach;?>
                                        </datalist>
                                </div>

                                <div class="form-group mb-0">
                                    <label class="form-label">Deskripsi</label>
                                    <div id="editorarea">
                                    </div>
                                </div>

                                <input type="hidden" name="hidden-id" id="hidden-id"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Detail Matakuliah</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label" for="category">Kategori</label>
                                        <select id="kategori-matakuliah" name="kategori-matakuliah" class="custom-select form-control">
                                            <option value="">Pilih</option>
                                            <?php foreach($kategori as $each): ?>
                                            <option value="<?=$each->id_kategori;?>"><?=$each->kategori;?></option>
                                            <?php endforeach; ?>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="semester">semester</label>
                                    <?=dropdown_semester();?>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="category">Gambar Matakuliah</label>
                                    <div class="custom-file" id="fileupload">
                                        <input type="file" id="gambar" name="gambar" class="dropify" data-default-file="">
                                        <input type="hidden" name="filelama" id="filelama"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                </form>
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <button type="submit" id="submit-matakuliah" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_view('footer');?>
