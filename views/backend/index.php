<?php get_view('header');?>
<div class="mdk-header-layout__content">
    <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
        <div class="mdk-drawer-layout__content page ">
            <div class="container-fluid page__container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="instructor-dashboard.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>

                <h1 class="h2">Dashboard</h1>

                <h4>Dosen Pengampu Matakuliah :</h4>
                <div class="card-columns">
                    <?php foreach($matakuliah as $each): ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="media align-items-center">
                                <div class="media-left">
                                    <a target="_blank" href="<?=site_url('matakuliah/'.$each->id_matakuliah);?>">
                                        <img src="<?=base_url('uploaded/images/').$each->gambar_matakuliah;?>" alt="Card image cap" width="100" class="rounded">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="card-title mb-0"><a target="_blank" href="<?=site_url('matakuliah/'.$each->id_matakuliah);?>"><?=$each->nama_matakuliah;?></a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>


                <!--<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <div class="flex">
                                    <h4 class="card-title">Komentar</h4>
                                    <p class="card-subtitle">Komentar Terakhir</p>
                                </div>
                                <div class="text-right" style="min-width: 80px;">
                                    <a href="#" class="btn btn-outline-primary btn-sm"><i class="material-icons">keyboard_arrow_left</i></a>
                                    <a href="#" class="btn btn-outline-primary btn-sm"><i class="material-icons">keyboard_arrow_right</i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#" class="avatar avatar-sm">
                                            <img src="<?php echo get_directory('assets');?>images/people/110/guy-9.jpg" alt="Guy" class="avatar-img rounded-circle">
                                        </a>
                                    </div>
                                    <div class="media-body d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <a href="instructor-profile.html" class="text-body"><strong>Laza Bogdan</strong></a>
                                            <small class="ml-auto text-muted">27 min ago</small><br>
                                        </div>
                                        <span class="text-muted">on <a href="instructor-course-edit.html" class="text-black-50" style="text-decoration: underline;">Data Visualization With Chart.js</a></span>
                                        <p class="mt-1 mb-0 text-black-70">How can I load Charts on a page?</p>
                                    </div>
                                </div>
                                <div class="media ml-sm-32pt mt-3 border rounded p-3 bg-light">
                                    <div class="media-left">
                                        <a href="#" class="avatar avatar-sm">
                                            <img src="<?php echo get_directory('assets');?>images/people/110/guy-6.jpg" alt="Guy" class="avatar-img rounded-circle">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="d-flex align-items-center">
                                            <a href="instructor-profile.html" class="text-body"><strong>FrontendMatter</strong></a>
                                            <small class="ml-auto text-muted">just now</small>
                                        </div>
                                        <p class="mt-1 mb-0 text-black-70">Hi Bogdan,<br> Thank you for purchasing our course! <br><br>Please have a look at the charts library documentation <a href="#">here</a> and follow the instructions.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <form action="#" id="message-reply">
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control form-control-appended" required="" placeholder="Quick Reply">
                                        <div class="input-group-append">
                                            <div class="input-group-text pr-2">
                                                <button class="btn btn-flush" type="button"><i class="material-icons">tag_faces</i></button>
                                            </div>
                                            <div class="input-group-text pl-0">
                                                <div class="custom-file custom-file-naked d-flex" style="width: 24px; overflow: hidden;">
                                                    <input type="file" class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" style="color: inherit;" for="customFile">
                                                        <i class="material-icons">attach_file</i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="input-group-text pl-0">
                                                <button class="btn btn-flush" type="button"><i class="material-icons">send</i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>-->
    
            </div>
        </div>
    </div>
</div>
<?php get_view('menu');?>
<?php get_view('footer');?>