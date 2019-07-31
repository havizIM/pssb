<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Pendaftaran</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Pendaftaran</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="content-header-right col-md-6 col-12">
   
  </div>
</div>
<div class="content-body">
  <section>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Data pendaftaran</h4>
          </div>
          <div class="card-content">
            <div class="card-body card-dashboard">
              <table class="table table-striped" id="t_pendaftaran">
                <thead>
                  <tr>
                    <th>ID Pendaftaran</th>
                    <th>NISN</th>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Asal Sekolah</th>
                    <th>Tahun Ajaran</th>
                    <th>Status Pendaftaran</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade text-left" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel35"> Detail </h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-12">
              <h4>Pendaftaran</h4>              
             <div class="table-responsive">
              <table class="table table-striped" id="det_pendaftaran"></table>
            </div>
            <br><br>
          </div>
          <div class="col-12">
            <h4>Subpendaftaran</h4>
            <div class="table-responsive">
              <table class="table table-striped" id="det_subpendaftaran">
                <thead>
                  <tr>
                    <th>ID Pendaftaran</th>
                    <th>NISN</th>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Asal Sekolah</th>
                    <th>Tahun Ajaran</th>
                    <th>Status Pendaftaran</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    var session = localStorage.getItem('pssb');
    var auth = JSON.parse(session);

    var table = $('#t_pendaftaran').DataTable({
      columnDefs: [{
        targets: [1, 2],
        searchable: false
      }, {
        targets: [2],
        orderable: false
      }],
      autoWidth: false,
      language: {
        search: 'Cari Nama: _INPUT_',
        lengthMenu: 'Tampilkan: _MENU_',
        paginate: {'next': 'Berikutnya', 'previous': 'Sebelumnya'},
        info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ Pendaftaran',
        zeroRecords: 'Pendaftaran tidak ditemukan',
        infoEmpty: 'Menampilkan 0 sampai 0 dari _TOTAL_ Pendaftaran',
        loadingRecords: '<i class="la la-spin la-spinner"></i>',
        processing: 'Memuat....',
        infoFiltered: ''
      },
      responsive: true,
      processing: true,
      ajax: '<?= base_url('api/pendaftaran/show/') ?>'+auth.token,
      columns: [
        {"data": null, 'render': function(data, type, row){
                return `<a href="#/pendaftaran/${row.id_pendaftar}">${row.id_pendaftar}</a>`;
            }
        },
        {"data": 'nisn'},
        {"data": 'nik'},
        {"data": 'nama_lengkap'},
        {"data": 'jenis_kelamin'},
        {"data": 'agama'},
        {"data": 'asal_sekolah'},
        {"data": 'tahun_ajaran.kd_ta'},
        {"data": 'status_pendaftaran'},
      ],
      order: [[0, 'desc']]
    })

    $(document).on('click', '#hapus_pendaftaran', function(){
      var id_pendaftaran = $(this).attr('data-id');
      var nama_pendaftaran = $(this).attr('data-nama')

      Swal.fire({
        title: `Apa Anda yakin ingin menghapus ${nama_pendaftaran}?`,
        text: "pendaftaran akan terhapus secara permanen",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Saya yakin.',
        cancelButtonText: 'Batal',
        showLoaderOnConfirm: true
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: `<?= base_url('api/pendaftaran/delete/'); ?>${auth.token}?id_pendaftaran=${id_pendaftaran}`,
            type: 'GET',
            dataType: 'JSON',
            success: function(response){
              if(response.status === 200){
                Swal.fire({
                  position: 'center',
                  type: 'success',
                  title: response.message,
                  showConfirmButton: false,
                  timer: 1500
                });
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
            error: function(){
              Swal.fire({
                position: 'center',
                type: 'error',
                title: 'Tidak dapat mengakses server',
                showConfirmButton: false,
                timer: 1500
              });
            }
          });
        }
      })
    });

    $(document).on('click', '#detail_pendaftaran', function(){
      var id_pendaftaran = $(this).attr('data-id')

      $.ajax({
        url: `<?= base_url('api/pendaftaran/show/') ?>${auth.token}?id_pendaftaran=${id_pendaftaran}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(response){
          var detail_pendaftaran = ``;
          var detail_subpendaftaran = ``;

          $.each(response.data, function(k, v){

            detail_pendaftaran += `
              <tr>
                <th>ID pendaftaran</th>
                <td>${v.id_pendaftaran}</td>
              </tr>
              <tr>
                <th>Nama pendaftaran</th>
                <td>${v.nama_pendaftaran}</td>
              </tr>
              <tr>
                <th>Bobot</th>
                <td>${v.bobot_pendaftaran}</td>
              </tr>
            `;

            $.each(v.subpendaftaran, function(k1, v1){
              detail_subpendaftaran += `
                <tr>
                  <td>${v1.id_subpendaftaran}</td>
                  <td>${v1.nama_subpendaftaran}</td>
                  <td>${v1.bobot_sub}</td>
                </tr>
              `;
            })
          })

          $('#det_pendaftaran').html(detail_pendaftaran);
          $('#det_subpendaftaran tbody').html(detail_subpendaftaran);
          $('#modal_detail').modal('show');
        },
        error: function(){
          Swal.fire({
            position: 'center',
            type: 'warning',
            title: 'Tidak dapat mengakses server',
            showConfirmButton: false,
            timer: 1500
          });
        }
      })
    })

    var pusher = new Pusher('f6a967b44e507048ffa7', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe('pssb');
    channel.bind('pendaftaran', function(data) {
      table.ajax.reload()
    });

  })

</script>
