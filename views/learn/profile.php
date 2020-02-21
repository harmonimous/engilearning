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
                    <a href="<?=site_url('mahasiswa/profile/edit');?>"><img src="<?=base_url('uploaded/images/').get_user_info('picture')?>" alt="" class="rounded-circle" width="100" style="max-width:100px;"></a>
                    <h1 class="h2 mb-0 mt-1"><?=get_user_info('nama_user')?></h1>
                    <p class="lead text-muted mb-0"><?=get_user_info('hak_akses')?></p><br>
                    <p><b>Level : <?=$detail->level?></b></p>
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?=$progress;?>%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="1000"><?=$detail->point_exp.' XP/ '.$detail->max_exp.' XP';?></div>
                    </div>
                    <hr>
                </div>


                <div class="card">
                  <ul class="nav nav-tabs nav-tabs-card">
                    <li class="nav-item text-center">
                      <a class="nav-link active" href="#one" data-toggle="tab">Quest/Tugas</a>
                    </li>
                  </ul>
                  <div class="card-body tab-content">
                    <div class="tab-pane active" id="one">
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

                            <div class="text-center" style="margin-top: 20px;">
                              <a target="_blank" href="<?=site_url('mahasiswa/tugas');?>" class="btn btn-primary btn-sm text-center">Daftar Tugas</a>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane " id="two">
                      w
                    </div>
                    <div class="tab-pane " id="three">
                      3
                    </div>
                    <div class="tab-pane " id="four">
                      4
                    </div>
                  </div>
                </div>

            </div>

        </div>
    </div>
</div>
<?php get_view('footer');?>