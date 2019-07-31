<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kepsek extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->load->view('kepsek/main');
  }

  function dashboard()
  {
    $this->load->view('kepsek/dashboard');
  }

  function tahun_ajaran()
  {
    $this->load->view('kepsek/tahun_ajaran');
  }

  function laporan_hasil()
  {
    $this->load->view('kepsek/laporan_hasil');
  }

  function laporan_pendaftaran()
  {
    $this->load->view('kepsek/laporan_pendaftaran');
  }


}
