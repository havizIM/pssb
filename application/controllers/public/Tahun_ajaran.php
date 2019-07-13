<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Tahun_ajaran extends CI_Controller {

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
  }

  function show(){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      $where = array(
        'kd_ta'   => $this->input->get('kd_ta'),
        'status'  => 'Publish'
      );
        
        $show          = $this->TahunAjaranModel->show($where);
        $tahun_ajaran  = array();

        foreach($show->result() as $key){
            $json = array();

            $json['kd_ta']          = $key->kd_ta;
            $json['tahun_awal']     = $key->tahun_awal;
            $json['tahun_akhir']    = $key->tahun_akhir;
            $json['tgl_awal']       = $key->tgl_awal;
            $json['tgl_akhir']      = $key->tgl_akhir;
            $json['status']         = $key->status;
            $json['tgl_input']      = $key->tgl_input;

            $tahun_ajaran[] = $json;
        }

        json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $tahun_ajaran));
        
    }
  }


}

?>
