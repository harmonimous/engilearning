<?php get_view('header');?>
<div class="mdk-header-layout__content">

    <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
        <div class="mdk-drawer-layout__content page ">

            <div class="container-fluid page__container p-0">
                <div class="row m-0">
                    <div class="col-lg container-fluid page__container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=set_url('profile');?>">Profil</a></li>
                            <li class="breadcrumb-item active">Edit Profil</li>
                        </ol>
                        <h1 class="h2">Edit Profil Saya</h1>
                        <div class="card">
                            <div class="list-group list-group-fit">
                                <form id="form-profile" action="update" enctype="multipart/form-data">
                                    <div class="list-group-item">
                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                            <div class="form-row">
                                                <label class="col-md-3 col-form-label form-label">NIDN</label>
                                                <div class="col-md-9">
                                                        <input id="nid" type="text" name="nid" value="<?=get_user_info('id_user')?>" class="form-control form-control-prepended" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                            <div class="form-row">
                                                <label class="col-md-3 col-form-label form-label">Nama Lengkap</label>
                                                <div class="col-md-9">
                                                    <input id="nama-dosen" name="nama-dosen" type="text" value="<?=$dosen->nama_dosen;?>" class="form-control form-control-prepended">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div role="group" aria-labelledby="label-about" class="m-0 form-group">
                                            <div class="form-row">
                                                <label class="col-md-3 col-form-label form-label">Ubah Password</label>
                                                <div class="col-md-4">
                                                    <input type="password" id="password" name="password" class="form-control">
                                                    <small id="description-display_realname" class="form-text text-muted">* Lewati jika tidak akan diubah.</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="password" id="ulangipassword" name="ulangipassword" class="form-control">
                                                    <small id="description-display_realname" class="form-text text-muted">Ulangi Password.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                            <div class="form-row">
                                                <label class="col-md-3 col-form-label form-label">Email</label>
                                                <div class="col-md-9">
                                                    <input id="email" type="email" placeholder="Your profile name" name="email" value="<?=$dosen->email;?>" class="form-control form-control-prepended">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                            <div class="form-row">
                                                <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">Nomor Handphone</label>
                                                <div class="col-md-9">
                                                        <input id="handphone" name="handphone" type="text" value="<?=$dosen->handphone;?>" class="form-control form-control-prepended">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div role="group" aria-labelledby="label-avatar" class="m-0 form-group">
                                            <div class="form-row">
                                                <label id="label-avatar" for="avatar" class="col-md-3 col-form-label form-label">Photo Profil</label>
                                                <div class="col-md-9">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <div class="custom-file" id="fileupload">
                                                                <input type="file" id="gambar" name="gambar" class="dropify" data-default-file="<?=base_url('uploaded/images/').$dosen->gambar_dosen;?>">
                                                                <small id="description-display_realname" class="form-text text-muted">Ukuran gambar maksimal 2 MB</small>
                                                                <input value="<?=$dosen->gambar_dosen;?>" type="hidden" name="filelama" id="filelama"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="page-nav" class="col-lg-auto page-nav">
                        <div data-perfect-scrollbar>
                            <div class="page-section pt-lg-32pt">
                                <ul class="nav page-nav__menu">
                                    <li class="nav-item">
                                        <a href="<?=set_url('profile');?>" class="nav-link">Kembali ke Profil</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active">Edit Profil</a>
                                    </li>
                                </ul>
                                <div class="page-nav__content">
                                    <button id="submit-profile" class="btn btn-success">Simpan Perubahan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<?php get_view('menu');?>
<?php get_view('footer');?>