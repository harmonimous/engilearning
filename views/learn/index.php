<?=get_view('header');?>
<div class="mdk-header-layout__content">
    <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
        <div class="mdk-drawer-layout__content page ">

            <div class="container-fluid page__container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=site_url('matakuliah');?>">Matakuliah</a></li>
                    <li class="breadcrumb-item active">Materi</li>
                </ol>
                <div class="media align-items-center mb-headings">
                    <div class="media-body">
                        <h1 class="h2"></h1>
                    </div>
                </div>
                <div class="clearfix"></div>

                <!--alert-->
                <div id='alert-materi'>
                </div>

                <div class="card-columns" id="materi-card">
                    
                </div>

                <!-- Pagination -->
                <ul class="pagination justify-content-center pagination-sm" id="pagination-materi">
                </ul>
            </div>

        </div>
    </div>
</div>
<?=get_view('footer');?>