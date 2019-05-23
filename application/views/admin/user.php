<div class="az-content-header d-block d-md-flex">
  <div class="row">
    <div class="">
      <h2 class="az-content-title mg-b-5 mg-b-lg-8">User</h2>
    </div>
    <div class="az-content-breadcrumb" style="margin-left: 10px; margin-top: -6px;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">User</li>
      </ol>
    </div>

    <div class="btn-add">
      <button type="button" class="btn btn-info" id="btn_add" name="button"><i class="fa fa-plus-circle"></i> Tambah Baru</button>
    </div>
  </div>
</div><!-- az-content-header -->
<div class="az-content-body">
  <table id="t_user" class="table table-hovered responsive" style="width: 100%;">
    <thead>
      <tr>
        <th>Tgl Registrasi</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Level</th>
        <th>Foto</th>
        <th>Status</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

    </tbody>
  </table>
</div><!-- az-content-body -->

<div id="modal_add" class="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-content-demo">
      <div class="modal-header">
        <h6 class="modal-title">Tambah User</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" id="form_add">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
          </div>

          <div class="form-group">
            <select class="form-control" id="level" name="level">
              <option value="">-- Pilih Level --</option>
              <option value="Guru">Guru</option>
              <option value="Panitia">Panitia</option>
              <option value="kepsek">Kepsek</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="submit_add" class="btn btn-indigo">Simpan</button>
        </div>
      </form>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div id="modal_edit" class="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-content-demo">
      <div class="modal-header">
        <h6 class="modal-title">Tambah User</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" id="form_edit">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="edit_nama" name="nama" placeholder="Nama">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="edit_username" name="username" placeholder="Username">
          </div>

          <div class="form-group">
            <select class="form-control" id="edit_level" name="level">
              <option value="">-- Pilih Level --</option>
              <option value="Guru">Guru</option>
              <option value="Panitia">Panitia</option>
              <option value="kepsek">Kepsek</option>
            </select>
          </div>

          <div class="form-group">
            <select class="form-control" id="status" name="status">
              <option value="">-- Pilih Status --</option>
              <option value="Aktif">Aktif</option>
              <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="nip" id="edit_nip">
          <button type="submit" id="submit_edit" class="btn btn-indigo">Simpan</button>
        </div>
      </form>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->

<script type="text/javascript">

  $(document).ready(function(){

    var table = $('#t_user').DataTable({
      columnDefs: [{
        targets: [0, 1, 3, 4, 5, 6, 7],
        searchable: false
      }, {
        targets: [7],
        orderable: false
      }],
      autoWidth: false,
      language: {
        search: 'Cari Nama: _INPUT_',
        lengthMenu: 'Tampilkan: _MENU_',
        paginate: {'next': 'Next', 'previous': 'Prev'},
        info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ User',
        zeroRecords: 'User tidak ditemukan',
        infoEmpty: 'Menampilkan 0 sampai 0 dari _TOTAL_ User',
        loadingRecords: '<i class="fa fa-refresh fa-spin"></i>',
        processing: 'Memuat....',
        infoFiltered: ''
      },
      responsive: true,
      processing: true,
      ajax: '<?= base_url('api/user/show/'); ?>'+auth.token,
      columns: [
        {"data": 'tgl_registrasi'},
        {"data": 'nip'},
        {"data": 'nama'},
        {"data": 'username'},
        {"data": 'level'},
        {"data": 'foto'},
        {"data": 'status'},
        {"data": null, 'render': function(data, type, row){
          return `<button class="btn btn-info" id="edit_user" data-id="${row.nip}"><i class="far fa-edit"></i></button> <button class="btn btn-danger" style="margin-left: 5px;" id="hapus_user" data-id="${row.nip}"><i class="fas fa-trash"></i></button>`
          }
        }
      ],
      order: [[0, 'desc']]
    })
  })

  $('#btn_add').on('click', function(){
    $('#modal_add').modal('show')
  })

  $('#form_add').on('submit', function(e){
    e.preventDefault()

    var nip = $('#nip').val()
    var nama = $('#nama').val()
    var username = $('#username').val()
    var level = $('#level').val()

    if(nip === '' || nama === '' || username === '' || level === ''){
      Swal.fire({
        position: 'center',
        type: 'warning',
        title: 'Data tidak boleh kosong',
        showConfirmButton: false,
        timer: 1500
      });
    } else {
      $.ajax({
        url: '<?= base_url('api/user/add/') ?>'+auth.token,
        type: 'POST',
        dataType: 'JSON',
        beforeSend: function(){
          $('#submit_add').addClass('disabled').attr('disabled', 'disabled').html('<i class="fa fa-fw fa-spinner fa-spin"></i>');
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
            });
            $('#modal_add').modal('hide')
            $('#form_add')[0].reset()
            table.ajax.reload()
          } else {
            Swal.fire({
              position: 'center',
              type: 'warning',
              title: response.message,
              showConfirmButton: false,
              timer: 1500
            })
          }
          $('#submit_add').removeClass('disabled').removeAttr('disabled', 'disabled').text('Simpan')
        },
        error: function(){
          Swal.fire({
            position: 'center',
            type: 'warning',
            title: 'Tidak dapat mengakses server',
            showConfirmButton: false,
            timer: 1500
          })
          $('#submit_add').removeClass('disabled').removeAttr('disabled', 'disabled').text('Simpan')
        }
      })
    }

    $(document).on('click', '#edit_user', function(){
      var nip = $(this).attr('data-id')

      $.ajax({
        url: `<?= base_url('api/user/show/') ?>${auth.token}?nip=${nip}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(response){
          $.each(response.data, function(k, v){
            $('#modal_edit').modal('show')
            $('#edit_nama').val(v.nama)
            $('#edit_username').val(v.username)
            $('#edit_level').val(v.level)
            $('#status').val(v.status)
            $('#edit_nip').val(v.nip)
          })
        },
        error: function(){
          Swal.fire({
            position: 'center',
            type: 'warning',
            title: response.message,
            showConfirmButton: false,
            timer: 1500
          });
        }
      })
    })

    $('#form_edit').on('submit', function(e){
      e.preventDefault()

      var nama = $('#edit_nama').val()
      var username = $('#edit_username').val()
      var level = $('#edit_level').val()
      var status = $('#status').val()

      if(nama === '' || username === '' || level === '' || status === ''){
        Swal.fire({
          position: 'center',
          type: 'warning',
          title: 'Data tidak boleh kosong',
          showConfirmButton: false,
          timer: 1500
        });
      } else {
        $.ajax({
          url: `<?= base_url('api/user/edit/') ?>${auth.token}?nip=${nip}`,
          type: 'POST',
          dataType: 'JSON',
          beforeSend: function(){
            $('#submit_edit').addClass('disabled').attr('disabled', 'disabled').html('<i class="fa fa-fw fa-spinner fa-spin"></i>')
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
              $('#modal_edit').modal('hide')
              $('#form_edit')[0].reset()
            } else {
              Swal.fire({
                position: 'center',
                type: 'warning',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
              })
            }
            $('#submit_edit').removeClass('disabled').removeAttr('disabled', 'disabled').text('Simpan')
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

    $(document).on('click', '#hapus_user', function(){
      var nip = $(this).attr('data-id');

      Swal.fire({
        title: 'Apa Anda yakin ingin menghapus ini?',
        text: "User akan terhapus secara permanen",
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
            url: `<?= base_url('api/user/delete/'); ?>${auth.token}?nip=${nip}`,
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

  })

</script>
