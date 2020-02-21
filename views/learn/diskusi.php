<?=get_view('header');?>
<div class="mdk-header-layout__content">
    <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
        <div class="mdk-drawer-layout__content page ">

            <div class="container-fluid page__container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=site_url('home');?>">Home</a></li>
                    <li class="breadcrumb-item active">Diskusi</li>
                </ol>

                <div class="row">
                    <div class="col-md-8">

                        <h1 class="h2 mb-2">Diskusi Materi : <?=$materi->judul_materi;?></h1>
                        <p class="text-muted d-flex align-items-center mb-4">
                        </p>

                        <div class="card card-body">
                            <h4><?=$count?> Komentar</h4>
                            <?php if ($count == 0):?>
                            <h5 class="text-muted d-flex align-items-center mb-4">Kosong</h5>

                            <?php else : ?>

                            <?php foreach($komentar as $each): ?>
                            <div class="d-flex mb-3 border rounded p-3 bg-light">
                                <a href="#" class="avatar avatar-xs mr-3">
                                    <img src="<?=base_url('uploaded/images/').$each->gambar_mahasiswa;?>" alt="No Image" class="avatar-img rounded-circle">
                                </a>
                                <div class="flex">
                                    <a href="#" class="text-body"><strong><?=$each->nama_mahasiswa;?></strong></a>
                                    <p><?=$each->komentar;?></p>
                                    <div class="d-flex align-items-center">
                                        <small class="text-black-50 mr-2">27 min ago</small>
                                        <a href="#" class="text-black-50"><small>Liked</small></a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>

                            <?php endif;?>

                        </div>
                        <div class="d-flex mb-4">
                            <a href="<?=site_url('profile');?>" class="avatar mr-3">
                                <img src="<?=base_url('uploaded/images/').get_user_info('picture')?>" alt="people" class="avatar-img rounded-circle">
                            </a>
                            <div class="flex">
                                <form id="form-komentar" action="create" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="comment" class="form-label">Komentari</label>
                                        <textarea class="form-control" name="komentar" id="komentar" rows="2" placeholder="Ketik komentar disini"></textarea>
                                    </div>
                                    <button id="submit-komentar" class="btn btn-success">Kirim</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?=get_view('footer');?>