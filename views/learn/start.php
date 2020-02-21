<?=get_view( 'header' );?>
<div class="mdk-header-layout__content">

    <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
        <div class="mdk-drawer-layout__content page ">
            <div class="container-fluid page__container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="student-dashboard.html">Home</a></li>
                    <li class="breadcrumb-item active">Materi</li>
                </ol>

                    <div class="card border-left-3 border-left-primary">
                        <div class="card-body" style="height: auto;">
                            <form id="show-materi" name="show-materi" action="post">
                                <fieldset id="data-with-jquery" >
                                </fieldset>
                            </form>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
<?=get_view( 'footer' );?>