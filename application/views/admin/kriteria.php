<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Kriteria</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Kriteria</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="content-header-right col-md-6 col-12">
    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
      <a href="#/add_kriteria"><button class="btn btn-info round box-shadow-2 px-2" type="button"><i class="ft-plus icon-left"></i> Tambah Baru</button></a>
    </div>
  </div>
</div>
<div class="content-body">
  <section>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Data Kriteria</h4>
          </div>
          <div class="card-content">
            <div class="card-body card-dashboard">
              <table class="table table-striped" id="t_kriteria">
                <thead>
                  <tr>
                    <th>Kriteria</th>
                    <th>Subkriteria (Bobot)</th>
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
              <h4>Kriteria</h4>              
             <div class="table-responsive">
              <table class="table table-striped" id="det_kriteria"></table>
            </div>
            <br><br>
          </div>
          <div class="col-12">
            <h4>Subkriteria</h4>
            <div class="table-responsive">
              <table class="table table-striped" id="det_subkriteria">
                <thead>
                  <tr>
                    <th>ID Subkriteria</th>
                    <th>Nama Subkriteria</th>
                    <th>Bobot</th>
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

    var table = $('#t_kriteria').DataTable({
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
        info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ Kriteria',
        zeroRecords: 'Kriteria tidak ditemukan',
        infoEmpty: 'Menampilkan 0 sampai 0 dari _TOTAL_ Kriteria',
        loadingRecords: '<i class="la la-spin la-spinner"></i>',
        processing: 'Memuat....',
        infoFiltered: ''
      },
      responsive: true,
      processing: true,
      ajax: '<?= base_url('api/kriteria/show/'); ?>'+auth.token,
      columns: [
        {"data": 'nama_kriteria'},
        {"data": null, 'render': function(data, type, row){

            var subkriteria = '';
            $.each(row.subkriteria, function(k, v){
              subkriteria += `${v.nama_subkriteria} (${v.bobot_sub})<br/>`;
            })

            return subkriteria;
          
          }
        },
        {"data": null, 'render': function(data, type, row){
          return `<a href="#/edit_kriteria/${row.id_kriteria}" class="btn btn-sm btn-info"><i class="la la-edit"></i></a> <button type="button" class="btn btn-sm btn-default" id="detail_kriteria" data-id="${row.id_kriteria}"><i class="la la-eye"></i></button> <button type="button" class="btn btn-sm btn-danger" id="hapus_kriteria" data-id="${row.id_kriteria}" data-nama="${row.nama_kriteria}"><i class="la la-trash"></i></button>`
          }
        },
      ],
      order: [[0, 'desc']]
    })

    $(document).on('click', '#hapus_kriteria', function(){
      var id_kriteria = $(this).attr('data-id');
      var nama_kriteria = $(this).attr('data-nama')

      Swal.fire({
        title: `Apa Anda yakin ingin menghapus ${nama_kriteria}?`,
        text: "Kriteria akan terhapus secara permanen",
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
            url: `<?= base_url('api/kriteria/delete/'); ?>${auth.token}?id_kriteria=${id_kriteria}`,
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

    $(document).on('click', '#detail_kriteria', function(){
      var id_kriteria = $(this).attr('data-id')

      $.ajax({
        url: `<?= base_url('api/kriteria/show/') ?>${auth.token}?id_kriteria=${id_kriteria}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(response){
          var detail_kriteria = ``;
          var detail_subkriteria = ``;

          $.each(response.data, function(k, v){

            detail_kriteria += `
              <tr>
                <th>ID Kriteria</th>
                <td>${v.id_kriteria}</td>
              </tr>
              <tr>
                <th>Nama Kriteria</th>
                <td>${v.nama_kriteria}</td>
              </tr>
            `;

            $.each(v.subkriteria, function(k1, v1){
              detail_subkriteria += `
                <tr>
                  <td>${v1.id_subkriteria}</td>
                  <td>${v1.nama_subkriteria}</td>
                  <td>${v1.bobot_sub}</td>
                </tr>
              `;
            })
          })

          $('#det_kriteria').html(detail_kriteria);
          $('#det_subkriteria tbody').html(detail_subkriteria);
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
    channel.bind('kriteria', function(data) {
      table.ajax.reload()
    });

  })

</script>
