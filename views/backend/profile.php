<?php get_view('header');?>
<div class="mdk-header-layout__content">

    <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
        <div class="mdk-drawer-layout__content page ">

            <div class="container-fluid page__container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=set_url('dashboard');?>">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>

                <div class="text-center">
                    <a href="<?=set_url('profile/edit');?>"><img src="<?=base_url('uploaded/images/').get_user_info('picture')?>" alt="" class="rounded-circle" width="100" style="max-width:100px;"></a>
                    <h1 class="h2 mb-0 mt-1"><?=get_user_info('nama_user')?></h1>
                    <p class="lead text-muted mb-0"><?=get_user_info('hak_akses')?></p><br>
                    <a href="<?=set_url('profile/edit');?>" class="btn btn-primary btn-sm ">Edit Profil</a>
                    <hr>
                </div>
                <h4>Dosen Pengampu Matakuliah :</h4>
                <div class="card-columns">
                    <?php foreach($matakuliah as $each): ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="media align-items-center">
                                <div class="media-left">
                                    <a target="_blank" href="<?=site_url('matakuliah/detail/'.$each->id_matakuliah);?>">
                                        <img src="<?=base_url('uploaded/images/').$each->gambar_matakuliah;?>" alt="Card image cap" width="100" class="rounded">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="card-title mb-0"><a target="_blank" href="<?=site_url('matakuliah/detail/'.$each->id_matakuliah);?>"><?=$each->nama_matakuliah;?></a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>

        </div>
    </div>
</div>
<?php get_view('menu');?>
<?php get_view('footer');?>