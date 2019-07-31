<style>
/* Make sure images don't get too big */
img {
  max-width: 100%;
}

/* no-gutters Class Rules */
.row.no-gutters {
   margin-right: 0;
   margin-left: 0;
}
.row.no-gutters > [class^="col-"],
.row.no-gutters > [class*=" col-"] {
   padding-right: 0;
   padding-left: 0;
}

.img-fluid.h-680{
    height: 680px !important;
}

.img-fluid.h-310{
    height: 310px !important;
}

.ovrflow{
    height: 100%;
    width: 100%;
    overflow: auto;
}
.ovrflow::-webkit-scrollbar{
    display:none;
}
.svg-seleksi {
    height: 550px;
    display: block;
    margin: auto;
}
</style>
<section id="sizing">
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Tambah Seleksi</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#/pendaftaran"><i class="fa fa-users"></i> Seleksi</a></li>
                <li class="breadcrumb-item active">Tambah Seleksi</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Hasil Seleksi</h4>
                </div>
                <div class="card-body">
                    <form id="form_seleksi">
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>


<script>
    var session = localStorage.getItem('pssb');
    var auth = JSON.parse(session);
    var id_seleksi = location.hash.substr(14);


    var renderUI = (() => {
        return {
            renderForm: (data) => {
                var html = `
                    <div class="form-group">
                        <label for="">ID Seleksi</label>
                        <input type="text" readonly id="id_seleksi" name="id_seleksi" class="form-control" value="${data.id_seleksi}">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" readonly id="nama_lengkap" name="nama_lengkap" class="form-control" value="${data.nama_lengkap}">
                    </div>
                `

                $.each(data.kriteria, function(k, v){
                    html += `
                        <div class="form-group">
                            <label for="">${v.nama_kriteria}</label>
                            <select name="id_subkriteria[]" class="form-control" id="id_subkriteria" required>
                                <option value="">-- Pilih Subkriteria --</option>`

                            $.each(v.subkriteria, function(k1, v1){
                                html += `<option value="${v1.id_subkriteria}">${v1.nama_subkriteria}</option>`
                            })
                            
                    html += 
                            `</select>
                        </div>
                    `
                })

                html += `
                    <button class="btn btn-md btn-success" id="submit_add">Submit</button>
                    <a href="#/jadwal" class="btn btn-md btn-danger">Cancel</a>
                `

                $('#form_seleksi').html(html);
            }
        }
    })();


    var seleksiController = ((UI) => {

        var getForm = () => {
            $.ajax({
                url: `<?= base_url('api/seleksi/get_form') ?>?id_seleksi=${id_seleksi}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    UI.renderForm(res.data);
                },
                error: function(){
                    alert('Tidak dapat mengakses server');
                }
            })
        }

        var submitForm = () => {
            $('#form_seleksi').on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    url: `<?= base_url('api/seleksi/hadir/') ?>${auth.token}?id_seleksi=${id_seleksi}`,
                    type: 'POST',
                    // dataType: 'JSON',
                    data: $(this).serialize(),
                    beforeSend: function(){
                        $('#submit_add').html('<i class="la la-spin la-spinner"></i>')
                    },
                    success: function(response){
                        console.log(response);
                        if(response.status === 200){
                            Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            location.hash = `#/jadwal`;
                        } else {
                            Swal.fire({
                                position: 'center',
                                type: 'error',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#submit_add').html('Submit')
                        }
                    },
                    error: function(){
                        $('#submit_add').html('Submit')

                    }
                })
            })
                
        }

        return {
            init: () => {
                getForm();
                submitForm();
            }
        }
    })(renderUI);

    $(document).ready(function(){
        seleksiController.init();
    })
</script>