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
                <h3 class="text-themecolor m-b-0 m-t-0">Hasil Seleksi</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#/jadwal"><i class="fa fa-users"></i> Jadwal</a></li>
                    <li class="breadcrumb-item active">Hasil Seleksi</li>
                </ol>
            </div>
        </div>

        <div id="hasil_seleksi">
            
        </div>
</section>

<script>
    var id_seleksi = location.hash.substr(14);

    var renderUI = (() => {
        return {
            renderHasil: (data) => {
                console.log(data);
                var html = '';
                
                $.each(data, function(k, v){
                    html += `
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"> Detail Pendaftar</h4>
                                        <table class="table">
                                            <tr>
                                                <th>ID Pendaftar</th>
                                                <td>${v.pendaftar.id_pendaftar}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Lengkap</th>
                                                <td>${v.pendaftar.nama_lengkap}</td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th>
                                                <td>${v.pendaftar.jenis_kelamin}</td>
                                            </tr>
                                            <tr>
                                                <th>Tahun Ajaran</th>
                                                <td>${v.pendaftar.kd_ta}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Daftar</th>
                                                <td>${v.pendaftar.tgl_register}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"> Detail Hasil Seleksi</h4>
                                        <table class="table">
                                            <thead>
                                                <th>Kriteria</th>
                                                <th>Hasil Seleksi</th>
                                                <th>Bobot</th>
                                            </thead>
                                            <tbody>`

                                            $.each(v.detail, function(k1, v1){
                                                html += `
                                                    <tr>
                                                        <td>${v1.kriteria.nama_kriteria}</td>
                                                        <td>${v1.subkriteria.nama_subkriteria}</td>
                                                        <td>${v1.subkriteria.bobot}</td>
                                                    </tr>
                                                `;
                                            })
                                                
                    html +=
                                            `</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                })

                $('#hasil_seleksi').html(html);
            }
        }
    })();

    var hasilController = ((UI) => {
        
        var getHasil = () => {
            $.ajax({
                url: `<?= base_url('api/seleksi/lihat_hasil/') ?>${auth.token}?id_seleksi=${id_seleksi}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    UI.renderHasil(res.data);
                },
                error: function(err){
                    alert('Tidak dapat mengakses server');
                }
            })
        }

        return {
            init: () => {
                getHasil();
            }
        }
    })(renderUI);

    $(document).ready(function(){
        hasilController.init();
    })


</script>