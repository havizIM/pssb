<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Tahun Ajaran</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Tahun Ajaran</li>
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
            <h4 class="card-title">Data Tahun Ajaran</h4>
          </div>
          <div class="card-content">
            <div class="card-body card-dashboard">
              <table class="table table-striped" id="t_tahun_ajaran">
                <thead>
                  <tr>
                    <th>Tgl. Input</th>
                    <th>Tahun Ajaran</th>
                    <th>Tahun Awal Ajaran</th>
                    <th>Tahun Akhir Ajaran</th>
                    <th>Tgl. Awal Ajaran</th>
                    <th>Tgl. Akhir Ajaran</th>
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
          return `<button type="button" class="btn btn-sm btn-default" id="detail_tahun_ajaran" data-id="${row.kd_ta}"><i class="la la-eye"></i></button>`
          }
        }
      ],
      order: [[1, 'desc']]
    })

    var pusher = new Pusher('f6a967b44e507048ffa7', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe('pssb');
    channel.bind('tahun_ajaran', function(data) {
      table.ajax.reload()
    });

  })

</script>
