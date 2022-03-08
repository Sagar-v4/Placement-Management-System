<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function getByUser($email)
	{
		$this->db->where('user_email', $email);
        return $this->db->get('pms_users')->row_array();
	}
}
