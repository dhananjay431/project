
<?php
class Restaurant_timings_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
	public function get($data)
	{
		$query = $this->db->query("SELECT * FROM `restaurant_timings` WHERE `restaurant_id` =".$data);
		return $query->result();
	}	
}
