<?php get_view('header');?>
    <!-- Breadcrumb -->
    <div class="breadcrumb-area" data-bgimage="<?php echo get_directory('assets');?>images/bg/fun-01.jpg" data-black-overlay="4">
        <div class="container">
            <div class="in-breadcrumb">
                <div class="row">
                    <div class="col">
                        <h3><?=get_user_info('nama_user')?></h3>
                        <!-- breadcrumb-list start -->
                        <ul class="breadcrumb-list">
                            <li class="breadcrumb-item"><a href="home"><?=get_user_info('hak_akses')?></a></li>
                        </ul>
                        <!-- breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Breadcrumb -->
    
    
    
    <!-- Page Conttent -->
    <main class="page-content section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="account-dashboard">
                        <div class="row">
                            <div class="col-md-12 col-lg-2">
                                <!-- Nav tabs -->
                                <ul role="tablist" class="nav flex-column dashboard-list">
                                    <li><a href="#dashboard" data-toggle="tab" class="nav-link active">My Dashboard</a></li>
                                    <?php if($this->session->userdata('mahasiswa')){;?>
                                    <li><a href="#tugas" data-toggle="tab" class="nav-link">Tugas</a></li>
                                    <?php }?>
                                    <li><a href="#account-details" data-toggle="tab" class="nav-link">Details Akun</a></li>
                                    <li><a href="<?=set_url('logout');?>" class="nav-link"><b>logout</b></a></li>
                                </ul>
                            </div>
                            <div class="col-md-12 col-lg-10">
                                <!-- Tab panes -->
                                <div class="tab-content dashboard-content">
                                    <div class="tab-pane active" id="dashboard">
                                        <h3>My Dashboard </h3>
                                        <p>Didalam My Dasboard, anda dapat mengetahui info mengenai tugas yang tersedia,<a href="#">mengubah password, serta mengedit informasi dari akun anda.</a></p>
                                    </div>
                                    <?php if($this->session->userdata('mahasiswa')){;?>
                                    <div class="tab-pane fade" id="tugas">
                                        <h3>Tugas</h3>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Matakuliah</th>
                                                        <th>Tanggal Berakhir</th>
                                                        <th>Status</th>
                                                        <th>Link</th>               
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($tugas as $each):?>
                                                    <tr>
                                                        <td><?=$each->nama_tugas;?></td>
                                                        <td><?=$each->waktu_berakhir;?></td>
                                                        <td>never</td>
                                                        <td><a href="<?=site_url('mahasiswa/tugas/jawab/');?><?=$each->id_tugas;?>" class="view">Kerjakan</a></td>
                                                    </tr>
                                                <?php endforeach;?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center"><a target="_blank" href="<?=site_url('mahasiswa/tugas');?>" class="view">Daftar Tugas</a></div>
                                    </div>
                                    <?php }?>
                                    <div class="tab-pane fade" id="account-details">
                                        <h3>Account details </h3>
                                        <div class="login">
                                            <div class="login-form-container">
                                                <div class="account-login-form">
                                                    <form action="#">
                                                        <p>Already have an account? <a href="#">Log in instead!</a></p>
                                                        <label>Social title</label>
                                                        <div class="input-radio">
                                                            <span class="custom-radio"><input type="radio" value="1" name="id_gender"> Mr.</span>
                                                            <span class="custom-radio"><input type="radio" value="1" name="id_gender"> Mrs.</span>
                                                        </div>
                                                        <div class="account-input-box">
                                                            <label>First Name</label>
                                                            <input type="text" name="first-name">
                                                            <label>Last Name</label>
                                                            <input type="text" name="last-name">
                                                            <label>Email</label>
                                                            <input type="text" name="email-name">
                                                            <label>Password</label>
                                                            <input type="password" name="user-password">
                                                            <label>Birthdate</label>
                                                            <input type="text" placeholder="MM/DD/YYYY" value="" name="birthday">
                                                        </div>
                                                        <div class="example">
                                                          (E.g.: 05/31/1970)
                                                        </div>
                                                        <div class="custom-checkbox">
                                                            <input type="checkbox" value="1" name="optin">
                                                            <label>Receive offers from our partners</label>
                                                        </div>
                                                        <div class="custom-checkbox">
                                                            <input type="checkbox" value="1" name="newsletter">
                                                            <label>Sign up for our newsletter<br><em>You may unsubscribe at any moment. For that purpose, please find our contact info in the legal notice.</em></label>
                                                        </div>
                                                        <div class="button-box">
                                                            <button class="btn default-btn" type="submit">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--// Page Conttent -->
    
    
    
<?php get_view('footer')?>