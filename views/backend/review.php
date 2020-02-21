<?php get_view('header');?>
<div class="mdk-header-layout__content">
    <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
        <div class="mdk-drawer-layout__content page ">

            <div class="container-fluid page__container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="instructor-dashboard.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="instructor-quizzes.html">Quiz Manager</a></li>
                    <li class="breadcrumb-item active">Quiz Review</li>
                </ol>

                <div class="media flex-wrap align-items-center mb-headings">
                    <div class="media-body mb-3 mb-sm-0">
                        <h1 class="h2 mb-0">Jawaban <?=$tugas->nama_tugas;?> : <?=$tugas->nama_matakuliah;?></h1>
                        <span class="text-muted">Dosen</span> <a href="instructor-profile.html"><?=$tugas->dibuat_oleh;?></a>
                    </div>
                </div>

                <div class="card card-body border-left-3 border-left-primary navbar-shadow mb-4">
                    <form action="#">
                        <div class="d-flex flex-wrap2 align-items-center mb-headings">
                            <div class="flex search-form ml-3 search-form--light">
                                <input type="text" class="form-control" placeholder="Cari berdasarkan nama mahasiswa" id="search" name="search">
                                <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
                            </div>
                        </div>

                        <div id="count-jawaban" class="d-flex flex-column flex-sm-row align-items-sm-center" style="white-space: nowrap;">  
                        </div>
                    </form>
                </div>

                <!--alert-->
                <div id='alert-jawaban'>
                </div>
                 
                <!--content-->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                                <table id="tbl-jawaban" class="table mb-0" >
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="20%">Tanggal </th>
                                            <th width="50%">Nama Mahasiswa</th>
                                            <th width="10%">Nilai</th>
                                            <th width="15%">Aksi</th>
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
                <ul class="pagination justify-content-center pagination-sm" id="pagination-jawaban" name="pagination-jawaban">
                    
                </ul>

            </div>
        </div>
    </div>
</div>
<?php get_view('menu');?>
<div class="modal fade" id="mymodal">
    <div id="modalsize" class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="modalheader">Judul</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <ul class="nav nav-tabs nav-tabs-card">
                        <li class="nav-item">
                            <a class="nav-link active" href="#first" data-toggle="tab">Review</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="first">
                            <ul class="list-group mb-0 list-group-fit">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>
                                                <strong >Nama : </strong><strong id="nama-mahasiswa">Nama</strong><br>
                                                <strong >NIM :  </strong><strong id="nim">NIM</strong><br>
                                                <small class="text" id="waktu-menjawab"></small>
                                            </p>
                                                <label class="form-label">Jawaban : </label>
                                                <small><a id="download" href="" download>File Jawaban</a></small>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form id="form-nilai" action="" enctype="multipart/form-data" class="form-horizontal">
                                                <div class="form-group d-flex flex-column">
                                                    <label class="form-label" for="customRange2">Nilai</label>
                                                    <input type="text" data-toggle="touch-spin" class="form-control" min="0" max="100" id="nilai-tugas" name="nilai-tugas" placeholder="input nilai" required autofocus>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="2" id="komentar" placeholder="Ketik Komentar"></textarea>
                                                </div>
                                                <input type="hidden" name="hidden-id" id="hidden-id"/>
                                            </form>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button id="submit-nilai" class="btn btn-success">Simpan Nilai<i class="material-icons btn__icon--right">check</i></button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_view('footer');?>