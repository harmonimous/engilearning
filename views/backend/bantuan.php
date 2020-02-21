<?php get_view('header');?>
        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content d-flex flex-column">

            <div class="page__header">
            </div>

            <div class="page ">

                <div class="container page__container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=set_url('dashboard')?>">dashboard</a></li>
                        <li class="breadcrumb-item active">Bantuan</li>
                    </ol>
                    <div class="media mb-headings align-items-center">
                        <div class="media-body">
                            <h1 class="h2">Halaman Bantuan</h1>
                        </div>
                        <div class="media-right">
                            <a href="http://instagram.com/mif.ig" target="_blank" class="btn btn-success">
                                Pertanyaan Lain <i class="material-icons btn__icon--right">help_outline</i>
                            </a>
                        </div>
                    </div>
                    <div class="card-columns">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <div class="flex">
                                    <h4 class="card-title">Introduction</h4>
                                    <div class="card-subtitle">Getting started</div>
                                </div>
                                <i class="material-icons text-muted">info_outline</i>
                            </div>
                            <ul class="list-group list-group-fit">
                                <li class="list-group-item">
                                    <a href="#" class="text-body"><i class="material-icons float-right text-muted">trending_flat</i> <strong>Basic Setup</strong></a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#" class="text-body"><i class="material-icons float-right text-muted">trending_flat</i> <strong>Working with the Dev</strong></a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#" class="text-body"><i class="material-icons float-right text-muted">trending_flat</i> <strong>Your first deploy</strong></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <div class="flex">
                                    <h4 class="card-title">Customization</h4>
                                    <div class="card-subtitle">Documentation</div>
                                </div>
                                <i class="material-icons text-muted">info_outline</i>
                            </div>
                            <ul class="list-group list-group-fit">
                                <li class="list-group-item">
                                    <a href="#" class="text-body"><i class="material-icons float-right text-muted">trending_flat</i> <strong>Styling with SASS</strong></a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#" class="text-body"><i class="material-icons float-right text-muted">trending_flat</i> <strong>Editing the Pages</strong></a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#" class="text-body"><i class="material-icons float-right text-muted">trending_flat</i> <strong>Saving for later</strong></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <div class="flex">
                                    <h4 class="card-title">API</h4>
                                    <div class="card-subtitle">Documentation</div>
                                </div>
                                <i class="material-icons text-muted">info_outline</i>
                            </div>
                            <ul class="list-group list-group-fit">
                                <li class="list-group-item">
                                    <a href="#" class="text-body"><i class="material-icons float-right text-muted">trending_flat</i> <strong>Course API Docs</strong></a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#" class="text-body"><i class="material-icons float-right text-muted">trending_flat</i> <strong>Student API Docs</strong></a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#" class="text-body"><i class="material-icons float-right text-muted">trending_flat</i> <strong>Instructor API Docs</strong></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- // END Header Layout Content -->
<?php get_view('menu');?>
<?php get_view('footer');?>