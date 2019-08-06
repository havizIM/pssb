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

.alert.float-right {
    padding: 1.75rem 1rem;
}
</style>
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Detail Pendaftaran</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#/pendaftaran"><i class="fa fa-users"></i> Pendaftaran</a></li>
            <li class="breadcrumb-item active">Detail Pendaftaran</li>
        </ol>
    </div>
    <div class="col-md-7 col-4" id="action">
        
    </div>
</div>

<div class="row" id="content_profile"></div>

<div class="modal fade text-left" id="modal_terima" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel35">Pilih Tahun Ajaran</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form id="form_terima">
        <div class="modal-body form-group">
                <div class="form-group">
                  <input type="text" class="form-control" name="id_pendaftar" id="id_pendaftar" placeholder="ID Pendaftar" readonly>
                </div>

                <div class="form-group">
                  <select type="date" class="form-control" name="id_jadwal" id="id_jadwal">
                    
                  </select>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan">
                </div>
                
        </div>
        <div class="modal-footer">
            <button type="submit" id="submit_add" class="btn btn-info float-md-right">Tambahkan</button>
            <button type="submit" data-dismiss="modal" class="btn btn-danger float-md-right">Batal</button>
        </div>
    </form>
    </div>
  </div>
</div>
<script>
 var renderUI = (function(){
        
        return {
            renderAction: function(data){
                var html = '';

                if (data.status_pendaftaran === "Proses") {
                    html += `
                        <button type="button" class="btn btn-md round btn-danger btn-glow float-right" id="btn_tolak" data-id="${data.id_pendaftar}"><i class="la la-close" style="margin-right:10px;"></i> Tolak Pendaftaran</button>
                        <button type="button" class="btn btn-md round btn-success btn-glow float-right" id="btn_terima" data-id="${data.id_pendaftar}"><i class="la la-check" style="margin-right:10px;"></i> Terima Pendaftaran</button>
                    `
                } else if (data.status_pendaftaran === 'Terima') {
                    html += `
                        <div class="alert alert-icon-left alert-success alert-dismissible mb-2 float-right" role="alert">
                            <span class="alert-icon"><i class="la la-check"></i></span>
                            <strong>Diterima.</strong> Pendaftaran Siswa berhasil tervalidasi.
                        </div>
                    `
                } else {
                    html += `
                    <div class="alert alert-icon-left alert-danger alert-dismissible mb-2 float-right" role="alert">
                        <span class="alert-icon"><i class="la la-check"></i></span>
                        <strong>Ditolak.</strong> Pendaftaran Siswa gagal tervalidasi.
                    </div>
                     `
                }

                $('#action').html(html)
            },
            renderProfile: function(data){
                var html = '';

                
                //DATA PRIBADI
                html += `
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Detail Pendaftaran</h4>
                            </div>

                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="activeIcon1-tab1" data-toggle="tab" href="#activeIcon1" aria-controls="activeIcon1" aria-expanded="true"><i class="ft-heart"></i> Data Diri</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="linkIcon1-tab1" data-toggle="tab" href="#linkIcon1" aria-controls="linkIcon1" aria-expanded="false"><i class="ft-link"></i> Alamat</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="ortu-tab1" data-toggle="tab" href="#ortu" aria-controls="ortu" aria-expanded="false"><i class="ft-link"></i> Data Orang Tua</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="lain2-tab1" data-toggle="tab" href="#lain2" aria-controls="lain2"><i class="ft-external-link"></i> Lain-lain</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="linkIconOpt1-tab1" data-toggle="tab" href="#linkIconOpt1" aria-controls="linkIconOpt1"><i class="ft-external-link"></i> Dokumen</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content px-1 pt-1">
                                        <div role="tabpanel" class="tab-pane active" id="activeIcon1" aria-labelledby="activeIcon1-tab1" aria-expanded="true">
                                            <h1 class="primary" style="margin-bottom:20px;">Kelengkapan Data Diri</h1>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="card-text">
                                                        <dl>
                                                            <dt>Nama Lengkap</dt>
                                                            <dd>${data.nama_lengkap || '-'}</dd>
                                                            <dt>Jenis Kelamin</dt>
                                                            <dd>${data.jenis_kelamin || '-'}</dd>
                                                            <dt>Nomor Induk Kependudukkan (NIK)</dt>
                                                            <dd>${data.nik || '-'}</dd>
                                                            <dt>Agama</dt>
                                                            <dd>${data.agama || '-'}</dd>
                                                            <dt>Tempat dan Tgl Lahir</dt>
                                                            <dd>${data.tmp_lahir}, ${data.tgl_lahir || '-'}</dd>
                                                            <dt>No Handphone</dt>
                                                            <dd>${data.no_hp || '-'}</dd>
                                                            <dt>Email</dt>
                                                            <dd>${data.email || '-'}</dd>
                                                        </dl>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="card-text">
                                                        <dl>
                                                            <dt>Asal Sekolah</dt>
                                                            <dd>${data.asal_sekolah || '-'}</dd>
                                                            <dt>Jenis Tempat Tinggal</dt>
                                                            <dd>${data.jenis_tmp_tinggal || '-'}</dd>
                                                            <dt>Alat Transportasi</dt>
                                                            <dd>${data.alat_transportasi || '-'}</dd>
                                                            <dt>Ekstrakulikuler</dt>
                                                            <dd>${data.ekstrakulikuler || '-'}</dd>
                                                            <dt>Golongan Darah</dt>
                                                            <dd>${data.gol_darah || '-'}</dd>
                                                            <dt>Anak Ke</dt>
                                                            <dd>${data.anak_ke || '-'}</dd>
                                                            <dt>Jumlah Saudara</dt>
                                                            <dd>${data.jml_saudara || '-'}</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                    
                                                <div class="col-md-4">
                                                    <div class="card-text">
                                                        <dl>
                                                            <dt>Tinggi Badan</dt>
                                                            <dd>${data.tinggi_badan || '-'}</dd>
                                                            <dt>Berat Badan</dt>
                                                            <dd>${data.berat_badan || '-'}</dd>
                                                            <dt>Nomor Induk Siswa Nasional (NISN)</dt>
                                                            <dd>${data.nisn || '-'}</dd>
                                                            <dt>No. Ijazah</dt>
                                                            <dd>${data.no_ijazah || '-'}</dd>
                                                            <dt>Surat Keterangan Hasil Ujian Nasional (SKHUN)</dt>
                                                            <dd>${data.no_skhun || '-'}</dd>
                                                            <dt>Kartu Indonesia Pintar (KIP)</dt>
                                                            <dd>${data.kip || '-'}</dd>
                                                            <dt>Golongan Darah</dt>
                                                            <dd>${data.gol_darah || '-'}</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="linkIcon1" role="tabpanel" aria-labelledby="linkIcon1-tab1" aria-expanded="false">
                                            <h1 class="primary" style="margin-bottom:20px;">Alamat Lengkap</h1>
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="card-text">
                                                        <dl>
                                                            <dt>Alamat</dt>
                                                            <dd>${data.alamat_lengkap.alamat || '-'}</dd>
                                                        </dl>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="card-text">
                                                        <dl>
                                                            <dt>RT/RW</dt>
                                                            <dd>${data.alamat_lengkap.rtrw || '-'}</dd>
                                                            <dt>Kelurahan</dt>
                                                            <dd>${data.alamat_lengkap.kelurahan || '-'}</dd>
                                                            <dt>Kecamatan</dt>
                                                            <dd>${data.alamat_lengkap.kecamatan || '-'}</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="card-text">
                                                        <dl>
                                                            
                                                            <dt>Kabupaten</dt>
                                                            <dd>${data.alamat_lengkap.kabupaten || '-'}</dd>
                                                            <dt>Provinsi</dt>
                                                            <dd>${data.alamat_lengkap.provinsi || '-'}</dd>
                                                            <dt>Kode Pos</dt>
                                                            <dd>${data.alamat_lengkap.kode_pos || '-'}</dd>
                                                        </dl>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="ortu" role="tabpanel" aria-labelledby="ortu-tab1" aria-expanded="false">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h1 class="primary" style="margin-bottom:20px;">Ayah</h1>
                                                </div>
                                                <div class="col-md-6">
                                                    <h1 class="primary" style="margin-bottom:20px;">Ibu</h1>
                                                </div>
                                            </div>
                                        
                                            <div class="row">

                                                <div class="col-md-3">
                                                    <div class="card-text">
                                                        <dl>
                                                            <dt>Nama Ayah</dt>
                                                            <dd>${data.data_ayah.nama_ayah || '-'}</dd>
                                                            <dt>NIK Ayah</dt>
                                                            <dd>${data.data_ayah.nik_ayah || '-'}</dd>
                                                            <dt>Tempat dan Tgl Lahir</dt>
                                                            <dd>${data.data_ayah.tmp_lahir_ayah}, ${data.data_ayah.tgl_lahir_ayah || '-'}</dd>
                                                            
                                                        </dl>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="card-text">
                                                        <dl>
                                                            <dt>Pekerjaan</dt>
                                                            <dd>${data.data_ayah.pekerjaan_ayah || '-'}</dd>
                                                            <dt>Pendidikan Terakhir</dt>
                                                            <dd>${data.data_ayah.pendidikan_ayah || '-'}</dd>
                                                            <dt>Penghasilan Perbulan</dt>
                                                            <dd>${data.data_ayah.penghasilan_ayah || '-'}</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <div class="card-text">
                                                        <dl>
                                                            <dt>Nama Ibu</dt>
                                                            <dd>${data.data_ibu.nama_ibu || '-'}</dd>
                                                            <dt>NIK Ibu</dt>
                                                            <dd>${data.data_ibu.nik_ibu || '-'}</dd>
                                                            <dt>Tempat dan Tgl Lahir</dt>
                                                            <dd>${data.data_ibu.tmp_lahir_ibu}, ${data.data_ibu.tgl_lahir_ibu || '-'}</dd>
                                                        </dl>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="card-text">
                                                        <dl>
                                                            <dt>Pekerjaan</dt>
                                                            <dd>${data.data_ibu.pekerjaan_ibu || '-'}</dd>
                                                            <dt>Pendidikan Terakhir</dt>
                                                            <dd>${data.data_ibu.pendidikan_ibu || '-'}</dd>
                                                            <dt>Penghasilan Perbulan</dt>
                                                            <dd>${data.data_ibu.penghasilan_ibu || '-'}</dd>
                                                        </dl>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                            
                                        <div class="tab-pane" id="lain2" role="tabpanel" aria-labelledby="lain2-tab1" aria-expanded="false">
                                            <h1 class="primary" style="margin-bottom:20px;">Data Lainnya </h1>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="card-text">
                                                        <dl>
                                                            <dt>Tanggal Registrasi</dt>
                                                            <dd>${data.tgl_register || '-'}</dd>
                                                        </dl>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="card-text">
                                                        <dl>
                                                            <dt>Status Pendaftaran</dt>
                                                            <dd>${data.status_pendaftaran || '-'}</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane ovrflow" id="linkIconOpt1" role="tabpanel" aria-labelledby="linkIconOpt1-tab1" aria-expanded="false" style="height: 540px;">
                                            <h1 class="primary" style="margin-bottom:20px;">Kelengkapan Dokumen</h1>
                                            <div class="row no-gutters gallerys ovrflow2">
                                                <div class="col-xl-12 col-lg-12">
                                                    <div class="card text-center">
                                                        <div class="card-content">
                                                    <a href="<?= base_url() ?>doc/foto/${data.dokumen.foto}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/foto/${data.dokumen.foto}" onerror="this.onerror=null;this.src='<?= base_url('assets/app-assets/images/undraw_resume_folder_2_arse.svg') ?>';" style="border-left: 3px solid #1e9ff2;" class="img-fluid img-responsive"></a> 
                                                        <div class="card-body">
                                                            <h4 class="card-title">Foto Siswa</h4>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-lg-12">
                                                    <div class="card text-center">
                                                        <div class="card-content">
                                                    <a href="<?= base_url() ?>doc/ijazah/${data.dokumen.ijazah}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/ijazah/${data.dokumen.ijazah}" onerror="this.onerror=null;this.src='<?= base_url('assets/app-assets/images/undraw_resume_folder_2_arse.svg') ?>';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-680 img-responsive"></a> 
                                                        <div class="card-body">
                                                            <h4 class="card-title">Ijasah</h4>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xl-4 col-lg-12">
                                                    <div class="card text-center">
                                                        <div class="card-content">
                                                    <a href="<?= base_url() ?>doc/skhun/${data.dokumen.skhun}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/skhun/${data.dokumen.skhun}" onerror="this.onerror=null;this.src='<?= base_url('assets/app-assets/images/undraw_resume_folder_2_arse.svg') ?>';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-680 img-responsive"></a> 
                                                        <div class="card-body">
                                                            <h4 class="card-title">Surat Keterangan Hasil Ujian Nasional (SKHUN)</h4>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xl-4 col-lg-12">
                                                    <div class="card text-center">
                                                        <div class="card-content">
                                                    <a href="<?= base_url() ?>doc/sk_baik/${data.dokumen.sk_baik}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/sk_baik/${data.dokumen.sk_baik}" onerror="this.onerror=null;this.src='<?= base_url('assets/app-assets/images/undraw_resume_folder_2_arse.svg') ?>';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-680 img-responsive"></a> 
                                                        <div class="card-body">
                                                            <h4 class="card-title">Surat Keterangan Baik</h4>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                                <div class="col-xl-4 col-lg-12">
                                                    <div class="card text-center">
                                                        <div class="card-content">
                                                    <a href="<?= base_url() ?>doc/ktp_ayah/${data.dokumen.ktp_ayah}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/ktp_ayah/${data.dokumen.ktp_ayah}" onerror="this.onerror=null;this.src='<?= base_url('assets/app-assets/images/undraw_resume_folder_2_arse.svg') ?>';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-310 img-responsive"></a> 
                                                        <div class="card-body">
                                                            <h4 class="card-title">KTP Ayah</h4>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                                <div class="col-xl-4 col-lg-12">
                                                    <div class="card text-center">
                                                        <div class="card-content">
                                                    <a href="<?= base_url() ?>doc/ktp_ayah/${data.dokumen.ktp_ibu}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/ktp_ibu/${data.dokumen.ktp_ibu}" onerror="this.onerror=null;this.src='<?= base_url('assets/app-assets/images/undraw_resume_folder_2_arse.svg') ?>';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-310 img-responsive"></a> 
                                                        <div class="card-body">
                                                            <h4 class="card-title">KTP Ibu</h4>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                                <div class="col-xl-4 col-lg-12">
                                                    <div class="card text-center">
                                                        <div class="card-content">
                                                    <a href="<?= base_url() ?>doc/ktp_wali/${data.dokumen.ktp_wali}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/ktp_wali/${data.dokumen.ktp_wali}" onerror="this.onerror=null;this.src='<?= base_url('assets/app-assets/images/undraw_resume_folder_2_arse.svg') ?>';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-310 img-responsive"></a> 
                                                        <div class="card-body">
                                                            <h4 class="card-title">KTP Wali</h4>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-lg-12">
                                                    <div class="card text-center">
                                                        <div class="card-content">
                                                    <a href="<?= base_url() ?>doc/kk/${data.dokumen.kk}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/kk/${data.dokumen.kk}" onerror="this.onerror=null;this.src='<?= base_url('assets/app-assets/images/undraw_resume_folder_2_arse.svg') ?>';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-310 img-responsive"></a> 
                                                        <div class="card-body">
                                                            <h4 class="card-title">Kartu Keluarga (KK)</h4>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-lg-12">
                                                    <div class="card text-center">
                                                        <div class="card-content">
                                                    <a href="<?= base_url() ?>doc/fc_kip/${data.dokumen.fc_kip}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/fc_kip/${data.dokumen.fc_kip}" onerror="this.onerror=null;this.src='<?= base_url('assets/app-assets/images/undraw_resume_folder_2_arse.svg') ?>';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-310 img-responsive"></a> 
                                                        <div class="card-body">
                                                            <h4 class="card-title">Legalisir Kartu Indonesia Pintar (KIP)</h4>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-lg-12">
                                                    <div class="card text-center">
                                                        <div class="card-content">
                                                    <a href="<?= base_url() ?>doc/sertifikat/${data.dokumen.sertifikat}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/sertifikat/${data.dokumen.sertifikat}" onerror="this.onerror=null;this.src='<?= base_url('assets/app-assets/images/undraw_resume_folder_2_arse.svg') ?>';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-310 img-responsive"></a> 
                                                        <div class="card-body">
                                                            <h4 class="card-title">Sertifikat</h4>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    
            `;
                    
                $('#content_profile').html(html);
            },
            renderNoData: function(){
                console.log('No Data');
            },

            renderJadwal: function (data) {
                var html = ' <option value="">--- Pilih ---</option>';
                
                $.each(data, function(k, v){
                    if(v.status === 'Buka'){
                        html +=`
                            <option value="${v.id_jadwal}">${v.id_jadwal} - ${v.keterangan_jadwal}</option>
                        `
                    }
                      
                })
              $('#id_jadwal').html(html);
            }
        }

    })()

 var loadData = (function(UI){

        var ID_PENDAFTAR = location.hash.substr(14);

        var dataProfile = function(){
            $.ajax({
                url: `<?= base_url('api/pendaftaran/show/'); ?>${auth.token}?id_pendaftar=${ID_PENDAFTAR}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    if(response.status === 200){
                        if(response.data.length !== 1){
                            UI.renderNoData();
                        } else {
                            $.each(response.data, function(k, v){
                                UI.renderProfile(v);
                                UI.renderAction(v);
                            })
                        }
                    } else {
                        UI.renderNoData();
                    }
                },
                error: function(err){
                    location.hash = '#/pendaftaran'
                }
            }) 
        }

        var magnificPop = function(){
            $(document).on('click', '.magni', function(){
                $('.gallerys').magnificPopup({
                    delegate:'a',
                    type:'image',
                    mainClass: 'mfp-with-zoom',
                    gallery:{
                        enabled: true
                    },
                    zoom: {
                        enabled: true, 

                        duration: 300, 
                        easing: 'ease-in-out',
                        opener: function(openerElement) {
                            return openerElement.is('img') ? openerElement : openerElement.find('img');
                        }
                    }
                });
                
                return false;
            });
        }

        var modalTerima = function () {
            $(document).on('click', '#btn_terima', function(){
                var id_pendaftar = $(this).attr('data-id');

                $('#id_pendaftar').val(id_pendaftar)
                $('#modal_terima').modal('show');
                    
            })
        }
        
        var getJadwal = function() {
            console.log()
            $.ajax({
                url: `<?= base_url('api/jadwal/show/'); ?>${auth.token}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    if (response.data.length !== 0) {
                        UI.renderJadwal(response.data)
                    }
                    
                },
            error: function(err){
                // location.hash = '#/deta'
                }
            }) 
        }

        var submitSeleksi = function() {
            $('#form_terima').on('submit', function(e){
                e.preventDefault();
                // alert('test')
                var id_pendaftar = $('#id_pendaftar').val();
                var id_jadwal = $('#id_jadwal').val();
                var keterangan = $('#keterangan').val();

                if (id_pendaftar === '' || id_jadwal === '' || keterangan === '') {
                    Swal.fire({
                        position: 'center',
                        type: 'warning',
                        title: 'Data tidak boleh kosong',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }  else {
                    $.ajax({
                    url: '<?= base_url('api/pendaftaran/terima/') ?>'+auth.token,
                    type: 'POST',
                    dataType: 'JSON',
                    beforeSend: function(){
                        $('#submit_add').addClass('disabled').attr('disabled', 'disabled').html('<i class="la la-spin la-spinner"></i>')
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
                            $('#form_terima')[0].reset();
                            $('#modal_terima').modal('hide');
                            dataProfile()
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
                    error: function(){
                            Swal.fire({
                                position: 'center',
                                type: 'warning',
                                title: 'Tidak dapat mengakses server',
                                showConfirmButton: false,
                                timer: 1500
                            });
                         $('#submit_add').removeClass('disabled').removeAttr('disabled', 'disabled').text('Tambah')
                        }
                    })
                }
            })
        }
        

      
    var tolakPendaftaran = function () {
        $(document).on('click', '#btn_tolak', function() {
            var id_pendaftar = $(this).attr('data-id');
            link_get = `<?= base_url('api/pendaftaran/tolak/') ?>${auth.token}?id_pendaftar=${id_pendaftar}`;

            // alert(id_pendaftar)
            $.ajax({
                url: link_get,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                    if(response.status === 200){
                         Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: response.message,
                                showConfirmButton: true,
                                timer: 1500
                        });
                        dataProfile();

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
                error: function(err){
                    Swal.fire({
                                position: 'center',
                                type: 'warning',
                                title: 'Tidak dapat mengakses server',
                                showConfirmButton: false,
                                timer: 1500
                            });
                         $('#submit_add').removeClass('disabled').removeAttr('disabled', 'disabled').text('Tambah')
                   dataProfile();
                }
            }) 
        })
        
    }
       
        return {
            init : function(){
                dataProfile();
                magnificPop();
                modalTerima();
                getJadwal();
                submitSeleksi();
                tolakPendaftaran();
            }
        }

    })(renderUI)

    $(document).ready(function(){
        loadData.init();
    })
 

</script>