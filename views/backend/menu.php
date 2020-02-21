<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content ">
        <div class="sidebar sidebar-left sidebar-dark bg-dark o-hidden" data-perfect-scrollbar>
            <div class="sidebar-p-y">
                <?php
                $_this =& get_instance();
                if($this->session->userdata('hak_akses')=='admin'){;?>
                <div class="sidebar-heading">Admin</div>
                <ul class="sidebar-menu">
                    <li class="sidebar-menu-item <?=is_active_page_print('dashboard','active');?>">
                        <a class="sidebar-menu-button" href="<?=set_url('dashboard');?>">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">home</i> Dashboard
                        </a>
                    </li>
                    <!--<li class="sidebar-menu-item <?=is_active_page_print('slider','active');?>">
                        <a class="sidebar-menu-button" href="<?=set_url('slider');?>">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">web</i> Slider Home
                        </a>
                    </li>-->
                    <li class="sidebar-menu-item <?=is_active_page_print('dosen','active');?><?=is_active_page_print('mahasiswa','active');?><?=is_active_page_print('kelas','active');?><?=is_active_page_print('matakuliah','active');?><?=is_active_page_print('kategori','active');?>">
                        <a class="sidebar-menu-button sidebar-js-collapse" data-toggle="collapse" href="#account_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">folder_shared</i>
                            Pengelolaan Data
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse" id="account_menu">
                        <li class="sidebar-menu-item <?=is_active_page_print('dosen','active');?>">
                            <a class="sidebar-menu-button" href="<?=set_url('dosen');?>">
                                <span class="sidebar-menu-text">Dosen</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item <?=is_active_page_print('mahasiswa','active');?>">
                            <a class="sidebar-menu-button" href="<?=set_url('mahasiswa');?>">
                                <span class="sidebar-menu-text">Mahasiswa</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item <?=is_active_page_print('kategori','active');?>">
                            <a class="sidebar-menu-button" href="<?=set_url('kategori');?>">
                                <span class="sidebar-menu-text">Kategori</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item <?=is_active_page_print('kelas','active');?>">
                            <a class="sidebar-menu-button" href="<?=set_url('kelas');?>">
                                <span class="sidebar-menu-text">Kelas</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item <?=is_active_page_print('matakuliah','active');?>">
                            <a class="sidebar-menu-button" href="<?=set_url('matakuliah');?>">
                                <span class="sidebar-menu-text">Matakuliah</span>
                            </a>
                        </li>
                        </ul>
                    </li>
                </ul>
                <?php }?>
                <div class="sidebar-heading">Dosen</div>
                <ul class="sidebar-menu sm-active-button-bg">
                    <li class="sidebar-menu-item <?=is_active_page_print('materi','active');?>">
                        <a class="sidebar-menu-button" href="<?=set_url('materi');?>">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">file_copy</i> Kelola Materi
                        </a>
                    </li>
                    <li class="sidebar-menu-item <?=is_active_page_print('tugas','active');?>">
                        <a class="sidebar-menu-button" href="<?=set_url('tugas');?>">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">help</i> Tugas
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="<?=set_url('profile');?>">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person</i> Profile
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="<?=set_url('logout');?>">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">lock_open</i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>