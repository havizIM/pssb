<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panitia extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->load->view('panitia/main');
  }

  function dashboard()
  {
    $this->load->view('panitia/dashboard');
  }

  function tahun_ajaran()
  {
    $this->load->view('panitia/tahun_ajaran');
  }

  function add_tahun_ajaran()
  {
    $this->load->view('panitia/add_tahun_ajaran');
  }

  function edit_tahun_ajaran($id)
  {
    $this->load->view('panitia/edit_tahun_ajaran');
  }

  function jadwal()
  {
    $this->load->view('panitia/jadwal');
  }

  function add_jadwal()
  {
    $this->load->view('panitia/add_jadwal');
  }

  function edit_jadwal($id)
  {
    $this->load->view('panitia/edit_jadwal');
  }

  public function pendaftaran($id = null)
	{
		if($id == null){
			$this->load->view('panitia/pendaftaran');
		} else {
			$this->load->view('panitia/detail_pendaftaran');
		}
  }
  
  public function seleksi($id)
	{
			$this->load->view('panitia/seleksi');
  }
  
  public function add_seleksi($id)
	{
			$this->load->view('panitia/add_seleksi');
  }
  
  public function lihat_hasil($id)
	{
			$this->load->view('panitia/lihat_hasil');
	}

}
