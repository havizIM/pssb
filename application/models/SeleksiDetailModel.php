<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SeleksiDetailModel extends CI_Model {

    function show($where)
    {
      $this->db->select('a.id_seleksi')
               ->select('b.id_subkriteria, b.nama_subkriteria, b.bobot_sub')
               ->select('c.id_kriteria, c.nama_kriteria')

               ->from('hasil_seleksi_detail a')
               ->join('subkriteria b', 'b.id_subkriteria = a.id_subkriteria')
               ->join('kriteria c', 'c.id_kriteria = b.id_kriteria');

      if(!empty($where)){
          foreach($where as $key => $value){
              if($value != null){
                  $this->db->where($key, $value);
              }
          }
      }

      $this->db->order_by('b.id_subkriteria', 'desc');
      return $this->db->get();
    }

    // function edit($where, $data, $detail)
    // {
    //     $this->db->trans_start();
    //     $this->db->where($where)->update('hasil_seleksi', $data);

    //     if(!empty($detail)){
    //         $this->db->insert_batch('hasil_seleksi_detail', $detail);
    //     }

    //     $this->db->trans_complete();

    //     if ($this->db->trans_status() === FALSE){
    //         $this->db->trans_rollback();
    //         return false;
    //     } else {
    //         $this->db->trans_commit();
    //         return true;
    //     }
    // }
}

?>
