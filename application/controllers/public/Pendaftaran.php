<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Pendaftaran extends CI_Controller {

  function __construct(){
    parent::__construct();

    $this->options = array(
      'cluster' => 'ap1',
      'useTLS' => true
    );
    $this->pusher = new Pusher\Pusher(
      'f6a967b44e507048ffa7',
      '50d00b73be4f3f73a02f',
      '776594',
      $this->options
    );

    $this->load->model('PendaftaranModel');
    $this->load->model('WilayahModel');
  }

  function add(){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'POST') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {
      $id_pendaftar       = $this->KodeModel->buatKode('pendaftaran', 'P-', 'id_pendaftar', 9);
      $kd_ta              = $this->input->get('kd_ta');
      $nama_lengkap       = $this->input->post('nama_lengkap');
      $jenis_kelamin      = $this->input->post('jenis_kelamin');
      $nisn               = $this->input->post('nisn');
      $no_ijazah          = $this->input->post('no_ijazah');
      $no_skhun           = $this->input->post('no_skhun');
      $no_un              = $this->input->post('no_un');
      $asal_sekolah       = $this->input->post('asal_sekolah');
      $nik                = $this->input->post('nik');
      $tmp_lahir          = $this->input->post('tmp_lahir');
      $tgl_lahir          = $this->input->post('tgl_lahir');
      $agama              = $this->input->post('agama');
      $alamat             = $this->input->post('alamat');
      $rtrw               = $this->input->post('rtrw');
      $id_kelurahan       = $this->input->post('id_kelurahan');
      $kode_pos           = $this->input->post('kode_pos');
      $alat_transportasi  = $this->input->post('alat_transportasi');
      $jenis_tmp_tinggal  = $this->input->post('jenis_tmp_tinggal');
      $anak_ke            = $this->input->post('anak_ke');
      $jml_saudara        = $this->input->post('jml_saudara');
      $kip                = $this->input->post('kip');
      $no_hp              = $this->input->post('no_hp');
      $email              = $this->input->post('email');
      $nama_ayah          = $this->input->post('nama_ayah');
      $nik_ayah           = $this->input->post('nik_ayah');
      $tmp_lahir_ayah     = $this->input->post('tmp_lahir_ayah');
      $tgl_lahir_ayah     = $this->input->post('tgl_lahir_ayah');
      $pekerjaan_ayah     = $this->input->post('pekerjaan_ayah');
      $pendidikan_ayah    = $this->input->post('pendidikan_ayah');
      $penghasilan_ayah   = $this->input->post('penghasilan_ayah');
      $nama_ibu           = $this->input->post('nama_ibu');
      $nik_ibu            = $this->input->post('nik_ibu');
      $tmp_lahir_ibu      = $this->input->post('tmp_lahir_ibu');
      $tgl_lahir_ibu      = $this->input->post('tgl_lahir_ibu');
      $pekerjaan_ibu      = $this->input->post('pekerjaan_ibu');
      $pendidikan_ibu     = $this->input->post('pendidikan_ibu');
      $penghasilan_ibu    = $this->input->post('penghasilan_ibu');
      $tinggi_badan       = $this->input->post('tinggi_badan');
      $berat_badan        = $this->input->post('berat_badan');
      $gol_darah          = $this->input->post('gol_darah');
      $ekstrakulikuler    = $this->input->post('ekstrakulikuler');

      // if($kd_ta == null || $nama_lengkap == null || $jenis_kelamin == null || $nisn == null || $no_ijazah == null || $no_skhun == null || $no_un == null || $asal_sekolah == null || $nik == null || $tmp_lahir == null || $tgl_lahir == null || $agama == null || $alamat == null || $rtrw == null || $id_kelurahan == null || $kode_pos == null || $alat_transportasi == null || $jenis_tmp_tinggal == null || $anak_ke == null || $jml_saudara == null || $kip == null || $no_hp == null || $email == null || $tinggi_badan == null || $berat_badan == null || $gol_darah == null || $ekstrakulikuler == null){
      //   json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data pendaftar yang dikirim tidak lengkap'));
      // } else if($nama_ayah == null || $nik_ayah == null || $tmp_lahir_ayah == null || $tgl_lahir_ayah == null || $pekerjaan_ayah == null || $penghasilan_ayah == null || $pendidikan_ayah == null || $nama_ibu == null || $nik_ibu == null || $tmp_lahir_ibu == null || $tgl_lahir_ibu == null || $pekerjaan_ibu == null || $pendidikan_ibu == null || $penghasilan_ibu == null){
      //   json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data orang tua yang dikirim tidak lengkap'));
      // } else {
          $ijazah       = $this->upload_file('ijazah', $id_pendaftar);
          $skhun        = $this->upload_file('skhun', $id_pendaftar);
          $kk           = $this->upload_file('kk', $id_pendaftar);
          $ktp_ayah     = $this->upload_file('ktp_ayah', $id_pendaftar);
          $ktp_ibu      = $this->upload_file('ktp_ibu', $id_pendaftar);
          $ktp_wali     = $this->upload_file('ktp_wali', $id_pendaftar);
          $fc_kip       = $this->upload_file('fc_kip', $id_pendaftar);
          $foto         = $this->upload_file('foto', $id_pendaftar);
          $sk_baik      = $this->upload_file('sk_baik', $id_pendaftar);
          $sertifikat   = $this->upload_file('sertifikat', $id_pendaftar);

          // if($ijazah == null || $skhun == null || $kk == null || $ktp_ayah == null || $ktp_ibu == null || $ktp_wali == null || $foto == null || $sk_baik == null){
          //   json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data dokumen yang dikirim tidak lengkap'));
          // } else {

            $data = array(
                'id_pendaftar'       => $id_pendaftar,
                'kd_ta'              => $kd_ta,
                'nama_lengkap'       => $nama_lengkap,
                'jenis_kelamin'      => $jenis_kelamin,
                'nisn'               => $nisn,
                'no_ijazah'          => $no_ijazah,
                'no_skhun'           => $no_skhun,
                'no_un'              => $no_un,
                'asal_sekolah'       => $asal_sekolah,
                'nik'                => $nik,
                'tmp_lahir'          => $tmp_lahir,
                'tgl_lahir'          => $tgl_lahir,
                'agama'              => $agama,
                'alamat'             => $alamat,
                'rtrw'               => $rtrw,
                'id_kelurahan'       => $id_kelurahan,
                'kode_pos'           => $kode_pos,
                'alat_transportasi'  => $alat_transportasi,
                'jenis_tmp_tinggal'  => $jenis_tmp_tinggal,
                'anak_ke'            => $anak_ke,
                'jml_saudara'        => $jml_saudara,
                'kip'                => $kip,
                'no_hp'              => $no_hp,
                'email'              => $email,
                'nama_ayah'          => $nama_ayah,
                'nik_ayah'           => $nik_ayah,
                'tmp_lahir_ayah'     => $tmp_lahir_ayah,
                'tgl_lahir_ayah'     => $tgl_lahir_ayah,
                'pekerjaan_ayah'     => $pekerjaan_ayah,
                'pendidikan_ayah'    => $pendidikan_ayah,
                'penghasilan_ayah'   => $penghasilan_ayah,
                'nama_ibu'           => $nama_ibu,
                'nik_ibu'            => $nik_ibu,
                'tmp_lahir_ibu'      => $tmp_lahir_ibu,
                'tgl_lahir_ibu'      => $tgl_lahir_ibu,
                'pekerjaan_ibu'      => $pekerjaan_ibu,
                'pendidikan_ibu'     => $pendidikan_ibu,
                'penghasilan_ibu'    => $penghasilan_ibu,
                'tinggi_badan'       => $tinggi_badan,
                'berat_badan'        => $berat_badan,
                'gol_darah'          => $gol_darah,
                'ekstrakulikuler'    => $ekstrakulikuler,
                'ijazah'             => $ijazah,
                'skhun'              => $skhun,
                'kk'                 => $kk,
                'ktp_ayah'           => $ktp_ayah,
                'ktp_ibu'            => $ktp_ibu,
                'ktp_wali'           => $ktp_wali,
                'fc_kip'             => $fc_kip,
                'foto'               => $foto,
                'sk_baik'            => $sk_baik,
                'sertifikat'         => $sertifikat
            );
  
            $log = array('message' => 'Berhasil melakukan pendaftaran');
            $add = $this->PendaftaranModel->add($data);
  
            if(!$add){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal melakukan pendaftaran'));
            } else {
                $this->pusher->trigger('pssb', 'pendaftaran', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil melakukan pendaftaran'));
            } 
          // }
      // }
    }
  }

  function provinsi(){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {
        $where = array(
          'id' => $this->input->get('id')
        );

        $show       = $this->WilayahModel->provinsi($where);
        $provinsi   = array();

        foreach($show->result() as $key){
          $json = array();

          $json['id']             = $key->id;
          $json['nama_provinsi']  = $key->nama_provinsi;

          $provinsi[] = $json;
        }

        json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $provinsi));
          
    }
  }

  function kabupaten(){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {
        $where = array(
          'id'          => $this->input->get('id'),
          'id_provinsi' => $this->input->get('id_provinsi')
        );

        $show  = $this->WilayahModel->kabupaten($where);
        $kabupaten  = array();

        foreach($show->result() as $key){
          $json = array();

          $json['id']             = $key->id;
          $json['nama_kabupaten'] = $key->nama_kabupaten;

          $kabupaten[] = $json;
        }

        json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $kabupaten));
          
    }
  }

  function kecamatan(){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {
        $where = array(
          'id'          => $this->input->get('id'),
          'id_kabupaten' => $this->input->get('id_kabupaten')
        );

        $show  = $this->WilayahModel->kecamatan($where);
        $kecamatan  = array();

        foreach($show->result() as $key){
          $json = array();

          $json['id']             = $key->id;
          $json['nama_kecamatan'] = $key->nama_kecamatan;

          $kecamatan[] = $json;
        }

        json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $kecamatan));
          
    }
  }

  function kelurahan(){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {
        $where = array(
          'id'            => $this->input->get('id'),
          'id_kecamatan'  => $this->input->get('id_kecamatan')
        );

        $show  = $this->WilayahModel->kelurahan($where);
        $kelurahan  = array();

        foreach($show->result() as $key){
          $json = array();

          $json['id']             = $key->id;
          $json['nama_kelurahan'] = $key->nama_kelurahan;

          $kelurahan[] = $json;
        }

        json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $kelurahan));
          
    }
  }

  function upload_file($name, $id)
  {
    if(isset($_FILES[$name]) && $_FILES[$name]['name'] != ""){
      $files = glob('doc/'.$name.'/'.$id.'.*');
      foreach ($files as $key) {
        unlink($key);
      }

      $config['upload_path']   = './doc/'.$name.'/';
      $config['allowed_types'] = 'jpg|jpeg|png|pdf';
      $config['overwrite']     = TRUE;
			$config['max_size']      = '3048';
			$config['remove_space']  = TRUE;
			$config['file_name']     = $id;

      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      if(!$this->upload->do_upload($name)){
        return null;
      } else {
        $file = $this->upload->data();
        return $file['file_name'];
      }
    } else {
      $files = glob('doc/'.$name.'/'.$id.'.*');
      foreach ($files as $key) {
        unlink($key);
      }

      return null;
    }
  }


}

?>
