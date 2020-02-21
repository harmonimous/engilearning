<?=get_view( 'header' );?>
<div class="mdk-header-layout__content">
    <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
        <div class="mdk-drawer-layout__content page ">
            <div class="container-fluid page__container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=site_url('profile');?>">Profile</a></li>
                    <li class="breadcrumb-item active">Tugas</li>
                </ol>
                <div class="media flex-wrap align-items-center mb-headings">
                    <div class="media-body mb-3 mb-sm-0">
                        <h1 class="h2 mb-0">Tugas Matakuliah : <?=$tugas->nama_matakuliah;?></h1>
                        <span class="text-muted">Dosen</span> <a href="<?=site_url('team');?>" target="_blank"><?=$tugas->nama_dosen;?></a>
                    </div>
                </div>

                <div class="card">
                    <ul class="nav nav-tabs nav-tabs-card">
                        <li class="nav-item">
                            <a class="nav-link active" href="#first" data-toggle="tab">Soal</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="first">
                            <ul class="list-group mb-0 list-group-fit">
                                <li class="list-group-item">
                                <form id="form-jawaban-tugas" action="jawab" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p><strong>Nama Tugas :</strong> <?=$tugas->nama_tugas;?></p>                               
                                            <small class="text-muted">Soal :</small>
                                            <p><?=$tugas->deskripsi_tugas;?></p><br>
                                            <small>File Tugas : &nbsp; <b><a id="download" href="<?=site_url('uploaded/tugas/').$tugas->file_tugas?>" download>Unduh File Tugas</a></b></small>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="customRange2">Unggah Jawaban Kamu :</label>
                                            <div class="form-group">
                                                <input type="file" id="filejawaban" name="filejawaban" class="dropify" data-default-file="">
                                            </div>
                                            <button type="submit" id="submit-jawaban" class="btn btn-success float-left">Unggah Jawaban <i class="material-icons btn__icon--right">cloud_upload</i></button>
                                        </div>
                                    </div>
                                </form>
                                </li>
                                <li class="list-group-item">
                                    <p><b>Untuk Kelas : </b><?=$tugas->nama_kelas;?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="mdk-drawer js-mdk-drawer" data-align="end">
            <div class="mdk-drawer__content ">
                <div class="sidebar sidebar-right sidebar-light bg-white o-hidden" data-perfect-scrollbar>
                    <div class="sidebar-p-y">
                        <div class="sidebar-heading">Waktu tersisa tinggal :</div>
                        <div id="timer" class="countdown sidebar-p-x" data-value="<?=$waktu;?>" data-unit="second"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?=get_view( 'footer' );?>