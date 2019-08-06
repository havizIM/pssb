<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Laporan Hasil Seleksi </h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Laporan Hasil Seleksi</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="content-body">
  <section>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Filter Laporan Hasil Seleksi</h4>
          </div>
          <div class="card-content">
            <div class="card-body card-dashboard">
              <form id="form_laporan">
                <div class="form-group">
                  <label for="">Pilih Tahun Ajaran</label>
                  <select name="kd_ta" id="kd_ta" class="form-control">

                  </select>
                </div>
                <div class="form-group">
                  <button class="btn btn-md btn-info btn-block" id="submit_lap">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div id="content_laporan">
    
</div>

<script>
  var laporanHasilView = (() => {
    return {
      renderTahun: (data) => {
        var html = '<option value="">- Pilih Tahun Ajaran -</option>';

        $.each(data, function(k, v){
          if(v.status === 'Valid'){
             html += `
                <option value="${v.kd_ta}">${v.kd_ta}</option>
              `
          }
        })

        $('#kd_ta').html(html);
      },
      renderLaporan: (data) => {
        var html = '';
        var kd_ta = $('#kd_ta').val();

        html += `
            <section class="card" id="printAble">
              <div id="invoice-template" class="card-body">
                <div id="invoice-company-details" class="row">
                  <div class="col-md-6 col-sm-12 text-md-left">
                    <div class="media">
                      <img src="<?= base_url('assets') ?>/app-assets/images/home/logo_test.png" style="height: 100px" alt="company logo" class="" />
                      <div class="media-body">
                        <ul class="ml-2 px-0 list-unstyled">
                          <li class="text-bold-800"><b>MTS AR-Rizkan</b></li>
                          <li>Maja Lebak Banten</li>
                          <li>Telp. 08568955555</li>
                          <li>Email. rera.hayati1994@gmail.com</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12 text-center text-md-right">
                    <h2>Laporan Hasil Seleksi</h2>
                    <p class="pb-3">Tahun Ajaran ${kd_ta}</p>
                  </div>
                </div>
                <div id="invoice-items-details" class="pt-2">
                  <div class="row">
                    <div class="table-responsive col-sm-12">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>ID Seleksi</th>
                            <th>Nama Peserta</th>
                            <th>Jenis Kelamin</th>
                            <th>Hasil Seleksi</th>
                            <th>Tgl Pendaftaran</th>
                          </tr>
                        </thead>
                        <tbody>`
                        
                         var no = 1;
                         var total_lulus = 0;
                         var total_tlulus = 0;
                         $.each(data.peserta, function(k, v){
                           if(v.hasil === 'Lulus'){
                            total_lulus++;
                           }

                           if(v.hasil === 'Tidak Lulus'){
                            total_tlulus++;
                           }

                           html += `
                             <tr>
                                <td>${no++}</td>
                                <td>${v.id_seleksi}</td>
                                <td>${v.pendaftar.nama_lengkap}</td>
                                <td>${v.pendaftar.jenis_kelamin}</td>
                                <td>${v.hasil}</td>
                                <td>${v.pendaftar.tgl_register}</td>
                              </tr>
                           `
                         })

        html += 
                        `</tbody>
                      </table>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-md-5 col-sm-12">
                      <br><br>
                      <p class="lead">Total Pendaftar</p>
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
                            <tr>
                              <td>Total Diterima</td>
                              <td class="text-right">${total_lulus}</td>
                            </tr>
                            <tr>
                              <td>Total Ditolak</td>
                              <td class="text-right">${total_tlulus}</td>
                            </tr>
                            <tr class="bg-grey bg-lighten-4">
                              <td class="text-bold-800">Total Pendaftar</td>
                              <td class="text-bold-800 text-right">${data.peserta.length}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <section class="card">
              <button class="btn btn-md btn-success" id="print"><i class="la la-print"></i> Print</button>
            </section>
        `

        $('#content_laporan').html(html);
      }
    }
  })();

  var laporanHasilController = ((UI) => {

    var getTahun = () => {
      $.ajax({
        url: `<?= base_url('api/tahun_ajaran/show/'); ?>${auth.token}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(res){
          if(res.status === 200){
            UI.renderTahun(res.data)
          }
        },
        error: function(err){ 
          alert('Tidak dapat mengakses server');
        }
      })
    }

    var submitLaporan = () => {
      $('#form_laporan').on('submit', function(e){
        e.preventDefault();

        var kd_ta = $('#kd_ta').val();

        if(kd_ta === ''){
          Swal.fire({
            position: 'center',
            type: 'warning',
            title: 'Silahkan pilih Tahun Ajaran',
            showConfirmButton: false,
            timer: 1500
          });
        } else {
          $.ajax({
            url: `<?= base_url('api/hasil/show/'); ?>${auth.token}?kd_ta=${kd_ta}`,
            type: 'GET',
            dataType: 'JSON',
            beforeSend: function(){
              $('#submit_lap').html('Loading...');
            },
            success: function(res){
              if(res.status === 200){
                $.each(res.data, function(k, v){
                  UI.renderLaporan(v);
                })
              } else {
                Swal.fire({
                  position: 'center',
                  type: 'warning',
                  title: 'Tidak dapat mengakses server',
                  showConfirmButton: false,
                  timer: 1500
                });
              }

              $('#submit_lap').html('Submit');
            },
            error: function(err){
              $('#submit_lap').html('Submit');
            }
          })
        }
      })
    }

    var printLap = () => {
      $(document).on('click', '#print', function(){
          var mode = 'iframe'; //popup
          var close = mode == "popup";
          var options = {
              mode: mode,
              popClose: close
          };

          $('#printAble').printArea(options);
      })
    }

    return {
      init: () => {
        getTahun();
        submitLaporan();
        printLap();
      }
    }
  })(laporanHasilView);

  $(document).ready(function(){
    laporanHasilController.init();
  })
  

</script>