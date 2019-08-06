<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SeleksiModel extends CI_Model {

    function show($where)
    {
      $this->db->select('a.id_seleksi, a.id_jadwal, a.keterangan, a.status_seleksi')
               ->select('b.*')
               ->select('c.status')
               ->select('d.status as status_jadwal')

               ->from('hasil_seleksi a')
               ->join('pendaftaran b', 'b.id_pendaftar = a.id_pendaftar')
               ->join('tahun_ajaran c', 'c.kd_ta = b.kd_ta')
               ->join('jadwal_seleksi d', 'd.id_jadwal = a.id_jadwal');

      if(!empty($where)){
          foreach($where as $key => $value){
              if($value != null){
                  $this->db->where($key, $value);
              }
          }
      }

      $this->db->order_by('a.id_seleksi', 'desc');
      return $this->db->get();
    }

    function edit($where, $data, $detail)
    {
        $this->db->trans_start();
        $this->db->where($where)->update('hasil_seleksi', $data);

        if(!empty($detail)){
            $this->db->insert_batch('hasil_seleksi_detail', $detail);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
}

?>
