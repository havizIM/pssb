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
                        <h1 class="text-bold-600">Hasil Seleksi</h1>
                </div>
            </div>

<div id="content_hasil"></div>

</section>
<script>
 var renderUI = (function(){
        
        return {
            renderHasil: function(data){
                var html = '';
                html += `
                    <div class="row">
                        <div class="col-md-12">

                        <div class="alert bg-info alert-icon-left mb-2" role="alert">
                          <span class="alert-icon"><i class="la la-check"></i></span>
                          <strong>Pengumuman!</strong>
                          <p>Bagi calon siswa/siswi yang menerima hasil Lulus seleksi diharapkan mendaftar ulang. Agar dapat segera diproses lebih lanjut dan mendapatkan NIS dari MTS AR-Rizkan</p>
                        </div>

                        <div class="card">
                            <div class="card-content collpase show">
                                <div class="card-body">
                                  <form class="form">
                                    <div class="form-body">
                                    <h4 class="form-section"><i class="ft-check-circle"></i> Hasil Seleksi Tahun Ajaran ${data.kd_ta}</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                              <table class="table">
                                                <thead>
                                                  <tr>
                                                    <th>ID Seleksi</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Nilai</th>
                                                    <th>Hasil Seleksi</th>
                                                  </tr>
                                                </thead>
                                                <tbody>`

                                                if(data.peserta.length === 0){
                                                  html += `
                                                    <tr>
                                                      <td colspan="5"><center>Tidak ada peserta yang diseleksi</center></td>
                                                    </tr>
                                                  `
                                                } else {
                                                  $.each(data.peserta, function(k, v){
                                                    html += `
                                                      <tr>
                                                        <td>${v.id_seleksi}</td>
                                                        <td>${v.pendaftar.nama_lengkap}</td>
                                                        <td>${v.pendaftar.jenis_kelamin}</td>
                                                        <td><span class="${v.hasil === 'Lulus' ? 'text-success' : 'text-danger'}">${v.rate}</span></td>
                                                        <td><span class="${v.hasil === 'Lulus' ? 'text-success' : 'text-danger'}">${v.hasil}</span></td>
                                                      </tr>
                                                    `
                                                  })
                                                }
                                                
                  html +=
                                                `</tbody>
                                              </table>
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
              

                $('#content_hasil').html(html)
            },

            renderNoData: function(){
              var html = "";

               html += `
                <div class="container">
                  <div class="row">
                    <div class="col-md-12 col-xs-12 col-lg-12">
                      <div class="card text-white bg-grey text-center border-0 box-shadow-0">
                          <div class="card-content">
                            <div class="card-body">
                              <h1 class="card-title fz text-white">Tidak ada hasil seleksi</h1>
                              <p class="card-text" style="font-size: 1.2rem;">Data tidak tersedia, Silahkan kembali ke halaman utama</p>
                              <img class="card-img-top" src="<?= base_url('assets') ?>/app-assets/images/home/no-data.svg" alt="Card image cap">
                            </div>
                          </div>
                        </div>      
                    </div>
                  </div>
                </div>
              `
              $('#content_hasil').html(html);
            }
        }

    })()

 var loadData = (function(UI){

        var dataHasil = function(){
            $.ajax({
                url: `<?= base_url('public/hasil/show/'); ?>`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    if(response.status === 200){
                        if(response.data.length !== 1){
                            UI.renderNoData();
                        } else {
                            $.each(response.data, function(k, v){
                                UI.renderHasil(v);
                            })
                        }
                    } 
                },
                error: function(err){
                    // location.hash = '#/home'
                }
            }) 
        }
       
        return {
            init : function(){
                dataHasil();
            }
        }

    })(renderUI)

    $(document).ready(function(){
        loadData.init();
    })
 

</script>