<?php
class Restaurant_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
	public function getAll()
	{
		$query = $this->db->query("select *from restaurant");
		return $query->result();
	}

}