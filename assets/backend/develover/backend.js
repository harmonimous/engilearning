var editor = '';
var path = window.location.pathname;
var host = window.location.hostname;

console.log(path);
var delay = (function(){
    var timer = 0;
    return function(callback,ms){
        clearTimeout(timer);
        timer = setTimeout(callback,ms);
    };
})();

$(function(){
    $(window).hashchange(function(){
            var hash = $.param.fragment();
            if(hash == 'add'){

                if (path.search('dosen/kelas') > 0){
                    /*Tampilan dan fungsi pada form mymodal*/
                    $('#mymodal .modal-header #modalheader').text('Tambah Kelas');
                    $('#mymodal .modal-body #submit-kelas').text('Simpan');
                    $('#mymodal #form-kelas').attr('action', 'create'); 
                    $('#mymodal .modal-body #hidden-id').val("");
                }

                else if (path.search('dosen/kategori') > 0){

                    /*Tampilan dan fungsi pada form mymodal*/
                    $('#mymodal .modal-header #modalheader').text('Tambah Kategori');
                    $('#mymodal .modal-body #submit-kategori').text('Simpan');
                    $('#mymodal #form-kategori').attr('action', 'create'); 
                    $('#mymodal .modal-body #hidden-id').val("");
                }

                else if (path.search('dosen/matakuliah') > 0){
                    removeeditor();
                    createeditor('editorarea');

                    /*Tampilan dan fungsi pada form mymodal*/
                    $('#mymodal .modal-header #modalheader').text('Tambah Matakuliah');
                    $('#mymodal .modal-body #submit-matakuliah').text('Simpan');
                    $('#mymodal #form-matakuliah').attr('action', 'create'); 
                    $('#mymodal .modal-body #hidden-id').val("");
                }

                else if (path.search('dosen/materi/isi') > 0){
                    $('#soal').hide();
                    $('#pembahasan').hide();
                    $('#opsi-pg').hide();

                    removeeditor();
                    createeditor('editorpembahasan');

                    /*Tampilan dan fungsi pada form mymodal*/
                    $('#mymodal .modal-header #modalheader').text('Tambah Isi Materi');
                    $('#mymodal .modal-body #submit-isi').text('Simpan');
                    $('#mymodal #form-isi').attr('action', 'create'); 
                    $('#mymodal .modal-body #hidden-id').val("");
                } 

                else if (path.search('dosen/materi') > 0){
                    removeeditor();
                    createeditor('editorarea');

                    /*Tampilan dan fungsi pada form mymodal*/
                    $('#mymodal .modal-header #modalheader').text('Tambah Materi');
                    $('#mymodal .modal-body #submit-materi').text('Simpan');
                    $('#mymodal #form-materi').attr('action', 'create'); 
                    $('#mymodal .modal-body #hidden-id').val("");
                }

                else if (path.search('dosen/dosen') > 0){

                    /*Tampilan dan fungsi pada form mymodal*/
                    $('#mymodal .modal-header #modalheader').text('Tambah Dosen');
                    $('#mymodal .modal-body #submit-dosen').text('Simpan');
                    $('#mymodal #form-dosen').attr('action', 'create'); 
                    $('#mymodal .modal-body #hidden-id').val("");
                }

                else if (path.search('dosen/mahasiswa') > 0){       
                    /*Tampilan dan fungsi pada form mymodal*/
                    $('#mymodal .modal-header #modalheader').text('Tambah Mahasiswa');
                    $('#mymodal .modal-body #submit-mahasiswa').text('Simpan');
                    $('#mymodal #form-mahasiswa').attr('action', 'create'); 
                    $('#mymodal .modal-body #hidden-id').val("");
                }

                else if (path.search('dosen/tugas') > 0){
                    removeeditor();
                    createeditor('editorarea');

                    /*Tampilan dan fungsi pada form mymodal*/
                    $('#mymodal .modal-header #modalheader').text('Tambah tugas');
                    $('#mymodal .modal-body #submit-tugas').text('Simpan');
                    $('#mymodal #form-tugas').attr('action', 'create'); 
                    $('#mymodal .modal-body #hidden-id').val("");
                }
                else if (path.search('dosen/slider') > 0){

                    /*Tampilan dan fungsi pada form mymodal*/
                    $('#mymodal .modal-header #modalheader').text('Tambah Gambar Slider');
                    $('#mymodal .modal-body #submit-slider').text('Simpan');
                    $('#mymodal #form-slider').attr('action', 'create'); 
                    $('#mymodal .modal-body #hidden-id').val("");
                }



                /*Fungsi Keseluruhan untuk Hashchange Tambah*/
                $('#mymodal').modal('show');
            }
            else if(hash.search('edit')==0){
                if (path.search('dosen/kelas') > 0){
                    var kelas = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/crud/read',{id:kelas});
                                                                                                                                     
                    $('#mymodal form').find("input[name='nama-kelas']").val(detail.data['nama_kelas']).prop('readonly', true);
                    $('#mymodal form').find("select[name='tahun-angkatan']").val(detail.data['tahun_angkatan']);
                    $('#mymodal form').find("select[name='semester']").val(detail.data['semester']);
                    
                    $('#mymodal #form-kelas #hidden-id').val(kelas);
                    $('#mymodal .modal-header #modalheader').text(detail.data['nama_kelas']);
                    $('#mymodal .modal-body #submit-kelas').text('Update');
                    $('#mymodal #form-kelas').attr('action','update'); 
                }
                else if (path.search('dosen/kategori') > 0){
                    var kategori = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/crud/read',{id:kategori});
                                                                                                                                     
                    $('#mymodal form').find("input[name='kode-kategori']").val(detail.data['kode_kategori']).prop('readonly',true);                         
                    $('#mymodal form').find("input[name='nama-kategori']").val(detail.data['kategori']);
                    
                    $('#mymodal #form-kategori #hidden-id').val(kategori);
                    $('#mymodal .modal-header #modalheader').text(detail.data['kategori']);
                    $('#mymodal .modal-body #submit-kategori').text('Update');
                    $('#mymodal #form-kategori').attr('action','update'); 
                }
                else if (path.search('dosen/matakuliah') > 0){
                    var id_matakuliah = geturlvar()['id'];
                    var detail_matakuliah = getJSON('http://'+host+path+'/crud/read',{id:id_matakuliah});
                                                                                                                                    
                    $('#mymodal form').find("input[name='kode-matakuliah']").val(detail_matakuliah.data['kode_matakuliah']);          
                    $('#mymodal form').find("input[name='nama-matakuliah']").val(detail_matakuliah.data['nama_matakuliah']);
                    $('#mymodal form').find("input[name='dosen-pengampu']").val(detail_matakuliah.data['dosen_pengampu']);
                    
                    removeeditor();
                    createeditor('editorarea',detail_matakuliah.data['deskripsi_matakuliah']);

                    $('#mymodal form').find("select[name='kategori-matakuliah']").val(detail_matakuliah.data['kategori_matakuliah']);
                    $('#mymodal form').find("select[name='semester']").val(detail_matakuliah.data['semester']);
                    
                    $('#mymodal #form-matakuliah #hidden-id').val(id_matakuliah);
                    $('#mymodal #form-matakuliah #filelama').val(detail_matakuliah.data['gambar_matakuliah']);  
                    
                    $('#mymodal form').find("input[name='gambar']").prop('data-default-file',detail_matakuliah.data['gambar_matakuliah']);

                    $('#mymodal .modal-header #modalheader').text(detail_matakuliah.data['nama_matakuliah']);
                    $('#mymodal .modal-footer #submit-matakuliah').text('Update');
                    $('#mymodal #form-matakuliah').attr('action','update'); 
                }
                else if (path.search('dosen/materi/isi') > 0){
                    var id = geturlvar()['id'];
                    var detail_isi = getJSON('http://'+host+path+'/read',{id:id});

                    $('#mymodal form').find("input[name='sub-judul']").val(detail_isi.data['sub_judul']);
                    $('#mymodal form').find("select[name='tipe-isi']").val(detail_isi.data['tipe_isi']);

                    if(detail_isi.data['tipe_isi']=="pembahasan"){  
                        $('#soal').hide();
                        $('#pembahasan').show();
                        removeeditor();
                        createeditor('editorpembahasan',detail_isi.data['isi_pembahasan']);
                        $('#mymodal #form-isi #filelama').val(detail_isi.data['lampiran_materi']); 
                        $('#mymodal .modal-body #hidden-id2').val(detail_isi.data['id_pembahasan']);
                    }
                    else if(detail_isi.data['tipe_isi']=="soal" && detail_isi.data_soal['jenis_soal']=="pg" ){
                        $('#pembahasan').hide();
                        removeeditor();

                        $('#soal').show();
                        $('#opsi-pg').show();

                        $('#mymodal form').find("input[name='pertanyaan']").val(detail_isi.data_soal['pertanyaan']);
                        $('#mymodal form').find("select[name='soal-untuk']").val(detail_isi.data_soal['soal_untuk']);
                        $('#mymodal form').find("select[name='jenis-soal']").val(detail_isi.data_soal['jenis_soal']);


                        $('#mymodal form').find("input[name='pilihan1']").val(detail_isi.data_soal['pilihan_1']);
                        $('#mymodal form').find("input[name='pilihan2']").val(detail_isi.data_soal['pilihan_2']);
                        $('#mymodal form').find("input[name='pilihan3']").val(detail_isi.data_soal['pilihan_3']);
                        $('#mymodal form').find("input[name='pilihan4']").val(detail_isi.data_soal['pilihan_4']);

                        $('#mymodal form').find("input[name='jawaban']").val(detail_isi.data_soal['jawaban']);
                        $('#mymodal .modal-body #hidden-id2').val(detail_isi.data_soal['id_soal']);
                    }
                    else if(detail_isi.data_soal['tipe_isi']=="soal" && detail_isi.data_soal['jenis_soal']=="essay" ){
                        $('#pembahasan').hide();
                        removeeditor();

                        $('#opsi-pg').hide();
                        $('#soal').show();

                        $('#mymodal form').find("input[name='pertanyaan']").val(detail_isi.data_soal['pertanyaan']);
                        $('#mymodal form').find("select[name='soal-untuk']").val(detail_isi.data_soal['soal_untuk']);
                        $('#mymodal form').find("select[name='jenis-soal']").val(detail_isi.data_soal['jenis_soal']);

                        $('#mymodal form').find("input[name='jawaban']").val(detail_isi.data_soal['jawaban']);
                        $('#mymodal .modal-body #hidden-id2').val(detail_isi.data_soal['id_soal']);
                    }

                    $('#mymodal .modal-body #hidden-id').val(id);
                    $('#mymodal .modal-header #modalheader').text('Edit Isi Materi');
                    $('#mymodal .modal-body #submit-isi').text('Update');
                    $('#mymodal #form-isi').attr('action', 'update'); 
                }
                else if (path.search('dosen/materi') > 0){
                    var id_materi = geturlvar()['id'];
                    var detail_materi = getJSON('http://'+host+path+'/crud/read',{id:id_materi});
                                                                                                                                     
                    $('#mymodal form').find("input[name='judul-materi']").val(detail_materi.data['judul_materi']);
                    
                    removeeditor();
                    createeditor('editorarea',detail_materi.data['keterangan']);
                    $('#mymodal form').find("select[name='matakuliah']").val(detail_materi.data['matakuliah_id']);
                    
                    $('#mymodal #form-materi #hidden-id').val(id_materi);
                    $('#mymodal .modal-header #modalheader').text(detail_materi.data['judul_materi']);
                    $('#mymodal .modal-footer #submit-materi').text('Simpan');
                    $('#mymodal #form-materi').attr('action','update'); 
                }
                else if (path.search('dosen/dosen') > 0){
                    var nid = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/crud/read',{nid:nid});

                    $('#mymodal form').find("input[name='nid']").val(detail.data['nid']);                         
                    $('#mymodal form').find("input[name='nama-dosen']").val(detail.data['nama_dosen']);
                    $('#mymodal form').find("input[name='handphone']").val(detail.data['handphone']);
                    $('#mymodal form').find("input[name='email']").val(detail.data['email']);
                    $('#mymodal form').find("input[name='password']").val(detail.data['password']);
                    $('#mymodal form').find("select[name='hak-akses']").val(detail.data['hak_akses']);
                    $('#mymodal #form-dosen #hidden-id').val(nid);

                    $('#mymodal .modal-header #modalheader').text(detail.data['nama_dosen']);
                    $('#mymodal .modal-footer #submit-dosen').text('Simpan');
                    $('#mymodal #form-dosen').attr('action','update'); 
                }
                else if (path.search('dosen/mahasiswa') > 0){
                    var nim = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/crud/read',{nim:nim});

                    $('#mymodal form').find("input[name='nim']").val(detail.data['nim']);                         
                    $('#mymodal form').find("input[name='nama-mahasiswa']").val(detail.data['nama_mahasiswa']);
                    $('#mymodal form').find("input[name='email']").val(detail.data['email']);
                    $('#mymodal form').find("input[name='password']").val(detail.data['password']);
                    $('#mymodal form').find("select[name='kelas']").val(detail.data['kelas_id']);
                    $('#mymodal #form-mahasiswa #hidden-id').val(nim);

                    $('#mymodal .modal-header #modalheader').text(detail.data['nama_mahasiswa']);
                    $('#mymodal .modal-footer #submit-mahasiswa').text('Simpan');
                    $('#mymodal #form-mahasiswa').attr('action','update'); 
                }
                else if (path.search('dosen/tugas') > 0){
                    var id = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/crud/read',{id:id});

                    $('#mymodal form').find("input[name='waktu-berakhir']").val(detail.data['waktu_berakhir']);
                    $('#mymodal form').find("input[name='nama-tugas']").val(detail.data['nama_tugas']);
                    removeeditor();
                    createeditor('editorarea',detail.data['deskripsi_tugas']);

                    $('#mymodal form').find("select[name='matakuliah']").val(detail.data['matakuliah_id']);
                    $('#mymodal form').find("select[name='kelas']").val(detail.data['tugas_kelas']);
                    $('#mymodal #form-tugas #filelama').val(detail.data['file_tugas']); 
    
                    $('#mymodal .modal-body #hidden-id').val(id);
                    $('#mymodal .modal-header #modalheader').text('Edit Tugas');
                    $('#mymodal .modal-body #submit-tugas').text('Update');
                    $('#mymodal #form-tugas').attr('action', 'update'); 
                }
                else if (path.search('dosen/slider') > 0){
                    var id = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/crud/read',{id:id});

                    $('#mymodal form').find("input[name='waktu-berakhir']").val(detail.data['waktu_berakhir']);
                    $('#mymodal form').find("input[name='nama-tugas']").val(detail.data['nama_tugas']);
                    $('#mymodal #form-slider #gambarlama').val(detail.data['gambarslider']); 
    
                    $('#mymodal .modal-body #hidden-id').val(id);
                    $('#mymodal .modal-header #modalheader').text('Edit');
                    $('#mymodal .modal-body #submit-slider').text('Update');
                    $('#mymodal #form-slider').attr('action', 'update'); 
                }
                
                $('#mymodal').modal('show');
            }
            else if (hash.search('get') == 0){
                if (path.search('dosen/kelas') > 0){
                    var hal_aktif, cari = null;
                    var hash = geturlvar();
                    if (hash['cari'] && hash['hal']){
                        var cari = hash['cari'];
                        hal_aktif = hash['hal'];
                    }
                    else if (hash['hal']){
                        hal_aktif=hash['hal'];
                    }
                    read_kelas(hal_aktif,true,cari);
                    $("ul#pagination-kelas li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
                }
                else if (path.search('dosen/matakuliah') > 0){
                    var hal_aktif, cari = null;
                    var hash = geturlvar();

                    if (hash['cari'] && hash['hal']){
                        cari = hash['cari'];
                        hal_aktif = hash['hal'];
                    }
                    else if (hash['hal']){
                        hal_aktif=hash['hal'];
                    }
                    read_matakuliah(hal_aktif,true,cari);
                    $("ul#pagination-matakuliah li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
                }
                else if (path.search('dosen/materi') > 0){
                    var hal_aktif, cari,matakuliah = null;
                    var hash = geturlvar();

                    if (hash['matakuliah'] && hash['hal']){
                        matakuliah = hash['matakuliah'];
                        hal_aktif = hash['hal'];
                    }
                    else if (hash['cari'] && hash['hal']){
                        cari = hash['cari'];
                        hal_aktif = hash['hal'];
                    }
                    else if (hash['hal']){
                        hal_aktif=hash['hal'];
                    }
                    read_materi(hal_aktif,true,matakuliah,cari);
                    $("ul#pagination-materi li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
                }
                else if (path.search('dosen/dosen') > 0){
                    var hal_aktif, cari, hak = null;
                    var hash = geturlvar();

                    if (hash['hak'] && hash['hal']){
                        hak = hash['hak'];
                        hal_aktif = hash['hal'];
                    }
                    else if (hash['cari'] && hash['hal']){
                        cari = hash['cari'];
                        hal_aktif = hash['hal'];
                    }
                    else if (hash['hal']){
                        hal_aktif=hash['hal'];
                    }
                    read_dosen(hal_aktif,true,hak,cari);
                    $("ul#pagination-dosen li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
                }
                else if (path.search('dosen/mahasiswa') > 0){
                    var hal_aktif, cari = null;
                    var hash = geturlvar();

                    if (hash['cari'] && hash['hal']){
                        var cari = hash['cari'];
                        hal_aktif = hash['hal'];
                    }
                    else if (hash['hal']){
                        hal_aktif=hash['hal'];
                    }
                    read_mahasiswa(hal_aktif,true,cari);
                    $("ul#pagination-mahasiswa li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
                }
                else if (path.search('dosen/tugas') > 0){
                    var hal_aktif, cari, kelas, matakuliah = null;
                    var hash = geturlvar();

                    if (hash['cari'] && hash['hal']){
                        var cari = hash['cari'];
                        hal_aktif = hash['hal'];
                    }
                    else if (hash['kelas'] && hash['hal']){
                        var kelas = hash['kelas'];
                        hal_aktif = hash['hal'];
                    }
                    else if (hash['matakuliah'] && hash['hal']){
                        var matakuliah = hash['matakuliah'];
                        hal_aktif = hash['hal'];
                    }
                    else if (hash['hal']){
                        hal_aktif=hash['hal'];
                    }
                    read_tugas(hal_aktif,true,cari,kelas,matakuliah);
                    $("ul#pagination-tugas li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
                }
                else if (path.search('dosen/kategori') > 0){
                    var hal_aktif, cari = null;
                    var hash = geturlvar();
                    if (hash['cari'] && hash['hal']){
                        var cari = hash['cari'];
                        hal_aktif = hash['hal'];
                    }
                    else if (hash['hal']){
                        hal_aktif=hash['hal'];
                    }
                    read_kategori(hal_aktif,true,cari);
                    $("ul#pagination-kategori li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
                }
                else if (path.search('dosen/slider') > 0){
                    var hal_aktif, cari = null;
                    var hash = geturlvar();
                    if (hash['cari'] && hash['hal']){
                        var cari = hash['cari'];
                        hal_aktif = hash['hal'];
                    }
                    else if (hash['hal']){
                        hal_aktif=hash['hal'];
                    }
                    read_slider(hal_aktif,true,cari);
                    $("ul#pagination-slider li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
                }
            }
            else if (hash.search('delete') == 0){
                
                if (path.search('dosen/kelas') > 0){
                    var kelas = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/crud/read',{id:kelas});

                    $('#mymodal .modalsize').removeClass('modal-lg');
                    $('#mymodal form').hide();
                    $('#mymodal .modal-header #modalheader').text('Hapus');
                    $('#mymodal #submit-kelas').text('Hapus'); 
                    $('#mymodal #form-kelas').attr('action','delete'); 
                    $('#mymodal .modal-body').prepend('<p id="notifikasi-hapus"> Apakah Anda yakin untuk menghapus Data Kelas <b>'+detail.data['nama_kelas']+'</b> ??? </p>');
                    $('#mymodal #form-kelas #hidden-id').val(kelas);   
                }
                else if (path.search('dosen/matakuliah') > 0){
                    var id_matakuliah = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/crud/read',{id:id_matakuliah});

                    $('#mymodal .modalsize').removeClass('modal-dialog modal-lg');
                    $('#mymodal form').hide();
                    $('#mymodal .modal-header #modalheader').text('Hapus');
                    $('#mymodal #submit-matakuliah').text('Hapus'); 
                    $('#mymodal #form-matakuliah').attr('action','delete'); 
                    $('#mymodal .modal-body').prepend('<p id="notifikasi-hapus"> Apakah Anda yakin untuk menghapus Data <b>'+detail.data['nama_matakuliah']+'</b> ??? </p>');
                    $('#mymodal #form-matakuliah #hidden-id').val(id_matakuliah);  
                    $('#mymodal #form-matakuliah #filelama').val(detail.data['gambar_matakuliah']);  
                } 
                else if (path.search('dosen/materi/isi') > 0){
                    var id_isi = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/read',{id:id_isi});

                    $('#mymodal .modalsize').removeClass('modal-lg');
                    $('#mymodal form').hide();
                    $('#mymodal .modal-header #modalheader').text('Hapus');
                    $('#mymodal #submit-isi').text('Hapus'); 
                    $('#mymodal #form-isi').attr('action','delete'); 
                    $('#mymodal .modal-body').prepend('<p id="notifikasi-hapus"> Apakah Anda yakin untuk menghapus Data Materi <b>'+detail.data['sub_judul']+'</b> ??? </p>');
                    $('#mymodal #form-isi #hidden-id').val(id_isi);
                    $('#mymodal #form-isi #filelama').val(detail.data['lampiran_materi']);    
                } 
                else if (path.search('dosen/materi') > 0){
                    var id_materi = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/crud/read',{id:id_materi});

                    $('#mymodal .modalsize').removeClass('modal-lg');
                    $('#mymodal form').hide();
                    $('#mymodal .modal-header #modalheader').text('Hapus');
                    $('#mymodal #submit-materi').text('Hapus'); 
                    $('#mymodal #form-materi').attr('action','delete'); 
                    $('#mymodal .modal-body').prepend('<p id="notifikasi-hapus"> Apakah Anda yakin untuk menghapus Data Materi <b>'+detail.data['judul_materi']+'</b> ??? </p>');
                    $('#mymodal #form-materi #hidden-id').val(id_materi);   
                    $('#mymodal #form-materi #filelama').val(detail.data['gambar_materi']);  
                } 
                else if (path.search('dosen/dosen') > 0){
                    var nidurl = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/crud/read',{nid:nidurl});

                    $('#mymodal .modalsize').removeClass('modal-dialog modal-lg');
                    $('#mymodal form').hide();
                    $('#mymodal .modal-header #modalheader').text('Hapus');
                    $('#mymodal #submit-dosen').text('Hapus'); 
                    $('#mymodal #form-dosen').attr('action','delete'); 
                    $('#mymodal .modal-body').prepend('<p id="notifikasi-hapus"> Apakah Anda yakin untuk menghapus Data Dosen<b>'+detail.data['nama_dosen']+'</b> ??? </p>');
                    $('#mymodal #form-dosen #hidden-id').val(nidurl);   
                }
                else if (path.search('dosen/mahasiswa') > 0){
                    var nim = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/crud/read',{nim:nim});

                    $('#mymodal .modalsize').removeClass('modal-lg');
                    $('#mymodal form').hide();
                    $('#mymodal .modal-header #modalheader').text('Hapus');
                    $('#mymodal #submit-mahasiswa').text('Hapus'); 
                    $('#mymodal #form-mahasiswa').attr('action','delete'); 
                    $('#mymodal .modal-body').prepend('<p id="notifikasi-hapus"> Apakah Anda yakin untuk menghapus Data Mahasiswa <b>'+detail.data['nama_mahasiswa']+'</b> ??? </p>');
                    $('#mymodal #form-mahasiswa #hidden-id').val(nim);   
                }
                else if (path.search('dosen/tugas') > 0){
                    var id = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/crud/read',{id:id});

                    $('#mymodal .modalsize').removeClass('modal-lg');
                    $('#mymodal #form-tugas').hide();
                    $('#mymodal .modal-header #modalheader').text('Hapus');
                    $('#mymodal #submit-tugas').text('Hapus');
                    $('#mymodal #form-tugas').attr('action','delete'); 
                    $('#mymodal .modal-body').prepend('<p id="notifikasi-hapus"> Apakah Anda yakin untuk menghapus Tugas <b>'+detail.data['nama_tugas']+'</b> ??? </p>');
                    $('#mymodal #form-tugas #hidden-id').val(id);
                    $('#mymodal #form-tugas #filelama').val(detail.data['file_tugas']);    
                } 
                else if (path.search('dosen/kategori') > 0){
                    var kategori = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/crud/read',{id:kategori});

                    $('#mymodal .modalsize').removeClass('modal-lg');
                    $('#mymodal form').hide();
                    $('#mymodal .modal-header #modalheader').text('Hapus');
                    $('#mymodal #submit-kategori').text('Hapus'); 
                    $('#mymodal #form-kategori').attr('action','delete'); 
                    $('#mymodal .modal-body').prepend('<p id="notifikasi-hapus"> Hapus Data Kategori <b>'+detail.data['kategori']+'</b> ? </p>');
                    $('#mymodal #form-kategori #hidden-id').val(kategori);   
                }
                else if (path.search('dosen/slider') > 0){
                    var id = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/crud/read',{id:id});

                    $('#mymodal .modalsize').removeClass('modal-lg');
                    $('#mymodal #form-slider').hide();
                    $('#mymodal .modal-header #modalheader').text('Hapus');
                    $('#mymodal #submit-slider').text('Hapus');
                    $('#mymodal #form-slider').attr('action','delete'); 
                    $('#mymodal .modal-body').prepend('<p id="notifikasi-hapus"> Apakah Anda yakin untuk menghapus Gambar??? </p>');
                    $('#mymodal #form-slider #hidden-id').val(id);
                    $('#mymodal #form-slider #gambarlama').val(detail.data['gambarslider']);    
                }
                $('#mymodal').modal('show');
            }
            else if (hash.search('review')==0){
                if (path.search('dosen/tugas/review') > 0){
                    var id = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/read',{id:id});

                    $('#nama-mahasiswa').text(detail.data['nama_mahasiswa']);
                    $('#nim').text(detail.data['nim']);
                    $('#waktu-menjawab').text('Diselesaikan pada : '+detail.data['waktu_menjawab']);
                    $('#download').text(detail.data['jawaban']);
                    $('#download').prop("href", 'http://'+host+websitename+'uploaded/jawaban-tugas/'+detail.data['jawaban']);
    
                    $('#mymodal .modal-body #hidden-id').val(id);
                    $('#mymodal .modal-header #modalheader').text('Beri Penilaian');
                    $('#mymodal .modal-body #submit-nilai').text('Simpan Nilai');
                    $('#mymodal #form-nilai').attr('action', 'update'); 
                }

                $('#mymodal').modal('show');
            }
    });

    $(window).trigger('hashchange');

    /* Fungsi Ketika Modal di Hidden */
    $('#mymodal').on('hidden.bs.modal',function(){
        window.history.pushState(null,null,path);
        removeeditor();
        $('#mymodal #notifikasi-hapus').remove();  
        $('#mymodal form').show();
        $('#mymodal form').find("input[list=nama-dosen], input[type=number], input[type=text], input[type=hidden], input[type=password], input[type=email], textarea,select").val("").prop('readonly', false);
        $('#fileshow').html("");
        $('#fileshow').append(
           '<div class="icon-block rounded" id="thumbnail">'+
                '<i class="material-icons text-muted-light md-36">photo</i>'+
            '</div>');
        $('#fileupload').show();
        $('.dropify-clear').click();
    });

//FORM WIZARD
    $('#tipe-isi').change(function() {
        if( $(this).val()=="pembahasan"){
            $('#soal').hide();
            $('#pembahasan').show();
            removeeditor();
            createeditor('editorpembahasan');
        }
        else if( $(this).val()=="soal"){
            $('#pembahasan').hide();
            $('#soal').show();
            removeeditor();
        }
        else{
            $('#soal').hide();
            $('#pembahasan').hide();
            removeeditor();
        }
    });

    $('#jenis-soal').change(function() {
        if( $(this).val()=="essay"){
            $('#opsi-pg').hide();
            $('#jawaban').attr('placeholder',"Ketik Jawaban");
        }
        else if( $(this).val()=="pg"){  
            $('#opsi-pg').show();
            $('#jawaban').attr('placeholder',"Ketik Jawaban, Harap Sesuaikan dengan Pilihan diatas");
        }
        else{
            $('#opsi-pg').hide();
        }
    });

    $('.dropify').dropify({
        messages: {
        default: 'Pilih File',
        replace: 'Ganti',
        remove:  'Hapus',
        error:   'error'
        }
    });

    $('.flatpickr').flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });

    $(document).on('keyup','#search', function(){
        delay(function(){
        var searchkey = $('#search').val();
        window.location.hash = "#get?cari="+searchkey+"&hal=1";
    }, 1000);
  });

//BUTTON CLICK// 

    $(document).on('click','#submit-profile',function(eve){
        eve.preventDefault();
        
        var action = $('#form-profile').attr('action');
        var datatosend = new FormData($("#form-profile")[0]);

        $.ajax('http://'+host+path+'/update',{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status =='success'){
                   swal({
                        title: 'Yeay!',
                        text: 'Profil Berhasil diubah, Silahkan Login Kembali',
                        type: 'success',
                        confirmButtonColor: '#4fa7f3'
                    }, function() {
                        var link ='http://'+host+websitename+'dosen/login';
                        window.location.replace(link);
                    }); 
                }
                else if(data.error=='different'){
                    swal({
                        title: 'Ubah password Gagal!',
                        text: 'Password tidak sesuai',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                }
                else if(data.error=='upload_gagal'){
                    swal({
                        title: 'Upload Gambar Gagal!',
                        text: 'Format file harus png/jpg/jpeg dengan ukuran maksiman 2 MB',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                }
                else{
                    $.each(data.errors, function(key,value) {
                    swal({
                        title: 'Perintah Gagal!',
                        text: 'Form '+key+' :'+value+'',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                        });
                    });
                    $.each(data.errors, function(key, value) {
                    $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });

    read_kelas();
    $(document).on('click','#submit-kelas',function(eve){
        eve.preventDefault();
        
        var action = $('#form-kelas').attr('action');
        var datatosend = new FormData($("#form-kelas")[0]);

        $.ajax('http://'+host+path+'/crud/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status =='success'){
                    swal({
                        title: 'Perintah Berhasil!',
                        text: 'Data Berhasil Di'+action+'!',
                        type: 'success',
                        confirmButtonColor: '#4fa7f3'
                    });
                    $('#mymodal').modal('hide');
                    $('#alert-kelas').html("");
                    read_kelas(null,false); 
                }
                else{
                    $.each(data.errors, function(key,value) {
                    swal({
                        title: 'Perintah Gagal!',
                        text: 'Form '+key+' :'+value+'',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                        });
                    });
                    $.each(data.errors, function(key, value) {
                    $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });

    read_matakuliah();
    $(document).on('click','#submit-matakuliah',function(eve){
        eve.preventDefault();
        
        var action = $('#form-matakuliah').attr('action');

        if(action == 'delete'){
            var datatosend = new FormData($("#form-matakuliah")[0]);
        }
        else{
            var datatosend = new FormData($("#form-matakuliah")[0]);
            datatosend.append("editorvalue", editor.getData());
        }

        $.ajax('http://'+host+path+'/crud/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status =='success'){
                    read_matakuliah(null,false); 
                    swal({
                        title: 'Perintah Berhasil!',
                        text: 'Data Berhasil Di'+action+'!',
                        type: 'success',
                        confirmButtonColor: '#4fa7f3'
                    });
                    $('#mymodal').modal('hide');
                    $('#alert-matakuliah').html("");
                }
                else{
                    $.each(data.errors, function(key,value) {
                    swal({
                        title: 'Perintah Gagal!',
                        text: 'Form '+key+' :'+value+'',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                        });
                    });
                    $.each(data.errors, function(key, value) {
                    $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });

    read_dosen();
    $(document).on('click','#submit-dosen',function(eve){
        eve.preventDefault();
        
        var action = $('#form-dosen').attr('action');
        var datatosend = new FormData($("#form-dosen")[0]);

        $.ajax('http://'+host+path+'/crud/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status =='success'){
                    swal({
                        title: 'Perintah Berhasil!',
                        text: 'Data Berhasil Di'+action+'!',
                        type: 'success',
                        confirmButtonColor: '#4fa7f3'
                    });
                    $('#mymodal').modal('hide');
                    $('#alert-dosen').html("");
                    read_dosen(null,false); 
                }
                else{
                    $.each(data.errors, function(key,value) {
                    swal({
                        title: 'Perintah Gagal!',
                        text: 'Form '+key+' :'+value+'',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                        });
                    });
                    $.each(data.errors, function(key, value) {
                    $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });

    read_mahasiswa();
    $(document).on('click','#submit-mahasiswa',function(eve){
        eve.preventDefault();
        
        var action = $('#form-mahasiswa').attr('action');
        var datatosend = new FormData($("#form-mahasiswa")[0]);

        $.ajax('http://'+host+path+'/crud/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status =='success'){
                    swal({
                        title: 'Perintah Berhasil!',
                        text: 'Data Berhasil Di'+action+'!',
                        type: 'success',
                        confirmButtonColor: '#4fa7f3'
                    });
                    $('#mymodal').modal('hide');
                    $('#alert-mahasiswa').html("");
                    read_mahasiswa(null,false); 
                }
                else{
                    $.each(data.errors, function(key,value) {
                    swal({
                        title: 'Perintah Gagal!',
                        text: 'Form '+key+' :'+value+'',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                        });
                    });
                    $.each(data.errors, function(key, value) {
                    $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });

    read_isi_materi();
    $(document).on('click','#submit-isi',function(eve){
        eve.preventDefault();
        var action = $('#form-isi').attr('action');

        if(action == 'delete'){
            datatosend = new FormData($("#form-isi")[0]);
        }
        else if($('#tipe-isi').val()=="soal"){
            datatosend = new FormData($("#form-isi")[0]);
        }
        else{
            datatosend = new FormData($("#form-isi")[0]);
            datatosend.append("isi-pembahasan", editor.getData());
        }
        $.ajax('http://'+host+path+'/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status =='success'){
                    read_isi_materi (null,false);
                    swal({
                        title: 'Perintah Berhasil!',
                        text: 'Data Berhasil Di'+action+'!',
                        type: 'success',
                        confirmButtonColor: '#4fa7f3'
                    });
                    $('#mymodal').modal('hide');
                    $('#alert-mahasiswa').html("");
                }
                else{
                    $.each(data.errors, function(key,value) {
                    swal({
                        title: 'Perintah Gagal!',
                        text: 'Form '+key+' :'+value+'',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                        });
                    });
                }
            }
        });
    });

    read_materi();
    $(document).on('click','#submit-materi',function(eve){
        eve.preventDefault();
        
        var action = $('#form-materi').attr('action');

        if(action == 'delete'){
            var datatosend = new FormData($("#form-materi")[0]);
        }
        else{
            var datatosend = new FormData($("#form-materi")[0]);
            datatosend.append("keterangan", editor.getData());
        }

        $.ajax('http://'+host+path+'/crud/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status =='success'){
                    read_materi(null,false); 
                    swal({
                        title: 'Perintah Berhasil!',
                        text: 'Data Berhasil Di'+action+'!',
                        type: 'success',
                        confirmButtonColor: '#4fa7f3'
                    });
                    $('#mymodal').modal('hide');
                    $('#alert-materi').html("");
                }
                else{
                    $.each(data.errors, function(key,value) {
                    swal({
                        title: 'Perintah Gagal!',
                        text: 'Form '+key+' :'+value+'',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                        });
                    });
                }
            }
        });
    });
    
    read_tugas();
    $(document).on('click','#submit-tugas',function(eve){
        eve.preventDefault();
        var action = $('#form-tugas').attr('action');

        if(action == 'delete'){
            datatosend = new FormData($("#form-tugas")[0]);
        }
        else{
            datatosend = new FormData($("#form-tugas")[0]);
            datatosend.append("deskripsi", editor.getData());
        }
        $.ajax('http://'+host+path+'/crud/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status =='success'){
                    read_tugas (null,false);
                    swal({
                        title: 'Perintah Berhasil!',
                        text: 'Data Berhasil Di'+action+'!',
                        type: 'success',
                        confirmButtonColor: '#4fa7f3'
                    });
                    $('#mymodal').modal('hide');
                    $('#alert-mahasiswa').html("");
                }
                else{
                    $.each(data.errors, function(key,value) {
                    swal({
                        title: 'Perintah Gagal!',
                        text: 'Form '+key+' :'+value+'',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                        });
                    });
                }
            }
        });
    });

    read_kategori();
    $(document).on('click','#submit-kategori',function(eve){
        eve.preventDefault();
        
        var action = $('#form-kategori').attr('action');
        var datatosend = new FormData($("#form-kategori")[0]);

        $.ajax('http://'+host+path+'/crud/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status =='success'){
                    swal({
                        title: 'Perintah Berhasil!',
                        text: 'Data Berhasil Di'+action+'!',
                        type: 'success',
                        confirmButtonColor: '#4fa7f3'
                    });
                    $('#mymodal').modal('hide');
                    $('#alert-kategori').html("");
                    read_kategori(null,false); 
                }
                else if(data.status=='duplicate'){
                    swal({
                        title: 'Gagal!',
                        text: 'Duplikasi Kode Kategori',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                }
                else{
                    $.each(data.errors, function(key,value) {
                    swal({
                        title: 'Perintah Gagal!',
                        text: 'Form '+key+' :'+value+'',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                        });
                    });
                    $.each(data.errors, function(key, value) {
                    $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });

    read_slider();
    $(document).on('click','#submit-slider',function(eve){
        eve.preventDefault();
        
        var action = $('#form-slider').attr('action');
        var datatosend = new FormData($("#form-slider")[0]);

        $.ajax('http://'+host+path+'/crud/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status =='success'){
                    swal({
                        title: 'Perintah Berhasil!',
                        text: 'Data Berhasil Di'+action+'!',
                        type: 'success',
                        confirmButtonColor: '#4fa7f3'
                    });
                    $('#mymodal').modal('hide');
                    $('#alert-slider').html("");
                    read_slider(null,false); 
                }
                else{
                    $.each(data.errors, function(key,value) {
                    swal({
                        title: 'Perintah Gagal!',
                        text: 'Form '+key+' :'+value+'',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                        });
                    });
                    $.each(data.errors, function(key, value) {
                    $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });

    read_jawaban();
    $(document).on('click','#submit-nilai',function(eve){
        eve.preventDefault();
        
        var action = $('#form-nilai').attr('action');
        var datatosend = new FormData($("#form-nilai")[0]);

        $.ajax('http://'+host+path+'/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status =='success'){
                    swal({
                        title: 'Berhasil!',
                        text: 'Tugas Sudah diberinilai',
                        type: 'success',
                        confirmButtonColor: '#4fa7f3'
                    });
                    $('#mymodal').modal('hide');
                    $('#alert-jawaban').html("");
                    read_jawaban(null,false); 
                }
                else{
                    $.each(data.errors, function(key,value) {
                    swal({
                        title: 'Perintah Gagal!',
                        text: 'Form '+key+' :'+value+'',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                        });
                    });
                    $.each(data.errors, function(key, value) {
                    $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });

    });

});

    
function humanize(str){
  str = str.replace(/-/g, ' ');
  str = str.replace(/_/g, ' ');
  return str.charAt(0).toUpperCase() + str.slice(1);
}

function getJSON(url,data){
    return JSON.parse($.ajax({

        type :'POST',
        url : url,
        data:data,
        dataType: 'json',
        global: false,
        async: false,
        success:function(msg){
        }
        }).responseText);  
}

function geturlvar(){
    var vars=[],hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

    for (var i =0; i <hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash [1];
    }
    return vars
}

function read_kelas(hal_aktif,scrolltop,cari){
    if($('table#tbl-kelas').length > 0){
    $.ajax('http://'+host+path+'/crud/read',{
        dataType:'json',
        type : 'POST',
        data : {hal_aktif:hal_aktif,cari:cari},
        success:function(data){
            var no = 0;
            $('table#tbl-kelas tbody tr').remove();
            $('#count-kelas').html("");
            $('#alert-kelas').html("");
            if (data.total_rows == 0){
                $('#count-kelas').prepend('<small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0"> Jumlah Data Kelas : 0</small>');
                $('#alert-kelas').prepend(
                    '<div class="alert alert-light alert-dismissible border-1 border-left-3 border-left-success" role="alert" id="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                   ' <span aria-hidden="true">&times;</span>'+
                   ' </button>'+
                    '<div class="text-black-70">Opps! Tidak ada data untuk ditampilkan. Silahkan tambahkan data kelas.</div>'+
                    '</div>'
                  );
            }
            else{
                $('#count-kelas').prepend('<small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0"> Jumlah Data kelas : '+data.total_rows+'</small>');
                $.each(data.record,function(index,element){
                    no++;
                    $('table#tbl-kelas').find('tbody').append(
                    '<tr>'+
                    '   <td>'+no+'</td>'+
                    '   <td width="20%">'+element.nama_kelas+'</td>'+
                    '   <td width="20%">'+element.tahun_angkatan+'</td>'+
                    '   <td><small class="text-muted">'+element.semester+'</small></td>'+
                    '    <td width="15%" class="td-actions">'+
                    '        <a href="kelas#edit?id='+element.id_kelas+'" class="link-edit btn btn-info btn-sm"><i class="material-icons">edit</i></a>'+
                    '        <a href="kelas#delete?id='+element.id_kelas+'" class="link-edit btn btn-danger btn-sm"><i class="material-icons">delete_forever</i></a>'+
                    '    </td>'+
                    '</tr>'
                    )
                });
            }
            
        /*-----------------PAGINATION----------------------------------------*/
        var pagination ='';
        var paging = Math.ceil(data.total_rows/data.perpage);

        if ((!hal_aktif) && ($('ul#pagination-kelas li').length == 0)){
                $('ul#pagination-kelas li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li class="page-item active"><a aria-label="1" class="page-link" href="kelas#get?hal='+i+'"><span>'+i+'</span></a></li>';
                }
        }
        else if (hal_aktif && cari){
            $('ul#pagination-kelas li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li class="page-item">'+
                        '<a class="page-link" href="kelas#get?cari='+cari+'&hal='+i+'" aria-label="1">'+
                            '<span>'+i+'</span>'+
                        '</a>'+
                    '</li>';
                }
        }

        $('ul#pagination-kelas').append(pagination);
        $("ul#pagination-kelas li:contains('"+hal_aktif+"')").addClass('active');
        
        if(scrolltop == true ){
            $('body').scrollTop(2);
        }
        }
        });
    }
}

function read_slider(hal_aktif,scrolltop,cari){
    if($('table#tbl-slider').length > 0){
    $.ajax('http://'+host+path+'/crud/read',{
        dataType:'json',
        type : 'POST',
        data : {hal_aktif:hal_aktif,cari:cari},
        success:function(data){
            var no = 0;
            $('table#tbl-slider tbody tr').remove();
            $('#count-slider').html("");
            $('#alert-slider').html("");
            if (data.total_rows == 0){
                $('#count-slider').prepend('<small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0"> Jumlah Gambar : 0</small>');
                $('#alert-slider').prepend(
                    '<div class="alert alert-light alert-dismissible border-1 border-left-3 border-left-success" role="alert" id="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                   ' <span aria-hidden="true">&times;</span>'+
                   ' </button>'+
                    '<div class="text-black-70">Opps! Tidak ada data untuk ditampilkan.</div>'+
                    '</div>'
                  );
            }
            else{
                $('#count-slider').prepend('<small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0"> Jumlah Gambar : '+data.total_rows+'</small>');
                $.each(data.record,function(index,element){
                    no++;
                    $('table#tbl-slider').find('tbody').append(
                    '<tr>'+
                    '   <td>'+no+'</td>'+
                    '   <td width="20%">'+element.teks+'</td>'+
                    '   <td width="20%">'+element.subteks+'</td>'+
                    '    <td width="15%" class="td-actions">'+
                    '        <a href="slider#edit?id='+element.id_slider+'" class="link-edit btn btn-info btn-sm">Edit</a>'+
                    '        <a href="slider#delete?id='+element.id_slider+'" class="link-edit btn btn-danger btn-sm">Hapus</a>'+
                    '    </td>'+
                    '</tr>'
                    )
                });
            }
            
        /*-----------------PAGINATION----------------------------------------*/
        var pagination ='';
        var paging = Math.ceil(data.total_rows/data.perpage);

        if ((!hal_aktif) && ($('ul#pagination-slider li').length == 0)){
                $('ul#pagination-slider li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li class="page-item active"><a aria-label="1" class="page-link" href="slider#get?hal='+i+'"><span>'+i+'</span></a></li>';
                }
        }
        else if (hal_aktif && cari){
            $('ul#pagination-slider li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li class="page-item">'+
                        '<a class="page-link" href="slider#get?cari='+cari+'&hal='+i+'" aria-label="1">'+
                            '<span>'+i+'</span>'+
                        '</a>'+
                    '</li>';
                }
        }

        $('ul#pagination-slider').append(pagination);
        $("ul#pagination-slider li:contains('"+hal_aktif+"')").addClass('active');
        
        if(scrolltop == true ){
            $('body').scrollTop(2);
        }
        }
        });
    }
}

function read_kategori(hal_aktif,scrolltop,cari){
    if($('table#tbl-kategori').length > 0){
    $.ajax('http://'+host+path+'/crud/read',{
        dataType:'json',
        type : 'POST',
        data : {hal_aktif:hal_aktif,cari:cari},
        success:function(data){
            var no = 0;
            $('table#tbl-kategori tbody tr').remove();
            $('#count-kategori').html("");
            $('#alert-kategori').html("");
            if (data.total_rows == 0){
                $('#count-kategori').prepend('<small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0"> Jumlah Kategori : 0</small>');
                $('#alert-kategori').prepend(
                    '<div class="alert alert-light alert-dismissible border-1 border-left-3 border-left-success" role="alert" id="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                   ' <span aria-hidden="true">&times;</span>'+
                   ' </button>'+
                    '<div class="text-black-70">Opps! Tidak ada data untuk ditampilkan.</div>'+
                    '</div>'
                  );
            }
            else{
                $('#count-kategori').prepend('<small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0"> Jumlah Kategori : '+data.total_rows+'</small>');
                $.each(data.record,function(index,element){
                    no++;
                    $('table#tbl-kategori').find('tbody').append(
                    '<tr>'+
                    '   <td width="5%">'+no+'</td>'+
                    '   <td width="15%">'+element.kode_kategori+'</td>'+
                    '   <td width="50%">'+element.kategori+'</td>'+
                    '    <td width="15%" class="td-actions">'+
                    '        <a href="kategori#edit?id='+element.id_kategori+'" class="link-edit btn btn-info btn-sm"><i class="material-icons">edit</i></a>'+
                    '        <a href="kategori#delete?id='+element.id_kategori+'" class="link-edit btn btn-danger btn-sm"><i class="material-icons">delete_forever</i></a>'+
                    '    </td>'+
                    '</tr>'
                    )
                });
            }
            
        /*-----------------PAGINATION----------------------------------------*/
        var pagination ='';
        var paging = Math.ceil(data.total_rows/data.perpage);

        if ((!hal_aktif) && ($('ul#pagination-kategori li').length == 0)){
                $('ul#pagination-kategori li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li class="page-item active"><a aria-label="1" class="page-link" href="kategori#get?hal='+i+'"><span>'+i+'</span></a></li>';
                }
        }
        else if (hal_aktif && cari){
            $('ul#pagination-kategori li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li class="page-item">'+
                        '<a class="page-link" href="kategori#get?cari='+cari+'&hal='+i+'" aria-label="1">'+
                            '<span>'+i+'</span>'+
                        '</a>'+
                    '</li>';
                }
        }

        $('ul#pagination-kategori').append(pagination);
        $("ul#pagination-kategori li:contains('"+hal_aktif+"')").addClass('active');
        
        if(scrolltop == true ){
            $('body').scrollTop(2);
        }
        }
        });
    }
}

function read_matakuliah(hal_aktif,scrolltop,cari){
    $.ajax('http://'+host+path+'/crud/read',{
        dataType:'json',
        type : 'POST',
        data : {hal_aktif:hal_aktif, cari:cari},
        success:function(data){  
            $('#matakuliah-card').html("");
            $('#count-matakuliah').html("");
            $('#alert-matakuliah').html("");
            if (data.total_rows == 0){
                $('#count-matakuliah').prepend('<small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0"> Jumlah matakuliah : 0</small>');
                $('#alert-matakuliah').prepend(
                    '<div class="alert alert-light alert-dismissible border-1 border-left-3 border-left-success" role="alert" id="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                   ' <span aria-hidden="true">&times;</span>'+
                   ' </button>'+
                    '<div class="text-black-70">Opps! Tidak ada data untuk ditampilkan. Silahkan tambahkan data.</div>'+
                    '</div>'
                  );
            }
            else{
                $('#count-matakuliah').prepend('<small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0"> Jumlah Matakuliah : '+data.total_rows+' data</small>');
                $.each(data.record,function(index,element){
                    var filelink = 'http://'+host+websitename+'uploaded/matakuliah/';
                    $('#matakuliah-card').append(
                    '<div class="col-md-6">'+
                    '   <div class="card border-left-3 border-left-info">'+
                    '       <div class="card-body">'+
                    '           <div class="d-flex flex-column flex-sm-row">'+
                    '               <a href="http://'+host+websitename+'matakuliah/detail/'+element.id_matakuliah+'" target="_blank" class="avatar avatar-lg avatar-4by3 mb-3 w-xs-plus-down-100 mr-sm-3">'+
                    '                   <img src="'+websitename+'uploaded/images/'+element.gambar_matakuliah+'" alt="No Image" class="avatar-img rounded">'+
                    '               </a>'+
                    '               <div class="flex" style="min-width: 200px;">'+
                    '                   <h4 class="card-title mb-1"><a href="http://'+host+websitename+'matakuliah/detail/'+element.id_matakuliah+'">'+element.nama_matakuliah+'</a></h4>'+
                    '                   <p class="text-black-70">'+element.deskripsi_matakuliah.substr(0,80)+'</p>'+
                    '                   <div class="text-right">'+
                    '                       <a href="matakuliah#edit?id='+element.id_matakuliah+'" class="btn btn-sm btn-white">Edit</a>'+
                    '                   </div>'+
                    '               </div>'+
                    '           </div>'+
                    '       </div>'+
                    '       <div class="card__options dropdown right-0 pr-2">'+
                    '           <a href="#" class="dropdown-toggle text-muted" data-caret="false" data-toggle="dropdown">'+
                    '               <i class="material-icons">more_vert</i>'+
                    '           </a>'+
                    '           <div class="dropdown-menu dropdown-menu-right">'+
                    '               <a class="dropdown-item" href="matakuliah#edit?id='+element.id_matakuliah+'">Edit</a>'+
                    '               <div class="dropdown-divider"></div>'+
                    '                   <a class="dropdown-item text-danger" href="matakuliah#delete?id='+element.id_matakuliah+'">Delete</a>'+
                    '               </div>'+
                    '           </div>'+
                    '       </div>'+
                    '</div>'
                    );
                });
            }/*-----------------PAGINATION----------------------------------------*/
            var pagination ='';
            var paging = Math.ceil(data.total_rows/data.perpage);

            if ((!hal_aktif) && ($('ul#pagination-matakuliah li').length == 0)){
                    $('ul#pagination-matakuliah li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li class="page-item active"><a aria-label="1" class="page-link" href="matakuliah#get?hal='+i+'"><span>'+i+'</span></a></li>';
                    }
            }
            else if (hal_aktif && kategori){
                $('ul#pagination-matakuliah li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li class="page-item">'+
                        '<a class="page-link" href="matakuliah#get?kategori='+kategori+'&hal='+i+'"" aria-label="1">'+
                            '<span>'+i+'</span>'+
                        '</a>'+
                    '</li>';
                    }
            }
            else if (hal_aktif && cari){
                $('ul#pagination-matakuliah li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li class="page-item">'+
                            '<a class="page-link" href="matakuliah#get?cari='+cari+'&hal='+i+'" aria-label="1">'+
                                '<span>'+i+'</span>'+
                            '</a>'+
                        '</li>';
                    }
            }

            $('ul#pagination-matakuliah').append(pagination);
            $("ul#pagination-matakuliah li:contains('"+hal_aktif+"')").addClass('active');
            
            if(scrolltop == true ){
                $('body').scrollTop(2);
            }
            }
    });
}

function read_materi(hal_aktif,scrolltop,matakuliah,cari){
    $.ajax('http://'+host+path+'/crud/read',{
        dataType:'json',
        type : 'POST',
        data : {hal_aktif:hal_aktif,matakuliah:matakuliah, cari:cari},
        success:function(data){  
            $('#materi-card').html("");
            $('#alert-materi').html("");
          
            if (data.total_rows == 0){
                $('#alert-materi').prepend(
                    '<div class="alert alert-light alert-dismissible border-1 border-left-3 border-left-success" role="alert" id="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                   ' <span aria-hidden="true">&times;</span>'+
                   ' </button>'+
                    '<div class="text-black-70">Opps! Tidak ada data untuk ditampilkan. Silahkan tambahkan data.</div>'+
                    '</div>'
                  );
            }
            else{
                $.each(data.record,function(index,element){
                    $('#materi-card').append(
                    '<div class="card card-sm">'+
                        '<div class="card-body media">'+
                            '<div class="media-left">'+
                                '<div class="avatar avatar-lg avatar-4by3">'+
                                    '<img src="'+websitename+'uploaded/images/'+element.gambar_materi+'" alt="No Image" class="avatar-img rounded">'+
                                '</div>'+
                            '</div>'+
                            '<div class="media-body">'+
                                '<h4 class="card-title mb-0">'+element.judul_materi+'</h4>'+
                                '<small class="text-muted">'+element.nama_matakuliah+'</small>'+
                            '</div>'+
                        '</div>'+
                        '<div class="card-footer text-center">'+
                    '        <a href="materi/isi/'+element.id_materi+'" class="btn btn-white btn-sm float-left"><i class="material-icons btn__icon--left">playlist_add_check</i> Isi Materi</a>'+  
                            '<div class="clearfix"></div>'+
                        '</div>'+
                    '       <div class="card__options dropdown right-0 pr-2">'+
                    '           <a href="#" class="dropdown-toggle text-muted" data-caret="false" data-toggle="dropdown">'+
                    '               <i class="material-icons">more_vert</i>'+
                    '           </a>'+
                    '           <div class="dropdown-menu dropdown-menu-right">'+
                    '               <a class="dropdown-item" href="#edit?id='+element.id_materi+'">Edit</a>'+
                    '               <div class="dropdown-divider"></div>'+
                    '                   <a class="dropdown-item text-danger" href="#delete?id='+element.id_materi+'">Delete</a>'+
                    '               </div>'+
                    '           </div>'+
                    '       </div>'+
                    '</div>'
                    );
                });
            }
            $('#filterby-matakuliah option').remove();
            $('#filterby-matakuliah').append('<option value="materi">Semua</option>');

            for(var i in data.matakuliah){
                $('#filterby-matakuliah').append('<option value="materi#get?matakuliah='+data.matakuliah[i]['id_matakuliah']+'&hal=1">'+data.matakuliah[i]['nama_matakuliah']+'</option>');
            }

            /*-----------------PAGINATION----------------------------------------*/
            var pagination ='';
            var paging = Math.ceil(data.total_rows/data.perpage);

            if ((!hal_aktif) && ($('ul#pagination-materi li').length == 0)){
                    $('ul#pagination-materi li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li class="page-item active"><a aria-label="1" class="page-link" href="materi#get?hal='+i+'"><span>'+i+'</span></a></li>';
                    }
            }
            else if (hal_aktif && matakuliah){
                $('ul#pagination-materi li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li class="page-item">'+
                        '<a class="page-link" href="materi#get?matakuliah='+matakuliah+'&hal='+i+'"" aria-label="1">'+
                            '<span>'+i+'</span>'+
                        '</a>'+
                    '</li>';
                    }
            }
            else if (hal_aktif && cari){
                $('ul#pagination-materi li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li class="page-item">'+
                            '<a class="page-link" href="materi#get?cari='+cari+'&hal='+i+'" aria-label="1">'+
                                '<span>'+i+'</span>'+
                            '</a>'+
                        '</li>';
                    }
            }

            $('ul#pagination-materi').append(pagination);
            $("ul#pagination-materi li:contains('"+hal_aktif+"')").addClass('active');
            
            if(scrolltop == true ){
                $('body').scrollTop(2);
            }
        }

    });
}

function read_isi_materi(scrolltop){
    $.ajax('http://'+host+path+'/read', {
      dataType : 'json',
      type : 'POST',
      success: function(data){
        var no = 0;
            $('#nestable ul').html("");
            $.each(data.record,function(index,element){
                 no++;
                        $('#nestable ul').append(
                        '            <li id="ID_'+element.id_isi+'"class="list-group-item nestable-item">'+
                        '                <div class="media align-items-center">'+
                        '                    <div class="media-left">'+
                        '                        <a href="#" class="btn btn-default nestable-handle"><i class="material-icons">menu</i></a>'+
                        '                    </div>'+
                        '                    <div class="media-body">'+element.sub_judul+' </div>'+
                        '                    <div class="media-right text-right">'+
                        '                        <div style="width:100px">'+
                        '                             <a href="#edit?id='+element.id_isi+'" class="btn btn-primary btn-sm"><i class="material-icons">edit</i></a>'+
                        '                             <a href="#delete?id='+element.id_isi+'" class="btn btn-danger btn-sm"><i class="material-icons">delete</i></a>'+
                        '                        </div>'+
                        '                    </div>'+
                        '                </div>'+
                        '            </li>'
                        );                             
            });

             var updateOutput = function () {
                var orderAll = [];
                $('.list-group li').each(function(){
                    orderAll.push($(this).attr('id').replace(/_/g, '[]='));
                });
                $.post( 'http://'+host+path+'/sort', orderAll.join('&'));
            };

            $('#nestable').nestable().on('change', updateOutput);
        }
    });
}

function read_dosen(hal_aktif,scrolltop,hak,cari){
    if($('table#tbl-dosen').length > 0){
    $.ajax('http://'+host+path+'/crud/read',{
        dataType:'json',
        type : 'POST',
        data : {hal_aktif:hal_aktif, hak:hak, cari:cari},
        success:function(data){
            var no = 0;
            $('table#tbl-dosen tbody tr').remove();
            $('#count-dosen').html("");
            $('#alert-dosen').html("");
            if (data.total_rows == 0){
                $('#count-dosen').prepend('<small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0"> Jumlah Data Dosen : 0</small>');
                $('#alert-dosen').prepend(
                    '<div class="alert alert-light alert-dismissible border-1 border-left-3 border-left-success" role="alert" id="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                   ' <span aria-hidden="true">&times;</span>'+
                   ' </button>'+
                    '<div class="text-black-70">Opps! Tidak ada data untuk ditampilkan. Silahkan tambahkan data dosen.</div>'+
                    '</div>'
                  );
            }
            else{

                $('#count-dosen').prepend('<small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0"> Jumlah Data Dosen : '+data.total_rows+'</small>');
                $.each(data.record,function(index,element){
                    no++;
                    $('table#tbl-dosen').find('tbody').append(
                        '<tr>'+
                        '   <td>'+no+'</td>'+
                        '   <td>'+
                        '       <div class="media align-items-center">'+
                        '           <div class="media-body">'+
                        '               <span class="js-lists-values-employee-name">'+element.nama_dosen+'</span>'+
                        '           </div>'+
                        '       </div>'+
                        '   </td>'+
                        '   <td><small class="text-muted">'+element.hak_akses+'</small></td>'+
                        '   <td width="20%">'+element.nid+'</td>'+
                        '    <td width="15%" class="td-actions">'+
                        '        <a href="dosen#edit?id='+element.nid+'" class="link-edit btn btn-info btn-sm"><i class="material-icons">edit</i></a>'+
                        '        <a href="dosen#delete?id='+element.nid+'" class="link-edit btn btn-danger btn-sm"><i class="material-icons">delete_forever</i></a>'+
                        '    </td>'+
                        '</tr>'
                    )
                });
            }
            
        /*-----------------PAGINATION----------------------------------------*/
        var pagination ='';
        var paging = Math.ceil(data.total_rows/data.perpage);

        if ((!hal_aktif) && ($('ul#pagination-dosen li').length == 0)){
                $('ul#pagination-dosen li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li class="page-item active"><a aria-label="1" class="page-link" href="dosen#get?hal='+i+'"><span>'+i+'</span></a></li>';
                }
        }
        else if (hal_aktif && hak){
            $('ul#pagination-dosen li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li class="page-item">'+
                    '<a class="page-link" href="dosen#get?hak='+hak+'&hal='+i+'"" aria-label="1">'+
                        '<span>'+i+'</span>'+
                    '</a>'+
                '</li>';
                }
        }
        else if (hal_aktif && cari){
            $('ul#pagination-dosen li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li class="page-item">'+
                        '<a class="page-link" href="dosen#get?cari='+cari+'&hal='+i+'" aria-label="1">'+
                            '<span>'+i+'</span>'+
                        '</a>'+
                    '</li>';
                }
        }

        $('ul#pagination-dosen').append(pagination);
        $("ul#pagination-dosen li:contains('"+hal_aktif+"')").addClass('active');
        
        if(scrolltop == true ){
            $('body').scrollTop(2);
        }
        }
        });
    }
}

function read_mahasiswa(hal_aktif,scrolltop,cari){
    if($('table#tbl-mahasiswa').length > 0){
    $.ajax('http://'+host+path+'/crud/read',{
        dataType:'json',
        type : 'POST',
        data : {hal_aktif:hal_aktif, cari:cari},
        success:function(data){
            var no = 0;
            $('table#tbl-mahasiswa tbody tr').remove();
            $('#count-mahasiswa').html("");
            $('#alert-mahasiswa').html("");
            if (data.total_rows == 0){
                $('#count-mahasiswa').prepend('<small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0"> Jumlah Data Mahasiswa : 0</small>');
                $('#alert-mahasiswa').prepend(
                    '<div class="alert alert-light alert-dismissible border-1 border-left-3 border-left-success" role="alert" id="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                   ' <span aria-hidden="true">&times;</span>'+
                   ' </button>'+
                    '<div class="text-black-70">Opps! Tidak ada data untuk ditampilkan. Silahkan tambahkan data Mahasiswa.</div>'+
                    '</div>'
                  );
            }
            else{
                $('#count-mahasiswa').prepend('<small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0"> Jumlah Data Mahasiswa : '+data.total_rows+'</small>');
                $.each(data.record,function(index,element){
                    no++;
                    $('table#tbl-mahasiswa').find('tbody').append(
                    '<tr>'+
                    '   <td>'+no+'</td>'+
                    '   <td>'+
                    '       <div class="media align-items-center">'+
                    '           <div class="media-body">'+
                    '               <span class="js-lists-values-employee-name">'+element.nama_mahasiswa+'</span>'+
                    '           </div>'+
                    '       </div>'+
                    '   </td>'+
                    '    <td width="15%" class="td-actions">'+
                    '        <span>'+element.nama_kelas+'</span>'+
                    '    </td>'+
                    '    <td width="15%" class="td-actions">'+
                    '           <a href="#" class="link-edit btn btn-primary btn-sm" data-toggle="dropdown"><i class="material-icons">menu</i></a>'+
                    '           <div class="dropdown-menu">'+
                    '               <a class="dropdown-item" href="mahasiswa#edit?id='+element.nim+'">Edit</a>'+
                    '               <div class="dropdown-divider"></div>'+
                    '                   <a class="dropdown-item text-danger" href="mahasiswa#delete?id='+element.nim+'">Delete</a>'+
                    '               </div>'+
                    '           </div>'+
                    '    </td>'+
                    '</tr>'
                    )
                });
            }
            
        /*-----------------PAGINATION----------------------------------------*/
        var pagination ='';
        var paging = Math.ceil(data.total_rows/data.perpage);

        if ((!hal_aktif) && ($('ul#pagination-mahasiswa li').length == 0)){
            $('ul#pagination-mahasiswa li').remove();
            for(i=1; i <= paging; i++){
                pagination = pagination+'<li class="page-item active"><a aria-label="1" class="page-link" href="mahasiswa#get?hal='+i+'"><span>'+i+'</span></a></li>';
            }
        }
        else if (hal_aktif && cari){
            $('ul#pagination-mahasiswa li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li class="page-item">'+
                        '<a class="page-link" href="mahasiswa#get?cari='+cari+'&hal='+i+'" aria-label="1">'+
                            '<span>'+i+'</span>'+
                        '</a>'+
                    '</li>';
            }
        }

        $('ul#pagination-mahasiswa').append(pagination);
        $("ul#pagination-mahasiswa li:contains('"+hal_aktif+"')").addClass('active');
        
            if(scrolltop == true ){
                $('body').scrollTop(2);
            }
        }
        });
    }
}

function read_tugas(hal_aktif,scrolltop,cari,kelas,matakuliah){
    if($('table#tbl-tugas').length > 0){
    $.ajax('http://'+host+path+'/crud/read',{
        dataType:'json',
        type : 'POST',
        data : {hal_aktif:hal_aktif,cari:cari,kelas:kelas,matakuliah:matakuliah},
        success:function(data){
            var no = 0;
            $('table#tbl-tugas tbody tr').remove();
            $('#count-tugas').html("");
            $('#alert-tugas').html("");
            if (data.total_rows == 0){
                $('#count-tugas').prepend('<small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0"> Jumlah Tugas : 0</small>');
                $('#alert-tugas').prepend(
                    '<div class="alert alert-light alert-dismissible border-1 border-left-3 border-left-success" role="alert" id="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                   ' <span aria-hidden="true">&times;</span>'+
                   ' </button>'+
                    '<div class="text-black-70">Opps! Tidak ada data untuk ditampilkan.</div>'+
                    '</div>'
                  );
            }
            else{
                $('#count-tugas').prepend('<small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0"> Jumlah Tugas : '+data.total_rows+'</small>');
                $.each(data.record,function(index,element){
                    no++;
                    $('table#tbl-tugas').find('tbody').append(
                    '<tr>'+
                    '   <td width="20%">'+element.nama_matakuliah+'</td>'+
                    '   <td width="20%">'+element.nama_tugas+'</td>'+
                    '   <td width="20%">'+element.nama_kelas+'</td>'+
                    '   <td width="20%">'+element.nama_dosen+'</td>'+
                    '   <td width="20%">'+element.waktu_berakhir+'</td>'+
                    '   <td width="15%" class="td-actions">'+
                    '           <a href="#" class="link-edit btn btn-primary btn-sm" data-toggle="dropdown"><i class="material-icons">menu</i></a>'+
                    '           <div class="dropdown-menu">'+
                    '               <a class="dropdown-item" href="tugas/review/'+element.id_tugas+'">Review</a>'+
                    '               <a class="dropdown-item" href="tugas#edit?id='+element.id_tugas+'">Edit</a>'+
                    '               <div class="dropdown-divider"></div>'+
                    '                   <a class="dropdown-item text-danger" href="tugas#delete?id='+element.id_tugas+'">Delete</a>'+
                    '               </div>'+
                    '           </div>'+
                    '    </td>'+
                    '</tr>'
                    )
                });
            }
            
        /*-----------------PAGINATION----------------------------------------*/
        var pagination ='';
        var paging = Math.ceil(data.total_rows/data.perpage);

        if ((!hal_aktif) && ($('ul#pagination-tugas li').length == 0)){
                $('ul#pagination-tugas li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li class="page-item active"><a aria-label="1" class="page-link" href="tugas#get?hal='+i+'"><span>'+i+'</span></a></li>';
                }
        }
        else if (hal_aktif && kelas){
            $('ul#pagination-tugas li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li class="page-item">'+
                        '<a class="page-link" href="tugas#get?kelas='+kelas+'&hal='+i+'" aria-label="1">'+
                            '<span>'+i+'</span>'+
                        '</a>'+
                    '</li>';
                }
        }
        else if (hal_aktif && matakuliah){
            $('ul#pagination-tugas li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li class="page-item">'+
                        '<a class="page-link" href="tugas#get?matakuliah='+matakuliah+'&hal='+i+'" aria-label="1">'+
                            '<span>'+i+'</span>'+
                        '</a>'+
                    '</li>';
                }
        }
        else if (hal_aktif && cari){
            $('ul#pagination-tugas li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li class="page-item">'+
                        '<a class="page-link" href="tugas#get?cari='+cari+'&hal='+i+'" aria-label="1">'+
                            '<span>'+i+'</span>'+
                        '</a>'+
                    '</li>';
                }
        }

        $('ul#pagination-tugas').append(pagination);
        $("ul#pagination-tugas li:contains('"+hal_aktif+"')").addClass('active');
        
        if(scrolltop == true ){
            $('body').scrollTop(2);
        }
        }
        });
    }
}

function read_jawaban(hal_aktif,scrolltop,cari){
    if($('table#tbl-jawaban').length > 0){
    $.ajax('http://'+host+path+'/read',{
        dataType:'json',
        type : 'POST',
        data : {hal_aktif:hal_aktif,cari:cari},
        success:function(data){
            var no = 0;
            $('table#tbl-jawaban tbody tr').remove();
            $('#count-jawaban').html("");
            $('#alert-jawaban').html("");
            if (data.total_rows == 0){
                $('#count-jawaban').prepend('<small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0"> Jumlah Jawaban : 0</small>');
                $('#alert-jawaban').prepend(
                    '<div class="alert alert-light alert-dismissible border-1 border-left-3 border-left-success" role="alert" id="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                   ' <span aria-hidden="true">&times;</span>'+
                   ' </button>'+
                    '<div class="text-black-70">Opps! Tidak ada data jawaban.</div>'+
                    '</div>'
                  );
            }
            else{
                $('#count-jawaban').prepend('<small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0"> Jumlah Jawaban : '+data.total_rows+'</small>');
                $.each(data.record,function(index,element){
                    no++;
                    $('table#tbl-jawaban').find('tbody').append(
                    '<tr>'+
                    '   <td width="5%">'+no+'</td>'+
                    '   <td width="20%">'+element.waktu_menjawab+'</td>'+
                    '   <td width="50%">'+element.nama_mahasiswa+'</td>'+
                    '   <td width="10%">'+element.nilai+'</td>'+
                    '    <td width="15%" class="td-actions">'+
                    '        <a href="#review?id='+element.id_jawaban+'" class="link-edit btn btn-info btn-sm"><i class="material-icons">edit</i></a>'+
                    '    </td>'+
                    '</tr>'
                    )
                });
            }
            
        /*-----------------PAGINATION----------------------------------------*/
        var pagination ='';
        var paging = Math.ceil(data.total_rows/data.perpage);

        if ((!hal_aktif) && ($('ul#pagination-jawaban li').length == 0)){
                $('ul#pagination-jawaban li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li class="page-item active"><a aria-label="1" class="page-link" href="#get?hal='+i+'"><span>'+i+'</span></a></li>';
                }
        }
        else if (hal_aktif && cari){
            $('ul#pagination-jawaban li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li class="page-item">'+
                        '<a class="page-link" href="#get?cari='+cari+'&hal='+i+'" aria-label="1">'+
                            '<span>'+i+'</span>'+
                        '</a>'+
                    '</li>';
                }
        }

        $('ul#pagination-jawaban').append(pagination);
        $("ul#pagination-jawaban li:contains('"+hal_aktif+"')").addClass('active');
        
        if(scrolltop == true ){
            $('body').scrollTop(2);
        }
        }
        });
    }
}

function createeditor(element,content){
    if ( editor ) return;
    editor = CKEDITOR.appendTo( element,
    {
      bodyId: 'editorvalue',
      entities: false,
      uiColor: '#fafafa', 
      height: '150px',
      toolbar: [
        '/',
        { name: 'tools', items: [ 'Maximize' ] },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: ['Undo', 'Redo' ] },
        { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
        { name: 'styles', items: [ 'Styles', 'Format' ] }
        
      ]
    
    }, content );
}
  
function removeeditor() {
    if ( !editor )
        return;

    // Destroy the editor.
    editor.destroy();
    editor = null;
}








/* 
    //1 Fungsi Timer
    geturlvar merupakan fungsi untuk mengambil suatu string pada url menjadi suatu variable.


    scrolltop merupakan fungsi bawaan jquery untuk melakukan auto scroll ke atas halaman.
*/