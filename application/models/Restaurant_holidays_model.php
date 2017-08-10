<?php
class Restaurant_holidays_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
	public function token($data,$token)
	{
		$query = $this->db->query("INSERT INTO `token`( `ua`, `ip`,`token`) VALUES ('".$data['User-Agent']."','".$data['ip']."','".$token."')");
		return $query;
	}	
	public function checktoken($token)
	{
		if(array_key_exists('csrf', $token)){
		$query = $this->db->query("SELECT * FROM `token` WHERE token = '".$token['csrf']."'");
		return $query->result();
		}else
		{
			return array();
		}
		
	}
}