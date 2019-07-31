<?php


	defined('BASEPATH') OR exit('No direct script access allowed');

	class TahunAjaranModel extends CI_Model
	{
		function add($tahun_ajaran, $pengaturan)
        {
            $this->db->trans_start();
            $this->db->insert('tahun_ajaran', $tahun_ajaran);
            $this->db->insert_batch('pengaturan', $pengaturan);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }

		function edit($kd_ta, $tahun_ajaran, $pengaturan)
        {
            $this->db->trans_start();
            $this->db->where('kd_ta', $kd_ta)->update('tahun_ajaran', $tahun_ajaran);
            $this->db->where('kd_ta', $kd_ta)->delete('pengaturan');
            $this->db->insert_batch('pengaturan', $pengaturan);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }

		function show($where)
        {
            $this->db->select('*')
                     ->from('tahun_ajaran');

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

		function delete($kd_ta)
        {
            $this->db->trans_start();
            $this->db->where('kd_ta', $kd_ta)->delete('tahun_ajaran');
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }

		function detail($where)
		{
            $this->db->select('a.*')
                     ->select('b.nama_kriteria')

					 ->from('pengaturan a')
					 ->join('kriteria b', 'b.id_kriteria = a.id_kriteria');

            if(!empty($where)){
                foreach($where as $key => $value){
                    if($value != null){
                        $this->db->where($key, $value);
                    }
                }
            }

            $this->db->order_by('a.id_pengaturan', 'desc');
            return $this->db->get();
		}
  }

  ?>
