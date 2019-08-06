<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Hasil extends CI_Controller {

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

    $this->load->model('TahunAjaranModel');
    $this->load->model('KriteriaModel');
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
              'kd_ta'   => $this->input->get('kd_ta')
          );
              
          $show           = $this->TahunAjaranModel->show($where);
          $hasil_seleksi  = array();

          foreach($show->result() as $key){
              $json = array();

              $json['kd_ta']          = $key->kd_ta;
              $json['tahun_awal']     = $key->tahun_awal;
              $json['tahun_akhir']    = $key->tahun_akhir;
              $json['tgl_awal']       = $key->tgl_awal;
              $json['tgl_akhir']      = $key->tgl_akhir;
              $json['status']         = $key->status;
              $json['tgl_input']      = $key->tgl_input;
              $json['peserta']        = array();

              $where_sk = array(
                  'id_seleksi'        => $this->input->get('id_seleksi'),
                  'status_seleksi'    => 'Hadir',
                  'b.kd_ta'           => $key->kd_ta,
                  'd.status'          => 'Tutup'
              );
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
                  
                  $json['peserta'][]      = $json_s;
              }

              $hasil_seleksi[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $hasil_seleksi));
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
            $post           = $this->input->post();
            $tahun_awal     = $post['tahun_awal'];
            $tahun_akhir    = $post['tahun_akhir'];
            $tgl_awal       = $post['tgl_awal'];
            $tgl_akhir      = $post['tgl_akhir'];
            $status         = 'Nonaktif';
            $kd_ta          = $tahun_awal.'-'.$tahun_akhir;

            if($tahun_awal == null || $tahun_akhir == null || $tgl_awal == null || $tgl_akhir == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {
              if(!isset($post['id_kriteria']) && count($post['id_kriteria']) < 1){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Anda harus memilih Kriteria'));
              } else {

                $pengaturan = array();
                foreach($post['id_kriteria'] as $key => $val){
                  $pengaturan[] = array(
                    'kd_ta'         => $kd_ta,
                    'id_kriteria'   => $post['id_kriteria'][$key],
                    'tipe'          => $post['tipe'][$key],
                    'q'             => $post['q'][$key],
                    'p'             => $post['p'][$key]
                  );
                }

                $tahun_ajaran = array(
                    'kd_ta'         => $kd_ta,
                    'tahun_awal'    => $tahun_awal,
                    'tahun_akhir'   => $tahun_akhir,
                    'tgl_awal'      => $tgl_awal,
                    'tgl_akhir'     => $tgl_akhir,
                    'status'        => $status
                );

                $log = array('message' => 'Berhasil menambah tahun ajaran');
                $add = $this->TahunAjaranModel->add($tahun_ajaran, $pengaturan);

                if(!$add){
                    json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah data tahun ajaran'));
                } else {
                    $this->pusher->trigger('pssb', 'tahun_ajaran', $log);
                    json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah data tahun ajaran'));
                }
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
            $kd_ta          = $this->input->get('kd_ta');

            $post           = $this->input->post();
            $tahun_awal     = $post['tahun_awal'];
            $tahun_akhir    = $post['tahun_akhir'];
            $tgl_awal       = $post['tgl_awal'];
            $tgl_akhir      = $post['tgl_akhir'];

            if($kd_ta == null){
              json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Tidak ada Tahun Ajaran yang dipilih'));
            } else {
              if($tahun_awal == null || $tahun_akhir == null || $tgl_awal == null || $tgl_akhir == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
              } else {
                if(!isset($post['id_kriteria']) && count($post['id_kriteria']) < 1){
                    json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Anda harus memilih kriteria'));
                } else {
                    $pengaturan = array();
                    foreach($post['id_kriteria'] as $key => $val){
                        $pengaturan[] = array(
                            'kd_ta'         => $kd_ta,
                            'id_kriteria'   => $post['id_kriteria'][$key],
                            'tipe'          => $post['tipe'][$key],
                            'q'             => $post['q'][$key],
                            'p'             => $post['p'][$key]
                        );
                    }

                    $tahun_ajaran = array(
                        'tahun_awal'    => $tahun_awal,
                        'tahun_akhir'   => $tahun_akhir,
                        'tgl_awal'      => $tgl_awal,
                        'tgl_akhir'     => $tgl_akhir
                    );

                    $log  = array('message' => 'Berhasil mengedit tahun ajaran');
                    $edit = $this->TahunAjaranModel->edit($kd_ta, $tahun_ajaran, $pengaturan);

                    if(!$edit){
                        json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengedit tahun ajaran'));
                    } else {
                        $this->pusher->trigger('pssb', 'tahun_ajaran', $log);
                        json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengedit tahun ajaran'));
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
            $kd_ta = $this->input->get('kd_ta');

            if($kd_ta == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Kriteria tidak ditemukan'));
            } else {

              $log    = array('message' => 'Berhasil menghapus kriteria');
              $delete = $this->TahunAjaranModel->delete($kd_ta);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus tahun ajaran'));
              } else {
                $this->pusher->trigger('pssb', 'tahun_ajaran', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus tahun ajaran'));
              }
            }
          }
        }
      }
    }
  }

}

?>
