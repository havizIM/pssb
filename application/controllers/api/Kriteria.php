<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Kriteria extends CI_Controller {

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

    $this->load->model('KriteriaModel');
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

          $this->input->get('id_kriteria') != null ? $where['id_kriteria'] = $this->input->get('id_kriteria') : null;
          $this->input->get('nama_kriteria') != null ? $like['nama_kriteria'] = $this->input->get('nama_kriteria') : null;
            

            $show  = $this->KriteriaModel->show($where, $like);
            $kriteria  = array();

            foreach($show->result() as $key){
                $json = array();

                $json['id_kriteria']       = $key->id_kriteria;
                $json['nama_kriteria']     = $key->nama_kriteria;
                $json['jml_subkriteria']   = $key->jml_subkriteria;

                $kriteria[] = $json;
            }

            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $kriteria));
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
            $post            = $this->input->post();
            $id_kriteria     = $this->KodeModel->buatKode('kriteria', 'KR', 'id_kriteria', 9);
            $nama_kriteria   = $this->input->post('nama_kriteria');

            if($nama_kriteria == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {
              if(!isset($post['nama_subkriteria']) && count($post['nama_subkriteria']) < 1){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Masukan Subkriteria'));
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
                    'id_kriteria'         => $id_kriteria,
                    'nama_kriteria'       => $nama_kriteria
                );

                $log = array('message' => 'Berhasil menambah kriteria');
                $add = $this->KriteriaModel->add($kriteria, $subkriteria);

                if(!$add){
                    json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah data kriteria'));
                } else {
                    $this->pusher->trigger('pssb', 'kriteria', $log);
                    json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah data kriteria'));
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
                    $edit = $this->KriteriaModel->edit($id_kriteria, $kriteria, $subkriteria);

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
              $delete = $this->KriteriaModel->delete($id_kriteria);

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

  function detail($token = null){
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

          $otorisasi     = $auth->row();
          $id_kriteria   = $this->input->get('id_kriteria');
          $where        = array('id_kriteria' => $id_kriteria);
          $like         = array();

          $this->input->get('id_kriteria') != null ? $where['id_kriteria'] = $this->input->get('id_kriteria') : null;
          $this->input->get('nama_kriteria') != null ? $like['nama_kriteria'] = $this->input->get('nama_kriteria') : null;

          if($id_kriteria == null){
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Kriteria tidak dipilih'));
          } else {
            $show  = $this->KriteriaModel->show($where, $like);
            $show2 = $this->KriteriaModel->detail($where, $like);

            $kriteria      = array();
            $subkriteria   = array();

            foreach($show2->result() as $key){
              $json = array();

              $json['id_subkriteria']   = $key->id_subkriteria;
              $json['nama_subkriteria'] = $key->nama_subkriteria;
              $json['bobot']            = $key->bobot;

              $subkriteria[] = $json;
            }

            foreach($show->result() as $key){
              $json = array();

              $json['id_kriteria'] = $key->id_kriteria;
              $json['nama_kriteria']  = $key->nama_kriteria;
              $json['subkriteria']      = $subkriteria;

              $kriteria[] = $json;
            }

            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $kriteria));
          }
        }
      }
    }
  }


}

?>
