<style>
/* Make sure images don't get too big */
img {
  max-width: 100%;
}

/* no-gutters Class Rules */
.row.no-gutters {
   margin-right: 0;
   margin-left: 0;
}
.row.no-gutters > [class^="col-"],
.row.no-gutters > [class*=" col-"] {
   padding-right: 0;
   padding-left: 0;
}

.img-fluid.h-680{
    height: 680px !important;
}

.img-fluid.h-310{
    height: 310px !important;
}

.ovrflow{
    height: 100%;
    width: 100%;
    overflow: auto;
}
.ovrflow::-webkit-scrollbar{
    display:none;
}
.svg-seleksi {
    height: 550px;
    display: block;
    margin: auto;
}
</style>
<section id="sizing">
         <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Seleksi</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#/pendaftaran"><i class="fa fa-users"></i> Seleksi</a></li>
                    <li class="breadcrumb-item active">Seleksi</li>
                </ol>
            </div>
        </div>

<div id="content_seleksi"></div>
</section>
<script>
 var renderUI = (function(){
        
        return {
            renderSeleksi: function(data){
                var html = '';
                html += `
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Detail Jadwal</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                <div class="card-text">
                                    <p class="card-text">
                                        Berikut adalah kelengkapan data jadwal yang meliputi Status  dan Detail jadwal.
                                    </p>
                                </div>
                                <form class="form">
                                    <div class="form-body">
                                    <h4 class="form-section"><i class="ft-user"></i> Status</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <dl class="">
                                                <dt class="">ID Jadwal</dt>
                                            </dl>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                                <dl class="">
                                                    <dd class="">${data.id_jadwal}</dd>
                                                </dl>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                        <dl class="">
                                            <dt class="">Tahun Ajaran</dt>
                                        </dl>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <dl class="">
                                                    <dd class="">${data.kd_ta}</dd>
                                            </dl>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                        <dl class="">
                                            <dt class="">Status</dt>
                                        </dl>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <dl class="">
                                                    <dd class="">${data.status}</dd>
                                            </dl>
                                        </div>
                                        </div>
                                    </div>

                                    <h4 class="form-section"><i class="ft-check-circle"></i> Detail</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <dl class="">
                                                    <dt class="">Lokasi</dt>
                                                </dl>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <dl class="">
                                                        <dd class="">${data.lokasi}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                        <dl class="">
                                            <dt class="">Keterangan Jadwal</dt>
                                        </dl>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <dl class="">
                                                    <dd class="">${data.keterangan_jadwal}</dd>
                                            </dl>
                                        </div>
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <dl class="">
                                                <dt class="">Deskripsi Jadwal</dt>
                                            </dl>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <dl class="">
                                                        <dd class="">${data.deskripsi_jadwal}</dd>
                                                </dl>
                                            </div>
                                            </div>
                                        </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <dl class="">
                                                <dt class="">Tanggal Input</dt>
                                            </dl>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <dl class="">
                                                        <dd class="">${data.tgl_input}</dd>
                                                </dl>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        `

                html +=`
                        <div class="col-md-6">
                          <img class="svg-seleksi" alt="modern admin logo" src="<?= base_url('assets') ?>/app-assets/images/undraw_resume_folder_2_arse.svg">
                        </div>
                        `

                 html +=` 
                        <div class="col-md-12 mb-10">
                            <div class="table-responsive">
                                            <table class="table table-bordered mb-0 table-striped">
                                                <thead class="bg-success white">  
                                                    <tr>
                                                        <th>ID Seleksi</th>
                                                        <th>Pendaftaran</th>
                                                        <th>Th Ajaran</th>
                                                        <th>Nama Lengkap</th>
                                                        <th>Tgl Register</th>
                                                        <th>Keterangan</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead> 

                                                <tbody>` 
                                                    $.each(data.seleksi, function(k, v){
                                                        html += `
                                                        <tr>
                                                            <td>${v.id_seleksi}</td>
                                                            <td>${v.pendaftar.id_pendaftar}</td>
                                                            <td>${v.pendaftar.kd_ta}</td>
                                                            <td>${v.pendaftar.nama_lengkap}</td>
                                                            <td>${v.pendaftar.tgl_register}</td>
                                                            <td>${v.keterangan}</td>
                                                            <td>`

                                                            if (v.status_seleksi === "Proses") {
                                                                html += `<div class="btn-group">
                                                                            <button type="button" class="btn btn-info round btn-min-width box-shadow-2 btn-glow" id="btn_terima" data-id="${v.id_seleksi}">Hadir</button>
                                                                            <button type="button" class="btn btn-danger round btn-min-width box-shadow-2" data-id="${v.id_seleksi}" id="btn_tolak">Tidak Hadir</button>
                                                                        </div>
                                                                        `
                                                            } else if (v.status_seleksi === "Hadir"){
                                                                html += `<a href="#/">Lihat</a>`
                                                            } else {
                                                                html += `Ditolak`
                                                            }
                                                    html +=`</td>
                                                        </tr>
                                                        `
                                                    });
                                                html += `</tbody>
                                            </table>
                        </div>
                    </div>
                `
              

                $('#content_seleksi').html(html)
            },

            renderNoData: function(){
                console.log('No Data');
            },

            renderJadwal: function (data) {
                var html = ' <option value="">--- Pilih ---</option>';
                
                $.each(data, function(k, v){
                      html +=`
                            <option value="${v.id_jadwal}">${v.id_jadwal}</option>
                        `
                })
              $('#id_jadwal').html(html);
            }
        }

    })()

 var loadData = (function(UI){

        var ID_JADWAL = location.hash.substr(10);

        var dataSeleksi = function(){
            // alert(ID_JADWAL)
            $.ajax({
                url: `<?= base_url('api/seleksi/show/'); ?>${auth.token}?id_jadwal=${ID_JADWAL}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    if(response.status === 200){
                        if(response.data.length !== 1){
                            UI.renderNoData();
                        } else {
                            $.each(response.data, function(k, v){
                                UI.renderSeleksi(v);
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
                dataSeleksi();
                tolakSeleksi();
            }
        }

    })(renderUI)

    $(document).ready(function(){
        loadData.init();
    })
 

</script>