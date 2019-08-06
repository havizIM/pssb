<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Seleksi extends CI_Controller {

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
    $this->load->model('TahunAjaranModel');
    $this->load->model('SubkriteriaModel');
    $this->load->model('SeleksiModel');
    $this->load->model('SeleksiDetailModel');
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
            'id_jadwal' => $this->input->get('id_jadwal')
          );
            

            $show  = $this->JadwalModel->show($where);
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
                $json['seleksi']            = array();

                $where_sk   = array('a.id_jadwal' => $key->id_jadwal);
                $show2      = $this->SeleksiModel->show($where_sk);

                foreach($show2->result() as $key2){
                  $json_s = array();

                  $json_s['id_seleksi']     = $key2->id_seleksi;
                  $json_s['pendaftar']      = array(
                    'id_pendaftar'    => $key2->id_pendaftar,
                    'kd_ta'           => $key2->kd_ta,
                    'nama_lengkap'    => $key2->nama_lengkap,
                    'jenis_kelamin'   => $key2->jenis_kelamin,
                    'tgl_register'    => $key2->tgl_register
                  );
                  $json_s['keterangan']     = $key2->keterangan;
                  $json_s['status_seleksi'] = $key2->status_seleksi;
                  $json_s['detail']         = array();

                  $where_dt = array('a.id_seleksi' => $key2->id_seleksi);
                  $show3    = $this->SeleksiDetailModel->show($where_dt);

                  foreach($show3->result() as $key3){
                    $json_d = array();

                    $json_d['subkriteria']      = array(
                        'id_subkriteria'    => $key3->id_subkriteria,
                        'nama_subkriteria'  => $key3->nama_subkriteria,
                        'bobot'             => $key3->bobot_sub
                    );
                    $json_d['kriteria']         = array(
                        'id_kriteria'   => $key3->id_kriteria,
                        'nama_kriteria' => $key3->nama_kriteria
                    );

                    $json_s['detail'][] = $json_d;
                  }

                  $json['seleksi'][]        = $json_s;
                }

                $jadwal[] = $json;
            }

            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $jadwal));
        }
      }
    }
  }

  function get_form(){
      $where_sk     = array('a.id_seleksi' => $this->input->get('id_seleksi'));
      $peserta      = $this->SeleksiModel->show($where_sk)->row();

      $where  = array('kd_ta' => $peserta->kd_ta);
      $form   = $this->TahunAjaranModel->detail($where);

      $kriteria = array(
        'id_seleksi'    => $peserta->id_seleksi,
        'nama_lengkap'  => $peserta->nama_lengkap,
        'kriteria'      => array()
      );

      foreach($form->result() as $key2){
        $json_p = array();
        $json_p['id_kriteria']      = $key2->id_kriteria;
        $json_p['nama_kriteria']    = $key2->nama_kriteria;
        $json_p['subkriteria']      = array();
        

        $where2 = array('id_kriteria' => $key2->id_kriteria);
        $subkriteria = $this->SubkriteriaModel->show($where2);

        foreach($subkriteria->result() as $key){
          $json_a = array();

          $json_a['id_subkriteria'] = $key->id_subkriteria;
          $json_a['nama_subkriteria'] = $key->nama_subkriteria;


          $json_p['subkriteria'][] = $json_a;
        }

        $kriteria['kriteria'][]   = $json_p;
      }
      
      json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $kriteria));
  }

  function lihat_hasil($token = null){
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

            $where_sk = array(
              'id_seleksi' => $this->input->get('id_seleksi')
            );
            $show2      = $this->SeleksiModel->show($where_sk);

            $seleksi = array();

              foreach($show2->result() as $key2){
                $json_s = array();

                $json_s['id_seleksi']     = $key2->id_seleksi;
                $json_s['pendaftar']      = array(
                  'id_pendaftar'    => $key2->id_pendaftar,
                  'kd_ta'           => $key2->kd_ta,
                  'nama_lengkap'    => $key2->nama_lengkap,
                  'jenis_kelamin'   => $key2->jenis_kelamin,
                  'tgl_register'    => $key2->tgl_register
                );
                $json_s['keterangan']     = $key2->keterangan;
                $json_s['status_seleksi'] = $key2->status_seleksi;
                $json_s['detail']         = array();

                $total_bobot = 0;
                $where_dt = array('a.id_seleksi' => $key2->id_seleksi);
                $show3    = $this->SeleksiDetailModel->show($where_dt);

                foreach($show3->result() as $key3){
                  $total_bobot += $key3->bobot_sub;
                  $json_d = array();

                  $json_d['subkriteria']      = array(
                      'id_subkriteria'    => $key3->id_subkriteria,
                      'nama_subkriteria'  => $key3->nama_subkriteria,
                      'bobot'             => $key3->bobot_sub
                  );
                  $json_d['kriteria']         = array(
                      'id_kriteria'   => $key3->id_kriteria,
                      'nama_kriteria' => $key3->nama_kriteria
                  );

                  $json_s['detail'][] = $json_d;
                }

                $json_s['rate']   = $total_bobot / $show3->num_rows();
                $json_s['hasil']  = $json_s['rate'] < 7 ? 'Tidak Lulus' : 'Lulus';
              
                $seleksi[]      = $json_s;
              }


            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $seleksi));
        }
      }
    }
  }

  function hadir($token = null){
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
            $id_seleksi         = $this->input->get('id_seleksi');

            if($id_seleksi == null){
              json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Tidak ada ID Seleksi yang dipilih'));
            } else {
                if(!isset($post['id_subkriteria']) && count($post['id_subkriteria']) < 1){
                    json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Anda harus memilih Subkriteria'));
                } else {

                    $detail = array();
                    foreach($post['id_subkriteria'] as $key => $val){
                        $detail[] = array(
                            'id_seleksi'         => $id_seleksi,
                            'id_subkriteria'     => $post['id_subkriteria'][$key]
                        );
                    }

                    $where  = array('id_seleksi' => $id_seleksi);
                    $data   = array('status_seleksi' => 'Hadir');

                    $log  = array('message' => 'Berhasil mengedit jadwal');
                    $edit = $this->SeleksiModel->edit($where, $data, $detail);

                    if(!$edit){
                        json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengedit seleksi'));
                    } else {
                        $this->pusher->trigger('pssb', 'seleksi', $log);
                        json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengedit seleksi'));
                    }
                }
            }
          }
        }
      }
    }
  }

  function tidak_hadir($token = null){
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
            $id_seleksi = $this->input->get('id_seleksi');

            if($id_seleksi == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Jadwal tidak ditemukan'));
            } else {
              $where  = array('id_seleksi' => $id_seleksi);
              $data   = array('status_seleksi' => 'Tidak Hadir');
              $log    = array('message' => 'Berhasil menghapus seleksi');
              $update = $this->SeleksiModel->edit($where, $data, FALSE);

              if(!$update){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus seleksi'));
              } else {
                $this->pusher->trigger('pssb', 'seleksi', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus seleksi'));
              }
            }
          }
        }
      }
    }
  }

}

?>
