<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Ubah Tahun Ajaran</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="#/jadwal">Jadwal</a></li>
          <li class="breadcrumb-item active">Ubah Jadwal</li>
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
            <h4 class="card-title">Ubah Jadwal</h4>
          </div>
          <div class="card-content">
            <div class="card-body card-dashboard">
              <form class="form-horizontal" id="form_edit">
                <div class="form-group">
                  <label>Pilih Tahun Ajaran</label>
                  <div class="input-group">
                    <input type="hidden" name="kd_ta" class="kd_ta">
                    <input type="text" class="form-control kd_ta" name="kd_ta" placeholder="-- Pilih Tahun Ajaran --" readonly>
                    <div class="input-group-append">
                      <span class="input-group-text bg-info text-white" id="modal_tahun_ajaran" style="cursor: pointer;">Cari</span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="keterangan_jadwal" id="keterangan" placeholder="Keterangan">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="deskripsi_jadwal" id="deskripsi" placeholder="Deskripsi">
                </div>

                <div class="form-group">
                  <input type="date" class="form-control" name="tgl_pelaksanaan" id="tgl_pelaksanaan" placeholder="Tanggal Pelaksanaan">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi">
                </div>

                <button type="submit" id="submit_edit" class="btn btn-indigo float-md-right">Simpan</button>
                <br><br>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade text-left" id="lookup_tahun_ajaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel35">Pilih Tahun Ajaran</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body form-group">
        <div class="table-responsive m-t-40">
          <table class="table table-striped table-hover" id="t_tahun_ajaran">
            <thead>
              <th>Tgl. Input</th>
              <th>Tahun Ajaran</th>
              <th>Tahun Awal Ajaran</th>
              <th>Tahun Akhir Ajaran</th>
              <th>Tgl. Awal Ajaran</th>
              <th>Tgl. Akhir Ajaran</th>
              <th>Status</th>
              <th></th>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    var session = localStorage.getItem('pssb');
    var auth = JSON.parse(session);
    var id_jadwal = location.hash.substr(14);

    var table = $('#t_tahun_ajaran').DataTable({
      columnDefs: [{
        targets: [0, 2, 3, 4, 5, 6, 7],
        searchable: false
      }, {
        targets: [7],
        orderable: false
      }],
      autoWidth: false,
      language: {
        search: 'Cari Tahun Ajaran: _INPUT_',
        lengthMenu: 'Tampilkan: _MENU_',
        paginate: {'next': 'Berikutnya', 'previous': 'Sebelumnya'},
        info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ Tahun Ajaran',
        zeroRecords: 'Tahun Ajaran tidak ditemukan',
        infoEmpty: 'Menampilkan 0 sampai 0 dari _TOTAL_ Tahun Ajaran',
        loadingRecords: '<i class="la la-spin la-spinner"></i>',
        processing: 'Memuat....',
        infoFiltered: ''
      },
      responsive: true,
      processing: true,
      ajax: '<?= base_url('api/tahun_ajaran/show/'); ?>'+auth.token,
      columns: [
        {"data": 'tgl_input'},
        {"data": 'kd_ta'},
        {"data": 'tahun_awal'},
        {"data": 'tahun_akhir'},
        {"data": 'tgl_awal'},
        {"data": 'tgl_akhir'},
        {"data": 'status'},
        {"data": null, 'render': function(data, type, row){
          return `<button type="button" class="btn btn-sm btn-info" id="pilih_tahun_ajaran" data-id="${row.kd_ta}">Pilih</button>`
          }
        }
      ],
      order: [[1, 'desc']]
    })

    $('#modal_tahun_ajaran').on('click', function(){
      $('#lookup_tahun_ajaran').modal('show')
    })

    $('#t_tahun_ajaran').on('click', '#pilih_tahun_ajaran', function(){
      var kd_ta = $(this).attr('data-id')

      $('.kd_ta').val(kd_ta)

      $('#lookup_tahun_ajaran').modal('hide')
    })

    $.ajax({
      url: `<?= base_url('api/jadwal/show/') ?>${auth.token}?id_jadwal=${id_jadwal}`,
      type: 'GET',
      dataType: 'JSON',
      success: function(response){
        $.each(response.data, function(k, v){
          $('.kd_ta').val(v.kd_ta)
          $('#keterangan').val(v.keterangan_jadwal)
          $('#deskripsi').val(v.deskripsi_jadwal)
          $('#tgl_pelaksanaan').val(v.tgl_pelaksanaan)
          $('#lokasi').val(v.lokasi)
        })
      }
    })

    $('#form_edit').on('submit', function(e){
      e.preventDefault();

      var kd_ta = $('.kd_ta').val()
      var keterangan = $('#keterangan').val()
      var deskripsi = $('#deskripsi').val()
      var tgl_pelaksanaan = $('#tgl_pelaksanaan').val()
      var lokasi = $('#lokasi').val()

      if(kd_ta === '' || keterangan === '' || deskripsi === '' || tgl_pelaksanaan === '' || lokasi === ''){
        Swal.fire({
          position: 'center',
          type: 'warning',
          title: 'Data tidak boleh kosong',
          showConfirmButton: false,
          timer: 1500
        })
      } else {
        $.ajax({
          url: `<?= base_url('api/jadwal/edit/') ?>${auth.token}?id_jadwal=${id_jadwal}`,
          type: 'POST',
          dataType: 'JSON',
          beforeSend: function(){
            $('#submit_edit').addClass('disabled').attr('disabled', 'disabled').html('<i class="la la-spin la-spinner"></i>');
          },
          data: $(this).serialize(),
          success: function(response){
            if(response.status === 200){
              Swal.fire({
                position: 'center',
                type: 'success',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
              })
              $('#form_edit')[0].reset();
              location.hash = '#/jadwal';
            } else {
              Swal.fire({
                position: 'center',
                type: 'error',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
              });
              $('#submit_edit').removeClass('disabled').removeAttr('disabled', 'disabled').text('Simpan');
            }
          },
          error: function(){
            Swal.fire({
              position: 'center',
              type: 'warning',
              title: 'Tidak dapat mengakses server',
              showConfirmButton: false,
              timer: 1500
            })
            $('#submit_edit').removeClass('disabled').removeAttr('disabled', 'disabled').text('Simpan')
          }
        })
      }
    })

  })

</script>
