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
             <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                        <h1 class="text-bold-600">Detail Jadwal Seleksi</h1>
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
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                <form class="form">
                                    <div class="form-body">
                                    <h4 class="form-section"><i class="ft-user"></i> Status</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="">
                                                <div class=""><b>ID Jadwal</b></div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                                <div class="">
                                                    <div class="">${data.id_jadwal}</div>
                                                </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="">
                                            <div class=""><b>Tahun Ajaran</b></div>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="">
                                                    <dd class="">${data.kd_ta}</dd>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="">
                                            <dt class="">Status</dt>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="">
                                                    <dd class="">${data.status}</dd>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    <h4 class="form-section"><i class="ft-check-circle"></i> Detail</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="">
                                                    <dt class="">Lokasi</dt>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="">
                                                        <dd class="">${data.lokasi}</dd>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="">
                                            <dt class="">Keterangan Jadwal</dt>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="">
                                                    <dd class="">${data.keterangan_jadwal}</dd>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <div class="">
                                                <dt class="">Deskripsi Jadwal</dt>
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="">
                                                        <dd class="">${data.deskripsi_jadwal}</dd>
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <div class="">
                                                <dt class="">Tanggal Input</dt>
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="">
                                                        <dd class="">${data.tgl_input}</dd>
                                                </div>
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
                                                    if(data.seleksi.length !== 0){
                                                        $.each(data.seleksi, function(k, v){
                                                            html += `
                                                            <tr>
                                                                <td>${v.id_seleksi}</td>
                                                                <td>${v.pendaftar.id_pendaftar}</td>
                                                                <td>${v.pendaftar.kd_ta}</td>
                                                                <td>${v.pendaftar.nama_lengkap}</td>
                                                                <td>${v.pendaftar.tgl_register}</td>
                                                                <td>${v.keterangan}</td>
                                                                <td>${v.status_seleksi}</td>
                                                            </tr>
                                                            `
                                                        });
                                                    } else {
                                                        html += `
                                                            <tr>
                                                                <td colspan="7"><center>Tidak ada peserta yang terdaftar</center></td>
                                                            </tr>
                                                        `;
                                                    }
                                                    
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

        var ID_JADWAL = location.hash.substr(17);

        var dataSeleksi = function(){
            // alert(ID_JADWAL)
            $.ajax({
                url: `<?= base_url('public/jadwal/show/'); ?>?id_jadwal=${ID_JADWAL}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    if(response.status === 200){
                        if(response.data.length !== 1){
                            UI.renderNoData();
                        } else {
                            $.each(response.data, function(k, v){
                                UI.renderSeleksi(v);
                            }) 
                        }
                    } 
                },
                error: function(err){
                    location.hash = '#/home'
                }
            }) 
        }
       
        return {
            init : function(){
                dataSeleksi();
            }
        }

    })(renderUI)

    $(document).ready(function(){
        loadData.init();
    })
 

</script>