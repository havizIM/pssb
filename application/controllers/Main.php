<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $this->load->view('public/main');
  }

  function home()
  {
    $this->load->view('public/home');
  }

  function pendaftaran($id = null)
  {
    if ($id == null) {
       $this->load->view('public/pendaftaran');
    } else {
       $this->load->view('public/add_pendaftaran');
    }
   
  }
  
  function jadwal_seleksi()
  {
    $this->load->view('public/jadwal_seleksi');
  }

  function hasil_seleksi()
  {
    $this->load->view('public/hasil_seleksi');
  }

}
