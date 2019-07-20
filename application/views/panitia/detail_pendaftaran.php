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
    <div class="col-md-7 col-4 align-self-center">

    </div>
</div>

<div class="row" id="content_profile">

<script>
 var renderUI = (function(){
        
        return {
            renderProfile: function(data){
                var html = '';

                
                //DATA PRIBADI
                html += `
                        <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                            <h4 class="card-title">Icon Tab with top line</h4>
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
                                    <h1 class="primary" style="margin-bottom:20px;">Kelengkapan Data Diri   </h1>
                                    <div class="row">

                                        <div class="col-md-4">
                                             <div class="card-text">
                                                <dl>
                                                    <dt>Nama Lengkap</dt>
                                                    <dd>${data.nama_lengkap}.</dd>
                                                    <dt>Jenis Kelamin</dt>
                                                    <dd>${data.jenis_kelamin}.</dd>
                                                    <dt>Nomor Induk Kependudukkan (NIK)</dt>
                                                    <dd>${data.nik}.</dd>
                                                    <dt>Agama</dt>
                                                    <dd>${data.agama}.</dd>
                                                    <dt>Tempat dan Tgl Lahir</dt>
                                                    <dd>${data.tmp_lahir}, ${data.tgl_lahir}.</dd>
                                                    <dt>No Handphone</dt>
                                                    <dd>${data.no_hp}.</dd>
                                                    <dt>Email</dt>
                                                    <dd>${data.email}.</dd>
                                                </dl>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card-text">
                                                <dl>
                                                    <dt>Asal Sekolah</dt>
                                                    <dd>${data.asal_sekolah}.</dd>
                                                    <dt>Jenis Tempat Tinggal</dt>
                                                    <dd>${data.jenis_tmp_tinggal}.</dd>
                                                    <dt>Alat Transportasi</dt>
                                                    <dd>${data.alat_transportasi}.</dd>
                                                    <dt>Anak Ke</dt>
                                                    <dd>${data.anak_ke}.</dd>
                                                    <dt>Jumlah Saudara</dt>
                                                    <dd>${data.jml_saudara}.</dd>
                                                    <dt>Ekstrakulikuler</dt>
                                                    <dd>${data.ekstrakulikuler}.</dd>
                                                    <dt>Golongan Darah</dt>
                                                    <dd>${data.gol_darah}.</dd>
                                                </dl>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="card-text">
                                                <dl>
                                                    <dt>Tinggi Badan</dt>
                                                    <dd>${data.tinggi_badan}.</dd>
                                                    <dt>Berat Badan</dt>
                                                    <dd>${data.berat_badan}.</dd>
                                                    <dt>Nomor Induk Siswa Nasional (NISN)</dt>
                                                    <dd>${data.nisn}.</dd>
                                                    <dt>No. Ijazah</dt>
                                                    <dd>${data.no_ijazah}.</dd>
                                                    <dt>Surat Keterangan Hasil Ujian Nasional (SKHUN)</dt>
                                                    <dd>${data.no_skhun}.</dd>
                                                    <dt>Kartu Indonesia Pintar (KIP)</dt>
                                                    <dd>${data.kip}.</dd>
                                                    <dt>Golongan Darah</dt>
                                                    <dd>${data.gol_darah}.</dd>
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
                                                    <dd>${data.alamat_lengkap.alamat}.</dd>
                                                </dl>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card-text">
                                                <dl>
                                                    <dt>RT/RW</dt>
                                                    <dd>${data.alamat_lengkap.rtrw}.</dd>
                                                    <dt>Kelurahan</dt>
                                                    <dd>${data.alamat_lengkap.kelurahan}.</dd>
                                                    <dt>Kecamatan</dt>
                                                    <dd>${data.alamat_lengkap.kecamatan}.</dd>
                                                </dl>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="card-text">
                                                <dl>
                                                    
                                                    <dt>Kabupaten</dt>
                                                    <dd>${data.alamat_lengkap.kabupaten}.</dd>
                                                    <dt>Provinsi</dt>
                                                    <dd>${data.alamat_lengkap.provinsi}.</dd>
                                                    <dt>Kode Pos</dt>
                                                    <dd>${data.alamat_lengkap.kode_pos}.</dd>
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
                                                    <dd>${data.data_ayah.nama_ayah}.</dd>
                                                    <dt>NIK Ayah</dt>
                                                    <dd>${data.data_ayah.nik_ayah}.</dd>
                                                    <dt>Tempat dan Tgl Lahir</dt>
                                                    <dd>${data.data_ayah.tmp_lahir_ayah}, ${data.data_ayah.tgl_lahir_ayah}.</dd>
                                                    
                                                </dl>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="card-text">
                                                <dl>
                                                    <dt>Pekerjaan</dt>
                                                    <dd>${data.data_ayah.pekerjaan_ayah}.</dd>
                                                    <dt>Pendidikan Terakhir</dt>
                                                    <dd>${data.data_ayah.pendidikan_ayah}.</dd>
                                                    <dt>Penghasilan Perbulan</dt>
                                                    <dd>${data.data_ayah.penghasilan_ayah}.</dd>
                                                </dl>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="card-text">
                                                <dl>
                                                    <dt>Nama Ibu</dt>
                                                    <dd>${data.data_ibu.nama_ibu}.</dd>
                                                    <dt>NIK Ibu</dt>
                                                    <dd>${data.data_ibu.nik_ibu}.</dd>
                                                    <dt>Tempat dan Tgl Lahir</dt>
                                                    <dd>${data.data_ibu.tmp_lahir_ibu}, ${data.data_ibu.tgl_lahir_ibu}.</dd>
                                                </dl>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="card-text">
                                                <dl>
                                                    <dt>Pekerjaan</dt>
                                                    <dd>${data.data_ibu.pekerjaan_ibu}.</dd>
                                                    <dt>Pendidikan Terakhir</dt>
                                                    <dd>${data.data_ibu.pendidikan_ibu}.</dd>
                                                    <dt>Penghasilan Perbulan</dt>
                                                    <dd>${data.data_ibu.penghasilan_ibu}.</dd>
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
                                                    <dd>${data.tgl_register}.</dd>
                                                </dl>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="card-text">
                                                <dl>
                                                    <dt>Status Pendaftaran</dt>
                                                    <dd>${data.status_pendaftaran}.</dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="linkIconOpt1" role="tabpanel" aria-labelledby="linkIconOpt1-tab1" aria-expanded="false" style="height: 540px; overflow-y:scroll; overflow-x:hidden;">
                                    <h1 class="primary" style="margin-bottom:20px;">Kelengkapan Dokumen</h1>

                                    <div class="row no-gutters gallerys">
                                        

                                    </div>
                                    <div class="row no-gutters gallerys">
                                        <div class="col-xl-12 col-lg-12">
                                            <div class="card text-center">
                                                <div class="card-content">
                                               <a href="<?= base_url() ?>doc/foto/${data.dokumen.foto}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/foto/${data.dokumen.foto}" onerror="this.onerror=null;this.src='<?= base_url() ?>assets/img/error/undraw_problem_solving_ft81.svg';" style="border-left: 3px solid #1e9ff2;" class="img-fluid img-responsive"></a> 
                                                <div class="card-body">
                                                    <h4 class="card-title">Foto Siswa</h4>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="col-xl-4 col-lg-12">
                                            <div class="card text-center">
                                                <div class="card-content">
                                               <a href="<?= base_url() ?>doc/ijazah/${data.dokumen.ijazah}" target="_blank" onclick="close_window();return false;" class="magni"><img src="<?= base_url() ?>doc/ijazah/${data.dokumen.ijazah}" onerror="this.onerror=null;this.src='<?= base_url() ?>assets/img/error/undraw_problem_solving_ft81.svg';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-680 img-responsive"></a> 
                                                <div class="card-body">
                                                    <h4 class="card-title">Ijasah</h4>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                         <div class="col-xl-4 col-lg-12">
                                            <div class="card text-center">
                                                <div class="card-content">
                                               <a href="<?= base_url() ?>doc/skhun/${data.dokumen.skhun}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/skhun/${data.dokumen.skhun}" onerror="this.onerror=null;this.src='<?= base_url() ?>assets/img/error/undraw_problem_solving_ft81.svg';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-680 img-responsive"></a> 
                                                <div class="card-body">
                                                    <h4 class="card-title">Surat Keterangan Hasil Ujian Nasional (SKHUN)</h4>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                         <div class="col-xl-4 col-lg-12">
                                            <div class="card text-center">
                                                <div class="card-content">
                                               <a href="<?= base_url() ?>doc/sk_baik/${data.dokumen.sk_baik}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/sk_baik/${data.dokumen.sk_baik}" onerror="this.onerror=null;this.src='<?= base_url() ?>assets/img/error/undraw_problem_solving_ft81.svg';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-680 img-responsive"></a> 
                                                <div class="card-body">
                                                    <h4 class="card-title">Surat Keterangan Baik</h4>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                 
                                         <div class="col-xl-4 col-lg-12">
                                            <div class="card text-center">
                                                <div class="card-content">
                                               <a href="<?= base_url() ?>doc/ktp_ayah/${data.dokumen.ktp_ayah}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/ktp_ayah/${data.dokumen.ktp_ayah}" onerror="this.onerror=null;this.src='<?= base_url() ?>assets/img/error/undraw_problem_solving_ft81.svg';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-310 img-responsive"></a> 
                                                <div class="card-body">
                                                    <h4 class="card-title">KTP Ayah</h4>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                 
                                         <div class="col-xl-4 col-lg-12">
                                            <div class="card text-center">
                                                <div class="card-content">
                                               <a href="<?= base_url() ?>doc/ktp_ayah/${data.dokumen.ktp_ibu}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/ktp_ibu/${data.dokumen.ktp_ibu}" onerror="this.onerror=null;this.src='<?= base_url() ?>assets/img/error/undraw_problem_solving_ft81.svg';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-310 img-responsive"></a> 
                                                <div class="card-body">
                                                    <h4 class="card-title">KTP Ibu</h4>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                 
                                         <div class="col-xl-4 col-lg-12">
                                            <div class="card text-center">
                                                <div class="card-content">
                                               <a href="<?= base_url() ?>doc/ktp_wali/${data.dokumen.ktp_wali}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/ktp_wali/${data.dokumen.ktp_wali}" onerror="this.onerror=null;this.src='<?= base_url() ?>assets/img/error/undraw_problem_solving_ft81.svg';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-310 img-responsive"></a> 
                                                <div class="card-body">
                                                    <h4 class="card-title">KTP Wali</h4>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="col-xl-4 col-lg-12">
                                            <div class="card text-center">
                                                <div class="card-content">
                                               <a href="<?= base_url() ?>doc/kk/${data.dokumen.kk}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/kk/${data.dokumen.kk}" onerror="this.onerror=null;this.src='<?= base_url() ?>assets/img/error/undraw_problem_solving_ft81.svg';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-310 img-responsive"></a> 
                                                <div class="card-body">
                                                    <h4 class="card-title">Kartu Keluarga (KK)</h4>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="col-xl-4 col-lg-12">
                                            <div class="card text-center">
                                                <div class="card-content">
                                               <a href="<?= base_url() ?>doc/fc_kip/${data.dokumen.fc_kip}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/fc_kip/${data.dokumen.fc_kip}" onerror="this.onerror=null;this.src='<?= base_url() ?>assets/img/error/undraw_problem_solving_ft81.svg';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-310 img-responsive"></a> 
                                                <div class="card-body">
                                                    <h4 class="card-title">Legalisir Kartu Indonesia Pintar (KIP)</h4>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="col-xl-4 col-lg-12">
                                            <div class="card text-center">
                                                <div class="card-content">
                                               <a href="<?= base_url() ?>doc/sertifikat/${data.dokumen.sertifikat}" target="_blank" class="magni"><img src="<?= base_url() ?>doc/sertifikat/${data.dokumen.sertifikat}" onerror="this.onerror=null;this.src='<?= base_url() ?>assets/img/error/undraw_problem_solving_ft81.svg';" style="width: 100%;border-left: 3px solid #1e9ff2;" class="img-fluid h-310 img-responsive"></a> 
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
            </div>

                        
                    `;
                    
                    


                $('#content_profile').html(html);
            },
            renderNoData: function(){
                console.log('No Data');
            }
        }

    })()

 var loadData = (function(UI){

        var ID_PENDAFTAR = location.hash.substr(14);

        var dataProfile = function(){
            // alert(ID_PENDAFTAR)
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
            $(document).on('click', '.gallerys', function(){
                $(this).magnificPopup({
                    delegate:'a',
                    type:'image',
                    mainClass: 'mfp-with-zoom',
                    gallery:{
                        enabled: true
                    },
                    zoom: {
                        enabled: true, // By default it's false, so don't forget to enable it

                        duration: 300, // duration of the effect, in milliseconds
                        easing: 'ease-in-out', // CSS transition easing function

                        // The "opener" function should return the element from which popup will be zoomed in
                        // and to which popup will be scaled down
                        // By defailt it looks for an image tag:
                        opener: function(openerElement) {
                        // openerElement is the element on which popup was initialized, in this case its <a> tag
                        // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                        return openerElement.is('img') ? openerElement : openerElement.find('img');
                        }
                    },
                    
            });
            
        }

        // var deleteSurvey = function(){
        //     $(document).on('click', '#delete_survey', function(){
        //         var id_survey = $(this).attr('data-id');

        //         swal({
        //             title: "Apakah anda yakin?",
        //             text: "Data survey ini akan terhapus secara permanen.",
        //             type: "warning",
        //             showCancelButton: true,
        //             confirmButtonColor: "#DD6B55",
        //             confirmButtonText: "Ya",
        //             cancelButtonText: "Tidak",
        //             closeOnConfirm: false,
        //             closeOnCancel: true,
        //             showLoaderOnConfirm: true
        //         }, function (isConfirm) {
        //             if(isConfirm){
        //             $.ajax({
        //                 url: `<?= base_url('ext/survey/delete/') ?>${auth.token}?id_survey=${id_survey}`,
        //                 type: 'GET',
        //                 dataType: 'JSON',
        //                 success: function(response){
        //                 if(response.status === 200){
        //                     swal.close();
        //                     makeNotif('success', response.description, response.message, 'bottom-left');
        //                     location.hash = '#/survey';
        //                 } else {
        //                     makeNotif('error', response.description, response.message, 'bottom-left');
        //                 }
        //                 },
        //                 error: function(){
        //                 makeNotif('error', 'Error', 'Tidak dapat mengakses server', 'bottom-left');
        //                 }
        //             })
        //             }
        //         });
        //     });
        // }

       
        return {
            init : function(){
                dataProfile();
                magnificPop();
            }
        }

    })(renderUI)

    $(document).ready(function(){
        loadData.init();
    })
 

</script>