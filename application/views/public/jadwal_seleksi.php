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
.icon i {
    margin-left: 10px;
    position: relative;
    top: 2px;
}

.card .card-title.fz {
 font-size: 2.12rem !important;
}

.bg-grey {
  background-color: #6b6f826b !important;
}
</style>
<section id="sizing">
         <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
                <h1 class="text-bold-600">Jadwal Seleksi</h1>
          </div>
        </div>

<div id="content_seleksi">

</div>
</section>
<script>
 var renderUI = (function(){
        
        return {
            renderJadwalSeleksi: function(data){
                 var html = '<div class="row">';

                 if(data.length === 0){
                      html += `
                        <div class="container">
                          <div class="row">
                            <div class="col-md-12 col-xs-12 col-lg-12">
                              <div class="card text-white bg-grey text-center border-0 box-shadow-0">
                                  <div class="card-content">
                                    <div class="card-body">
                                      <h1 class="card-title fz text-white">Tidak ada jadwal</h1>
                                      <p class="card-text" style="font-size: 1.2rem;">Data tidak tersedia, Silahkan kembali ke halaman utama</p>
                                      <img class="card-img-top" src="<?= base_url('assets') ?>/app-assets/images/home/no-data.svg" alt="Card image cap">
                                    </div>
                                  </div>
                                </div>      
                            </div>
                          </div>
                        </div>
                      `
                 } else {
                    $.each(data, function(k, v){
                   html += `
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
                                                      <div class="">${v.id_jadwal}</div>
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
                                                      <div class="">${v.kd_ta}</div>
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
                                                      <div class="">${v.status}</div>
                                              </div>
                                          </div>
                                          </div>
                                      </div>

                                      <h4 class="form-section"><i class="la la-bars"></i> Detail</h4>
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <div class="">
                                                      <dt class="">Lokasi</dt>
                                                  </div>
                                              </div>
                                              <div class="col-md-6">
                                                  <div class="form-group">
                                                      <div class="">
                                                          <div class="">${v.lokasi}</div>
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
                                                      <div class="">${v.keterangan_jadwal}</div>
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
                                                          <div class="">${v.deskripsi_jadwal}</div>
                                                  </div>
                                              </div>
                                              </div>
                                          </div>

                                      <div class="form-group">
                                          <div class="row">
                                              <div class="col-md-6">
                                              <div class="">
                                                  <dt class="">Tanggal Seleksi</dt>
                                              </div>
                                              </div>
                                              <div class="col-md-6">
                                              <div class="form-group">
                                                  <div class="">
                                                          <div class="">${v.tgl_pelaksanaan}</div>
                                                  </div>
                                              </div>
                                              </div>
                                          </div>
                                      </div>
                                      
                                      </div>
                                  </form>
                                  <a href="#/jadwal_seleksi/${v.id_jadwal}" class="btn btn-info btn-min-width mr-1 mb-2 float-right"> Lihat Selengkapnya <i class="la la-arrow-circle-right"></i></a>
                                  </div>
                              </div>
                            </div>
                      </div>`
                });
                 }
                 

                html += `</div>`

                $('#content_seleksi').html(html)
               

            }

        }

    })()

 var loadData = (function(UI){


        var dataJadwalSeleksi = function(){
            $.ajax({
                url: `<?= base_url('public/jadwal/show/'); ?>`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    if(response.status === 200){
                       UI.renderJadwalSeleksi(response.data)
                    } 
                },
                error: function(err){
                    location.hash = '#/jadwal_seleksi'
                }
            }) 
        }

      
       
        return {
            init : function(){
                dataJadwalSeleksi();
            }
        }

    })(renderUI)

    $(document).ready(function(){
        loadData.init();
    })
 

</script>