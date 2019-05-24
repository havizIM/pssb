<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class JadwalModel extends CI_Model {

    function show($where = array(), $like = array())
    {
      $this->db->select('*')
               ->from('jadwal_seleksi');

      if(count($where) != 0){
        $this->db->where($where);
      }

      if(count($like) != 0){
        $this->db->like($like);
      }

      $this->db->order_by('tgl_input', 'desc');
      return $this->db->get();
    }

    function add($data)
    {
      return $this->db->insert('jadwal_seleksi', $data);
    }

    function edit($id_jadwal, $data)
    {
      $this->db->where('id_jadwal', $id_jadwal);
      return $this->db->update('jadwal_seleksi', $data);
    }

    function delete($id_jadwal)
    {
      $this->db->where('id_jadwal', $id_jadwal);
      return $this->db->delete('jadwal_seleksi');
    }
}

?>
