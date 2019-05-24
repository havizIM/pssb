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
                $json['deskripsi_jadwal']   = $key->deskripsi_jadwal;
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
                    'id_jadwal'         => $id_jadwal,
                    'kd_ta'             => $kd_ta,
                    'keterangan_jadwal' => $keterangan_jadwal,
                    'deskripsi_jadwal'  => $deskripsi_jadwal,
                    'tgl_pelaksanaan'   => $tgl_pelaksanaan,
                    'lokasi'            => $lokasi,
                    'status'            => 'Tutup'
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
            $id_jadwal          = $this->input->get('id_jadwal');
            $kd_ta              = $this->input->post('kd_ta');
            $keterangan_jadwal  = $this->input->post('keterangan_jadwal');
            $deskripsi_jadwal   = $this->input->post('deskripsi_jadwal');
            $tgl_pelaksanaan    = $this->input->post('tgl_pelaksanaan');
            $lokasi             = $this->input->post('lokasi');

            if($id_jadwal == null){
              json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Tidak ada ID Jadwal yang dipilih'));
            } else {
              if($kd_ta == null || $keterangan_jadwal == null || $deskripsi_jadwal == null || $tgl_pelaksanaan == null || $lokasi == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
              } else {
                $data = array(
                    'kd_ta'             => $kd_ta,
                    'keterangan_jadwal' => $keterangan_jadwal,
                    'deskripsi_jadwal'  => $deskripsi_jadwal,
                    'tgl_pelaksanaan'   => $tgl_pelaksanaan,
                    'lokasi'            => $lokasi,
                    'status'            => 'Tutup'
                );

                $log  = array('message' => 'Berhasil mengedit jadwal');
                $edit = $this->JadwalModel->edit($id_jadwal, $data);

                if(!$edit){
                    json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengedit jadwal'));
                } else {
                    $this->pusher->trigger('pssb', 'jadwal', $log);
                    json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengedit jadwal'));
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
            $id_jadwal = $this->input->get('id_jadwal');

            if($id_jadwal == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Jadwal tidak ditemukan'));
            } else {

              $log    = array('message' => 'Berhasil menghapus jadwal');
              $delete = $this->JadwalModel->delete($id_jadwal);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus jadwal'));
              } else {
                $this->pusher->trigger('pssb', 'jadwal', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus jadwal'));
              }
            }
          }
        }
      }
    }
  }


}

?>
