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
                    <th>Nama Kriteria</th>
                    <th>Jumlah Subkriteria</th>
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
        <h3 class="modal-title" id="myModalLabel35"> Detail Kriteria</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group">
          <input type="hidden" name="id_kriteria" id="id_kriteria">
        </div>

        <div class="form-group">
          <label>Nama Kriteria</label><br>
          <input type="text" class="form-control" name="nama_kriteria" id="detail_nama_kriteria" readonly>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Subkriteria</h4>
              </div>
              <div class="card-content">
                <div class="card-body card-dashboard">
                  <table class="table table-striped" id="t_subkriteria">
                    <thead>
                      <tr>
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
        {"data": 'jml_subkriteria'},
        {"data": null, 'render': function(data, type, row){
          return `<button type="button" class="btn btn-sm btn-default" id="detail_kriteria" data-id="${row.id_kriteria}"><i class="la la-eye"></i></button>`
          }
        }
      ],
      order: [[0, 'desc']]
    })

    $(document).on('click', '#detail_kriteria', function(){
      var id_kriteria = $(this).attr('data-id')

      $.ajax({
        url: `<?= base_url('api/kriteria/detail/') ?>${auth.token}?id_kriteria=${id_kriteria}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(response){
          $.each(response.data, function(k, v){
            $('#modal_detail').modal('show')
            $('#id_kriteria').val(v.id_kriteria)
            $('#detail_nama_kriteria').val(v.nama_kriteria)

            var html = ''

            $.each(v.subkriteria, function(k1, v1){
              html+=`<tr id="baris${v1.id_subkriteria}">`

              html+=`<td><input type="text" class="form-control" value="${v1.nama_subkriteria}" name="nama_subkriteria[]" placeholder="Nama Subkriteria" readonly></td>`
              html+=`<td><input type="text" class="form-control" value="${v1.bobot}" name="bobot" placeholder="Bobot" readonly></td>`
              html+=`</tr>`

              $('#t_subkriteria').append(html)
            })
          })
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
