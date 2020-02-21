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
                                <input type="text" class="form-control" placeholder="Cari Kelas" id="search" name="search">
                                <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
                            </div>
                        </div>

                        <div id="count-kelas" class="d-flex flex-column flex-sm-row align-items-sm-center" style="white-space: nowrap;">  
                        </div>
                    </form>
                </div>

                <!--alert-->
                <div id='alert-kelas'>
                </div>
                 
                <!--content-->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                                <table id="tbl-kelas" class="table mb-0" >
                                    <thead>
                                        <tr>

                                            <th>No</th>
                                            <th>Nama Kelas</th>
                                            <th>Tahun Angkatan</th>
                                            <th>Semester</th>
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
                <ul class="pagination justify-content-center pagination-sm" id="pagination-kelas" name="pagination-kelas">
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
                <form id="form-kelas" action="" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Informasi kelas</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label" for="title">Nama Kelas</label>
                                    <input required maxlength="7" type="text" id="nama-kelas" name="nama-kelas" class="form-control" placeholder="Ketik Nama Kelas">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="category">Tahun Angkatan</label>
                                    <select required id="tahun-angkatan" name="tahun-angkatan" class="custom-select form-control">
                                        <option value="">Pilih</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="category">Semester</label>
                                    <select required id="semester" name="semester" class="custom-select form-control">
                                        <option value="">Pilih</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                    </select>
                                </div>
                                <input type="hidden" name="hidden-id" id="hidden-id"/>
                            </div>
                        </div>
                    </div>
                </div> 
                </form>
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <button type="submit" id="submit-kelas" class="btn btn-success"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_view('footer');?>