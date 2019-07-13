<?php


	defined('BASEPATH') OR exit('No direct script access allowed');

	class WilayahModel extends CI_Model
	{
		function provinsi($where)
        {
            $this->db->select('*')
                     ->from('provinsi');

            if(!empty($where)){
                foreach($where as $key => $value){
                    if($value != null){
                        $this->db->where($key, $value);
                    }
                }
            }

            $this->db->order_by('id', 'desc');
            return $this->db->get();
        }

		function kabupaten($where)
        {
            $this->db->select('*')
                     ->from('kabupaten');

            if(!empty($where)){
                foreach($where as $key => $value){
                    if($value != null){
                        $this->db->where($key, $value);
                    }
                }
            }

            $this->db->order_by('id', 'desc');
            return $this->db->get();
        }

		function kecamatan($where)
        {
            $this->db->select('*')
                     ->from('kecamatan');

            if(!empty($where)){
                foreach($where as $key => $value){
                    if($value != null){
                        $this->db->where($key, $value);
                    }
                }
            }

            $this->db->order_by('id', 'desc');
            return $this->db->get();
        }

		function kelurahan($where)
        {
            $this->db->select('*')
                     ->from('kelurahan');

            if(!empty($where)){
                foreach($where as $key => $value){
                    if($value != null){
                        $this->db->where($key, $value);
                    }
                }
            }

            $this->db->order_by('id', 'desc');
            return $this->db->get();
        }
  }

  ?>
