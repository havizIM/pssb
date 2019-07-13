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

  function kriteria()
  {
    $this->load->view('kepsek/kriteria');
  }

  function tahun_ajaran()
  {
    $this->load->view('kepsek/tahun_ajaran');
  }

  function jadwal()
  {
    $this->load->view('kepsek/jadwal');
  }

}
