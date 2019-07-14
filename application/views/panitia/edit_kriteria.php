<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Ubah Kriteria</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="#/kriteria">Kriteria</a></li>
          <li class="breadcrumb-item active">Ubah Kriteria</li>
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
            <h4 class="card-title">Ubah Kriteria</h4>
          </div>
          <div class="card-content">
            <div class="card-body card-dashboard">
              <form class="form-horizontal" id="form_edit">
                <div class="form-group">
                  <label>Nama Kriteria</label>
                  <input type="text" class="form-control" name="nama_kriteria" id="nama_kriteria">
                </div>
                <div class="form-group">
                  <label>Bobot Kriteria</label>
                  <input type="number" class="form-control" name="bobot_kriteria" id="bobot_kriteria">
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title">Ubah Subkriteria</h4>
                      </div>
                      <div class="card-content">
                        <div class="card-body card-dashboard">
                          <table class="table table-striped" id="t_subkriteria">
                            <thead>
                              <tr>
                                <th>Nama Subkriteria</th>
                                <th>Bobot</th>
                                <th><button class="btn btn-sm btn-info round" id="add_sub" type="button"><i class="ft-plus"></i></button></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td colspan="3"><center>Tidak ada subkriteria yang ditambahkan</center></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="id_kriteria" id="id_kriteria">
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

<script type="text/javascript">

  $(document).ready(function(){

    var session = localStorage.getItem('pssb');
    var auth = JSON.parse(session);
    var ID_KRITERIA = location.hash.substr(16);
    var count = 1;
    var baris = 1;

    $('#add_sub').on('click', function(){
      count  = count + 1
      var html = `<tr id="baris${count}">`

      html+=`<td><input type="text" class="form-control" name="nama_subkriteria[]" placeholder="Nama Subkriteria" required></td>`
      html+=`<td><input type="text" class="form-control" name="bobot_sub[]" placeholder="Bobot" required></td>`
      html+=`<td><button type="button" class="btn btn-danger remove" id="${count}"><i class="la la-trash"></i></button></td>`
      html+=`</tr>`


      $('#t_subkriteria tbody').append(html)
    })

    $(document).on('click', '.remove', function(){
      var id = $(this).attr('id')

      $('#baris'+id+'').remove()
    })

    $.ajax({
      url: `<?= base_url('api/kriteria/show/') ?>${auth.token}?id_kriteria=${ID_KRITERIA}`,
      type: 'GET',
      dataType: 'JSON',
      success: function(response){
        $.each(response.data, function(k, v){
          $('#id_kriteria').val(v.id_kriteria)
          $('#nama_kriteria').val(v.nama_kriteria)
          $('#bobot_kriteria').val(v.bobot_kriteria)

          var html  = ''

          $.each(v.subkriteria, function(k1, v1){
            html+=`<tr id="baris${baris++}">`
            html+=`<td><input type="text" class="form-control" value="${v1.nama_subkriteria}" name="nama_subkriteria[]" placeholder="Nama Subkriteria" required></td>`
            html+=`<td><input type="text" class="form-control" value="${v1.bobot_sub}" name="bobot_sub[]" placeholder="Bobot" required></td>`
            html+=`<td><button type="button" class="btn btn-danger remove" id="${count++}"><i class="la la-trash"></i></button></td>`
            html+=`</tr>`

          })
            
          $('#t_subkriteria tbody').html(html)
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

    $('#form_edit').on('submit', function(e){
      e.preventDefault();

      var id_kriteria = $('#id_kriteria').val()
      var nama_kriteria = $('#nama_kriteria').val()
      var subkriteria = $('#subkriteria tbody tr').length

      if(id_kriteria === '' || nama_kriteria === ''){
        Swal.fire({
          position: 'center',
          type: 'warning',
          title: 'Data tidak boleh kosong',
          showConfirmButton: false,
          timer: 1500
        });
      } else {
        $.ajax({
          url: '<?= base_url('api/kriteria/edit/') ?>'+auth.token+'?id_kriteria='+ID_KRITERIA,
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
              });
              $('#form_edit')[0].reset();
              location.hash = '#/kriteria';
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
            });
            $('#submit_add').removeClass('disabled').removeAttr('disabled', 'disabled').text('Simpan')
          }
        })
      }
    })

  })

</script>
