<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deactivated_model extends CI_Model {

	public function getAllAdmins()	{

        $this->db->where('user_role', 'admin');
        $this->db->where('user_status', 0);
        return $this->db->get('pms_users')->result_array();

	}

    public function getAllCompanies() {

        $this->db->where('user_role', 'company');
        $this->db->where('user_status', 0);
        return $this->db->get('pms_users')->result_array();

    }

    public function getAllStudents() {

        $this->db->where('user_role', 'student');
        $this->db->where('user_status', 0);
        return $this->db->get('pms_users')->result_array();

    }

}
