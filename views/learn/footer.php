</div>
<!-- END Header Layout di header.php -->
    <!-- jQuery --> 
    <script src="<?php echo get_directory('assets');?>vendor/jquery.min.js"></script>
    <script src="<?php echo get_directory('assets');?>develover/jquery.validate.js"></script>
    <script src="<?php echo get_directory('assets');?>develover/steps/jquery.steps.js"></script>
    <script src="<?php echo get_directory('assets');?>develover/steps/debounce.js"></script>
    <script src="<?php echo get_directory('assets');?>develover/steps/jquery.steps.fix.js"></script>
    
    <!-- Bootstrap -->
    <script src="<?php echo get_directory('assets');?>vendor/popper.min.js"></script>
    <script src="<?php echo get_directory('assets');?>vendor/bootstrap.min.js"></script>

    <!-- Sweet Alert -->
    <script src="<?php echo get_directory('assets');?>vendor/sweetalert.min.js"></script>
    <script src="<?php echo get_directory('assets');?>js/sweetalert.js"></script>
    
    <!-- Develover Javascript -->  
    <script src="<?php echo get_directory('assets');?>develover/browser.js"></script>
    <script src="<?php echo get_directory('assets');?>develover/jquery.ba-bbq.min.js"></script>
    <script src="<?php echo get_directory('assets');?>develover/dropify/dropify.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="<?php echo get_directory('assets');?>vendor/perfect-scrollbar.min.js"></script>

    <!-- MDK -->
    <script src="<?php echo get_directory('assets');?>vendor/dom-factory.js"></script>
    <script src="<?php echo get_directory('assets');?>vendor/material-design-kit.js"></script>

    <!-- App JS -->
    <script src="<?php echo get_directory('assets');?>js/app.js"></script>

    <!-- Highlight.js -->
    <script src="<?php echo get_directory('assets');?>js/hljs.js"></script>

    <!-- App Settings (safe to remove) -->
    <script src="<?php echo get_directory('assets');?>js/app-settings.js"></script>

    <!-- Vendor JS -->
    <script src="<?php echo get_directory('assets');?>vendor/jquery.nestable.js"></script>
    <script src="<?php echo get_directory('assets');?>vendor/jquery.bootstrap-touchspin.js"></script>
    
    <!-- Required by countdown -->
    <script src="<?php echo get_directory('assets');?>vendor/moment.min.js"></script>

    <!-- Easy Countdown -->
    <script src="<?php echo get_directory('assets');?>vendor/jquery.countdown.min.js"></script>

    <!-- Init -->
    <script src="<?php echo get_directory('assets');?>js/countdown.js"></script>

    <script src="<?php echo site_url();?>const.js"></script>
    <script src="<?php echo get_directory('assets');?>develover/learn.js"></script>

    <?php if ($this->session->flashdata('waktu_habis')): ?>
    <script>
        swal({
            title: "Opss!",
            text: "Waktu Habis!",
            type: "warning"
        }, function() {
            window.location = "<?php echo site_url('mahasiswa/tugas'); ?>";
        });
    </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('sudah_menjawab')): ?>
    <script>
        swal({
            title: "Opss!",
            text: "Kamu sudah pernah mengirim jawabannya!",
            type: "warning"
        }, function() {
            window.location = "<?php echo site_url('mahasiswa/tugas'); ?>";
        });
    </script>
    <?php endif; ?>

</body>
</html>