<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Tambah Tahun Ajaran</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="#/tahun_ajaran">Tahun Ajaran</a></li>
          <li class="breadcrumb-item active">Tambah Tahun Ajaran</li>
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
            <h4 class="card-title">Tambah Tahun Ajaran</h4>
          </div>
          <div class="card-content">
            <div class="card-body card-dashboard">
              <form class="form-horizontal" id="form_add">
                <div class="form-group">
                  <input type="number" class="form-control" name="tahun_awal" id="tahun_awal" placeholder="Tahun Awal">
                </div>

                <div class="form-group">
                  <input type="number" class="form-control" name="tahun_akhir" id="tahun_akhir" placeholder="Tahun Akhir">
                </div>

                <div class="form-group">
                  <input type="date" class="form-control" name="tgl_awal" id="tgl_awal" placeholder="Tanggal Awal">
                </div>

                <div class="form-group">
                  <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" placeholder="Tanggal Akhir">
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <h5>Pilih Kriteria</h5>
                      <table class="table table-striped" id="select_kriteria">
                        <thead>
                          <tr>
                            <th width="30%">Nama Kriteria</th>
                            <th width="20%">Tipe</th>
                            <th>Q</th>
                            <th>P</th>
                            <th><button type="button" class="btn btn-sm btn-info" id="modal_kriteria"> <i class="la la-plus"></i> </button> </th>
                          
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <button type="submit" id="submit_add" class="btn btn-indigo float-md-right">Tambah</button>
                <br><br>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade text-left" id="lookup_kriteria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel35"> Pilih Kriteria</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body form-group">
        <div class="table-responsive m-t-40">
          <table class="table table-striped table-hover" id="t_kriteria">
            <thead>
              <th>Nama Kriteria</th>
              <th>Jumlah Subkriteria</th>
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
          return `<button class="btn btn-info" id="pilih_kriteria" data-id="${row.id_kriteria}" data-nama="${row.nama_kriteria}"> Pilih</button>`
          }
        }
      ],
      order: [[0, 'desc']]
    })

    $('#modal_kriteria').on('click', function(){
      $('#lookup_kriteria').modal('show')
    })

    $('#t_kriteria').on('click', '#pilih_kriteria', function(){
      var id_kriteria = $(this).attr('data-id')
      var nama_kriteria = $(this).attr('data-nama')

      var html = `<tr id="baris${id_kriteria}">`

      html+=`<td>${nama_kriteria} <input type="hidden" name="id_kriteria[]" value="${id_kriteria}"></td>`
      html+=`<td><select class="form-control form-control-sm" name="tipe[]">
                  <option value=""></option>
                  <option value="Quasi">Quasi</option>
                  <option value="Level">Level</option>
                 </select>
              </td>`
      html+=`<td><input type="number" class="form-control form-control-sm" name="q[]" required></td>`
      html+=`<td><input type="number" class="form-control form-control-sm" name="p[]" required></td>`
      html+=`<td><button type="button" class="btn btn-danger remove" id="${id_kriteria}"><i class="la la-trash"></i></button></td>`
      html+=`</tr>`

      $('#select_kriteria tbody').append(html)
      $('#lookup_kriteria').modal('hide')
    })

    $(document).on('click', '.remove', function(){
      var id = $(this).attr('id')

      $('#baris'+id+'').remove()
    })

    $('#form_add').on('submit', function(e){
      e.preventDefault()

      var tahun_awal = $('#tahun_awal').val()
      var tahun_akhir = $('#tahun_akhir').val()
      var tgl_awal = $('#tgl_awal').val()
      var tgl_akhir = $('#tgl_akhir').val()
      var select_kriteria = $('#select_kriteria tbody tr').length

      if(tahun_awal === '' || tahun_akhir === '' || tgl_awal === '' || tgl_akhir === ''){
        Swal.fire({
          position: 'center',
          type: 'warning',
          title: 'Data tidak boleh kosong',
          showConfirmButton: false,
          timer: 1500
        });
      } else {
        if(select_kriteria<1) {
          Swal.fire({
            position: 'center',
            type: 'warning',
            title: 'Detail Kriteria tidak boleh kosong',
            showConfirmButton: false,
            timer: 1500
          });
       } else {
         $.ajax({
           url: '<?= base_url('api/tahun_ajaran/add/') ?>'+auth.token,
           type: 'POST',
           dataType: 'JSON',
           beforeSend: function(){
             $('#submit_add').addClass('disabled').attr('disabled', 'disabled').html('<i class="la la-spin la-spinner"></i>');
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
               $('#form_add')[0].reset();
               location.hash = '#/tahun_ajaran';
             } else {
               Swal.fire({
                 position: 'center',
                 type: 'error',
                 title: response.message,
                 showConfirmButton: false,
                 timer: 1500
               });
               $('#submit_add').removeClass('disabled').removeAttr('disabled', 'disabled').text('Tambah');
             }
           },
           error: function(err){
             Swal.fire({
               position: 'center',
               type: 'warning',
               title: 'Tidak dapat mengakses server',
               showConfirmButton: false,
               timer: 1500
             });
             $('#submit_add').removeClass('disabled').removeAttr('disabled', 'disabled').text('Tambah')
             console.log(err)
           }
         })
        }
      }
    })

  })

</script>
