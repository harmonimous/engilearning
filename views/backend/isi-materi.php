<?php get_view('header');?>
<div class="mdk-header-layout__content">
    <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
        <div class="mdk-drawer-layout__content page ">

            <div class="container-fluid page__container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="instructor-dashboard.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="instructor-quizzes.html">Quiz Manager</a></li>
                    <li class="breadcrumb-item active"><?=header_title();?></li>
                </ol>
                <h1 class="h2"><?php echo $judul_materi;?></h1>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Isi dari : Materi <?php echo $judul_materi;?></h4>
                    </div>
                    <div class="card-header">
                        <a href="#add" class="btn btn-outline-secondary">Tambah isi <i class="material-icons">add</i></a>
                        <div id="count-isi">
                        </div>
                        <div id="alert-isi">
                        </div>
                    </div>
                    <div class="nestable" id="nestable">
                         <ul class="list-group list-group-fit nestable-list-plain mb-0"></ul>
                    </div>
                </div>
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
                <form id="form-isi" action="" enctype="multipart/form-data">
                    <div class="row" id="Isi">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Informasi Materi</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label" for="title">Sub Judul</label>
                                        <input type="text" id="sub-judul" name="sub-judul" class="form-control" placeholder="Ketik Sub Judul">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="category">Tipe Isi</label>
                                        <select id="tipe-isi" name="tipe-isi" class="custom-select form-control">
                                            <option value="">Pilih Tipe</option>
                                            <option value="pembahasan">Pembahasan</option>
                                            <option value="soal">Soal</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="pembahasan">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Pembahasan</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div id="editorpembahasan"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="category">Lampiran Materi</label>
                                        <div class="custom-file" id="fileupload">
                                            <input type="file" id="filemateri" name="filemateri" class="dropify" data-default-file="">
                                            <input type="hidden" name="filelama" id="filelama"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="soal">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Soal</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label" for="title">Pertanyaan</label>
                                        <input type="text" id="pertanyaan" name="pertanyaan" class="form-control" placeholder="Ketik Pertanyaan">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="category">Tipe Soal</label>
                                        <select id="jenis-soal" name="jenis-soal" class="custom-select form-control">
                                            <option value="">Pilih Tipe</option>
                                            <option value="essay">Essay</option>
                                            <option value="pg">Pilihan Ganda</option>
                                        </select>
                                    </div>
                                    <div id="opsi-pg">
                                        <div class="form-group">
                                            <label class="form-label" for="title">pilihan A</label>
                                            <input type="text" id="pilihan1" name="pilihan1" class="form-control" placeholder="Ketik Sub Judul">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="title">pilihan B</label>
                                            <input type="text" id="pilihan2" name="pilihan2" class="form-control" placeholder="Ketik Sub Judul">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="title">pilihan C</label>
                                            <input type="text" id="pilihan3" name="pilihan3" class="form-control" placeholder="Ketik Sub Judul">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="title">pilihan D</label>
                                            <input type="text" id="pilihan4" name="pilihan4" class="form-control" placeholder="Ketik Sub Judul">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="title">Jawaban</label>
                                        <input type="text" id="jawaban" name="jawaban" class="form-control" placeholder="Ketik Jawaban">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <input type="hidden" name="hidden-id" id="hidden-id"/>
                    <input type="hidden" name="hidden-id2" id="hidden-id2"/>                 
                </form>
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <button type="submit" id="submit-isi" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_view('footer');?>