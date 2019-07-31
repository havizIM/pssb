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
    $this->load->model('SeleksiModel');
    $this->load->model('SeleksiDetailModel');
  }

  function show(){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
	} else {

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

?>
