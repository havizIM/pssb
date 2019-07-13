<?php


	defined('BASEPATH') OR exit('No direct script access allowed');

	class KriteriaModel extends CI_Model
	{
		function add($kriteria, $subkriteria)
        {
            $this->db->trans_start();
            $this->db->insert('kriteria', $kriteria);
            $this->db->insert_batch('subkriteria', $subkriteria);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }

		function edit($id_kriteria, $kriteria, $subkriteria)
        {
            $this->db->trans_start();
            $this->db->where('id_kriteria', $id_kriteria)->update('kriteria', $kriteria);
            $this->db->where('id_kriteria', $id_kriteria)->delete('subkriteria');
            $this->db->insert_batch('subkriteria', $subkriteria);
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
                     ->select("(SELECT COUNT(id_kriteria) FROM subkriteria WHERE subkriteria.id_kriteria = kriteria.id_kriteria) as jml_subkriteria")
                     ->from('kriteria');

            if(!empty($where)){
                foreach($where as $key => $value){
                    if($value != null){
                        $this->db->where($key, $value);
                    }
                }
            }

            $this->db->order_by('id_kriteria', 'desc');
            return $this->db->get();
        }

		function delete($id_kriteria)
        {
            $this->db->trans_start();
            $this->db->where('id_kriteria', $id_kriteria)->delete('kriteria');
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
			$this->db->select('*')
					 ->from('subkriteria');

            if(!empty($where)){
                foreach($where as $key => $value){
                    if($value != null){
                        $this->db->where($key, $value);
                    }
                }
            }

            $this->db->order_by('id_subkriteria', 'desc');
            return $this->db->get();
		}
  }

  ?>
