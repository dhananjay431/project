<?php
class Restaurant_cuisines_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
	public function getById($id)
	{
		$query = $this->db->query("select *from restaurant_cuisines where `restaurant_id`=".$id);
		return $query->result();
	}

}