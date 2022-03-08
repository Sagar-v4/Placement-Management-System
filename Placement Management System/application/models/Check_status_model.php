<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check_status_model extends CI_Model {

	public function checkStatus($email)	{

		$this->db->where('user_email', $email);
        $status =  $this->db->get('pms_users')->row_array();
		return $status['user_status'];

	}
}
