<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Jadwal extends CI_Controller {

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

    $this->load->model('JadwalModel');
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
          $where        = array();
          $like         = array();

          $this->input->get('id_jadwal') != null ? $where['id_jadwal'] = $this->input->get('id_jadwal') : null;
          $this->input->get('keterangan_jadwal') != null ? $like['keterangan_jadwal'] = $this->input->get('keterangan_jadwal') : null;
            

            $show  = $this->JadwalModel->show($where, $like);
            $jadwal  = array();

            foreach($show->result() as $key){
                $json = array();

                $json['id_jadwal']          = $key->id_jadwal;
                $json['kd_ta']              = $key->kd_ta;
                $json['keterangan_jadwal']  = $key->keterangan_jadwal;
                $json['deksripsi_jadwal']   = $key->deksripsi_jadwal;
                $json['tgl_pelaksanaan']    = $key->tgl_pelaksanaan;
                $json['lokasi']             = $key->lokasi;
                $json['status']             = $key->status;
                $json['tgl_input']          = $key->tgl_input;

                $jadwal[] = $json;
            }

            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $jadwal));
        }
      }
    }
  }

  function add($token = null){
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
            $id_jadwal          = $this->KodeModel->buatKode('jadwal_seleksi', 'JD', 'id_jadwal', 9);
            $kd_ta              = $this->input->post('kd_ta');
            $keterangan_jadwal  = $this->input->post('keterangan_jadwal');
            $deskripsi_jadwal   = $this->input->post('deskripsi_jadwal');
            $tgl_pelaksanaan    = $this->input->post('tgl_pelaksanaan');
            $lokasi             = $this->input->post('lokasi');

            if($kd_ta == null || $keterangan_jadwal == null || $deskripsi_jadwal == null || $tgl_pelaksanaan == null || $lokasi == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {
                $data = array(
                    'id_kriteria'         => $id_kriteria,
                    'id_kriteria'         => $id_kriteria,
                    'id_kriteria'         => $id_kriteria,
                    'id_kriteria'         => $id_kriteria,
                    'id_kriteria'         => $id_kriteria,
                    'id_kriteria'         => $id_kriteria,
                    'nama_kriteria'       => $nama_kriteria
                );

                $log = array('message' => 'Berhasil menambah jadwal');
                $add = $this->JadwalModel->add($data);

                if(!$add){
                    json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah data jadwal'));
                } else {
                    $this->pusher->trigger('pssb', 'jadwal', $log);
                    json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah data jadwal'));
                } 
            }
          }
        }
      }
    }
  }

  function edit($token = null){
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
            $post               = $this->input->post();
            $id_kriteria        = $this->input->get('id_kriteria');
            $nama_kriteria      = $this->input->post('nama_kriteria');

            if($id_kriteria == null){
              json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Tidak ada ID Kriteria yang dipilih'));
            } else {
              if($nama_kriteria == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
              } else {
                if(!isset($post['nama_subkriteria']) && count($post['nama_subkriteria']) < 1){
                    json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Masukan Subkriteria yang akan dikeluarkan'));
                } else {
                    $subkriteria = array();
                    foreach($post['nama_subkriteria'] as $key => $val){
                        $subkriteria[] = array(
                            'id_kriteria'       => $id_kriteria,
                            'nama_subkriteria'  => $post['nama_subkriteria'][$key],
                            'bobot'             => $post['bobot'][$key]
                        );
                    }

                    $kriteria = array(
                        'nama_kriteria'      => $nama_kriteria
                    );

                    $log  = array('message' => 'Berhasil mengedit kriteria');
                    $edit = $this->JadwalModel->edit($id_kriteria, $kriteria, $subkriteria);

                    if(!$edit){
                        json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengedit kriteria'));
                    } else {
                        $this->pusher->trigger('pssb', 'kriteria', $log);
                        json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengedit kriteria'));
                    }
                } 
              }
            }
          }
        }
      }
    }
  }

  function delete($token = null){
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
            $id_kriteria = $this->input->get('id_kriteria');

            if($id_kriteria == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Kriteria tidak ditemukan'));
            } else {

              $log    = array('message' => 'Berhasil menghapus kriteria');
              $delete = $this->JadwalModel->delete($id_kriteria);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus kriteria'));
              } else {
                $this->pusher->trigger('pssb', 'kriteria', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus kriteria'));
              }
            }
          }
        }
      }
    }
  }


}

?>
