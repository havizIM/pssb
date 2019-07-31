<?php


	defined('BASEPATH') OR exit('No direct script access allowed');

	class SubkriteriaModel extends CI_Model
	{
		function show($where)
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
