<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PendaftaranModel extends CI_Model {

    function show($where)
    {
      $this->db->select('a.*')
               ->select('b.tahun_awal, b.tahun_akhir')
               ->select('c.nama_kelurahan')
               ->select('d.nama_kecamatan')
               ->select('e.nama_kabupaten')
               ->select('f.nama_provinsi')

               ->from('pendaftaran a')
               ->join('tahun_ajaran b', 'b.kd_ta = a.kd_ta')
               ->join('kelurahan c', 'c.id = a.id_kelurahan')
               ->join('kecamatan d', 'd.id = c.id_kecamatan')
               ->join('kabupaten e', 'e.id = d.id_kabupaten')
               ->join('provinsi f', 'f.id = e.id_provinsi');

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
      return $this->db->insert('pendaftaran', $data);
    }

    function edit($where, $data, $seleksi)
    {

        $this->db->trans_start();
        $this->db->where($where)->update('pendaftaran', $data);

        if(!empty($seleksi)){
            $this->db->insert('hasil_seleksi', $seleksi);
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
