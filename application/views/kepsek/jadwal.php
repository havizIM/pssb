<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Jadwal</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Jadwal</li>
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
            <h4 class="card-title">Data Jadwal</h4>
          </div>
          <div class="card-content">
            <div class="card-body card-dashboard">
              <table class="table table-striped" id="t_jadwal">
                <thead>
                  <tr>
                    <th>ID Jadwal</th>
                    <th>Tanggal Input</th>
                    <th>Tahun Ajaran</th>
                    <th>Keterangan</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Pelaksanaan</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th></th>
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

<script type="text/javascript">

  $(document).ready(function(){

    var session = localStorage.getItem('pssb');
    var auth = JSON.parse(session);

    var table = $('#t_jadwal').DataTable({
      columnDefs: [{
        targets: [0, 2, 3, 4, 5, 6,],
        searchable: false
      }],
      autoWidth: false,
      language: {
        search: 'Cari Jadwal: _INPUT_',
        lengthMenu: 'Tampilkan: _MENU_',
        paginate: {'next': 'Berikutnya', 'previous': 'Sebelumnya'},
        info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ Jadwal',
        zeroRecords: 'Jadwal tidak ditemukan',
        infoEmpty: 'Menampilkan 0 sampai 0 dari _TOTAL_ Jadwal',
        loadingRecords: '<i class="la la-spin la-spinner"></i>',
        processing: 'Memuat....',
        infoFiltered: ''
      },
      responsive: true,
      processing: true,
      ajax: '<?= base_url('api/jadwal/show/'); ?>'+auth.token,
      columns: [
        {"data": null, 'render': function(data, type, row){
                return `<a href="#/seleksi/${row.id_jadwal}">${row.id_jadwal}</a>`;
            }
        },
        {"data": 'tgl_input'},
        {"data": 'kd_ta'},
        {"data": 'keterangan_jadwal'},
        {"data": 'deskripsi_jadwal'},
        {"data": 'tgl_pelaksanaan'},
        {"data": 'lokasi'},
        {"data": 'status'}
      ],
      order: [[1, 'desc']]
    })

    var pusher = new Pusher('f6a967b44e507048ffa7', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe('pssb');
    channel.bind('jadwal', function(data) {
      table.ajax.reload()
    });

  })

</script>
