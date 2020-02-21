<?php get_view('header');?>
<div class="mdk-header-layout__content">
    <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
        <div class="mdk-drawer-layout__content page ">
            <div class="container-fluid page__container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=site_url('profile');?>">Profile</a></li>
                    <li class="breadcrumb-item active">Daftar Tugas</li>
                </ol>

                <div class="d-flex flex-column flex-sm-row flex-wrap mb-headings align-items-start align-items-sm-center">
                    <div class="flex mb-2 mb-sm-0">
                        <h1 class="h2">Daftar Tugas</h1>
                    </div>
                </div>

                <div class="card card-body border-left-3 border-left-primary navbar-shadow mb-4">
                    <form action="#">
                        <div class="d-flex flex-wrap2 align-items-center mb-headings">
                            <div class="flex search-form ml-3 search-form--light">
                                <input type="text" class="form-control" placeholder="Cari Tugas" id="search" name="search">
                                <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
                            </div>
                        </div>

                        <div id="count-tugas" class="d-flex flex-column flex-sm-row align-items-sm-center" style="white-space: nowrap;">  
                        </div>
                    </form>
                </div>

                <!--alert-->
                <div id='alert-tugas'>
                </div>
                 
                <!--content-->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                                <table id="tbl-tugas" class="table mb-0" >
                                    <thead>
                                        <tr>
                                            <th>Matakuliah</th>
                                            <th>Nama/Judul</th>
                                            <th>Pembuat</th>
                                            <th>Waktu Berakhir</th>
                                            <th>Kerjakan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                    <?php foreach ($tugas as $each):?>
                                    <tr>
                                       <td width="30%"><?=$each->nama_matakuliah;?></td>
                                       <td width="20%"><?=$each->nama_tugas;?></td>
                                       <td width="20%"><?=$each->dibuat_oleh;?></td>
                                       <td width="20%"><?=$each->waktu_berakhir;?></td>
                                       <td width="15%" class="td-actions text-center">
                                           <a href="<?=site_url('mahasiswa/tugas/jawab/')?><?=$each->id_tugas;?>" class="link-edit btn btn-primary btn-sm"><i class="material-icons">play_arrow</i></a>
                                           <div class="dropdown-menu">
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <ul class="pagination justify-content-center pagination-sm" id="pagination-tugas" name="pagination-tugas">
                </ul>
            </div>
        </div>
    </div>
</div>
<?php get_view('footer');?>