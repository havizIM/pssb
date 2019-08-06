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
    $this->load->model('SeleksiModel');
    $this->load->model('SeleksiDetailModel');
  }

  function show($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
	} else {

        $where = array(
            'kd_ta'   => $this->input->get('kd_ta'),
            'status'  => 'Publish'
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

?>
