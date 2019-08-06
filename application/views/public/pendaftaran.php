<style>
    .fz {
        font-size: 3em;
    }
    .img-fluid {
        position: relative;
        bottom: 70px;
    }

    .middle {
        position: absolute;
        transform: translate(0, -50%);
        top: 60%;
        left: 40%;
    }

    .middle i {
        font-size: 10em !important;
    }
</style>
<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
        <h1 class="text-bold-600">Pendaftaran</h1>
  </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="card">
                <div class="card-header">
                  <h2 class="card-title" style="font-size:20px;" id="heading-icon">Tatacara Pendaftaran</h2>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <h2 class="card-title" style="font-size:17px;">1. Silahkan akses ke halaman website <i></i> </h2>
                    <h2 class="card-title" style="font-size:17px;">2. Klik menu Pendaftaran</h2>
                    <h2 class="card-title" style="font-size:17px;">3. Isi Form Pendaftaran , kemudian Submit</h2>
                    <h2 class="card-title" style="font-size:17px;">4. Cek email untuk melihat jadwal seleksi</h2>
                    <h2 class="card-title" style="font-size:17px;">5. Orang tua menghadiri jadwal seleksi yang di tentukan</h2>
                    <h2 class="card-title" style="font-size:17px;">6. Melihat hasil seleksi pada halaman website</h2>
                  </div>
                </div>
              </div>


        </div>

        <div class="col-md-6 col-xs-12" id="content_ta">

        </div>




<script>
var renderUI = (function(){

        return {
            renderTA: function(data){
                var html = '';
                html += `
                <div class="card">
                    <div class="card-content">
                    <img class="card-img-top img-fluid" src="<?= base_url('assets') ?>/app-assets/images/home/school2.png" alt="Card image cap">

                    </div>
                    <div class="card-header">
                        <h1 class="text-bold-600">Tahun Ajaran ${data.kd_ta}</h1>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collpase show">
                        <div class="card-body">
                                <div class="card-text">
                                    <p class="card-text">
                                        Berikut adalah kelengkapan data Pendaftaran di tahun ajaran ${data.kd_ta}.
                                    </p>
                                </div>
                            <form class="form">
                                <div class="form-body">
                                        <h4 class="form-section"><i class="la la-calendar"></i> Detail</h4>
                                        <div class="row">
                                            <div class="col-md-3">
                                            <div class="form-group">
                                                <dl class="">
                                                    <dt class="">Dari Tanggal</dt>
                                                </dl>
                                            </div>
                                            </div>
                                            <div class="col-md-3">
                                            <div class="form-group">
                                                <dl class="">
                                                    <dd class="">${data.tgl_awal}</dd>
                                                </dl>
                                            </div>
                                            </div>

                                            <div class="col-md-3">
                                            <dl class="">
                                                <dt class="">Sampai Tanggal</dt>
                                            </dl>
                                            </div>
                                            <div class="col-md-3">
                                            <div class="form-group">
                                                <dl class="">
                                                    <dd class="">${data.tgl_akhir}</dd>
                                                </dl>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-actions center">
                                            <a href="#/pendaftaran/${data.kd_ta}" class="btn btn-block btn-lg btn-primary round btn-min-width btn-glow mr-1" style="position:relative; top: 10px">Daftar</a>
                                        </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                `


                $('#content_ta').html(html)
            },

            renderNoData: function(){
               var html = "";

               html += `
                <div class="" style="height: 620.344px;">
                    <div class="card-content">
                    <div class="card-body text-center">
                        <h1 class="fz">Belum ada Pendaftaran yang dibuka</h1>
                        <img class="card-img-top img-fluid" src="<?= base_url('assets') ?>/app-assets/images/home/school2.png" alt="Card image cap">
                    </div>
                    </div>
                </div>

               `
                $('#content_ta').html(html);
            },


        }

    })()

 var loadData = (function(UI){

        var ID_JADWAL = location.hash.substr(10);

        var dataTA = function(){
            // alert(ID_JADWAL)
            $.ajax({
                url: `<?= base_url('public/tahun_ajaran/show/'); ?>`,
                type: 'GET',
                dataType: 'JSON',

                beforeSend: function(){
                     $('#content_ta').html(`<div class="text-center middle"><i class="icon-spin la la-share-alt-square"></i></div>`);

                },
                success: function(response){
                    if(response.status === 200){
                        if(response.data.length !== 1){
                            UI.renderNoData();
                        } else {
                            $.each(response.data, function(k, v){
                                UI.renderTA(v);
                                // UI.renderAction(v);
                            })
                        }
                    }
                },
                error: function(err){
                    location.hash = '#/seleksi'
                }
            })
        }

        var tolakSeleksi = function(){
           $(document).on('click', '#btn_tolak', function(){
            var id_seleksi = $(this).attr("data-id");
            var link_get = `<?= base_url('api/seleksi/tidak_hadir/') ?>${auth.token}?id_seleksi=${id_seleksi}`;

                 Swal.fire({
            title: 'Seleksi  tidak akan dihadiri secara permanen?',
            type: 'question',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Saya yakin.',
            showLoaderOnConfirm: true
          }).then((result) => {
                 $.ajax({
                    url: link_get,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response){
                        if(response.status === 200){

                                Swal.fire({
                                    position: 'center',
                                    type: 'success',
                                    title: response.message,
                                    showConfirmButton: true,
                                    timer: 1500
                                });
                                dataSeleksi()
                        } else {

                                Swal.fire({
                                    position: 'center',
                                    type: 'error',
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });


                        }
                    },
                    error: function(err){
                        console.log(err)
                    }
                })
             });

           });

        }

        return {
            init : function(){
                dataTA();
                // tolakSeleksi();
            }
        }

    })(renderUI)

    $(document).ready(function(){
        loadData.init();
    })



</script>
