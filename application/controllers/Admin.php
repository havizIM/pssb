<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->load->view('admin/main');
  }

  function dashboard()
  {
    $this->load->view('admin/dashboard');
  }

  function user()
  {
    $this->load->view('admin/user');
  }

  function kriteria()
  {
    $this->load->view('admin/kriteria');
  }

  function add_kriteria()
  {
    $this->load->view('admin/add_kriteria');
  }

  function edit_kriteria($id)
  {
    $this->load->view('admin/edit_kriteria');
  }

}
