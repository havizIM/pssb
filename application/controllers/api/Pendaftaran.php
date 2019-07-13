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
  }

  function show($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi    = $auth->row();

          $where = array(
            'a.id_pendaftar'        => $this->input->get('id_pendaftar'),
            'a.status_pendaftaran'  => $this->input->get('status_pendaftaran')
          );
            

            $show         = $this->PendaftaranModel->show($where);
            $pendaftaran  = array();

            foreach($show->result() as $key){
                $json = array();

                $json['id_pendaftar']       = $key->id_pendaftar;
                $json['tahun_ajaran']       = array(
                    'kd_ta'         => $key->kd_ta,
                    'tahun_awal'    => $key->tahun_awal,
                    'tahun_akhir'   => $key->tahun_akhir
                );
                $json['nama_lengkap']       = $key->nama_lengkap;
                $json['jenis_kelamin']      = $key->jenis_kelamin;
                $json['nisn']               = $key->nisn;
                $json['no_ijazah']          = $key->no_ijazah;
                $json['no_skhun']           = $key->no_skhun;
                $json['no_un']              = $key->no_un;
                $json['asal_sekolah']       = $key->asal_sekolah;
                $json['nik']                = $key->nik;
                $json['tmp_lahir']          = $key->tmp_lahir;
                $json['tgl_lahir']          = $key->tgl_lahir;
                $json['agama']              = $key->agama;
                $json['alamat_lengkap']     = array(
                    'alamat'        => $key->alamat,
                    'rtrw'          => $key->rtrw,
                    'kelurahan'     => $key->nama_kelurahan,
                    'kecamatan'     => $key->nama_kecamatan,
                    'kabupaten'     => $key->nama_kabupaten,
                    'provinsi'      => $key->nama_provinsi,
                    'kode_pos'      => $key->kode_pos
                );
                $json['alat_transportasi']  = $key->alat_transportasi;
                $json['jenis_tmp_tinggal']  = $key->jenis_tmp_tinggal;
                $json['anak_ke']            = $key->anak_ke;
                $json['jml_saudara']        = $key->jml_saudara;
                $json['kip']                = $key->kip;
                $json['no_hp']              = $key->no_hp;
                $json['email']              = $key->email;
                $json['data_ayah']          = array(
                    'nama_ayah'         => $key->nama_ayah,
                    'nik_ayah'          => $key->nik_ayah,
                    'tmp_lahir_ayah'    => $key->tmp_lahir_ayah,
                    'tgl_lahir_ayah'    => $key->tgl_lahir_ayah,
                    'pekerjaan_ayah'    => $key->pekerjaan_ayah,
                    'pendidikan_ayah'   => $key->pendidikan_ayah,
                    'penghasilan_ayah'  => $key->penghasilan_ayah
                );
                $json['data_ibu']          = array(
                    'nama_ibu'         => $key->nama_ibu,
                    'nik_ibu'          => $key->nik_ibu,
                    'tmp_lahir_ibu'    => $key->tmp_lahir_ibu,
                    'tgl_lahir_ibu'    => $key->tgl_lahir_ibu,
                    'pekerjaan_ibu'    => $key->pekerjaan_ibu,
                    'pendidikan_ibu'   => $key->pendidikan_ibu,
                    'penghasilan_ibu'  => $key->penghasilan_ibu
                );
                $json['tinggi_badan']       = $key->tinggi_badan;                
                $json['berat_badan']        = $key->berat_badan;                
                $json['gol_darah']          = $key->gol_darah;                
                $json['ekstrakulikuler']    = $key->ekstrakulikuler;                                
                $json['dokumen']            = array(
                    'ijazah'        => $key->ijazah,
                    'skhun'         => $key->skhun,
                    'kk'            => $key->kk,
                    'ktp_ayah'      => $key->ktp_ayah,
                    'ktp_ibu'       => $key->ktp_ibu,
                    'ktp_wali'      => $key->ktp_wali,
                    'fc_kip'        => $key->fc_kip,
                    'foto'          => $key->foto,
                    'sk_baik'       => $key->sk_baik,
                    'sertifikat'    => $key->sertifikat
                );                
                $json['tgl_register']       = $key->tgl_register;                
                $json['status_pendaftaran'] = $key->status_pendaftaran;              


                $pendaftaran[] = $json;
            }

            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $pendaftaran));
        }
      }
    }
  }

  function terima($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'POST') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
	  } else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi = $auth->row();

          if($otorisasi->level != 'Panitia'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            
            $id_seleksi     = $this->KodeModel->buatKode('hasil_seleksi', 'SL-', 'id_seleksi', 8);
            $id_pendaftar   = $this->input->post('id_pendaftar');
            $id_jadwal      = $this->input->post('id_jadwal');
            $keterangan     = $this->input->post('keterangan');

            if($id_pendaftar == null || $id_jadwal == null || $keterangan == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {
                $where = array(
                    'id_pendaftar' => $id_pendaftar
                );

                $data = array(
                    'status_pendaftaran' => 'Terima'
                );

                $seleksi = array(
                    'id_seleksi'        => $id_seleksi,
                    'id_jadwal'         => $id_jadwal,
                    'id_pendaftar'      => $id_pendaftar,
                    'keterangan'        => $keterangan,
                    'status_seleksi'    => 'Proses'
                );

              $log    = array('message' => 'Berhasil menerima pendaftaran');
              $update = $this->PendaftaranModel->edit($where, $data, $seleksi);

              if(!$update){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menerima pendaftaran'));
              } else {
                $this->pusher->trigger('pssb', 'pendaftaran', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menerima pendaftaran'));
              }
            }
          }
        }
      }
    }
  }

  function tolak($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
	} else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi = $auth->row();

          if($otorisasi->level != 'Panitia'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_pendaftar = $this->input->get('id_pendaftar');

            if($id_pendaftar == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Jadwal tidak ditemukan'));
            } else {
                $where = array(
                    'id_pendaftar' => $id_pendaftar
                );

                $data = array(
                    'status_pendaftaran' => 'Tolak'
                );

              $log    = array('message' => 'Berhasil menolak pendaftaran');
              $update = $this->PendaftaranModel->edit($where, $data, FALSE);

              if(!$update){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menolak pendaftaran'));
              } else {
                $this->pusher->trigger('pssb', 'pendaftaran', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menolak pendaftaran'));
              }
            }
          }
        }
      }
    }
  }

}

?>
