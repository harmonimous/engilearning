var path = window.location.pathname;
var host = window.location.hostname;
var websitename ='/engilearning/';

$(function(){


    read_materi();

    daftar_materi();

    $(window).hashchange(function(){
      var hash = $.param.fragment();
      if (hash.search('get') == 0){
          if (path.search('mahasiswa/learn') > 0){
              var hal_aktif = null;
              var hash = geturlvar();
              if (hash['hal']){
                  hal_aktif=hash['hal'];
              }
              daftar_materi(hal_aktif,true);
              $("ul#pagination-materi li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
          }
      }
    });

    $(window).trigger('hashchange');
    
    $('#filejawaban').dropify({
        messages: {
        default: 'Pilih File',
        replace: 'Ganti',
        remove:  'Hapus',
        error:   'error'
    }
    });

    $(document).on('click','#submit-jawaban',function(eve){
    eve.preventDefault();
      var action = $('#form-jawaban-tugas').attr('action');
      var datatosend = new FormData($("#form-jawaban-tugas")[0]);

      $.ajax('http://'+host+path+'/jawab',{
          dataType:'json',
          type : 'POST',
          data : datatosend,
          contentType: false,
          processData: false,
          success:function(data){
              if(data.status =='success'){
                  swal({
                      title: 'File berhasil diupload!',
                      text: 'Tugas sudah Dijawab',
                      type: 'success',
                      confirmButtonColor: '#4fa7f3'
                  }, function() {
                    var link ='http://'+host+websitename+'mahasiswa/tugas';
                    window.location.replace(link);
                  });  
              }
              else if(data.status =='sudah_menjawab'){
                swal({
                    title: 'Anda sudah pernah Menjawab!',
                    text: 'Anda sudah pernah Menjawab',
                    type: 'warning',
                    confirmButtonColor: '#4fa7f3',
                    confirmButtonText: 'OK'
                    });
              }
              else if(data.status =='gagal_upload'){
                  swal({
                      title: 'Gagal diupload!',
                      text: 'File Gagal di upload, format file yang diterima hanya pdf/doc/docx/ppt/pptx/zip',
                      type: 'warning',
                      confirmButtonColor: '#4fa7f3',
                      confirmButtonText: 'OK'
                  });
              }
              else if(data.status =='waktu_habis'){
                  swal({
                      title: 'Opps!',
                      text: 'Waktu Sudah Habis',
                      type: 'warning',
                      confirmButtonColor: '#4fa7f3'
                  }, function() {
                    var link ='http://'+host+websitename+'mahasiswa/tugas';
                    window.location.replace(link);
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
              }
          }
      });
    });

    $(document).on('click','#submit-komentar',function(eve){
      eve.preventDefault();
      var datatosend = new FormData($("#form-komentar")[0]);

      $.ajax('http://'+host+path+'/komentari',{
          dataType:'json',
          type : 'POST',
          data : datatosend,
          contentType: false,
          processData: false,
          success:function(data){
              if(data.status =='success'){
                location.reload();
              }
              else{
                  $.each(data.errors, function(key,value) {
                  swal({
                      title: 'Gagal!',
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
                        var link ='http://'+host+websitename+'/login';
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
}); 
//-----------Pembelajaran--------------//
  function read_materi(hal_aktif,scrolltop){
    $.ajax('http://'+host+path+'/read',{
        dataType:'json',
        type : 'POST',
        data : {hal_aktif:hal_aktif},
        success:function(data){  
            $('#data-with-jquery').html("");
            $.each(data.record,function(index,element){
              var h3print = '';
              var html_pembahasan='+';
              var html_soal='?';
              if (element.tipe_isi == "soal"){
                h3print=html_soal;
              }
              else if (element.tipe_isi=="pembahasan"){
                h3print=html_pembahasan;
              }
              $('#data-with-jquery').append(
                '<h3 class="text-center">'+h3print+'</h3>'+
                '<div style="height: auto;">'+
                '<h4 class="text-center"><strong>'+element.sub_judul+'</strong></h4>'+
                (element.tipe_isi == 'soal' ? 
                  '<p>'+element.pertanyaan+'</p>'+
                  '<form id="form-soal" name"form-soal" method="post">'+
                  '<input type="hidden" name="hidden-jenis-soal" id="hidden-jenis-soal" value='+element.jenis_soal+'>'+
                  '<input type="hidden" name="hidden-id" id="hidden-id" value='+element.id_soal+'>'+
                  (element.jenis_soal=='pg'?
                    '<div class="form-group" id="for-pg">'+
                        '<div class="custom-controls-stacked">'+
                           ' <div class="custom-control custom-radio">'+
                              '  <input id="pilihan-1" name="jawaban-pg" type="radio" class="custom-control-input" value="'+element.pilihan_1+'">'+
                               ' <label for="pilihan-1" class="custom-control-label">'+element.pilihan_1+'</label>'+
                           ' </div>'+
                            '<div class="custom-control custom-radio">'+
                               ' <input id="pilihan-2" name="jawaban-pg" type="radio" class="custom-control-input" value="'+element.pilihan_2+'">'+
                               ' <label for="pilihan-2" class="custom-control-label">'+element.pilihan_2+'</label>'+
                            '</div>'+
                            '<div class="custom-control custom-radio">'+
                               ' <input id="pilihan-3" name="jawaban-pg" type="radio" class="custom-control-input" value="'+element.pilihan_3+'">'+
                               ' <label for="pilihan-3" class="custom-control-label">'+element.pilihan_3+'</label>'+
                            '</div>'+
                            '<div class="custom-control custom-radio">'+
                               ' <input id="pilihan-4" name="jawaban-pg" type="radio" class="custom-control-input" value="'+element.pilihan_4+'">'+
                               ' <label for="pilihan-4" class="custom-control-label">'+element.pilihan_4+'</label>'+
                            '</div>'+
                        '</div>'+
                    '</div>'
                    :
                    '<div class="form-group">'+
                      '<label>Jawab : </label>'+
                      '<input type="text" class="form-control" id="jawaban-essay" name="jawaban-essay" placeholder="Ketik Jawaban"></div>'+
                    '</div>'
                  )+
                  '</form>'
                :
                  '<fieldset>'+element.isi_pembahasan+'</fieldset>'+
                  (element.lampiran_materi!=''?'<a href="'+websitename+'uploaded/materi/'+element.lampiran_materi+'" target="_blank" type="button" class="btn btn-primary btn-sm" download>Download Materi</a>':'<p>&nbsp;</p>')
                  )+
                '</div>'
              );
            }); 
            init_show();
        }
    });    
  }

  function init_show(){
    var form = $("#show-materi");
    form.children("fieldset").steps({
      labels: { 
        finish: "Cek Jawaban",
        next: "Selanjutnya",
        previous: "Kembali"
      },
      headerTag: "h3",
      bodyTag: "div",
      transitionEffect: "slideLeft",
      cssClass: "wizard",
      onInit: function(event, currentIndex){
        resizeJquerySteps();
      },
      onStepChanging: function(event, currentIndex, newIndex){
        var sendform=$('.body.current form');     
        if(sendform.length==0){
          return true;
        }
        else if(currentIndex > newIndex){
          return true;
        }
        else{
          var response = false;
          var datatosend = sendform.serialize();
          $.ajax('http://'+host+path+'/jawab',{
              dataType:'json',
              type : 'POST',
              async : false,
              data : datatosend,
              success:function(data){
                  if(data.status =='benar'){
                    swal({
                          title: 'Benar',
                          text: 'Jawaban Benar',
                          type: 'success',
                          confirmButtonColor: '#4fa7f3'
                        });
                    response = true;
                  }
                  else if(data.status =='salah'){
                    swal({
                        title: 'Salah!',
                        text: 'Jawaban Salah',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                      });
                  }
                  else if(data.status =='empty'){
                    swal({
                        title: 'Kosong!',
                        text: 'Jawab Pertanyaan!',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                      });
                  }
              }
          });
          console.log(response);
          return response; //jika false tidak akan memunculkan slide selanjutnya,jika true maka tampilkan slide selanjutnya.
        }
      },
      onStepChanged: function (event, currentIndex, priorIndex){
          resizeJquerySteps();
      },
      onFinished: function (event, currentIndex){
          var sendform=$('.body.current form');  
          var response = false;
          var datatosend = sendform.serialize();
          $.ajax('http://'+host+path+'/final',{
              dataType:'json',
              type : 'POST',
              async : false,
              data : datatosend,
              success:function(data){
                  if(data.status =='benar' && data.levelup>0){
                    swal({
                          title: 'Yeay!',
                          text: 'Materi selesai, Level kamu meningkat!',
                          type: 'success',
                          confirmButtonColor: '#4fa7f3'
                        }, function() { 
                          var link ='http://'+host+websitename+'mahasiswa/learn/'+data.direct_to;
                          window.location.replace(link);
                    });
                  }
                  else if(data.status =='benar' && data.levelup==0){
                    swal({
                          title: 'Woaaah!',
                          text: 'Materi selesai',
                          type: 'success',
                          confirmButtonColor: '#4fa7f3'
                        }, function() { 
                          var link ='http://'+host+websitename+'mahasiswa/learn/'+data.direct_to;
                          window.location.replace(link);
                    });
                  }
                  else if(data.status =='salah'){
                    swal({
                        title: 'Opss!',
                        text: 'Jawaban Salah, Ulangi dari awal ya.',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                        }, function() { 
                          read_materi();
                    });
                  }
                  else if(data.status =='empty'){
                    swal({
                        title: 'Hey!',
                        text: 'Jawaban Kosong',
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                      });
                  }
              }
          });
          console.log(response);
          return response; //jika false tidak akan memunculkan slide selanjutnya,jika true maka tampilkan slide selanjutnya.
      }
    });
  }

  function daftar_materi(hal_aktif,scrolltop){
    $.ajax('http://'+host+path+'/read',{
        dataType:'json',
        type : 'POST',
        data : {hal_aktif:hal_aktif},
        success:function(data){  
            $('#materi-card').html("");
          
            if (data.total_rows == 0){
                $('#alert-materi').prepend(
                    '<div class="alert alert-light alert-dismissible border-1 border-left-3 border-left-success" role="alert" id="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                   ' <span aria-hidden="true">&times;</span>'+
                   ' </button>'+
                    '<div class="text-black-70">Opps! Tidak ada data untuk ditampilkan.</div>'+
                    '</div>'
                  );
                swal({
                    title: 'Opss!',
                    text: 'Tidak ada materi saat ini, klik OK untuk kembali ke Daftar Matakuliah',
                    type: 'warning',
                    confirmButtonColor: '#4fa7f3',
                    confirmButtonText: 'OK'
                    }, function() { 
                    var link ='http://'+host+websitename+'matakuliah';
                    window.location.replace(link);
                });
            }
            else{
                $.each(data.record,function(index,element){
                    $('#materi-card').append(
                      '    <div class="card">'+
                      '        <div class="card-header text-center">'+
                      '            <h4 class="card-title mb-0"><a href="start/'+element.id_matakuliah+'/'+element.id_materi+'">'+element.judul_materi+'</a></h4>'+
                              '</div>'+
                              '<a href="start/'+element.id_matakuliah+'/'+element.id_materi+'">'+
                                  '<img src="'+websitename+'uploaded/images/'+element.gambar_materi+'" alt="Opss! Gambar kosong" style="display: block;  margin-left: auto; margin-right: auto; width: 50%;">'+
                              '</a>'+
                              '<div class="card-body">'+
                                  '<small class="text"><b>'+element.nama_matakuliah+'</b></small>'+
                                  '<p>'+element.keterangan+'</p>'+
                                  '<div class="col-md-12 text-center">'+
                                      '<a href="http://'+host+websitename+'diskusi/'+element.id_materi+'" target="_blank" class="btn btn-success btn-sm">Diskusi &nbsp<i class="material-icons">comment</i></a>'+
                                  '</div>'+
                              '</div>'+
                          '</div>'
                    );
                });
            }

            /*-----------------PAGINATION----------------------------------------*/
            var pagination ='';
            var paging = Math.ceil(data.total_rows/data.perpage);

            if ((!hal_aktif) && ($('ul#pagination-materi li').length == 0)){
                    $('ul#pagination-materi li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li class="page-item active"><a aria-label="1" class="page-link" href="#get?hal='+i+'"><span>'+i+'</span></a></li>';
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
//----------- End Pembelajaran--------------//


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