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
                                <input type="text" class="form-control" placeholder="Cari Mahasiswa" id="search">
                                <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
                            </div>
                        </div>

                        <div id="count-mahasiswa" class="d-flex flex-column flex-sm-row align-items-sm-center" style="white-space: nowrap;">  
                        </div>
                    </form>
                </div>

                <!--alert-->
                <div id='alert-mahasiswa'>
                </div>
                 
                <!--content-->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                                <table id="tbl-mahasiswa" class="table mb-0" >
                                    <thead>
                                        <tr>

                                            <th>
                                                No
                                            </th>

                                            <th>Nama Mahasiswa</th>


                                            <th>Kelas</th>
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
                <ul class="pagination justify-content-center pagination-sm" id="pagination-mahasiswa" name="pagination-mahasiswa">
                    
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
                <div class="card">
                    <ul class="nav nav-tabs nav-tabs-card">
                        <li class="nav-item">
                            <a class="nav-link active" href="#first" data-toggle="tab">Akun Mahasiswa (Default)</a>
                        </li>
                    </ul>
                    <div class="tab-content card-body">
                        <div class="tab-pane active" id="first">
                            <form id="form-mahasiswa" action="" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label for="nik" class="col-sm-3 col-form-label form-label">Nomor Induk Mahasiswa</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input id="nim"  name="nim" type="text" class="form-control" placeholder="Ketik NIM">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label form-label">Nama Lengkap</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input id="nama-mahasiswa" name="nama-mahasiswa" type="text" class="form-control" placeholder="Ketik Nama Mahasiswa">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label form-label">Email</label>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="material-icons md-18 text-muted">mail</i>
                                                </div>
                                            </div>
                                            <input type="text" id="email" name="email" class="form-control" placeholder="example@ummi.ac.id">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-3 col-form-label form-label">Password</label>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="material-icons md-18 text-muted">lock</i>
                                                </div>
                                            </div>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter new password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kelas" class="col-sm-3 col-form-label form-label">Kelas</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select id="kelas" name="kelas" class="custom-select form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach($kelas as $each): ?>
                                                    <option value="<?=$each->id_kelas;?>"><?=$each->nama_kelas;?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="hidden-id" id="hidden-id"/>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="text-center ">
                        <div class="media-left">
                            <a href="#" id="submit-mahasiswa" name="submit-mahasiswa" class="btn btn-success">Simpan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_view('footer');?>