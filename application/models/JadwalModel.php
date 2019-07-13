<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class JadwalModel extends CI_Model {

    function show($where)
    {
      $this->db->select('*')
               ->from('jadwal_seleksi');

      if(!empty($where)){
          foreach($where as $key => $value){
              if($value != null){
                  $this->db->where($key, $value);
              }
          }
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
