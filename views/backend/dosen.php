<?php get_view('header');?>
<div class="mdk-header-layout__content">
    <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
        <div class="mdk-drawer-layout__content page ">
            <div class="container-fluid page__container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=set_url('dashboard');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manage Dosen</li>
                </ol>

                <div class="d-flex flex-column flex-sm-row flex-wrap mb-headings align-items-start align-items-sm-center">
                    <div class="flex mb-2 mb-sm-0">
                        <h1 class="h2"><?=header_title();?></h1>
                    </div>
                    <p><a href="#add" class="btn btn-success">Tambah <i class="material-icons">add</i></a></p>   
                </div>

                <div class="card card-body border-left-3 border-left-primary navbar-shadow mb-4">
                    
                        <div class="d-flex flex-wrap2 align-items-center mb-headings">
                            <div class="dropdown">
                                <a href="#" id="label-filter-dosen" data-toggle="dropdown" class="btn btn-white"><i class="material-icons mr-sm-2">tune</i> <span class="d-none d-sm-block">Filter</span></a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-item d-flex flex-column">
                                        <form action="#">
                                            <div class="form-group ">
                                                <label for="custom-select" class="form-label">Akses</label><br>
                                                <select id="filterby-hak" name="filterby-hak" class="form-control custom-select" style="width: 200px;" onchange="location=this.value;">
                                                    <option selected value="dosen">Semua</option>
                                                    <option value="dosen#get?hak=admin&hal=1">Admin</option>
                                                    <option value="dosen#get?hak=dosen&hal=1">Dosen</option>
                                                </select>
                                            </div>
                                        </form>
                                        <a href="dosen">Clear Filter</a>
                                    </div>
                                </div>
                            </div>
                            <div class="flex search-form ml-3 search-form--light">
                                <input type="text" class="form-control" placeholder="Cari Dosen" id="search">
                                <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
                            </div>
                        </div>

                        <div id="count-dosen" class="d-flex flex-column flex-sm-row align-items-sm-center" style="white-space: nowrap;">  
                        </div>
                </div>

                <!--alert-->
                <div id='alert-dosen'>
                </div>
                 
                <!--content-->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                                <table id="tbl-dosen" class="table mb-0">
                                    <thead>
                                        <tr>

                                            <th style="width: 18px;">No</th>
                                            <th>Dosen</th>
                                            <th style="width: 80px;">Akses</th>
                                            <th style="width: 60px;">NIDN</th>
                                            <th style="width: 24px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="staff">
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <ul id="pagination-dosen" name="pagination-dosen" class="pagination justify-content-center pagination-sm">
                    
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
                    <form id="form-dosen" action="" enctype="multipart/form-data" class="form-horizontal">
                    <ul class="nav nav-tabs nav-tabs-card">
                        <li class="nav-item">
                            <a class="nav-link active" href="#first" data-toggle="tab">Data Dosen (Default)</a>
                        </li>
                    </ul>
                    <div class="tab-content card-body">
                        <div class="tab-pane active" id="first">
                            <div class="form-group row">
                                <label for="nid" class="col-sm-3 col-form-label form-label">NIDN</label>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input id="nid"  name="nid" type="text" class="form-control" placeholder="NID">
                                        </div>
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
                                <label for="name" class="col-sm-3 col-form-label form-label">Nama Lengkap</label>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input id="nama-dosen" name="nama-dosen" type="text" class="form-control" placeholder="Ketik Nama Dosen">
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
                                <label for="handphone" class="col-sm-3 col-form-label form-label">Contact Person</label>
                                <div class="col-sm-6 col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="material-icons md-18 text-muted">phone</i>
                                            </div>
                                        </div>
                                        <input type="number" id="handphone" name="handphone" class="form-control" placeholder="Nomor Handphone">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hak-akses" class="col-sm-3 col-form-label form-label">Hak Akses</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="hak-akses" name="hak-akses" class="custom-control custom-select form-control">
                                        <option value="" selected="">Pilih Hak Akses</option>
                                        <option value="dosen">Dosen</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="hidden-id" id="hidden-id"/>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-md-12 text-center" style="margin-bottom: 10px">
                    <button type="submit" id="submit-dosen" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_view('footer');?>